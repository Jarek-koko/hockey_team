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
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.view');
JHTML::addIncludePath(JPATH_COMPONENT . DS . 'helpers');

class HockeyViewSchedule extends JView {

    function display($tpl = null) {
      
        if ($this->getLayout() == 'scheduler') {
            $this->_displayScheduler($tpl);
            return;
        }

        if ($this->getLayout() == 'schedulep') {
            $this->_displaySchedulep($tpl);
            return;
        }

        $mainframe = &JFactory::getApplication();
        $uri = & JFactory::getURI();
        $document = & JFactory::getDocument();
        $model = &$this->getModel();
        $params = &$mainframe->getPageParameters();

        $model->setSezon($params->get('iddsfp'));

        $menus = &JSite::getMenu();
        $menu = $menus->getActive();

        $title =  JText::_('HOC_SCHEDULEALL_TITLE');
        if (is_object($menu)) {
            $menu_params = new JParameter($menu->params);
            if (!$menu_params->get('page_title'))
                $params->set('page_title', $title);
        } else {
            $params->set('page_title', $title);
        }
        $document->setTitle($params->get('page_title'));

        $sezony = $model->getData();
        $nr = count($sezony);

        if ($nr < 1) {
            JError::raiseWarning(403, JText::_('HOC_NO_SEASON'));
            return;
        }
        for ($a = 0; $a < $nr; $a++) {
            if ($sezony[$a]->value == $model->_idsezon) {
                $name_season = $sezony[$a]->text;
            }
        }
        $rows = $model->getAllList();
        $lista = JHTML::_('select.genericlist', $sezony, 'sezon', 'class="inputbox size="1" ', 'value', 'text', $model->_idsezon);

        $stom = array();
        $stom[] = JHTML::_('select.option', '0', JText::_('HOC_REGULAR_SEASON_SELECT'));
        $stom[] = JHTML::_('select.option', '1', JText::_('HOC_PLAYOFF_SELECT'));
        $stom[] = JHTML::_('select.option', '2', JText::_('HOC_PRESEASON_SELECT'));
        $tom = JHTML::_('select.genericlist', $stom, 'tom', 'class="inputbox" size="1" ', 'value', 'text', $model->_tom);


        $re = array();
        $re[] = JHTML::_('select.option', '0', JText::_('HOC_ALL_GAMES'));
        $re[] = JHTML::_('select.option', '1', JText::_('HOC_HOME_GAMES'));
        $re[] = JHTML::_('select.option', '2', JText::_('HOC_AWAY_GAMES'));
        $where = JHTML::_('select.genericlist', $re, 'where', 'class="inputbox" size="1" ', 'value', 'text', $model->_where);

        $this->assignRef('tom', $tom);
        $this->assignRef('where', $where);
        $this->assignRef('rows', $rows);
        $this->assignRef('idsezon', $model->_idsezon);
        $this->assignRef('params', $params);
        $this->assignRef('name_season', $name_season);
        $this->assignRef('lista', $lista);
        $this->assignRef('action', $uri->toString());
        parent::display('form');
        parent::display($tpl);      // layout default.php
    }

    function _displayScheduler($tpl = null) {
        
        $nr_kol = (int) JRequest::getVar('kolejka', 0, 'post', 'int');

        $mainframe = &JFactory::getApplication();
        $uri = & JFactory::getURI();
        $document = & JFactory::getDocument();
        $document->addScript(JURI::base(true) . '/components/com_hockey/assets/jquery.js');

        $model = &$this->getModel();
        $params = &$mainframe->getPageParameters();

        $model->setSezon($params->get('iddsfp'));
        //pobiera liste kolejek
        $list = $model->getListMatchday(0);

        // if nr matchday is not select then get first
        if ($list) {
            $nr_kol = (in_array($nr_kol, $list) ? $nr_kol : $list[0]);
        }

        // list matches in matchday
        $rows = $model->getListMatches($nr_kol, 0);

        $menus = &JSite::getMenu();
        $menu = $menus->getActive();

        $title =  JText::_('HOC_SCHEDULER_TITLE');
        if (is_object($menu)) {
            $menu_params = new JParameter($menu->params);
            if (!$menu_params->get('page_title'))
                $params->set('page_title', $title);
        } else {
            $params->set('page_title', $title);
        }
        $document->setTitle($params->get('page_title'));

        $sezony = $model->getData();
        $nr = count($sezony);

        if ($nr < 1) {
            JError::raiseWarning(403, JText::_('HOC_NO_SEASON'));
            return;
        }
        for ($a = 0; $a < $nr; $a++) {
            if ($sezony[$a]->value == $model->_idsezon) {
                $name_season = $sezony[$a]->text;
            }
        }

        $lista = JHTML::_('select.genericlist', $sezony, 'sezon', 'class="inputbox" size="1"', 'value', 'text', $model->_idsezon);
        $select_season = JHTML::_('Selectseason.getSelect', $lista, $menu->query['view'], $uri->toString());


        $this->assignRef('list', $list);
        $this->assignRef('rows', $rows);
        $this->assignRef('nr_kol', $nr_kol);
        $this->assignRef('idsezon', $model->_idsezon);
        $this->assignRef('params', $params);
        $this->assignRef('action', $uri->toString());
        $this->assignRef('view', $menu->query['view']);
        $this->assignRef('name_season', $name_season);
        $this->assignRef('select_season', $select_season);
        parent::display($tpl);      // layout scheduler.php
    }

    function _displaySchedulep($tpl = null) {
   
        $uri = & JFactory::getURI();
        $document = & JFactory::getDocument();
        $model = &$this->getModel();
        $mainframe = &JFactory::getApplication();
        $params = &$mainframe->getPageParameters();

        $model->setSezon($params->get('iddsfp'));
        // list matches in matchday
        $rows = $model->getListPlayoff();

        $menus = &JSite::getMenu();
        $menu = $menus->getActive();

        $title =  JText::_('HOC_SCHEDULEP_TITLE');
        if (is_object($menu)) {
            $menu_params = new JParameter($menu->params);
            if (!$menu_params->get('page_title'))
                $params->set('page_title', $title);
        } else {
            $params->set('page_title', $title);
        }
        $document->setTitle($params->get('page_title'));

        $sezony = $model->getData();
        $nr = count($sezony);

        if ($nr < 1) {
            JError::raiseWarning(403, JText::_('HOC_NO_SEASON'));
            return;
        }
        
        for ($a = 0; $a < $nr; $a++) {
            if ($sezony[$a]->value == $model->_idsezon) {
                $name_season = $sezony[$a]->text;
            }
        }

        $lista = JHTML::_('select.genericlist', $sezony, 'sezon', 'class="inputbox" size="1"', 'value', 'text', $model->_idsezon);
        $select_season = JHTML::_('Selectseason.getSelect', $lista, $menu->query['view'], $uri->toString());

        $this->assignRef('rows', $rows);
        $this->assignRef('idsezon', $model->_idsezon);
        $this->assignRef('params', $params);
        $this->assignRef('name_season', $name_season);
        $this->assignRef('select_season', $select_season);
        parent::display($tpl);      // layout schedulep.php
    }
}
?>