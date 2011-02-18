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
jimport('joomla.application.component.controller');

class HockeyController extends JController {

    function display() {
        if (!JRequest::getCmd('view')) {
            JRequest::setVar('view', 'reports');
        }
        $document = &JFactory::getDocument();
        $document->addStyleSheet(JURI::base(true) . '/components/com_hockey/assets/style.css');
        parent::display ();
    }
    
    // ajax metod for stats player
    function tabplayer() {
        //set format=raw !
        $document = &JFactory::getDocument();
	$doc = &JDocument::getInstance('raw');
	$document = $doc;

        $view = & $this->getView('tabplayer', 'html');
        $model = & $this->getModel('stats');
        $view->setModel($model, true);
        $view->display();
    }

    // ajax metod for module top player
    function modtop() {
         // set format=raw !
        $document = &JFactory::getDocument();
	$doc = &JDocument::getInstance('raw');
	$document = $doc;

        $view = & $this->getView('modtop', 'html');
        $model = & $this->getModel('stats');
        $view->setModel($model, true);
        $view->display();
    }
       // ajax metod for module calendare
    function modcal(){
      // set format=raw !
        $document = &JFactory::getDocument();
	$doc = &JDocument::getInstance('raw');
	$document = $doc;
        $view = & $this->getView('modcal', 'html');
        $model = & $this->getModel('modcal');
        $view->setModel($model, true);
        $view->display();
    }
        // ajax metod for module calendare
    function modmatch(){
      // set format=raw !
        $document = &JFactory::getDocument();
	$doc = &JDocument::getInstance('raw');
	$document = $doc;
        $view = & $this->getView('modmatch', 'html');
        $model = & $this->getModel('modmatch');
        $view->setModel($model, true);
        $view->display();
    }
}
?>