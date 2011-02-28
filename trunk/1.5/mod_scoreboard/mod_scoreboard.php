<?php
/*
 * @package Joomla 1.5
 * @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 *
 * @module Hockey Team - Scoreboar
 * @copyright Copyright (C) Klich Jarosław
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');
require_once (dirname(__FILE__) . DS . 'helper.php');

$list = modScoreboardHelper::getList($params);
if (!count($list)) {
    echo "<h1>Bad numer id, Match not exists</h1>";
    return;
}
$document = & JFactory::getDocument ();
$document->addScript(JURI::base(true) . '/components/com_hockey/assets/jquery.js');

$path1 = 'images/hockey/numbers/';
$path2 = 'images/hockey/teams/';
$info = $params->get('info', '');
$title = $params->get('title', 'Raport');
$width = (int) $params->get('width', 800);
$height = (int) $params->get('height', 600);
$popup = (int) $params->get('popup', 1);
$show_countdown = (int) $params->get('show_countdown', 1);
$day = (int) $params->get('day', 01);
$month = (int) $params->get('month', 01);
$year = (int) $params->get('year', 2011);
$hour = (int) $params->get('hour', 01);
$minute = (int) $params->get('minute', 01);
$second = (int) $params->get('second', 01);
$sovertime = $params->get('t_sovertime', 'sovertime');
$shoutouts = $params->get('t_shoutouts', 'shoutouts');

$mstart = $params->get('m_start', 'Match is underway');
$tday = $params->get('t_day', 'Days');
$thour = $params->get('t_hour', 'Hours');
$tminute = $params->get('t_minute', 'Minutes');
$tsecond = $params->get('t_second', 'Seconds');

$params = &JComponentHelper::getParams('com_hockey');
$gnumber = intval($params->get('gnumber', 0));

if ($gnumber == 1) {
    require_once( JPATH_ROOT . DS . 'components' . DS . 'com_hockey' . DS . 'helpers' . DS . 'gnumbers.php' ); /// digital numbers helper
    $number1 = HockeyHelperGnumbers::getNumber($list['wynik_1']);
    $number2 = HockeyHelperGnumbers::getNumber($list['wynik_2']);
} else {
    $number1 = $list['wynik_1'];
    $number2 = $list['wynik_2'];
}
require(JModuleHelper::getLayoutPath('mod_scoreboard'));
?>