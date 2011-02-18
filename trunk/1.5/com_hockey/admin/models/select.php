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
jimport('joomla.application.component.model');

class HockeyModelSelect extends JModel {


    function getSezon(){
        $db = & JFactory::getDBO ();
        $query = "SELECT id,nazwa FROM #__hockey_system WHERE published=1 ORDER BY id DESC";
        $db->setQuery($query);
        $db->query();
        
        return $db->loadAssocList();
   }
}
?>
