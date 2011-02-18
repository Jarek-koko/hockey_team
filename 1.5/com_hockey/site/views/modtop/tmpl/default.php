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
$i = 1;
$show = '<table class="ttop"><tbody>';
if ($this->id == 3) {
    $rows = $this->model->getTopPlayers($this->type, $this->sez, 3);
    foreach ($rows as $row) {
        $uri = JRoute::_('index.php?option=com_hockey&view=player&id=' . $row->id);
        $show .= '<tr><td>' . $i . '</td><td class="ttop1"><a href="' . $uri . '">' . $row->nazwisko . '</a></td><td>' . $row->asysty . '</td></tr>';
        $i++;
    }
} else if ($this->id == 2) {
    $rows = $this->model->getTopPlayers($this->type, $this->sez, 2);
    foreach ($rows as $row) {
        $uri = JRoute::_('index.php?option=com_hockey&view=player&id=' . $row->id);
        $show .= '<tr><td>' . $i . '</td><td class="ttop1"><a href="' . $uri . '">' . $row->nazwisko . '</a></td><td>' . $row->bramki . '</td></tr>';
        $i++;
    }
} else {
    $rows = $this->model->getTopPlayers($this->type, $this->sez, 1);
    foreach ($rows as $row) {
        $uri = JRoute::_('index.php?option=com_hockey&view=player&id=' . $row->id);
        $show .= '<tr><td>' . $i . '</td><td class="ttop1"><a href="' . $uri . '">' . $row->nazwisko . '</a></td><td>' . $row->punkty . '</td></tr>';
        $i++;
    }
}
$show .='</tbody></table>';
echo $show;
?>