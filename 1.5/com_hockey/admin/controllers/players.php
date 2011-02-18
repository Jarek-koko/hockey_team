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

// no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.controller');


class HockeyControllerPlayers extends JController {

    var $_option = null;

    function __construct($config = array()) {
        parent::__construct($config);
        $this->registerTask('add', 'edit');
        $this->registerTask('apply', 'save');
        $this->registerTask('unpublish', 'publish');
        $this->_option = JRequest::getCmd('option');
    }

    function display() {
        $view = & $this->getView('players', 'html');
        $model1 = & $this->getModel('players');
        $model2 = & $this->getModel('teams');
        $view->setModel($model1, true);
        $view->setModel($model2, false);
        $view->display();
    }

    function edit() {
        JRequest::setVar('hidemainmenu', 1);
        $view = & $this->getView('Player', 'html');
        $model1 = & $this->getModel('players');
        $model2 = & $this->getModel('teams');
        $view->setModel($model1, true);
        $view->setModel($model2, false);
        $view->display();
    }

    function save() {
        JRequest::checkToken() or jexit('Invalid Token');

        $model = $this->getModel('players');
        if ($model->store()) {
            $msg = JText::_('Item Saved');
            $type = 'message';
        } else {
            $msg = $model->getError();
            $type = 'error';
        }

        $task = JRequest::getCmd('task');
        switch ($task) {
            case 'apply' :
                $link = 'index.php?option=' . $this->_option . '&section=players&task=edit&cid[]=' . $model->getId();
                break;

            case 'save' :
            default :
                $link = 'index.php?option=' . $this->_option . '&section=players';
                break;
        }
        $this->setRedirect($link, $msg, $type);
    }

    function remove() {
        JRequest::checkToken() or jexit('Invalid Token');
        $model = $this->getModel('players');
        if ($model->delete()) {
            $msg = JText::_('Items removed');
            $type = 'message';
        } else {
            $msg = $model->getError();
            $type = 'error';
        }
        $link = 'index.php?option=' . $this->_option . '&section=players';
        $this->setRedirect($link, $msg, $type);
    }

    function publish() {
        JRequest::checkToken() or jexit('Invalid Token');
        $cid = JRequest::getVar('cid', array(0), '', 'array');
        JArrayHelper::toInteger($cid);
        $publish = ( $this->getTask() == 'publish' ? 1 : 0 );

        JTable::addIncludePath(JPATH_COMPONENT . DS . 'tables');
        $row = & JTable::getInstance('players', 'Table');

        if (!$row->publish($cid, $publish)) {
            return JError::raiseError(500, $row->getError());
        }
        $this->setRedirect('index.php?option=' . $this->_option . '&section=players');
    }

    function cancel() {
        $this->setRedirect('index.php?option=' . $this->_option . '&section=players');
    }

}

?>