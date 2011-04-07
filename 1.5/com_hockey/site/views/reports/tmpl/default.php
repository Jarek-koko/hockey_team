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
$title = array(JTEXT::_('HOC_REGULAR_SEASON_SELECT'), JTEXT::_('HOC_PLAYOFF_SELECT'), JTEXT::_('HOC_PRESEASON_SELECT'));
?>
<div class="componentheading"><?php echo JText::_('HOC_REPORTS_TITLE'); ?> - <?php echo $this->name_season; ?></div>
<?php if ($this->params->get('show_select')) echo $this->select_season; ?>
<div class="bb">
<?php
if ($this->rows) {
    $n = count($this->rows);
    $type = null;

    for ($i = 0; $i < $n; $i++) {
        $row = &$this->rows [$i];
        $kow = &$this->rows [$i + 1];
        
        if ($type != $row->type) {
?>
    <div class="headtab">
        <div>:: <?php echo @$title[$row->type] ?> ::</div>
    </div>
    <table>
        <thead>
            <tr>
                <th><?php echo JText::_('HOC_DATE'); ?></th>
                <th><?php echo JText::_('HOC_HOME'); ?></th>
                <th><?php echo JText::_('HOC_SCORE'); ?></th>
                <th><?php echo JText::_('HOC_VISITORS'); ?></th>
                <th>- - -</th>
            </tr>
        </thead>
        <tbody>
   <?php } ?>
        <tr>
            <td><?php echo JHTML::_('date', $row->data, JText::_('DATE_FORMAT_LC4')) ?></td>
            <td><?php echo $row->druzyna1; ?></td>
            <td><?php 
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
            <td><a href="<?php echo JRoute::_('index.php?option=com_hockey&view=report&id=' . $row->id) ?>" >
                <img src="<?php echo JURI::base(true) ?>/components/com_hockey/assets/plik.png" alt="<?php echo JText::_('HOC_RAPORT') ?>" /></a>
            </td>
        </tr>
        <?php
        if (is_object($kow)) {
            if (($kow->type != $row->type)) {
                echo '</tbody></table>';
            }
        } else {
            echo '</tbody></table>';
        }
        $type = $row->type;
    }
} else
    echo JText::_('HOC_NO_RAPORT');
?>
</div>



