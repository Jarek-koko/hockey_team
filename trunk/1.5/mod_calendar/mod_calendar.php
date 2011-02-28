<?php
/*
 * @package Joomla 1.5
 * @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 *
 * @module Hockey Team - Calendar
 * @copyright Copyright (C) Klich Jarosław
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
require_once( dirname(__FILE__).DS.'helper.php' );
$document = & JFactory::getDocument ();
$document->addScript(JURI::base(true) . '/components/com_hockey/assets/jquery.js');

$add_month          = $params->get( 'add_month', '0' );
$show_tooltips      = $params->get( 'show_tooltips', '1' );

$uri            =& JFactory::getURI();
$config         =& JFactory::getConfig();
$tzoffset       = $config->getValue('config.offset');
$time           = time()  + ($tzoffset*60*60);
$today_month    = date( 'm', $time); //1
$today_year     = date( 'Y', $time); //2011
$today          = date( 'j',$time); //26

$post_month 	= (int)JRequest::getVar( 'month', 0, 'post','int');
$post_year      = (int)JRequest::getVar( 'year', 0, 'post','int');

if (($post_month < 1) OR ($post_month > 12) OR ($post_month == 0)) { $post_month = $today_month; }

if (($post_year < 1970) OR ($post_year > 2500) OR ($post_year == 0)) { $post_year = $today_year; }

$post_month = $post_month + $add_month;
if ($post_month >12) { $post_month = $post_month -12; $post_year = $post_year + 1;}

$prev_year = $post_year;
$next_year = $post_year;

$prev_month = $post_month-1;
if($prev_month < 1) { $prev_month = 12; $prev_year = $prev_year-1;}

$next_month = $post_month+1;
if($next_month > 12) { $next_month = 1; $next_year = $next_year+1;}

//Links nav
$back = '<a class="qprev" href="javascript:submitForm('.$prev_month.','.$prev_year.')"><img src="'.JURI::base(true).'/components/com_hockey/assets/prev.png" alt="prev" /></a>';
$next = '<a class="qnext" href="javascript:submitForm('.$next_month.','.$next_year.')"><img src="'.JURI::base(true).'/components/com_hockey/assets/next.png" alt="next" /></a>';

$first_of_month = gmmktime(0, 0, 0, $post_month, 1, $post_year);
list($month, $post_year, $weekday) = explode(',', gmstrftime('%m,%Y,%w', $first_of_month));
$weekday = ($weekday + 6 ) % 7;
$title   = JString::strtoupper(date('F',mktime(0,0,0,$month +1,0,0)));

$days = modcalendarHelper::getmatchdays($post_month, $post_year, $params);
require( JModuleHelper::getLayoutPath( 'mod_calendar'));
?> 