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

class HockeyViewSparring extends JView {

    function display($tpl = null) {

        if ($this->getLayout() == 'edit') {
            $this->_displayEdit($tpl);
            return;
        }
        
        $uri = & JFactory::getURI();
        $option = JRequest::getCmd('option');
         // get model
        $model  = &$this->getModel('matches');
        $model2 = &$this->getModel('teams');
        // get mytheam
        $myteam =  $model2->getMyTeam();
       // list matches in matchday
        $items = $model->getListMatches(1,2);
   
        $this->assignRef('myteam', $myteam);
        $this->assignRef('items', $items);
        $this->assignRef('option', $option);
        $this->assignRef('request_url', $uri->toString());
        $this->_addToolbar();
        $this->_addTitle();
        parent::display($tpl);
    }

    function _displayEdit($tpl = null) {
        $option = JRequest::getCmd('option');
        $mainframe = &JFactory::getApplication();
        $sez = HockeyHelperSelectSeason::SelSez();

        $kolejka_nr = JRequest::getVar('kol', 0, 'post', 'INT');
        $cid = JRequest::getVar('cid', array(0), '', 'array');
        JArrayHelper::toInteger($cid, array(0));


        $task = JRequest::getCmd('task');

        // ================= add ===========================================
        if ($task == 'add') {
            // get model
            $model = &$this->getModel('teams');
            $kl = $model->getSeasonTeamsSelect();
            //get match info
            JTable::addIncludePath(JPATH_COMPONENT . DS . 'tables');
            $row = & JTable::getInstance('match', 'Table');
            $row->load(0);

            $this->assignRef('kolejka_nr', $kolejka_nr = null);
            $this->assignRef('row', $row);
            $this->assignRef('option', $option);
            $this->assignRef('kl', $kl);
            $this->assignRef('sez', $sez);
            $this->_addToolbarEdit();
            parent::display($tpl);
        }

        // ============= edit ===============================================
        if ($task == 'edit') {
            if (($kolejka_nr == 0) or ($cid == array(0))) {
                $link = 'index.php?option=' . $option . '&section=sparring';
                $type = 'notice';
                $msg = JText::_('HOM_MUST_SELECT_MATCHDAY');
                $mainframe->redirect($link, $msg, $type);
            } else {
                // get model
                $model = &$this->getModel('teams');
                $kl = $model->getSeasonTeamsSelect();

                //get match info
                JTable::addIncludePath(JPATH_COMPONENT . DS . 'tables');
                $row = & JTable::getInstance('match', 'Table');
                $row->load($cid [0]);

                //czy wynik został  zapisany
                if (($row->wynik_1 == null) and ($row->wynik_2 == null )) {
                    $this->assignRef('kolejka_nr', $kolejka_nr);
                    $this->assignRef('row', $row);
                    $this->assignRef('option', $option);
                    $this->assignRef('kl', $kl);
                    $this->assignRef('sez', $sez);
                    $this->_addToolbarEdit();
                    parent::display($tpl);
                } else {
                    $link = 'index.php?option=' . $option . '&section=sparring';
                    $type = 'notice';
                    $msg = JText::_('HOM_NOT_ALLOWED');
                    $mainframe->redirect($link, $msg, $type);
                }
            }
        }
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
        $title = JText::_('SPARRING');
        $this->assignRef('title', $title);
        parent::display('head');
    }

    function _addToolbarEdit() {
        $info = HockeyHelperSelectSeason::getNameSez();
        JToolBarHelper::title(JText::_( 'HOCKEY' ).' : '.$info, 'logo.png' );
        JToolBarHelper::save ();
        JToolBarHelper::cancel ();
    }
}
?>
