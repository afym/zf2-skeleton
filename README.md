# ZF2 skeleton by AFYM

It is a simple implementation of Zend Framewor 2 for use of projects based on this framework.
The particularity of this implementation is that lets you create modules automatically by commands.

### Route

 This implementation allows you to work with Wildcard  type routing emulating
 the behavior of Zend Framework 1.

 Example :

 http://domain.com/module/controller/action/[param1/value1/param2/value2/..../paramn/valuen]

### Configurations

 In the config directory you can find 3 files which are :

 * application.config.php   :  Module configurations
 * external.config.php      :  Where you load your Zend Framework 2 library
 * modules.config.php       :  Project module list

 remember write the full path where ZF2 is.

### Create modules
  In this implementation  you have simple command tool to create modules inside
  your project.

  * Type :
   * cd [projectName]/data/scripts/bash/
   * php bash.php <options>

  * To create a module just for consume (php bash.php -module:create common:consume)
  * To create a module just for mvc (php bash.php -module:create user:mvc)

### Final

This implementation was made by my self base on the real skeleton of zf2.
You can find me in Zend Yellow pages:

[AFYM](http://www.zend.com/store/education/certification/yellow-pages.php#show-ClientCandidateID=ZEND018032)