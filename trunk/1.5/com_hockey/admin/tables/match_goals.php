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

class TableMatch_goals extends JTable {

    var $id = null;
    var $id_match = null;
    var $id_team = null;
    var $shooter = null;
    var $assist1 = null;
    var $assist2 = null;
    var $time = null;
    var $score1 = 0;
    var $score2 = 0;
    var $period = null;
    var $info = null;

    function __construct(&$db) {
        parent::__construct ( '#__hockey_match_goals', 'id', $db );
    }

    function check() {

        if (trim ( $this->id_match == null )) {
            $this->setError ( JText::_ ( 'HOG_NO_ID' ) );
            return false;
        }
        if (trim ( $this->score1 == null )) {
            $this->setError ( JText::_ ( 'HOG_NO_SCORRE' ) );
            return false;
        }
        if (trim ( $this->score1 == null )) {
            $this->setError ( JText::_ ( 'HOG_NO_SCORRE' ) );
            return false;
        }
        if (trim ( $this->id_team == 'no' )) {
            $this->setError ( JText::_ ( 'HOG_NO_TEAMNAME' ) );
            return false;
        }
        if (trim ( $this->shooter == 'no' )) {
            $this->setError ( JText::_ ( 'HOG_NO_SHOOTER' ) );
            return false;
        }
        if (trim ( $this->assist1 == 'no' )) {
            $this->assist1 = null;
        }
        if (trim ( $this->assist2 == 'no' )) {
            $this->assist2 = null;
        }
        if (trim ( $this->period == null )) {
            $this->period = 1;
        }

        return true;
    }
}
?>