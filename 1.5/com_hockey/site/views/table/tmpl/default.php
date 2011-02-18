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
<script type="text/javascript">
    //<![CDATA[
    jQuery.noConflict();
    jQuery(document).ready(function($)
    {
        $("#tablesorter").tablesorter({sortList:[[0,0],[2,1]],headers: {1:{sorter: false}}, widgets: ['zebra']});
    });
    //]]>
</script>
<div class="componentheading"><?php echo JText::_('HOC_TABLE_TITLE') . ' ' . $this->infosezon['nazwa']; ?></div>
<?php
if ($this->params->get('show_select'))
    echo $this->select_season;
if ($this->list) {
?>
<table class="tableleague" id="tablesorter">
    <thead>
        <tr>
            <th> - </th>
            <th><?php echo JText::_('HOC_TEAM'); ?></th>
            <th><?php echo JText::_('HOC_POINTS'); ?></th>
            <th><?php echo JText::_('HOC_M'); ?></th>
            <th><?php echo JText::_('HOC_W'); ?></th>
            <th><?php echo JText::_('HOC_R'); ?></th>
            <th><?php echo JText::_('HOC_P'); ?></th>
            <th><?php echo JText::_('HOC_PZ'); ?></th>
            <th><?php echo JText::_('HOC_RCA'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $n = count($this->list);
        $id_kol = null;
        for ($i = 0; $i < $n; $i++) {
            $row = &$this->list [$i];
            $j = $i + 1;
            echo '<tr><td>' . $j . '</td>
                    <td class="al">' . $row->nazwa_d . '</td><td>' . $row->punkty . '</td>
                    <td>' . $row->kolejka . '</td><td>' . $row->wygrane . '</td>
                    <td>' . $row->remisy . '</td><td>' . $row->przegrane . '</td>
                    <td>' . $row->b_strzelone . '/' . $row->b_stracone . ' </td>
                    <td>' . $row->roznica . '</td></tr>';
        }
        ?>
    </tbody>
</table>
<?php
    } else
        echo "<p><b>" . JText::_('HOC_NO_DATA') . "</b></p>";
?>
    <div style="text-align: left; margin-top: 50px;">
        <div class="lew" style="width: 50%; ">
            <p><b>- <?php echo JText::_('HOC_LEGEND'); ?>-</b></p>
            <ul>
                <li><?php echo JText::_('HOC_L_POINTS'); ?></li>
                <li><?php echo JText::_('HOC_L_M'); ?></li>
                <li><?php echo JText::_('HOC_L_W'); ?></li>
                <li><?php echo JText::_('HOC_L_R'); ?></li>
                <li><?php echo JText::_('HOC_L_P'); ?></li>
                <li><?php echo JText::_('HOC_L_PZ1'); ?></li>
                <li><?php echo JText::_('HOC_L_PZ2'); ?></li>
                <li><?php echo JText::_('HOC_L_RCA'); ?></li>
        </ul>
    </div>
  </div>
   <div class="lew" style="text-align:left; width: 50%;">
	 <p><b>- <?php echo JText::_('HOC_POINTS_SEASON') ?> -</b></p>
	 <ul>
             <li><b><?php echo $this->infosezon['p_w'] ?></b> <?php echo JText::_('HOC_MATCH_W') ?></li>
             <li><b><?php echo $this->infosezon['p_p'] ?></b> <?php echo JText::_('HOC_MATCH_L') ?></li>
             <?php
             if ($this->infosezon['karne'] != "T") {
                 echo '<li><b>' . $this->infosezon['p_r'] . '</b> ' . JText::_('HOC_MATCH_N') . '</li>';
             }
             if ($this->infosezon['dogr'] == "T") {
                 echo '<li><b>' . $this->infosezon['p_d_w'] . '</b> ' . JText::_('HOC_MATCH_WO') . '</li>
                       <li><b>' . $this->infosezon['p_d_p'] . '</b> ' . JText::_('HOC_MATCH_LO') . '</li>';
             }

             if ($this->infosezon['karne'] == "T") {
                 echo '<li><b>' . $this->infosezon['p_k_w'] . '</b> ' . JText::_('HOC_MATCH_WS') . '</li>
                      <li><b>' . $this->infosezon['p_k_p'] . '</b>  ' . JText::_('HOC_MATCH_LS') . '</li>';
             }
             ?>
        </ul>
  </div>
<div class="clr">&nbsp;</div>