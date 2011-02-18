<?php
/*
 * @package Joomla 1.5
 * @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 *
 * @component Hockey
 * @copyright Copyright (C) Klich Jarosław
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');

$listakol = $this->listakol;
$c = count($listakol);
$a = $c % 13;
$b = ($a == 0) ? 0 : 13 - $a;
$nr = $b + $c;
$boulid = '<div class="square"><p><b>' . JText::_('HOM_SELECT_MATCHDAYS') . '</b></p><table class="kol"><tr>';

for ($i = 1; $i <= $nr; $i++) {
    $boulid .= '<td>';

    if (!empty($listakol[$i - 1])) {
        if ($listakol[$i - 1] == $this->nr_kol) {
            $boulid .= '<a class="red" href="javascript:searchMach(\'' . $listakol[$i - 1] . '\')">' . $listakol[$i - 1] . '</a>';
        } else {
            $boulid .= '<a href="javascript:searchMach(\'' . $listakol[$i - 1] . '\')">' . $listakol[$i - 1] . '</a>';
        }
    } else {
        $boulid .= '--';
    }
    $boulid .= '</td>';

    if (($i % 13 == 0) && ($i != $nr))
        $boulid .= '</tr><tr>';
}
$boulid .='</tr></table></div>';

echo $boulid;
?>
