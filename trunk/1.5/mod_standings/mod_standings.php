<?php
/*
 * @package Joomla 1.5
 * @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 *
 * @module Hockey Team - Standings
 * @copyright Copyright (C) Klich Jarosław
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');
require_once (dirname(__FILE__).DS.'helper.php');

$rows = modStandingsHelper::getList($params);
if (!count($rows)) {
	return; 
}

$title1 = $params->get ( 'title1', 'P' );
$title2 = $params->get ( 'title2', 'Team' );
$title3 = $params->get ( 'title3', 'Ptk' );
$group1 = $params->get ( 'group1', '0' );
$group2 = $params->get ( 'group2', '1' );
$class1 = $params->get ( 'class1', 'tab20' );
$class2 = $params->get ( 'class2', 'tab21' );

require(JModuleHelper::getLayoutPath('mod_standings'));
?>