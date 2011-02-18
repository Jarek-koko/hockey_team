<?php

/*
 * @package Joomla 1.5
 * @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 *
 * @module Hockey Team - Matchdays
 * @copyright Copyright (C) Klich Jarosław
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');

$id = intval($params->get('id', 0));
$sez = intval($params->get('sez', 0));

if (($id == 0) || ($sez == 0)) {
    echo "Select season and current matchday";
    return;
}
$sname = intval($params->get('sname', 0));
$title = $params->get('title', 'Matchday');
require(JModuleHelper::getLayoutPath('mod_matchdays'));
?>