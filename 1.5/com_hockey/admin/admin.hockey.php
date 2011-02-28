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
defined ( '_JEXEC' ) or die ( 'Restricted access' );

//add style 
$document =& JFactory::getDocument();
$document->addStyleSheet(JURI::root(true).'/administrator/components/com_hockey/assets/style.css');

// Require the base controller
require_once (JPATH_COMPONENT.DS.'controller.php');

// pobieramy zmienna sekcji
$controllerName =   (string) JRequest::getVar('section',"info", 'default', 'string');

JSubMenuHelper::addEntry ( JText::_('INFO'), 'index.php?option=com_hockey',                             ("info"     === $controllerName ));
JSubMenuHelper::addEntry ( JText::_('MATCHES'), 'index.php?option=com_hockey&section=league',           ("league"   === $controllerName ));
JSubMenuHelper::addEntry ( JText::_('PLAYOFF'), 'index.php?option=com_hockey&section=playoff',          ("playoff"  === $controllerName ));
JSubMenuHelper::addEntry ( JText::_('SPARRING'), 'index.php?option=com_hockey&section=sparring',        ("sparring" === $controllerName ));
JSubMenuHelper::addEntry ( JText::_('PLAYERS'), 'index.php?option=com_hockey&section=players',          ("players"  === $controllerName ));
JSubMenuHelper::addEntry ( JText::_('TEAMS'), 'index.php?option=com_hockey&section=teams',              ("teams"    === $controllerName ));
JSubMenuHelper::addEntry ( JText::_('REFEREES'), 'index.php?option=com_hockey&section=referees',        ("referees"  === $controllerName ));
JSubMenuHelper::addEntry ( JText::_('TABLE'), 'index.php?option=com_hockey&section=tabela',             ("tabela"   === $controllerName ));
JSubMenuHelper::addEntry ( JText::_('SEASON'), 'index.php?option=com_hockey&section=sezon',             ("sezon"    === $controllerName ));
JSubMenuHelper::addEntry ( JText::_('SELECTSEASON'), 'index.php?option=com_hockey&amp;section=select',  ("select"   === $controllerName ));


if (file_exists ( JPATH_COMPONENT . DS . 'controllers' . DS . $controllerName . '.php' )) {
	require_once (JPATH_COMPONENT . DS . 'controllers' . DS . $controllerName . '.php');
} else {
	require_once (JPATH_COMPONENT . DS . 'controllers' . DS . 'info.php');
}

$controllerName = 'HockeyController' . ucfirst ( $controllerName );
// Create the controller
$controller = new $controllerName ( );

JResponse::setHeader ( 'Expires', 'Mon, 26 Jul 1997 05:00:00 GMT', true );
// Perform the Request task
$controller->execute ( JRequest::getCmd ( 'task' ) );

// Redirect if set by the controller
$controller->redirect ();
?>