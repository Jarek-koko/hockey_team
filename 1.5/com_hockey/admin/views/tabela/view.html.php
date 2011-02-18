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

class HockeyViewTabela extends JView {

    function display($tpl = null) {
        $uri = & JFactory::getURI();
        $option = JRequest::getCmd('option');
      
        $items = & $this->get('Data');
        $this->assignRef('items', $items);
        $this->assignRef('option', $option);
        $this->assignRef('request_url', $uri->toString());

        $this->_addToolbar();
        $this->_addTitle();
        parent::display($tpl);
    }

    function _addToolbar() {
        $info = HockeyHelperSelectSeason::getNameSez();
        JToolBarHelper::title(JText::_( 'HOCKEY' ).' : '.$info, 'logo.png' );
        JToolBarHelper::publishList ();
        JToolBarHelper::unpublishList ();
        JToolBarHelper::editList ();
        JToolBarHelper::deleteList ('HOC_HOB_DALATE_INFO');
        JToolBarHelper::addNew ();
    }

    function _addTitle() {
        $this->addTemplatePath(JPATH_COMPONENT_ADMINISTRATOR . DS . 'views' . DS . 'head');
        $title =  JText::_('TABLE');
        $this->assignRef('title', $title);
        parent::display('head');
    }
}
?>
