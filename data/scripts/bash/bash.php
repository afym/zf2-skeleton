<?php
/**
 * @link      http://github.com/afym/zf2-skeleton
 * @copyright Copyright (c) 2005-2013 AFYM
 * @license   New BSD License
 */
if (count($argv) > 1) {
    $parseCommand = str_replace('-', '', $argv[1]);

    switch ($parseCommand) {
        case 'help':
            help();
            break;
        case 'module:list':
            listModule();
            break;
        case 'module:create':
            $module = explode(':', $argv[2]);
            if (count($module) == 2) {
                $name = ucwords($module[0]);
                $type = $module[1];
                $modulePath = __DIR__ . '/../../../module/';
                $moduleList = getModules();

                if (!in_array($name, $moduleList)) {
                    $modulePathToCreate = $modulePath . $name;
                    switch ($type) {
                        case 'consume':
                            moduleDirCreate($modulePathToCreate, $name);
                            createFiles($modulePathToCreate, $type, $name);
                            registerModule($name);
                            echo "Your consume module {$name} was created correctly.\n";
                            break;
                        case 'mvc':
                            moduleDirCreate($modulePathToCreate, $name, $type);
                            createFiles($modulePathToCreate, $type, $name);
                            registerModule($name);
                            echo "Your mvc module {$name} was created correctly.\n";
                            break;
                            break;
                        default :
                            echo "You must type mvc or consume type.\n";
                            break;
                    }
                } else {
                    echo "The module '{$name}' has already exist in your project.\n";
                }
            } else {
                echo "You must type a module and type (module:type)\n";
            }
            break;
        default :

            break;
    }
} else {
    help();
}

function getModules()
{
    return include(__DIR__ . '/../../../config/modules.config.php');
}

function listModule()
{
    echo "Modules in your application : \n\n";
    foreach (getModules() as $module) {
        echo "$module \n";
    }
}

function help()
{
    $help = file_get_contents(__DIR__ . '/bases/help.txt');
    echo $help;
}

function moduleDirCreate($modulePathToCreate, $name, $type = 'consume')
{
    $paths = array(
        $modulePathToCreate,
        $modulePathToCreate . '/config',
        $modulePathToCreate . '/src/',
        $modulePathToCreate . '/src/' . $name,
        $modulePathToCreate . '/view'
    );

    if ($type == 'mvc') {
        $paths[] = $modulePathToCreate . '/src/' . $name . '/Controller';
        $paths[] = $modulePathToCreate . '/view/' . strtolower($name);
        $paths[] = $modulePathToCreate . '/view/' . strtolower($name) . '/index';
    }

    foreach ($paths as $path) {
        mkdir($path, 0777);
    }
}

function createFiles($modulePathToCreate, $type, $name)
{
    if ($type == 'consume') {
        $paths = array(
            $modulePathToCreate . '/config/service.config.php',
            $modulePathToCreate . '/config/module.config.php',
            $modulePathToCreate . '/Module.php'
        );

        $contens = array(
            file_get_contents(__DIR__ . '/bases/standar.txt'),
            file_get_contents(__DIR__ . '/bases/standar.txt'),
            file_get_contents(__DIR__ . '/modules/consume.txt'),
        );
    } else if ($type == 'mvc') {
        $paths = array(
            $modulePathToCreate . '/config/service.config.php',
            $modulePathToCreate . '/config/module.config.php',
            $modulePathToCreate . '/config/helper.config.php',
            $modulePathToCreate . '/config/controller.config.php',
            $modulePathToCreate . '/config/plugin.config.php',
            $modulePathToCreate . '/src/' . $name . '/Controller/IndexController.php',
            $modulePathToCreate . '/view/' . strtolower($name) . '/index/index.phtml',
            $modulePathToCreate . '/Module.php'
        );

        $contens = array(
            file_get_contents(__DIR__ . '/bases/standar.txt'),
            file_get_contents(__DIR__ . '/config/module.txt'),
            file_get_contents(__DIR__ . '/bases/standar.txt'),
            file_get_contents(__DIR__ . '/config/controller.txt'),
            file_get_contents(__DIR__ . '/bases/standar.txt'),
            file_get_contents(__DIR__ . '/bases/controller.txt'),
            file_get_contents(__DIR__ . '/bases/view.txt'),
            file_get_contents(__DIR__ . '/modules/mvc.txt'),
        );
    }

    foreach ($paths as $pathKey => $path) {
        $open = fopen($path, 'a+');
        $content = str_replace('{module}', $name, $contens[$pathKey]);

        if ($type == 'mvc') {
            $mvc = str_replace('{module-lower}', strtolower($name), $content);
            fwrite($open, $mvc);
        } else {
            fwrite($open, $content);
        }

        fclose($open);
    }
}

function registerModule($name)
{
    $moduleFile = file_get_contents(__DIR__ . '/config/modules.txt');
    $path = __DIR__ . '/../../../config/modules.config.php';
    $modules = '';

    foreach (getModules() as $module) {
        $modules .= "'{$module}',\n";
    }

    $modules .= "    '{$name}',";

    $open = fopen($path, 'r+');
    $content = str_replace('{modules}', $modules, $moduleFile);
    fwrite($open, $content);
    fclose($open);
}