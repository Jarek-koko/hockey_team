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

class HockeyViewReport6 extends JView {

    var $_type = null;

    function display($tpl = null) {

        $id_match = (int) JRequest::getVar('id_match', 0, 'get', 'INT');
        $this->_type = (int) JRequest::getVar('type', 5, '', 'INT');
        $option = JRequest::getCmd('option');

        $model = &$this->getModel('reports');
        $row = $model->getRapport($id_match);
        $ref = $model->getReferees();

        $opt [] = JHTML::_('select.option', '0', JText::_('HOS_SELECT'));
        $sedz = array_merge($opt, $ref);

        $referee [0] = JHTML::_('select.genericlist', $sedz, 'id_referee1', 'class="inputbox"', 'value', 'text', $row->id_referee1);
        $referee [1] = JHTML::_('select.genericlist', $sedz, 'id_referee2', 'class="inputbox"', 'value', 'text', $row->id_referee2);
        $referee [2] = JHTML::_('select.genericlist', $sedz, 'id_referee3', 'class="inputbox"', 'value', 'text', $row->id_referee3);
        $referee [3] = JHTML::_('select.genericlist', $sedz, 'id_referee4', 'class="inputbox"', 'value', 'text', $row->id_referee4);

        $this->assignRef('row', $row);
        $this->assignRef('referee', $referee);
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
        JToolBarHelper::customX('cancel', 'back.png', 'back.png', 'back', false);
        JToolBarHelper::save();
    }

    function _addTitle() {
        $this->addTemplatePath(JPATH_COMPONENT_ADMINISTRATOR . DS . 'views' . DS . 'head');
        $title_type = HockeyHelperType::getT(  $this->_type );
        $title = JText::_('HOS_REFEREES_SUMMARY');
        $title = $title_type.' - '.$title;
        $this->assignRef('title', $title);
        parent::display('head');
    }
}
?>
