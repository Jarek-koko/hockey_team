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
?>
<table class="mday">
<thead>
 <tr><th><?php echo JText::_('HOCM_HOME') ?></th><th><?php echo JText::_('HOCM_SCORE'); ?></th><th><?php echo JText::_('HOCM_VISITOR'); ?></th></tr>
</thead>
<tbody>
<?php $k = 0;
foreach ($this->rows as $row ) :
 $style = ($k == 0)? 'row1' : 'row2';
if ($row->wynik_1==null) $row->wynik_1=' - ';
if ($row->wynik_2==null) $row->wynik_2=' - ';
?>
<tr class="<?php echo $style;?>">
    <td><?php echo $row->druzyna1; ?></td>
    <td><?php echo $row->wynik_1; ?> : <?php echo $row->wynik_2; ?></td>
    <td><?php echo $row->druzyna2; ?></td>
</tr>
<?php $k = 1- $k; endforeach; ?>
</tbody>
</table>