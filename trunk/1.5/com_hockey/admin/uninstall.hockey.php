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

defined( '_JEXEC' ) or die( 'Restricted access' );
function  com_uninstall(){
?>
<b>Folders still exists ! </b> Please delete it manually, if you want.
<ul>
    <li>/images/hockey</li>
    <li>/images/hockey/teams</li>
    <li>/images/hockey/players</li>
    <li>/images/hockey/numbers</li>
</ul>
<?php 
}
?>