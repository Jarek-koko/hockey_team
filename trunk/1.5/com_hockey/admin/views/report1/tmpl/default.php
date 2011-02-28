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
    function submitbutton(pressbutton) {
        var form = document.adminForm;

        if( pressbutton == 'cancel' ) {
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

    window.addEvent('domready', function() {   
        if($('toogle') != null) {
            if($('toogle').checked) {
                $('ot').setStyle('display', 'table-row');
            } else {
                $('ot').setStyle('display', 'none');
            }

            $('toogle').addEvent('click', function(e){
                if(this.checked) {
                    $('ot').setStyle('display', 'table-row');
                } else {
                    $('ot').setStyle('display', 'none');
                }
            });
        }

        if($('toogle2') != null) {
            if($('toogle2').checked) {
                $('so').setStyle('display', 'table-row');
            } else {
                $('so').setStyle('display', 'none');
            }

            $('toogle2').addEvent('click', function(e){
                if(this.checked) {
                    $('so').setStyle('display', 'table-row');
                } else {
                    $('so').setStyle('display', 'none');
                }
            });
        }
    });
    //]]>
</script>
<div id="ht">
<form action="index.php" method="post" name="adminForm" id="adminForm" class="form-validate">
    <?php echo $this->dnot; ?>
    <table class="tabshort">
        <thead>
            <tr>
                <th style="width: 250px;"><?php echo JText::_('HOA_HOME'); ?></th>
                <th style="width: 150px;"><?php echo JText::_('HOM_SCORE'); ?></th>
                <th style="width: 250px;"><?php echo JText::_('HOA_VISITORS'); ?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $this->row->druzyna1; ?></td>
                <td>
                    <input type="text" name="wynik_1" value="<?php echo $this->row->wynik_1; ?>" size="3" maxlength="3" class="required validate-numeric" />
                    <span>:</span>
                    <input type="text" name="wynik_2" value="<?php echo $this->row->wynik_2; ?>" size="3" maxlength="3" class="required validate-numeric"/>
                </td>
                <td><?php echo $this->row->druzyna2; ?></td>
            </tr>
        </tbody>
    </table >

    <table class="tabshort">
        <thead>
            <tr>
                <th><?php echo JText::_('HOC_PERIOD'); ?></th>
                <th><?php echo JText::_('HOA_HOME') . ' : ' . JText::_('HOA_VISITORS'); ?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo JText::_('HOC_T1'); ?></td>
                <td>
                    <input type="text" name="w1p1" value="<?php echo $this->row->w1p1; ?>" size="2" maxlength="2" class="validate-numeric" />
                    <span>:</span>
                    <input type="text" name="w2p1" value="<?php echo $this->row->w2p1; ?>" size="2" maxlength="2" class="validate-numeric" />
                </td>

            </tr>
            <tr>
                <td><?php echo JText::_('HOC_T2'); ?></td>
                <td>
                    <input type="text" name="w1p2" value="<?php echo $this->row->w1p2; ?>" size="2" maxlength="2" class="validate-numeric" />
                    <span>:</span>
                    <input type="text" name="w2p2" value="<?php echo $this->row->w2p2; ?>" size="2" maxlength="2" class="validate-numeric" />
                </td>

            </tr>
            <tr>
                <td><?php echo JText::_('HOC_T3'); ?></td>
                <td>
                    <input type="text" name="w1p3" value="<?php echo $this->row->w1p3; ?>" size="2" maxlength="2" class="validate-numeric" />
                    <span>:</span>
                    <input type="text" name="w2p3" value="<?php echo $this->row->w2p3; ?>" size="2" maxlength="2" class="validate-numeric" />
                </td>

            </tr>
            <?php if (($this->infoSP['dogr'] == "T") || ($this->type != 0)) { ?>
            <tr id="ot">
                <td><?php echo JText::_('HOC_OT'); ?></td>
                <td>
                    <input type="text" name="w1ot" value="<?php echo $this->row->w1ot; ?>" size="2" maxlength="2" class="validate-numeric" />
                    <span>:</span>
                    <input type="text" name="w2ot" value="<?php echo $this->row->w2ot; ?>" size="2" maxlength="2" class="validate-numeric" />
                </td>
            </tr>
           <?php } if (($this->infoSP['karne'] == "T") || ($this->type != 0)) { ?>
            <tr id="so">
                <td><?php echo JText::_('HOC_SO'); ?></td>
                <td>
                    <input type="text" name="w1so" value="<?php echo $this->row->w1so; ?>" size="2" maxlength="2" class="validate-numeric" />
                    <span>:</span>
                    <input type="text" name="w2so" value="<?php echo $this->row->w2so; ?>" size="2" maxlength="2" class="validate-numeric" />
                </td>
            </tr>
           <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <td>
                    <?php
                    if (($this->infoSP['karne'] == "T") || ($this->type != 0)) {
                        echo '<label for="karne">' . JText::_('HOS_SHOOTOUTS') . ' : </label>';
                        if ($this->row->m_karne == "T") {
                            echo '<input  type="checkbox" checked="checked"  id="toogle2" name="karne" value="T"  />';
                        } else {
                            echo '<input  type="checkbox" name="karne" value="T"  id="toogle2"  />';
                        }
                    }
                    ?>
                </td>
                <td>
                    <?php
                    if (($this->infoSP['dogr'] == "T") || ($this->type != 0)) {
                        echo '<label for="dogrywka">' . JText::_('HOS_OVERTIME') . ' : </label>';
                        if ($this->row->m_dogr == "T") {
                            echo '<input  type="checkbox" name="dogrywka" id="toogle" checked="checked" value="T" />';
                        } else {
                            echo '<input  type="checkbox" name="dogrywka" id="toogle" value="T" />';
                        }
                    }
                    ?>
                </td>
            </tr>
        </tfoot>
    </table>
    <input type="hidden" name="<?php echo JUtility::getToken() ?>" value="1" />
    <input type="hidden" name="id_match" value="<?php echo $this->row->id; ?>" />
    <input type="hidden" name="section" value="report1" />
    <input type="hidden" name="option" value="<?php echo $this->option; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="id_system" value="<?php echo $this->row->id_system; ?>" />
    <input type="hidden" name="type" value="<?php echo $this->type; ?>" />
    <input type="hidden" name="boxchecked" value="0" />
</form>
</div>