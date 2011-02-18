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

class HockeyControllerReferees extends JController {

    var $_option = null;

    function __construct($config = array()) {
        parent::__construct ( $config );
        $this->registerTask('add', 'edit');
        $this->registerTask('apply', 'save');
        $this->registerTask('unpublish', 'publish');
        $this->_option = JRequest::getCmd('option');
    }

    function display() {
        $view = JRequest::getVar('view');
        if (!$view) {
            JRequest::setVar('view', 'referees');
        }
        parent::display();
    }

    function edit() {
        JRequest::setVar('hidemainmenu', 1);
        $view = & $this->getView('Referee', 'html');
        $model = & $this->getModel('referees');
        $view->setModel($model, true);
        $view->display();
    }

    function save() {
        JRequest::checkToken() or jexit('Invalid Token');
        $model =  & $this->getModel('referees');
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
                $link = 'index.php?option=' . $this->_option . '&section=referees&task=edit&cid[]=' . $model->getId();
                break;

            case 'save' :
            default :
                $link = 'index.php?option=' . $this->_option . '&section=referees';
                break;
        }
        $this->setRedirect($link, $msg, $type);
    }

    function remove() {
        JRequest::checkToken() or jexit('Invalid Token');
        $model =  & $this->getModel('referees');
        if ($model->delete()) {
            $msg = JText::_('Items removed');
            $type = 'message';
        } else {
            $msg = $model->getError();
            $type = 'error';
        }
        $link = 'index.php?option=' . $this->_option . '&section=referees';
        $this->setRedirect($link, $msg, $type);
    }

    function publish() {
        JRequest::checkToken() or jexit('Invalid Token');
        $option = JRequest::getCmd('option');
        $cid = JRequest::getVar('cid', array(0), '', 'array');
        JArrayHelper::toInteger($cid);

        $publish = ( $this->getTask() == 'publish' ? 1 : 0 );

        JTable::addIncludePath(JPATH_COMPONENT . DS . 'tables');
        $row = & JTable::getInstance('referees', 'Table');

        if (!$row->publish($cid, $publish)) {
            return JError::raiseWarning(500, $row->getError());
        }
        $this->setRedirect('index.php?option=' . $this->_option . '&section=referees');
    }

    function cancel() {
        $this->setRedirect('index.php?option=' . $this->_option . '&section=referees');
    }
}

?>