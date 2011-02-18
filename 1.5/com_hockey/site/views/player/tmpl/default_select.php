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
    jQuery.noConflict();
    jQuery(document).ready(function() {
        jQuery(".dropdown dt a").click(function() {
            jQuery(".dropdown dd ul").toggle();
            return false;
        });

        jQuery(document).bind('click', function(e) {
            var $clicked =  jQuery(e.target);
            if (! $clicked.parents().hasClass("dropdown"))
                jQuery(".dropdown dd ul").hide();
        });
      
    });
</script>
<div class="componentheading"><?php echo JText::_('HOC_PLAYER_TITLE'); ?></div>
<div class="box">
    <dl id="sample" class="dropdown">
        <dt><a href="#"><span><?php echo JText::_('HOC_SELECT_PLAYER'); ?></span></a></dt>
        <dd>
            <ul>
                <?php
                foreach ($this->selpl as $player) {
                    echo '<li><a href="' . JRoute::_('index.php?option=com_hockey&view=player&id=' . $player->value ) . '"><span>' . $player->text . '</span></a></li>';
                }
                ?>
            </ul>
        </dd>
    </dl>
</div>
<div class="clr" ></div>
