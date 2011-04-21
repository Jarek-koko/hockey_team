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
jimport('joomla.filesystem.file');
require_once( JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_hockey' . DS . 'helpers' . DS . 'position.php' );

class HockeyViewReport extends JView {

    function display($tpl = null) {
             
        $id = (int) JRequest::getVar('id', 0, 'get', 'INT');
        $tmpl =     JRequest::getVar('tmpl', '', 'get', 'string');
        $buttonback = '<a href = "javascript:history.back()"><img src="' . JURI::base(true) . '/components/com_hockey/assets/back.jpg" alt="back" /></a>';

        $mainframe = &JFactory::getApplication();
        $document = &JFactory::getDocument();

        if ($id == 0) {
            JError::raiseError(404, JText::_("Report not found"));
            return;
        }

        if ($tmpl == 'component') {
            $document->addStyleSheet(JURI::base(true) . '/components/com_hockey/assets/style.css');
            $buttonback =  '';
        }

        $document->addScript(JURI::base(true).'/components/com_hockey/assets/jquery.js' );
        $document->addScript(JURI::base(true).'/components/com_hockey/assets/jquery.tools.min.js' );

        $model = &$this->getModel();
        $model->setId($id);
        $list = $model->getList();

        if (count($list)) {
            $zawodnicy = $model->getPlayers();
            $gole = $model->getGoals();
            $penalty = $model->getPenalty();
            $goalie = $model->getGoalie();

            $params =  &$mainframe->getParams();
            $gnumber = $params->get('gnumber', 0);
            $document->setTitle($list['home'].' - '.$list['visitor'] );

            if ($gnumber == 1) {
                require_once( JPATH_COMPONENT . DS . 'helpers' . DS . 'gnumbers.php' );
                $number1 = HockeyHelperGnumbers::getNumber($list['wynik_1']);
                $number2 = HockeyHelperGnumbers::getNumber($list['wynik_2']);
            } else {
                $number1 = $list['wynik_1'];
                $number2 = $list['wynik_2'];
            }

            $this->assignRef('goalie', $goalie);
            $this->assignRef('gole', $gole);
            $this->assignRef('penalty', $penalty);
            $this->assignRef('zawodnicy', $zawodnicy);
            $this->assignRef('gnumber', $gnumber);
            $this->assignRef('number1', $number1);
            $this->assignRef('number2', $number2);
            $this->assignRef('list', $list);
            $this->assignRef('buttonback', $buttonback);

            parent::display($tpl);    // layout  default.php
            parent::display('body');  // layout  default_body.php
        }
    }
}
?>