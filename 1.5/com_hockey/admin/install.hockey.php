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
jimport('joomla.filesystem.folder');

function com_install() {
    $direxists = array();
?>
<?php echo JHTML::_('image.site', 'big-logo.png', 'components/com_hockey/assets/', NULL, NULL, 'Hockey Team'); ?>
    <div>
        <b><p>Installation Status :</p></b>
    <?php
    if ($direxists[] = JFolder::exists(JPATH_SITE . '/images/hockey')) {
        echo '<p><b><span style="color:green;">FINISHED : - </span></b> Directory created - /images/hockey</p>';
    } else {
        echo '<p><b><span style="color:red;">Note : - </span></b> Directory not created. - /images/hockey </p>';
    }

    if ($direxists[] = JFolder::exists(JPATH_SITE . '/images/hockey/numbers')) {
        echo '<p><b><span style="color:green;">FINISHED : - </span></b> Directory created - /images/hockey/numbers</p>';
    } else {
        echo '<p><b><span style="color:red;">Note : - </span></b> Directory not created - /images/hockey/numbers</p>';
    }

    if ($direxists[] = JFolder::exists(JPATH_SITE . '/images/hockey/players')) {
        echo '<p><b><span style="color:green;">FINISHED : - </span></b> Directory created - /images/hockey/players</p>';
    } else {
        echo '<p><b><span style="color:red;">Note : - </span></b> Directory not created - /images/hockey/players</p>';
    }

    if ($direxists[] = JFolder::exists(JPATH_SITE . '/images/hockey/teams')) {
        echo '<p><b><span style="color:green;">FINISHED : - </span></b> Directory created - /images/hockey/teams</p>';
    } else {
        echo '<p><b><span style="color:red;">Note : - </span></b> Directory not created - /images/hockey/teams</p>';
    }
    ?>
    <br />
    <?php if (in_array(false, $direxists)) : ?>
        <code>Please check following directories:
            <ul>
                <li>/images/hockey</li>
                <li>/images/hockey/teams</li>
                <li>/images/hockey/players</li>
                <li>/images/hockey/numbers</li>
            </ul>
        </code>
    <?php endif; ?>
    </div>    
<?php }

 ?>