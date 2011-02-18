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

class TablePlayers extends JTable {
    var $id = null;
    var $nazwisko = null;
    var $imie = null;
    var $pozycja = 1;
    var $data_u = null;
    var $wzrost = 0;
    var $waga = 0;
    var $klub = null;
    var $klubold = null;
    var $published = 0;
    var $foto = null;
    var $opis = null;
    var $review_date = null;
    var $nr = null;

    function __construct(&$db) {
        parent::__construct( '#__hockey_players', 'id', $db );
    }

    function check() {

        if (trim($this->nazwisko == '')) {
            $this->setError(JText::_( 'HOC_INFO_PLAYER_NAME' ));
            return false;
        }
        if (trim($this->imie == '')) {
            $this->setError(JText::_( 'HOC_INFO_PLAYER_FIRST_NAME' ));
            return false;
        }
        if (trim($this->klub == '')) {
            $this->setError(JText::_( 'HOC_INFO_PLAYER_TEAM' ));
            return false;
        }

        return true;
    }
}
?>