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
$link1 = JRoute::_('index.php?option=com_hockey&task=tabplayer&view=tabplayer&id=1&sez=' . $this->idsezon);
$link2 = JRoute::_('index.php?option=com_hockey&task=tabplayer&view=tabplayer&id=2&sez=' . $this->idsezon);
$link3 = JRoute::_('index.php?option=com_hockey&task=tabplayer&view=tabplayer&id=3&sez=' . $this->idsezon);
$link4 = JRoute::_('index.php?option=com_hockey&task=tabplayer&view=tabplayer&id=4&sez=' . $this->idsezon);
?>
<div class="componentheading"><?php echo JText::_('HOC_STAT_TITLE') ?></div>
<script type="text/javascript">
    //<![CDATA[
    jQuery.noConflict();
    jQuery(document).ready(function($)
    {
        $("ul.css-tabs").tabs("div.css-panes > div", {effect: 'ajax',
           onBeforeClick: function(event, i) {
		    var pane = this.getPanes("div.panes > div");
			pane.html('<img src="<?php echo  JURI::base(true) ?>/components/com_hockey/assets/loading.gif" />');
	 }
        });
    });
    //]]>
</script>
<?php if ($this->params->get('show_select')) echo $this->select_season; ?>
<ul class="css-tabs">
    <li><a href="<?php echo $link1; ?>"><span><?php echo JText::_('HOC_STAT_PLAYERS_R'); ?> </span></a></li>
    <li><a href="<?php echo $link2; ?>"><span><?php echo JText::_('HOC_STAT_PLAYERS_P'); ?> </span></a></li>
    <li><a href="<?php echo $link3; ?>"><span><?php echo JText::_('HOC_STAT_GOALIES_R'); ?> </span></a></li>
    <li><a href="<?php echo $link4; ?>"><span><?php echo JText::_('HOC_STAT_GOALIES_P'); ?> </span></a></li>
</ul>
<div class="css-panes">
    <div style="display:block"></div>
</div>
