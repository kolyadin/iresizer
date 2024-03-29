<?php
/**
 * User: anubis
 * Date: 22.11.13 16:11
 */

namespace popcorn\cli\command\kid;


use popcorn\lib\PDOHelper;
use popcorn\model\content\ImageFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Import extends Command {

	/**
	 * @var \PDO
	 */
	private $pdo;
	/**
	 * @var \PDOStatement
	 */
	private $selector;
	/**
	 * @var \PDOStatement
	 */
	private $insert;

	protected function configure() {
		$this->setName('import:kids')
			->setDescription("Импорт детей");

		$this->pdo = PDOHelper::getPDO();
		$this->selector = $this->pdo->prepare("SELECT * FROM popcornnews.popconnews_goods_ WHERE goods_id = 68");

		$this->insert = $this->pdo->prepare("
INSERT INTO pn_kids (
  id, firstParent, secondParent,
  name, description, birthDate,
  photo, votesUp, votesDown, sex
)
VALUES (
  :id, :firstParent, :secondParent,
  :name, :description, :birthDate,
  :photo, :votesUp, :votesDown, 0
)");

	}

	protected function execute(InputInterface $input, OutputInterface $output) {

		$output->writeln('<info>Импорт детей...</info>');

		PDOHelper::truncate(['pn_kids']);

		$this->selector->execute();

		$count = 0;
		$total = $this->selector->rowCount();

		for($i = 0; $i < $total; $i++) {

			$item = $this->selector->fetch(\PDO::FETCH_ASSOC);

			$output->write("<info>Дите #".$item['id']."...");

			$this->insert->bindValue(':id', $item['id']);
			$this->insert->bindValue(':firstParent', -1);
			$this->insert->bindValue(':secondParent', -1);
			$this->insert->bindValue(':name', $item['name']);
			$this->insert->bindValue(':description', $item['pole1']);

			$bd = $item['pole7'];
			$y = substr($bd, 0, 4);
			$m = substr($bd, 4, 2);
			$d = substr($bd, 6, 2);
			$this->insert->bindValue(':birthDate', "{$y}-{$m}-{$d}");

			if ($item['pole6']){
				$kidImage = ImageFactory::createFromUrl(sprintf('http://www.popcornnews.ru/upload1/%s',$item['pole6']));
				$this->insert->bindValue(':photo', $kidImage->getId());
			}

			$this->insert->bindValue(':votesUp', $item['pole20']);
			$this->insert->bindValue(':votesDown', $item['pole21']);

			if(!$this->insert->execute()) {
				$output->writeln("</info>");
				$output->writeln("<error>".print_r($this->insert->errorInfo(), true)."</error>");
				exit;
			}
			else {
				$output->writeln("готово</info>");
			}
			$count++;

		}

		$output->writeln("<info>Импортированно {$count} детей из {$total}</info>");
		$this->selector->closeCursor();
	}

} 