<?php

/*
 * @package Joomla 1.5
 * @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 *
 * @component Hockey
 * @copyright Copyright (C) Klich Jarosław
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.controller');

class HockeyControllerSparring extends MainController {

    function __construct($config = array()) {
        parent::__construct($config);
        $this->registerTask('apply', 'save');
        $this->registerTask('add', 'edit');
        $this->registerTask('unpublish', 'publish');
        $this->verSez();
    }

    function display() {
        $view = & $this->getView('sparring', 'html');
        $model1 = & $this->getModel('matches');
        $model2 = & $this->getModel('teams');
        $view->setModel($model1, true);
        $view->setModel($model2, false);
        $view->display();
    }

    function edit() {
        JRequest::setVar('hidemainmenu', 1);
        $view = & $this->getView('sparring', 'html');
        $model1 = & $this->getModel('matches');
        $model2 = & $this->getModel('teams');
        $view->setModel($model1, true);
        $view->setModel($model2, false);
        $view->setLayout('edit');
        $view->display();
    }

    function save() {
        JRequest::checkToken() or jexit('Invalid Token');
        $model = $this->getModel('matches');
        if ($model->store()) {
            $msg = JText::_('Item Saved');
            $type = 'message';
        } else {
            $msg = $model->getError();
            $type = 'error';
        }
        $link = 'index.php?option=' . $this->_option . '&section=sparring';
        $this->setRedirect($link, $msg, $type);
    }

    function remove() {
        JRequest::checkToken() or jexit('Invalid Token');
        $model = $this->getModel('matches');
        if ($model->delete()) {
            $msg = JText::_('Items removed');
            $type = 'message';
        } else {
            $msg = $model->getError();
            $type = 'error';
        }
        $link = 'index.php?option=' . $this->_option . '&section=sparring';
        $this->setRedirect($link, $msg, $type);
    }

    function publish() {
        JRequest::checkToken() or jexit('Invalid Token');
        $cid = JRequest::getVar('cid', array(0), '', 'array');
        JArrayHelper::toInteger($cid, array(0));

        $publish = ( $this->getTask() == 'publish' ? 1 : 0 );

        JTable::addIncludePath(JPATH_COMPONENT . DS . 'tables');
        $row = & JTable::getInstance('match', 'Table');

        if (!$row->publish($cid, $publish)) {
            return JError::raiseError(500, $row->getError());
        }
        $this->setRedirect('index.php?option=' . $this->_option . '&section=sparring');
    }

    function cancel() {
        $this->setRedirect('index.php?option=' . $this->_option . '&section=sparring');
    }

}

?>
