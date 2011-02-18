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

class TableMatch_rapport extends JTable {

    var $id = null;
    var $id_match = null;
    var $text = null;
    var $score = 0;
    var $id_referee1 = null;
    var $id_referee2 = null;
    var $id_referee3 = null;
    var $id_referee4 = null;

    function __construct(&$db) {
        parent::__construct ( '#__hockey_match_rapport', 'id', $db );
    }

    function check() {

        if ( trim($this->id_match == null) ) {
            return false;
        }
        if ( trim($this->id_referee1 == '0') ) {
            $this->id_referee1 = null;
        }
        if ( trim($this->id_referee2 == '0') ) {
            $this->id_referee2 = null;
        }
        if ( trim($this->id_referee3 == '0') ) {
            $this->id_referee3 = null;
        }
        if ( trim($this->id_referee4 == '0') ) {
            $this->id_referee4 = null;
        }
        if ( trim($this->text == '') ) {
            $this->text = null;
        }
        return true;
    }
}
?>