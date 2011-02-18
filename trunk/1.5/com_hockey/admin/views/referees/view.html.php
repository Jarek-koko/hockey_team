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

class HockeyViewReferees extends JView {

    function display($tpl = null) {

        $uri = & JFactory::getURI();
        $option = JRequest::getCmd('option');
        $mainframe = &JFactory::getApplication();

        $filter_custom = $mainframe->getUserStateFromRequest ( $option . 'filter_custom', 'filter_custom', '', 'string' );
        $search = $mainframe->getUserStateFromRequest($option . 'search', 'search', '', 'string');
        $search = JString::strtolower($search);

        $items = & $this->get('Data');
        $pagination = & $this->get('Pagination');

        $lists['search'] = $search;

        $this->assignRef('lists', $lists);
        $this->assignRef('items', $items);
        $this->assignRef('option', $option);
        $this->assignRef('pagination', $pagination);
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
        JToolBarHelper::deleteList ( 'HOC_QUESTION' );
        JToolBarHelper::addNew ();
    }

    function _addTitle() {
        $this->addTemplatePath(JPATH_COMPONENT_ADMINISTRATOR . DS . 'views' . DS . 'head');
        $title =  JText::_('REFEREES');
        $this->assignRef('title', $title);
        parent::display('head');
    }
}
?>
