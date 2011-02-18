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

class HockeyViewPlayers extends JView {

    function display($tpl = null) {

        $uri = & JFactory::getURI();
        $option = JRequest::getCmd('option');
        $mainframe = &JFactory::getApplication();

        // pobierz informację o sortowaniu oraz filtrowaniu wyników
        $filter_custom = $mainframe->getUserStateFromRequest ( $option . 'filter_custom', 'filter_custom', '', 'string' );
        $search = $mainframe->getUserStateFromRequest($option . 'search', 'search', '', 'string');
        $search = JString::strtolower($search);

        // pobierz dane z modelu players
        $items = & $this->get('Data');
        $pagination = & $this->get('Pagination');

        // pobierz dane z modelu teams
        $model = & $this->getModel('teams');
        $kluby = & $model->getAllTeamsSelect();

        // tworzenie selekta filtru //kluby
        $js = " onchange=\"if (this.options[selectedIndex].value!=''){ document.adminForm.submit(); }\" ";
        $lists ['custom'] = JHTML::_ ( 'select.genericlist', $kluby , 'filter_custom', 'class="inputbox" ' . $js, 'value', 'text', $filter_custom );

        // przypisz tekst po którym filtrujemy
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
        $title = JText::_('PLAYERS');
        $this->assignRef('title', $title);
        parent::display('head');
    }

}

?>
