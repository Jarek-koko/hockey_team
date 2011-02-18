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
jimport('joomla.application.component.view');

class HockeyViewSelect extends JView {

    function display($tpl = null) {

        $mainframe = &JFactory::getApplication();
        $option = JRequest::getCmd('option');

        $ArrayOfSezon = $this->get('Sezon');
        $number = count($ArrayOfSezon);
     
        if ($number == 0) {
            $msg = JText::_('HOC_NO_MORE_SEASON_ACTIVE');
            $mainframe->enqueueMessage($msg, 'error');
            $mainframe->redirect('index.php?option=' . $option . '&section=sezon');
        } else { 
            $this->assignRef('option', $option);
            $this->assignRef('sezons', $ArrayOfSezon);
      
            $this->_addToolbar();
            $this->_addTitle();
            parent::display($tpl);
        }
    }

    function _addToolbar() {
        $info = HockeyHelperSelectSeason::getNameSez();
        JToolBarHelper::title(JText::_( 'HOCKEY' ).' : '.$info, 'logo.png' );
        JToolBarHelper::customX ( 'save', 'apply.png', 'apply.png', 'SELECT', false );
    }

    function _addTitle() {
        $this->addTemplatePath(JPATH_COMPONENT_ADMINISTRATOR . DS . 'views' . DS . 'head');
        $title = JText::_('SELECTSEASON');
        $this->assignRef('title', $title);
        parent::display('head');
    }
}
?>

