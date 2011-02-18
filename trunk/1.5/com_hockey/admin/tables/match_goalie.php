<?php

/*
 * @package Joomla 1.5
 * @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 *
 * @component Hockey team
 * @copyright Copyright (C) Klich Jarosław
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');

class TableMatch_goalie extends JTable {

    var $id = null;
    var $id_match = null;
    var $id_player = null;
    var $time_p = null;
    var $goals = null;
    var $save = null;
    var $id_team = null;

    function __construct(&$db) {
        parent::__construct('#__hockey_match_goalie', 'id', $db);
    }

    function check() {
        if (trim($this->id_match == null)) {
            $this->setError(JText::_('HOG_NO_ID'));
            return false;
        }
        if (trim($this->id_player == null)) {
            return false;
        }
        if (trim($this->time_p == null)) {
            return false;
        }
        if (trim($this->goals == null)) {
            return false;
        }
        if (trim($this->id_team == null)) {
            return false;
        }
        return true;
    }

}

?>