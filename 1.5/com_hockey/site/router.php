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

function HockeyBuildRoute(&$query) {
    $segments = array();

    if (isset($query ['view'])) {
        $segments [] = $query ['view'];
        unset($query ['view']);
    }

    if (isset($query ['id'])) {
        $segments [] = $query ['id'];
        unset($query ['id']);
    }
    if (isset($query ['sez'])) {
        $segments [] = $query ['sez'];
        unset($query ['sez']);
    }
    return $segments;
}

function HockeyParseRoute($segments) {
    $vars = array();
    $vars ['view'] = $segments [0];

    if (count($segments) > 1) {
        $vars ['id'] = $segments [1];
        if (count($segments) > 2) {
            $vars ['sez'] = $segments [2];
        }
    }
    return $vars;
}
?>