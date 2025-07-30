<?php
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\EntityManager;

require_once __DIR__ . '/../../vendor/autoload.php';


$paths = [__DIR__ . '/../Model/Entity'];
$isDevMode = true;


$dbParams = [
    'driver'   => 'pdo_mysql',
    'host'     => 'localhost',
    'user'     => 'root',
    'password' => '',
    'dbname'   => 'games_bd',
];


$config = ORMSetup::createAnnotationMetadataConfiguration($paths, $isDevMode);

// Cria o EntityManager
$entityManager = EntityManager::create($dbParams, $config);
