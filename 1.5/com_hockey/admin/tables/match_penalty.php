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
defined ( '_JEXEC' ) or die ( 'Restricted access' );

class TableMatch_penalty extends JTable {

    var $id = null;
    var $id_match = null;
    var $id_team = null;
    var $id_player = null;
    var $note = null;
    var $time_p = null;
    var $time = null;
    var $period = null;
    

    function __construct(&$db) {
        parent::__construct ( '#__hockey_match_penalty', 'id', $db );
    }

    function check() {

        if (trim ( $this->id_match == null )) {
            $this->setError ( JText::_ ( 'HOG_NO_ID' ) );
            return false;
        }
        if (trim ( $this->id_team == null )) {
            return false;
        }
        if (trim ( $this->id_player == null )) {
            return false;
        }
        if (trim ( $this->time_p == null )) {
            return false;
        }
        if (trim ( $this->period == null )) {
            $this->period = 1;
        }

        return true;
    }
}
?>