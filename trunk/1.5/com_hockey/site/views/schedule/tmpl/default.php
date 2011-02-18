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
<div class="bb">
    <?php
    if ($this->rows) {
        $n = count($this->rows);
        $month_tmp = null;

        for ($i = 0; $i < $n; $i++) {

            $row = &$this->rows [$i];
            $kow = &$this->rows [$i + 1];

            if ($month_tmp != $row->mm) {
    ?>
        <div class="headtab">
            <div>:: <?php $text = JString::strtoupper(date('F', mktime(0, 0, 0, $row->mm + 1, 0, 0))); echo JTEXT::_('MONTH') . " : " . JTEXT::_($text); ?> ::</div>
        </div>
        <table>
            <thead>
                <tr><th><?php echo JText::_('HOC_DATE'); ?></th>
                    <th><?php echo JText::_('HOC_HOME'); ?></th>
                    <th><?php echo JText::_('HOC_SCORE'); ?></th>
                    <th><?php echo JText::_('HOC_VISITORS'); ?></th>
                    <th>- - -</th>
                    <th>- - -</th>
                </tr>
            </thead>
            <tbody>
            <?php } ?>
            <tr>
                <td><?php echo JHTML::_('date', $row->data, JText::_('DATE_FORMAT_LC4')) ?></td>
                <td><?php echo $row->druzyna1; ?></td>
                <td>
                    <?php
                    echo ($row->wynik_1 != null ? $row->wynik_1 : '-');
                    echo ' : ';
                    echo ($row->wynik_2 != null ? $row->wynik_2 : '-'); ?>
                </td>
                <td><?php echo $row->druzyna2; ?></td>
                <td>
                    <?php
                    if ($row->m_dogr == "T")  echo JText::_('HOC_OVERTIME_SHORT');
                    elseif ($row->m_karne == "T")  echo JText::_('HOC_PENALTY_SHORT');
                    else echo '--'; ?>
                </td>
                <td><?php
                    if ($row->rid) {
                        echo '<a href="' . JRoute::_('index.php?option=com_hockey&view=report&id=' . $row->id, false) . '">
                             <img src="' . JURI::base(true) . '/components/com_hockey/assets/plik.png" alt="' . JText::_('HOC_RAPORT') . '" /></a>';
                    }
                    ?>
                </td>
            </tr>
            <?php
                    if (is_object($kow)) {
                        if (($kow->mm != $row->mm)) {
                            echo '</tbody></table>';
                        }
                    } else {
                        echo '</tbody></table>';
                    }
                    $month_tmp = $row->mm;
                }
            } else
                echo JText::_('HOC_NO_MATCH');
            ?>
</div>

