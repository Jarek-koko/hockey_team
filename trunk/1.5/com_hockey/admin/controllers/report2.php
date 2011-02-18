<?php
/*
 * @package Joomla 1.5
 * @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 *
 * @component Hockey Team
 * @copyright Copyright (C) Klich Jarosław
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */
defined ( '_JEXEC' ) or die ( 'Restricted access' );
jimport ( 'joomla.application.component.controller' );


class HockeyControllerReport2 extends MainController {


    function __construct($config = array()) {
        parent::__construct ( $config );
        $this->registerTask ( 'apply', 'save' );
        $this->verSez();
        $this->setTypePage();
        $this->verIdMatch();
    }

    function display() {
        JRequest::setVar ( 'hidemainmenu', 1 );
        $view = & $this->getView('report2', 'html');
        $model1 = & $this->getModel('reports');
        $model2 = & $this->getModel('teams');
        $view->setModel($model1, true);
        $view->setModel($model2, false);
        $view->display();
    }
    
     function save() {
        JRequest::checkToken() or jexit( 'Invalid Token' );
        $model = $this->getModel('reports');
        if ($model->storeReport2()) {
            $msg = JText::_( 'Item Saved');
            $type = 'message';
        } else {
            $msg = $model->getError();
            $type = 'error';
        }
        $link = 'index.php?option=' . $this->_option . '&section='. $this->_page;
        $this->setRedirect($link, $msg, $type);
    }
}
?>