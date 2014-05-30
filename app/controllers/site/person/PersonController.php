<?php
namespace popcorn\app\controllers\site\person;

use popcorn\app\controllers\ControllerInterface;
use popcorn\app\controllers\GenericController;
use popcorn\model\dataMaps\NewsPostDataMap;
use popcorn\model\dataMaps\NewsTagDataMap;
use popcorn\model\dataMaps\PersonDataMap;
use popcorn\model\dataMaps\PersonFanDataMap;
use popcorn\model\dataMaps\PersonImageDataMap;
use popcorn\model\dataMaps\PersonsLinkDataMap;
use popcorn\model\dataMaps\TagDataMap;
use popcorn\model\dataMaps\UserDataMap;
use popcorn\model\exceptions\NotAuthorizedException;
use popcorn\model\persons\PersonFactory;
use popcorn\model\persons\Person;
use popcorn\model\content\Image;
use popcorn\model\posts\photoArticle\PhotoArticleFactory;
use popcorn\model\posts\PostFactory;
use popcorn\model\system\users\GuestUser;
use popcorn\model\system\users\UserFactory;
use Slim\Route;

/**
 * Class PersonController
 * @package popcorn\app\controllers
 */
class PersonController extends GenericController implements ControllerInterface {

	/**
	 * @var Person
	 */
	static private $person = null;

	static protected $personId = null;

	/**
	 * Проверяем существование персоны и преобразуем имя персоны в ID из базы
	 *
	 * @param Route $route
	 */
	final public function personExistsMiddleware(Route $route) {

		$personId = PersonFactory::checkByUrl($route->getParam('name'));

		//Не нашли персону в базе, показываем 404 ошибку
		if ($personId) {
			self::$personId = $personId;
		} else {
			$this->getSlim()->notFound();
		}
	}

	public function getRoutes() {

		$slim = $this->getSlim();

		$personExists = function (Route $route) use ($slim) {
			$personId = PersonFactory::checkByUrl($route->getParam('name'));

			//Не нашли персону в базе, показываем 404 ошибку
			if ($personId) {
				self::$personId = $personId;
			} else {
				$slim->notFound();
			}
		};

		$isFan = function (Route $route) use ($slim) {

			$dataMap = new PersonFanDataMap();
			$fan = $dataMap->isFan(UserFactory::getCurrentUser(), PersonFactory::getPerson(self::$personId));

			$this->getTwig()->addGlobal('isFan', $fan);

		};

		$slim->get('/persons', [$this, 'persons']);
		$slim->get('/persons/all', [$this, 'personsAll']);

		$slim->group('/persons/:name', $personExists, $isFan, function () use ($slim) {

			/*
			$authorizationNeeded = function (Route $route) {
				if (UserFactory::getCurrentUser()->getId() > 0) {
					return true;
				}

				$this->getSlim()->error(new NotAuthorizedException());

			};
			*/

			//Главная страница персоны
			$slim->get('', [$this, 'personPage']);

			//Страница новостей персоны
			$slim->get('/news(/page:page)', function ($personUrl, $page = null) {
				if ($page == 1) {
					$this->getSlim()->redirect(sprintf('/persons/%s/news', $personUrl));
				}

				$this->newsPage(self::$personId, $page);
			});

			$slim->get('/photo', [$this, 'personPhoto']);

			$slim->group('/fans', function () use ($slim) {


				$slim->get('(/page:page)', function ($personUrl, $page = null) {
					if ($page == 1) {
						$this->getSlim()->redirect(sprintf('/persons/%s/fans', $personUrl));
					}

					$this->fansPage(self::$personId, $page);
				});

				$slim->get('/new', [$this, 'fansNewPage']);

				$slim->get('/local(/page:page)', 'popcorn\\lib\\Middleware::authorizationNeeded', function ($personUrl, $page = null) {
					if ($page == 1) {
						$this->getSlim()->redirect(sprintf('/persons/%s/fans/local', $personUrl));
					}

					$this->fansLocalPage(self::$personId, $page);
				});

				$slim->get('/subscribe', 'popcorn\\lib\\Middleware::authorizationNeeded', [$this, 'fanSubscribePage']);
				$slim->get('/unsubscribe', 'popcorn\\lib\\Middleware::authorizationNeeded', [$this, 'fanUnSubscribePage']);
			});

			$slim->group('/fanfics', function () use ($slim) {
				$slim->get('', function () {

				});

				$slim->get('/all', function () {

				});

				$slim->get('/add', function () {

				});
			});

			$slim->group('/talks', function () use ($slim) {

				$slim->get('', [new PersonTalksController(), 'talksPage']);
				$slim->get('/topic/:topicId', [new PersonTalksController(), 'topicPage']);

				$slim
					->map('/post', function () {

						if (UserFactory::getCurrentUser() instanceof GuestUser) {
							$this->getSlim()->error(new NotAuthorizedException());
						}

						$ctr = new PersonTalksController();
						$ctr->talksCreate();
					})
					->via('GET', 'POST');
			});
		});

	}

