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

class HockeyViewReport1 extends JView {

    var $_type = null;
    var $_uscore = null;
    

    function display($tpl = null) {

        $id_match =  (int) JRequest::getVar ( 'id_match', 0, 'get', 'INT' );
        $this->_type  =  (int) JRequest::getVar('type', 5, '', 'INT');
        $option = JRequest::getCmd('option');
        
        $model = &$this->getModel('reports');
        $infoSP = $model->getInfoSP();

        //get info aboute match
        JTable::addIncludePath ( JPATH_COMPONENT . DS . 'tables' );
        $row = & JTable::getInstance ( 'match', 'Table' );
        $row->load ( $id_match);

        $model2 = &$this->getModel('teams');
        $row->druzyna1 = $model2->getNameTeam($row->druzyna1);
        $row->druzyna2 = $model2->getNameTeam($row->druzyna2);
        $this->_uscore = $row->uscore;

        $dnot = (($this->_uscore == 1) AND ($this->_type == 0)) ? '<div id="dnot">'.JText::_('HOC_DO_NOT_CHANGE_SCORE').'</div>' : '';

        $this->assignRef('row', $row);
        $this->assignRef('dnot' , $dnot);
        $this->assignRef('infoSP', $infoSP);
        $this->assignRef('option', $option);
        $this->assignRef('type', $this->_type);

        $this->_addToolbar();
        $this->_addTitle();

        parent::display($tpl);
    }

    function _addToolbar() {
        $info = HockeyHelperSelectSeason::getNameSez();
        JToolBarHelper::title(JText::_( 'HOCKEY' ).' : '.$info, 'logo.png' );
        JToolBarHelper::customX ( 'cancel', 'back.png', 'back.png', 'back', false );
     
        if  (($this->_type == 0) && ($this->_uscore == 0)) {
            JToolBarHelper::divider();
            JToolBarHelper::customX ( 'update', 'update.png', 'update.png', 'Update standings', false );
            JToolBarHelper::divider(); 
        }
         JToolBarHelper::save();
         JToolBarHelper::apply();
    }

    function _addTitle() {
        $this->addTemplatePath(JPATH_COMPONENT_ADMINISTRATOR . DS . 'views' . DS . 'head');
        $title_type = HockeyHelperType::getT(  $this->_type );
        $title = JText::_('HOS_RESULT_THE_MATCH');
        $title = $title_type.' - '.$title;
        $this->assignRef('title', $title);
        parent::display('head');
    }
}
?>
