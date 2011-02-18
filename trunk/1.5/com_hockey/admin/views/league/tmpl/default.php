<?php
/*
 * @package Joomla 1.5
 * @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * @component Hockey
 * @copyright Copyright (C) Klich Jarosław
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');
?>
<script type="text/javascript">
    //<![CDATA[
    function searchMach(val){
        var f = document.adminForm;
        if(f){
            f.elements['nrrrkol'].value = val;
            f.submit();
        }
    }
    //]]>
</script>
<div id="ht">
<form action="<?php echo $this->request_url; ?>" method="post" name="adminForm">
    <?php echo $this->loadTemplate('square'); ?>
    <table class="adminlist">
        <thead>
            <tr>
                <th rowspan="2">&nbsp;</th>
                <th style="width: 20px;" rowspan="2"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->items); ?>);" /></th>
                <th style="width: 50px;" rowspan="2">ID</th>
                <th style="width: 80px;" rowspan="2"><?php echo JText::_('HOA_DATE_MATCHE'); ?></th>
                <th style="width: 120px;" rowspan="2"><?php echo JText::_('HOA_HOME'); ?></th>
                <th style="width: 90px;" rowspan="2"><?php echo JText::_('HOM_SCORE'); ?></th>
                <th style="width: 120px;" rowspan="2"><?php echo JText::_('HOA_VISITORS'); ?></th>
                <th colspan="7"><?php echo JText::_('HOM_COVERAGE') ?></th>
                <th style="width: 50px;" nowrap="nowrap" rowspan="2"><?php echo JText::_('HOC_PAGE') ?></th>
                <th rowspan="2">&nbsp;</th>
            </tr>
            <tr>
                <th style="width: 25px;">S</th>
                <th style="width: 25px;">T</th>
                <th style="width: 25px;">G</th>
                <th style="width: 25px;">P</th>
                <th style="width: 25px;">GS</th>
                <th style="width: 25px;">R</th>
                <th style="width: 25px;">D</th>
            </tr>
        </thead>
        <tfoot>
            <tr><td colspan="16">
                    <div id="finfo">
                        <span> <b>S</b> - <?php echo JText::_('HOM_SCORE'); ?></span>
                        <span><b>T</b> - <?php echo JText::_('HOM_TEAMS'); ?></span>
                        <span><b>G</b> - <?php echo JText::_('HOM_GOALS'); ?></span>
                        <span><b>P</b> - <?php echo JText::_('HOM_PENALT'); ?></span>
                        <span><b>GS</b> - <?php echo JText::_('HOM_GOALIE'); ?></span>
                        <span><b>R</b> - <?php echo JText::_('HOM_REFEREES'); ?></span>
                        <span><b>D</b> - <?php echo JText::_('HOM_DESCRIPTION'); ?></span>
                    </div>
                </td>
            </tr>
        </tfoot>
        <tbody>
            <?php
            $k = 0; $i = 0;
            foreach ($this->items as $row) {
                $checked = JHTML::_('grid.id', $i, $row->id);
                $published = JHTML::_('grid.published', $row, $i);
                $link = JRoute::_('index.php?option=' . $this->option . '&section=report1&type=0&id_match=' . $row->id);
                $link1 = JRoute::_('index.php?option=' . $this->option . '&section=report2&type=0&id_match=' . $row->id);
                $link2 = JRoute::_('index.php?option=' . $this->option . '&section=report3&type=0&id_match=' . $row->id);
                $link3 = JRoute::_('index.php?option=' . $this->option . '&section=report4&type=0&id_match=' . $row->id);
                $link4 = JRoute::_('index.php?option=' . $this->option . '&section=report5&type=0&id_match=' . $row->id);
                $link5 = JRoute::_('index.php?option=' . $this->option . '&section=report6&type=0&id_match=' . $row->id);
                $link6 = JRoute::_('index.php?option=' . $this->option . '&section=report7&type=0&id_match=' . $row->id);
            ?>
                <tr style="text-align:center;" class="<?php echo "row$k"; ?>">
                    <td>&nbsp; </td>
                    <td><?php echo $checked; ?></td>
                    <td><?php echo $row->id; ?></td>
                    <td><?php echo $row->data; ?></td>
                    <td><?php echo ($row->druzyna1 == null ? JText::_('HOC_NOT_MATCH') : $row->druzyna1); ?></td>
                    <td><?php echo ($row->wynik_1 == null ? "--" : $row->wynik_1); ?> : <?php echo ($row->wynik_2 == null ? "--" : $row->wynik_2); ?></td>
                    <td><?php echo ($row->druzyna2 == null ? JText::_('HOC_NOT_MATCH') : $row->druzyna2); ?></td>
                <?php
                if (($row->druzyna1 != null) and ($row->druzyna2 != null)) {
                    echo '<td><a href="' . $link . '"><img src="components/com_hockey/assets/add.png" alt="edit" /></a></td>';
                } else {
                    echo '<td><img src="components/com_hockey/assets/no.png" alt="no" /></td>';
                }

                if ((($row->druzyna1 != null) and ($row->druzyna2 != null)) and (($row->idteam1 == $this->myteam) or ($row->idteam2 == $this->myteam))) {
                    echo '<td><a href="' . $link1 . '"><img src="components/com_hockey/assets/add.png" alt="edit" /></a></td>
                     <td><a href="' . $link2 . '"><img src="components/com_hockey/assets/add.png" alt="edit" /></a></td>
                     <td><a href="' . $link3 . '"><img src="components/com_hockey/assets/add.png" alt="edit" /></a></td>
                     <td><a href="' . $link4 . '"><img src="components/com_hockey/assets/add.png" alt="edit" /></a></td>
                     <td><a href="' . $link5 . '"><img src="components/com_hockey/assets/add.png" alt="edit" /></a></td>
                     <td><a href="' . $link6 . '"><img src="components/com_hockey/assets/add.png" alt="edit" /></a></td>';
                } else {
                    echo '<td><img src="components/com_hockey/assets/no.png" alt="no" /></td>
                      <td><img src="components/com_hockey/assets/no.png" alt="no" /></td>
                      <td><img src="components/com_hockey/assets/no.png" alt="no" /></td>
                      <td><img src="components/com_hockey/assets/no.png" alt="no" /></td>
                      <td><img src="components/com_hockey/assets/no.png" alt="no" /></td>
                      <td><img src="components/com_hockey/assets/no.png" alt="no" /></td>';
                }
                ?>
                <td><?php echo $published; ?></td>
                <td>&nbsp;</td>
            </tr>
            <?php
                $k = 1 - $k; $i++;
            }
            ?>
        </tbody>
    </table>
    <input type="hidden" name="<?php echo JUtility::getToken() ?>" value="1" />
    <input type="hidden" name="option" value="<?php echo $this->option; ?>" />
    <input type="hidden" name="kol" value="<?php echo $this->nr_kol; ?>" />
    <input type="hidden" name="nrrrkol" value="" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="type_of_match" value="0" />
</form>
</div>