	protected static function getDefaultPerson() {
		return self::$person;
	}

	public static function setDefaultPerson($person) {
		self::$person = $person;
	}

	/**
	 * @param $personId
	 * @return array
	 */
	protected function getPersonGeneric4Twig($personId) {

		$person = PersonFactory::getPerson($personId);

		return [
			'person'     => $person,
			'personLink' => sprintf('/persons/%s', $person->getUrlName())
		];
	}

	/**
	 * Основная страница персоны
	 */
	public function personPage() {

		$person = PersonFactory::getPerson(self::$personId, ['with' => PersonDataMap::WITH_ALL]);

		//Немного новостей с персонами
		$posts = PostFactory::findByPerson($person, ['with' => PersonDataMap::WITH_NONE], 0, 6, $postsTotal);

		$photoArticles = PhotoArticleFactory::getByPerson($person, [], 0, 2, $photoArticlesTotal);

		//Связи
		{
			$linkDataMap = new PersonsLinkDataMap();
			$links = $linkDataMap->find($person->getId());
		}

		//Фотографии персоны (выводим определенную часть)
		{
			$personImageDataMap = new PersonImageDataMap();
			/** @var Image[] $images */
			$images = $personImageDataMap->findById($person->getId(), [0, 5]);

			$person->setImages($images);
		}

		//Фаны
		{
			$dataMap = new PersonFanDataMap();

			$fans['paginator'] = [0, 9];
			$fans['fans'] = $dataMap->findById(self::$personId, ['id' => 'desc'], $fans['paginator']);
		}

		//Фильмография
		$filmography = PersonFactory::getFilmography($person, 0, 7, $filmographyCount);

		$this
			->getTwig()
			->display('/person/PersonPage.twig', [
				'person'             => $person,
				'posts'              => $posts,
				'postsTotal'         => $postsTotal,
				'photoArticles'      => $photoArticles,
				'photoArticlesTotal' => $photoArticlesTotal,
				'fans'               => $fans['fans'],
				'fansTotal'          => $fans['paginator']['overall'],
				'links'              => $links,
				'filmography'        => $filmography,
				'filmographyTotal'   => $filmographyCount
			]);
	}

	/**
	 *
	 */
	public function persons() {

		$dataMap = new PersonDataMap(PersonDataMap::WITH_NONE | PersonDataMap::WITH_PHOTO);
		$persons = $dataMap->find([], 0, 9);

		$this
			->getTwig()
			->display('/person/Persons.twig', [
				'persons' => $persons
			]);
	}

	/**
	 * Все персоны
	 */
	public function personsAll() {

		$dataMap = new PersonDataMap(PersonDataMap::WITH_NONE);

		$persons = $dataMap->find([], 0, -1, ['name' => 'asc']);

		$allPersons = [];

		foreach ($persons as $person) {
			$allPersons[] = [
				'urlName'   => $person->getUrlName(),
				'name'      => $person->getName(),
				'newsCount' => $person->getNewsCount()
			];
		}

		$maxPerson = $allPersons;

		usort($maxPerson, function ($a, $b) {
			return $a['newsCount'] < $b['newsCount'];
		});

		$maxPerson = $maxPerson[0];

		foreach ($allPersons as &$person) {
			$percent = ceil($person['newsCount'] * 100 / $maxPerson['newsCount']);

			$person['size'] = ceil((22 - 11) * ($percent / 100) + 11);
		}

		$this
			->getTwig()
			->display('/person/PersonsAll.twig', [
				'persons' => $allPersons
			]);
	}

	public function personPhoto() {

		$person = PersonFactory::getPerson(self::$personId);
		$photos = PersonFactory::getPersonPhotos($person);

		$this
			->getTwig()
			->display('/person/PersonPhoto.twig', [
				'person' => $person,
				'photos' => $photos
			]);
	}


	/**
	 * Страница новостей персоны
	 */
	public function newsPage($personId, $page = null) {

		if (is_null($page)) {
			$page = 1;
		}

		$person = PersonFactory::getPerson(self::$personId, ['with' => PersonDataMap::WITH_NONE]);

		$onPage = 6;
		$posts = PostFactory::findByPerson($person, ['with' => NewsPostDataMap::WITH_MAIN_IMAGE ^ NewsPostDataMap::WITH_TAGS], ($page - 1) * $onPage, $onPage, $postsTotal);

		$this
			->getTwig()
			->display('/person/PersonNews.twig', [
				'person'    => $person,
				'posts'     => $posts,
				'paginator' => [
					'pages'  => ceil($postsTotal / $onPage),
					'active' => $page
				]
			]);
	}

