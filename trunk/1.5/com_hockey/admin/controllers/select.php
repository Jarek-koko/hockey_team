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

class HockeyControllerSelect extends JController {

    function __construct($config = array()) {
        parent::__construct($config);
    }

    function display() {
       $view = JRequest::getVar('view');
	if (!$view) {
            JRequest::setVar('view', 'select');
        }
	parent::display();
    }

    function save() {
        JRequest::checkToken() or jexit('Invalid Token');

        $session = &JFactory::getSession ();
        $option = JRequest::getCmd('option');
        $id_sezonu = (int) JRequest::getVar('sez', 0, 'POST','INT');
        
        if ($id_sezonu == 0) {        
             $msg = JText::_('HOC_INFO_SEASON_NOT_SAVE');
             $type = 'error';
        } else {
           $session->set('sezon', $id_sezonu);
           $msg = JText::_('HOC_INFO_SEASON_ACTIVE');
           $type = 'message';
        }
        $link = 'index.php?option=' . $option . '&section=select' ;
        $this->setRedirect($link, $msg, $type);
    }
}
?>