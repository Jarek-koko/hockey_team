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
?>
<div class="componentheading"><?php echo JText::_('HOC_SCHEDULER_TITLE'); ?> - <?php echo $this->name_season; ?></div>
<?php
if ($this->params->get('show_select')) echo $this->select_season;
if ($this->rows) {
echo $this->loadTemplate('square');
?>
<div class="bb">
<div class="headtab">
<div>:: <?php echo JText::_('HOC_MATCHDAY'); ?> -  <?php echo $this->matchday; ?> ::</div>
</div>
<table>
<thead>
    <tr><th><?php echo JText::_('HOC_DATE'); ?></th>
        <th><?php echo JText::_('HOC_HOME'); ?></th>
        <th>&nbsp;</th>
        <th><?php echo JText::_('HOC_VISITORS'); ?></th>
        <th>- - -</th>
        <th>- - -</th>
    </tr>
</thead>
<tbody>
    <?php
    $n = count($this->rows);
    $id_kol = null;

    for ($i = 0; $i < $n; $i++) {
        $row = &$this->rows [$i];
    ?>
        <tr>
            <td><?php echo JHTML::_('date', $row->data, JText::_('DATE_FORMAT_LC4')) ?></td>
            <td><?php echo $row->druzyna1; ?></td>
            <td>
            <?php
            echo ($row->wynik_1 != null ? $row->wynik_1 : '-');
            echo ' : ';
            echo ($row->wynik_2 != null ? $row->wynik_2 : '-');
            echo '<span class="smp">(';
            echo ($row->w1p1 != null ? $row->w1p1 : '-').':'
             .($row->w2p1 != null ? $row->w2p1 : '-').', '
             .($row->w1p2 != null ? $row->w1p2 : '-').':'
             .($row->w2p2 != null ? $row->w2p2 : '-').', '
             .($row->w1p3 != null ? $row->w1p3 : '-').':'
             .($row->w2p3 != null ? $row->w2p3 : '-');
            echo ')</span>';
            ?>
        </td>
        <td><?php echo $row->druzyna2; ?></td>
        <td>
            <?php
            if ($row->m_karne == "T") echo JText::_('HOC_PENALTY_SHORT');
            elseif ($row->m_dogr == "T") echo JText::_('HOC_OVERTIME_SHORT');
            else echo '--'; ?>
        </td>
        <td>
            <?php
            if ($row->rid) {
                echo '<a href="' . JRoute::_('index.php?option=com_hockey&view=report&id=' . $row->id) . '">
                     <img src="' . JURI::base(true) . '/components/com_hockey/assets/plik.png" alt="' . JText::_('HOC_RAPORT') . '" /></a>';
            }
            ?>
                </td>
            </tr>
<?php
        }
?>
    </tbody>
</table>
</div>
<?php } else echo JText::_('HOC_NO_DATA'); ?>