	/**
	 * @param $personId
	 */
	public function photoPage($personId) {

	}

	/**
	 * Все фаны персоны
	 */
	public function fansPage($personId, $page = null) {

		if (is_null($page)) {
			$page = 1;
		}

		$person = PersonFactory::getPerson($personId);

		{
			$onPage = 50;
			$paginator = [($page - 1) * $onPage, $onPage];
		}

		$dataMap = new PersonFanDataMap();
		$users = $dataMap->findById(self::$personId, ['id' => 'asc'], $paginator);

		if ($page > $paginator['pages']) {
			$this->getSlim()->notFound();
		}

		{

			$i = 1;
			foreach ($users as &$user) {
				$user->setExtra('row', $i++ + $paginator[0]);
			}
			unset($i);
		}

		$this->getTwig()->display('/person/fans/PersonFans.twig', [
			'person'    => $person,
			'fans'      => $users,
			'customNum' => 1,
			'paginator' => [
				'pages'  => $paginator['pages'],
				'active' => $page
			]
		]);

	}

	/**
	 * Новыне фаны персоны
	 */
	public function fansNewPage() {

		$person = PersonFactory::getPerson(self::$personId);

		$dataMap = new PersonFanDataMap();

		$paginator = [0, 50];

		$users = $dataMap->findById(self::$personId, ['id' => 'desc'], $paginator);

		{

			$i = 1;
			foreach ($users as &$user) {
				$user->setExtra('row', $paginator['overall']--);
			}
			unset($i);
		}

		$this->getTwig()->display('/person/fans/PersonNewFans.twig', [
			'person'    => $person,
			'fans'      => $users,
			'customNum' => 1,
		]);

	}

	/**
	 * Фаны "в твоем городе"
	 */
	public function fansLocalPage($personId, $page = null) {

		if (is_null($page)) {
			$page = 1;
		}

		$person = PersonFactory::getPerson(self::$personId);

		{
			$onPage = 50;
			$paginator = [($page - 1) * $onPage, $onPage];
		}

		$cityId = UserFactory::getCurrentUser()->getUserInfo()->getCityId();

		$dataMap = new PersonFanDataMap();
		$users = $dataMap->find(self::$personId, ['info.cityId' => $cityId], ['id' => 'asc'], $paginator);

		if ($page > $paginator['pages']) {
			$this->getSlim()->notFound();
		}

		{
			$i = 1;
			foreach ($users as &$user) {
				$user->setExtra('row', $i++ + $paginator[0]);
			}
			unset($i);
		}

		$this->getTwig()->display('/person/fans/PersonLocalFans.twig', [
			'person'    => $person,
			'fans'      => $users,
			'customNum' => 1,
			'paginator' => [
				'pages'  => $paginator['pages'],
				'active' => $page
			]
		]);

	}

	/**
	 * Предлагаем стать поклонником
	 */
	public function fanSubscribePage() {

		$person = PersonFactory::getPerson(self::$personId);

		$dataMap = new PersonFanDataMap();

		if ($dataMap->isFan(UserFactory::getCurrentUser(), $person)) {
			$this->getSlim()->redirect(sprintf('/persons/%s/fans/unsubscribe', $person->getUrlName()));
		}

		$this->getTwig()->display('/person/fans/PersonFansSubscribe.twig', [
			'person' => $person
		]);

	}

	/**
	 * Предлагаем выйти из группы
	 */
	public function fanUnSubscribePage() {

		$person = PersonFactory::getPerson(self::$personId);

		$dataMap = new PersonFanDataMap();

		if (!$dataMap->isFan(UserFactory::getCurrentUser(), $person)) {
			$this->getSlim()->redirect(sprintf('/persons/%s/fans/subscribe', $person->getUrlName()));
		}

		$this->getTwig()->display('/person/fans/PersonFansUnSubscribe.twig', [
			'person' => $person
		]);

	}

	/**
	 * @param $personId
	 */
	public function puzzlePage($personId) {

	}

	/**
	 * @param $personId
	 */
	public function wallpaperPage($personId) {

	}

	/**
	 * @param $personId
	 */
	public function fanficsPage($personId) {

	}

	/**
	 * @param $personId
	 */
	public function factsPage($personId) {

	}


	/**
	 * @param $personId
	 */
	public function videoPage($personId) {

	}

	/**
	 * @param $personId
	 */
	public function setsPage($personId) {

	}
}