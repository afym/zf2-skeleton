<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\Adapter\Adapter;
use Migration\Postgres\Definition;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }

    public function saludoAction()
    {   
        $config = array(
            'driver'   => 'pgsql',
            'database' => 'blanco',
            'hostname' => '192.168.1.103',
            'port'     => '5432',
            'username' => 'admin',
            'password' => 'Sql$2012'
        );
        
        $db = new Adapter($config);
        echo "<h2>Migration Module : </h2>";
        $definition = new Definition();
        echo $definition->createTable('paises');
        echo "<br/>";
        echo $definition->addColumn('paises', 'id', 'varchar(60)', array('null' => false, 'default' => 'nextval(seq)', 'unique' => true));
        echo "<br/>";
        echo $definition->dropTable('usuarios');
        echo "<br/>";
        echo $definition->createPrimaryKey('usuario', array('id', 'codigo'));
        echo "<br/>";
        echo $definition->createForeignKey('usuario', 'usuario_tipo_id', array('table' => 'usuario_tipo', 'field' =>'id'));
        echo "<br/>";

        //$db->query("$create", Adapter::QUERY_MODE_EXECUTE);
        exit;
        //return new ViewModel();
    }
}
