<?php

namespace popcorn\cli;

use popcorn\cli\command;
use popcorn\cli\entity\CommunityEntity;
use popcorn\cli\entity\GeneratorEntity;
use popcorn\cli\entity\KidEntity;
use popcorn\cli\entity\PersonEntity;
use popcorn\cli\entity\PollEntity;
use popcorn\cli\entity\PostEntity;
use popcorn\cli\entity\UserEntity;
use Symfony\Component\Console\Application;

setlocale(LC_TIME, 'ru_RU.utf8');
date_default_timezone_set('Europe/Moscow');

include '../vendor/autoload.php';

class PopcornCliApp extends Application {

	static $cliPath;

	function __construct() {
		parent::__construct('Popcorn CLI Application', '1.0');
	}
}

$cliApp = new PopcornCliApp();

$cliApp->addCommands(PersonEntity::getCommands());
$cliApp->addCommands(PostEntity::getCommands());
$cliApp->addCommands(UserEntity::getCommands());
$cliApp->addCommands(GeneratorEntity::getCommands());
$cliApp->addCommands(KidEntity::getCommands());
$cliApp->addCommands(CommunityEntity::getCommands());
$cliApp->addCommands(PollEntity::getCommands());

$cliApp->run();