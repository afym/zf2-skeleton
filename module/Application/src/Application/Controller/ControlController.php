<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ControlController extends AbstractActionController
{
    public function indexAction()
    {
        echo 'Control';
        exit;
    }

    public function listAction()
    {
        echo 'Control List';
        exit;
    }
}
