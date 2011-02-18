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
defined ( '_JEXEC' ) or die ( 'Restricted access' );
$document = & JFactory::getDocument ();
$document->addScript("../administrator/components/com_hockey/assets/moocheck.js");
$countP  = count($this->items);
?>
<div id="ht">
<form action="index.php" method="post" name="adminForm">
    <table class="relation">
        <tr>
            <th class="hd"><?php echo $this->druzyna ['druzyna1']; ?></th>
            <th>&nbsp;</th>
            <th class="hd"><?php echo $this->druzyna ['druzyna2']; ?></th>
        </tr>
        <tr style="vertical-align:text-top;">
            <td>
                <?php
                for ($i = 0; $i < $countP; $i++) {
                    if ($this->items[$i]['klub'] == $this->druzyna ['team1']) {
                        if ($this->items[$i]['id_player'] == null) {
                            echo '<label class="f_checkbox"><input type="checkbox" name="players1[]"  value="' . $this->items[$i]['id'] . '" >' . $this->items[$i]['nazwisko'] . ' ' . $this->items[$i]['imie'] . '</label>';
                        } else {
                            echo '<label class="f_checkbox"><input type="checkbox" name="players1[]" checked="checked"  value="' . $this->items[$i]['id'] . '" >' . $this->items[$i]['nazwisko'] . ' ' . $this->items[$i]['imie'] . '</label>';
                        }
                    }
                }
                ?>
            </td>
            <td><?php echo JText::_('HOS_INFO_SELECT_PLAYERS'); ?></td>
            <td>
                <?php
                for ($i = 0; $i < $countP; $i++) {
                    if ($this->items[$i]['klub'] == $this->druzyna ['team2']) {
                        if ($this->items[$i]['id_player'] == null) {
                            echo '<label class="f_checkbox"><input type="checkbox" name="players2[]"  value="' . $this->items[$i]['id'] . '" >' . $this->items[$i]['nazwisko'] . ' ' . $this->items[$i]['imie'] . '</label>';
                        } else {
                            echo '<label class="f_checkbox"><input type="checkbox" name="players2[]" checked="checked"  value="' . $this->items[$i]['id'] . '" >' . $this->items[$i]['nazwisko'] . ' ' . $this->items[$i]['imie'] . '</label>';
                        }
                    }
                }
                ?>
            </td>
        </tr>
    </table>
    <input type="hidden" name="<?php echo JUtility::getToken() ?>" value="1" />
    <input type="hidden" name="team1" value="<?php echo $this->druzyna ['team1']; ?>" />
    <input type="hidden" name="team2" value="<?php echo $this->druzyna ['team2']; ?>" />
    <input type="hidden" name="id_match" value="<?php echo $this->id_match ?>" />
    <input type="hidden" name="section" value="report2" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="type" value="<?php echo $this->type; ?>" />
    <input type="hidden" name="option" value="<?php echo $this->option; ?>" />
    <input type="hidden" name="boxchecked" value="0" />
</form>
</div>