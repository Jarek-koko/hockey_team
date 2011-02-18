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
require_once( JPATH_COMPONENT . DS . 'helpers' . DS . 'type.php' );

class HockeyViewReport3 extends JView {

    var $_type = null;

    function display($tpl = null) {

        $id_match = (int) JRequest::getVar('id_match', 0, 'get', 'INT');
        $this->_type = (int) JRequest::getVar('type', 5, '', 'INT');
        $option = JRequest::getCmd('option');
    
        $model = &$this->getModel('reports');
        $items = $model->getGool($id_match);

        $model2 = &$this->getModel('teams');
        $team = $model2->getNameTeames($id_match);

        $sel [] = JHTML::_ ( 'select.option', 'no' ,JText::_('HOS_TEAMS_SELECT'));
        $sel [] = JHTML::_ ( 'select.option', $team ['team1'], $team ['druzyna1'] );
        $sel [] = JHTML::_ ( 'select.option', $team ['team2'], $team ['druzyna2'] );

        $this->assignRef('items', $items);
        $this->assignRef('team', $team);
        $this->assignRef('sel', $sel);
        $this->assignRef('id_match', $id_match);
        $this->assignRef('option', $option);
        $this->assignRef('type', $this->_type);

        $this->_addToolbar();
        $this->_addTitle();

        parent::display($tpl);
    }

    function _addToolbar() {
        $info = HockeyHelperSelectSeason::getNameSez();
        JToolBarHelper::title(JText::_('HOCKEY') . ' : ' . $info, 'logo.png');
        JToolBarHelper::customX ('cancel', 'back.png', 'back.png', 'back', false);
        JToolBarHelper::customX ('remove', 'delete.png', 'delete.png', 'HOC_DEL_GOALS', true);
        JToolBarHelper::customX ('save', 'apply.png', 'apply.png', 'HOC_ADD_GOALS', false);
    }

    function _addTitle() {
        $this->addTemplatePath(JPATH_COMPONENT_ADMINISTRATOR . DS . 'views' . DS . 'head');
        $title_type = HockeyHelperType::getT(  $this->_type );
        $title = JText::_('HOS_GOALS_SHOTS');
        $title = $title_type.' - '.$title;
        $this->assignRef('title', $title);
        parent::display('head');
    }
}
?>
