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

    // get query post from helper selectseason
    // work with raports, table, stats, schedule-r-p,
    function querypost() {
       $idsezon = (int) JRequest::getVar('sezon', 0, 'post', 'int');
       $page =  JRequest::getVar('page', 'reports', 'post', 'word');
       $session =&JFactory::getSession();
       $session->set('idsezon',$idsezon);
       $session->clear('matchday');
       $this->setRedirect(JRoute::_('index.php?option=com_hockey&view='.$page));
    }

    // get query post from square id_matchday
    // work only with scheduler
    function querypost2() {
       $matchday = (int) JRequest::getVar('matchday', 0, 'post', 'int');
       $session =&JFactory::getSession();
       $session->set('matchday',$matchday);
       $this->setRedirect(JRoute::_('index.php?option=com_hockey&view=scheduler'));
    }

    // get query post from schedule
    // work only with schedule
    function querypost3() {
       $idsezon = (int) JRequest::getVar('sezon', 0, 'post', 'int');
       $tom =     (int) JRequest::getVar('tom', 0, 'post', 'int');
       $where =   (int) JRequest::getVar('where', 0, 'post', 'int');
       $session =&JFactory::getSession();
       $session->set('idsezon',$idsezon);
       $session->set('tom',$tom);
       $session->set('where', $where);
       $this->setRedirect(JRoute::_('index.php?option=com_hockey&view=schedule'));
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