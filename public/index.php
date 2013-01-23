<?php
/**
 * @documentation : https://packages.zendframework.com/docs/latest/manual/en/index.html#
 */
// Error level
error_reporting(E_ALL);
ini_set('display_errors','On');
// Up a directory
chdir(dirname(__DIR__));

// Setup autoloading
$external = include 'config/external.config.php';

// Load ZF2
include $external['zend'] . '/Zend/Loader/AutoloaderFactory.php';
Zend\Loader\AutoloaderFactory::factory(array(
    'Zend\Loader\StandardAutoloader' => array(
        'autoregister_zf' => true
    )
));

// Run the application
Zend\Mvc\Application::init(include 'config/application.config.php')->run();

