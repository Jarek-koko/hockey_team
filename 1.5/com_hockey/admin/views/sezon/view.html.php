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

class HockeyViewSezon extends JView {

    function display($tpl = null) {

        if ($this->getLayout() == 'confirm') {
            $this->_displayConfirm($tpl);
            return;
        }
       
        if ($this->getLayout() == 'edit') {
            $this->_displayEdit($tpl);
            return;
        }
      
        if ($this->getLayout() == 'add') {
            $this->_displayAdd($tpl);
            return;
        }
        return;
    }

    function _displayEdit($tpl = null) {
        $option = JRequest::getCmd('option'); 
   
        $model2 = &$this->getModel('sezon');
        $row = $model2->getSezon();

        if (!$row) {
            $msg = $model2->getError();
            $link = 'index.php?option=' . $option . '&section=sezon';
            $type = 'error';
            $mainframe = &JFactory::getApplication();
            $mainframe->redirect($link, $msg, $type);
        }
   
        $model = &$this->getModel('teams');
        $cid = JRequest::getVar('cid', array(0), '', 'array');
        JArrayHelper::toInteger($cid, array(0));
        $kl = $model->getSeasonTeamsSelect(NULL, $cid[0]);
    
        $lists[] = JHTML::_('select.genericList', $kl, 'myteam', 'class="inputbox"', 'value', 'text', $row->myteam);

        //numbers for select
        $items = range(0, 10);
        foreach ($items as $item) {
            $pozycja[] = JHTML::_('select.option', $item);
        }

        $this->assignRef('lists', $lists);
        $this->assignRef('row', $row);
        $this->assignRef('option', $option);
        $this->assignRef('pozycja', $pozycja);
        $this->_addToolbarEdit();
        parent::display($tpl);
    }

   
    function _displayAdd($tpl = null) {
        $option = JRequest::getCmd('option');

        //models/teams
        $model = &$this->getModel('teams');
        $kluby = $teams = $model->getAllTeamsArray();

        $kl[] = JHTML::_('select.option', '0', JText::_('HOC_SELECT_TEAM_FILTR'));
        foreach ($teams as $team) {
            $kl [] = JHTML::_('select.option', $team['id'], $team['name']);
        }

        $teams = JHTML::_('select.genericList', $kl, 'myteam', 'class="inputbox validate-notzero"', 'value', 'text');

        //numbers for select
        $items = range(0, 10);
        foreach ($items as $item) {
            $pozycja[] = JHTML::_('select.option', $item);
        }

        $this->assignRef('pozycja', $pozycja);
        $this->assignRef('option', $option);
        $this->assignRef('teams', $teams);
        $this->assignRef('kluby', $kluby);
        $this->_addToolbarAdd();
        parent::display($tpl);
    }

    function _displayConfirm($tpl = null) {
        $option = JRequest::getCmd('option');
        $model = $this->getModel('sezon');

        if ($items = $model->getNameSezon()) {
            $this->assignRef('option', $option);
            $this->assignRef('items', $items);
            $this->_addToolbarConfirm();
            parent::display($tpl);
        } else {
            $msg = $model->getError();
            $type = 'error';
            $link = 'index.php?option=' . $option . '&section=sezon';
            $mainframe = & JFactory::getApplication();
            $mainframe->redirect($link, $msg, $type);
        }
    }

    function _addToolbarAdd(){
        JToolBarHelper::title(JText::_( 'HOCKEY' ), 'logo.png' );
        JToolBarHelper::save ();
        JToolBarHelper::cancel ();
    }

    function _addToolbarConfirm(){ 
        JToolBarHelper::title(JText::_( 'HOCKEY' ), 'logo.png' );
        JToolBarHelper::cancel ();
    }

    function _addToolbarEdit() {
        JToolBarHelper::title(JText::_('HOCKEY'), 'logo.png');
        JToolBarHelper::save('update');
        JToolBarHelper::cancel ();
    }
}
?>

