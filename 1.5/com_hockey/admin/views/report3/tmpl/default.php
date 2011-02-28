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
?>
<script type="text/javascript">
    //<![CDATA[
    window.addEvent('domready', function() {
        $('state').addEvent('change', function() {
            var url =  '<?php echo JURI::base(); ?>' + 'index.php?option=<?php echo $this->option; ?>&section=ajax&format=raw&state='+ this.getValue();
            var ajaxObj = new Ajax ( url , {
                method: "get"
            });

            ajaxObj.addEvent('onComplete', function (data) {
            document.getElementById('shooter').innerHTML = data ;
            document.getElementById('assist1').innerHTML = data ;
            document.getElementById('assist2').innerHTML = data ;
            });
            ajaxObj.request();
        });
    });

    function submitbutton(pressbutton){
        var form = document.adminForm;

        if (pressbutton == 'cancel') {
            submitform( pressbutton );
            return;
        }
        if (pressbutton == 'remove') {
            submitform( pressbutton );
            return;
        }
        
        if( document.formvalidator.isValid( form ) )
        {
            submitform( pressbutton );
            return;
        }
        else
        {
            alert('<?php echo JText::_('HOC_VALUES_NOT_ACCEPTABLE'); ?>');
            return false;
        }
    }
    //]]>
</script>
<div id="ht">
<form action="index.php" method="post" name="adminForm" id="adminForm" class="form-validate">
    <table class="tabshort">
        <thead>
            <tr>
                <th><?php echo JText::_('HOS_STR'); ?> </th>
                <th><?php echo JText::_('HOS_PERIOD'); ?></th>
                <th><?php echo JText::_('HOA_HOME'); ?></th>
                <th><?php echo JText::_('HOM_SCORE'); ?></th>
                <th><?php echo JText::_('HOA_VISITORS'); ?></th>

            </tr>
        </thead>
        <tfoot><tr><td colspan="5"><div id="finfo"><span><?php echo JText::_('HOG_SHOOTOUT_NOT_INSERT'); ?></span></div></td></tr></tfoot>
        <tbody>
            <tr>
                <td><input type="text" name="info" value="" size="3" maxlength="3" /></td>
                <td><select name="period" id="period" class="inputbox">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4"><?php echo JText::_('HOS_OVERTIME'); ?></option>
                    </select>
                </td>
                <td><?php echo $this->team['druzyna1']; ?></td>
                <td><input type="text" name="score1"  id="score1" value="" size="2" maxlength="2"  class="required validate-numeric"/>
                    <span>:</span>
                    <input type="text" name="score2"  id="score2" value="" size="2" maxlength="2"  class="required validate-numeric"/>
                </td>
                <td><?php echo $this->team['druzyna2']; ?></td>

            </tr>
        </tbody>
    </table>
    <table class="tabshort">
        <thead>
            <tr>
                <th><?php echo JText::_('HOS_R_TIME'); ?></th>
                <th><?php echo JText::_('HOC_HOB_TEAMS'); ?></th>
                <th><?php echo JText::_('HOS_R_GOALS'); ?></th>
                <th><?php echo JText::_('HOS_R_ASSIST'); ?> 1</th>
                <th><?php echo JText::_('HOS_R_ASSIST'); ?> 2</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="text" name="time" value="" size="4" maxlength="5" class="required validate-timematch" /></td>
                <td><?php echo JHTML::_('select.genericList', $this->sel, 'state', 'class="inputbox"', 'value', 'text'); ?></td>
                <td>
                    <select name="shooter" id="shooter" class="validate-notno" >
                        <option value="no"><?php echo JText::_('HOS_MUST_SELECT_TEAMS'); ?></option>
                    </select>
                </td>
                <td>
                    <select name="assist1" id="assist1" >
                        <option value="no"><?php echo JText::_('HOS_MUST_SELECT_TEAMS'); ?></option>
                    </select>
                </td>
                <td>
                    <select name="assist2" id="assist2" >
                        <option value="no"><?php echo JText::_('HOS_MUST_SELECT_TEAMS'); ?></option>
                    </select>
                </td>
            </tr>
        </tbody>
    </table>
    <table class="adminlist">
        <thead>
            <tr>
                <th>&nbsp;</th>
                <th style="width: 20px;"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->items); ?>);" /></th>
                <th style="width: 50px;"><?php echo JText::_('HOS_PERIOD'); ?></th>
                <th style="width: 50px;"><?php echo JText::_('HOS_R_TIME'); ?></th>
                <th style="width: 50px;"><?php echo JText::_('HOM_SCORE'); ?></th>
                <th style="width: 150px;"><?php echo JText::_('HOS_R_GOALS'); ?></th>
                <th style="width: 150px;"><?php echo JText::_('HOS_R_ASSIST'); ?> 1</th>
                <th style="width: 150px;"><?php echo JText::_('HOS_R_ASSIST'); ?> 2</th>
                <th style="width: 50px;"><?php echo JText::_('HOS_STR'); ?></th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tfoot><tr><td colspan="10">
                    <div id="finfo"> *<?php echo JText::_('HOS_STR'); ?> :
                        <span>PP - Power Play</span>
                        <span>SH - Short Handed</span>
                        <span>EV - Even Strength</span>
                        <span>PS - Penalty Shoot</span>
                    </div>
                </td>
            </tr>
        </tfoot>
        <tbody>
            <?php
            $i = 0;
            foreach ($this->items as $row) {
                $checked = JHTML::_('grid.id', $i, $row->id);
            ?>
                <tr style="text-align:center;">
                    <td>&nbsp;</td>
                    <td><?php echo $checked; ?></td>
                    <td><?php echo ($row->period == 4) ? JText::_('HOS_OVERTIME') : $row->period; ?></td>
                    <td><?php echo $row->time; ?></td>
                    <td><?php echo $row->score1; ?> : <?php echo $row->score2; ?></td>
                    <td><?php echo $row->strzelec; ?></td>
                    <td><?php echo $row->asysta1; ?></td>
                    <td><?php echo $row->asysta2; ?></td>
                    <td><?php echo $row->info; ?></td>
                    <td>&nbsp;</td>
                </tr>
            <?php
                $i++;
            }
            ?>
        </tbody>
    </table>
    <input type="hidden" name="<?php echo JUtility::getToken() ?>" value="1" />
    <input type="hidden" name="type" value="<?php echo $this->type; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="id_match" value="<?php echo $this->id_match; ?>" />
    <input type="hidden" name="section" value="report3" />
    <input type="hidden" name="option" value="<?php echo $this->option; ?>" />
    <input type="hidden" name="boxchecked" value="0" />
</form>
</div>
