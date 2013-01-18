<?php
// Up a directory
chdir(dirname(__DIR__));

// Setup autoloading
$external = include 'config/external.php';

if (is_dir($external['zend'])) {
    set_include_path(get_include_path() . PATH_SEPARATOR . $external['zend']);
} else {
    throw new Exception('ZF2 could not load.');
}
// Load ZF2 
include '/Zend/Loader/AutoloaderFactory.php';
Zend\Loader\AutoloaderFactory::factory(array(
    'Zend\Loader\StandardAutoloader' => array(
        'autoregister_zf' => true
    )
));

// Run the application!
Zend\Mvc\Application::init(include 'config/application.php')->run();

