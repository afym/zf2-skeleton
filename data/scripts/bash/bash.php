<?php
/*
 * 
 */
print_r($argv);

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
                            break;
                        case 'type':
                            break;
                        default :
                            echo "You must type mvc or consume type.";
                            break;
                    }
                } else {
                    echo "The module '{$name}' has already exist in your project.";
                }
            } else {
                echo "You must type a module and type (module:type)";
            }
            break;
        default :
            
            break;
    }
} else {
    help();
}
function createModule()
{
    
}
function getModules()
{
    $application = include(__DIR__ . '/../../../config/application.php');
    return $application['modules'];
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
    $help = file_get_contents(__DIR__ . '/help.txt');
    echo $help;
}

function moduleDirCreate($modulePathToCreate, $name)
{
    $paths = array(
        $modulePathToCreate,
        $modulePathToCreate . '/config',
        $modulePathToCreate . '/src/',
        $modulePathToCreate . '/src/' . $name,
        $modulePathToCreate . '/view'
    );
    foreach ($paths as $path) {
        mkdir($path, 0777);
    }
}

function createFiles($modulePathToCreate, $type, $name)
{
    if ($type == 'consume') {
        $paths = array(
            $modulePathToCreate . '/config/' . 'service.config.php',
            $modulePathToCreate . '/config/' . 'module.config.php',
            $modulePathToCreate . '/Module.php'
        );

        $contens = array(
            file_get_contents(__DIR__ . '/service.txt'),
            file_get_contents(__DIR__ . '/module.txt'),
            file_get_contents(__DIR__ . '/module.simple.txt'),
        );   
    } else if ($type == 'mvc') {
         $contens = array(
            file_get_contents(__DIR__ . '/service.txt'),
            file_get_contents(__DIR__ . '/module.txt'),
            file_get_contents(__DIR__ . '/module.mvc.txt'),
        ); 
    }

    foreach ($paths as $pathKey => $path) {
        $open = fopen($path, 'a+');
        $content = str_replace('{module}', $name, $contens[$pathKey]);
        fwrite($open, $content);
        fclose($open);
    }
}
    //$hyphen = strpos($argument, '-');
    //$colon  = strpos($argument, ':');