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
// no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.controller');

require_once( JPATH_COMPONENT . DS . 'helpers' . DS . 'season.php' );

class MainController extends JController {

    var $_sez = null;
    var $_option = null;
    var $_type = null;
    var $_page = null;
    var $_mainframe = null;
    var $_id_match = null;

    function  __construct() {
        parent::__construct();
        $this->_mainframe = &JFactory::getApplication();
        $this->_option = JRequest::getCmd('option');
    }

    function verSez() {        
        if ($sez = HockeyHelperSelectSeason::SelSez()) {
            $this->_sez = $sez;
        } else {
            $this->_mainframe->enqueueMessage(JText::_('HOC_MUST_SELECT_SEASON'), 'notice');
            $this->_mainframe->redirect('index.php?option=' . $this->_option . '&section=select');
        }
    }

    /**
     * set $type of match
     * 0 - MATCHDAYS
     * 1 - PLAYOFF
     * 2 - SPARING AND TOURNAMENT
     */
    function setTypePage() {
        $this->_type = (int) JRequest::getVar('type', 5, '', 'INT');

        switch ($this->_type) {
            case 2:
                $this->_page = 'sparring';
                break;
            case 1:
                $this->_page = 'playoff';
                break;
            case 0:
                $this->_page = 'league';
                break;
            default:
                $this->_mainframe->redirect('index.php?option=' . $this->_option);
                break;
        }
    }

    function verIdMatch() {
        $this->_id_match = (int) JRequest::getVar ( 'id_match', 0, '', 'INT' );

        if (($this->_id_match == 0)) {
            $this->_mainframe->enqueueMessage(JText::_('ERROR ID MATCH'), 'error');
            $this->_mainframe->redirect('index.php?option=' . $this->_option . '&section='. $this->_page);
        }
    }

    function cancel() {
        $this->setRedirect('index.php?option=' . $this->_option . '&section=' . $this->_page);
    }
}
?>
