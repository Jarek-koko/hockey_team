<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

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

class HockeyViewLeagueday extends JView {

    function display($tpl = null) {

        if ($this->getLayout() == 'add') {
            $this->_displayAdd($tpl);
            return;
        }

        if ($this->getLayout() == 'addnext') {
            $this->_displayAddNext($tpl);
            return;
        }
    }

    function _displayAdd($tpl = null) {

        $uri = & JFactory::getURI();
        $option = JRequest::getCmd('option');
        $mainframe = &JFactory::getApplication();

        $model = &$this->getModel('matches');
        $liczba_k = $model->getLastMatchday(0);
        $liczba_k++;

        for ($i = 1; $i <= $liczba_k; $i++) {
            $kl [] = JHTML::_('select.option', $i);
        }
        $lists ['kolejka_nr'] = JHTML::_('select.genericList', $kl, 'kolejka_nr', 'class="inputbox"', 'value', 'text', $liczba_k);

        $model = &$this->getModel('teams');
        $liczba_d = $model->getSeasonTeamsSelect();
        $liczba_d = ceil((count($liczba_d) / 2));

        for ($i = 1; $i <= $liczba_d; $i++) {
            $kk [] = JHTML::_('select.option', $i);
        }
        $lists ['liczba_s'] = JHTML::_('select.genericList', $kk, 'liczba_s', 'class="inputbox"', 'value', 'text', $liczba_d);

        $this->assignRef('lists', $lists);
        $this->assignRef('option', $option);
        $this->assignRef('request_url', $uri->toString());
        $this->_addToolbarAdd();
        parent::display($tpl);
    }

    function _displayAddNext($tpl = null) {

        $uri = & JFactory::getURI();
        $option = JRequest::getCmd('option');
        $mainframe = &JFactory::getApplication();

        $kolejka_nr = (int) JRequest::getVar('kolejka_nr', 0, 'post', 'INT');
        $liczba_s = (int) JRequest::getVar('liczba_s', 0, 'post', 'INT');
        $data = JRequest::getVar('data', '', 'post', 'STRING');

        if (($kolejka_nr == 0) || ($liczba_s == 0)) {
            $link = 'index.php?option=' . $option . '&section=league';
            $type = 'notice';
            $msg = JText::_('HOA_MUST_NR_MACHEDAY');
            $mainframe->redirect($link, $msg, $type);
        } else {
            $model = &$this->getModel('teams');
            $kl = $model->getSeasonTeamsSelect(1);

            $this->assignRef('kl', $kl);
            $this->assignRef('kolejka_nr', $kolejka_nr);
            $this->assignRef('liczba_s', $liczba_s);
            $this->assignRef('data', $data);
            $this->assignRef('option', $option);
            $this->assignRef('request_url', $uri->toString());
            $this->_addToolbarAddNext();
            parent::display($tpl);
        }
    }

    function _addToolbarAdd() {
        $info = HockeyHelperSelectSeason::getNameSez();
        JToolBarHelper::title(JText::_( 'HOCKEY' ).' : '.$info, 'logo.png' );
        JToolBarHelper::customX ( 'multipleAddNext', 'forward.png', 'forward.png', 'HOC_NEXT', false );
        JToolBarHelper::cancel ();
    }
    
    function _addToolbarAddNext() {
        $info = HockeyHelperSelectSeason::getNameSez();
        JToolBarHelper::title(JText::_( 'HOCKEY' ).' : '.$info, 'logo.png' );
        JToolBarHelper::customX ( 'multipleSave', 'save.png', 'save.png', 'Save', false );
        JToolBarHelper::cancel ();
    }
}
?>
