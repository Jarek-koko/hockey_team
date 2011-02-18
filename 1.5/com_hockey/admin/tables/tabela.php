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

class TableTabela extends JTable {
    var $id = null;
    var $team_id = 0;
    var $punkty = 0;
    var $kolejka = 0;
    var $wygrane = 0;
    var $remisy = 0;
    var $przegrane = 0;
    var $b_strzelone = 0;
    var $b_stracone = 0;
    var $roznica = 0;
    var $id_system = null;
    var $ordering = 0;
    var $grupa = 0;
    var $published = 0;


    function __construct(&$db) {
        parent::__construct( '#__hockey_tabela', 'id', $db );
    }

    function check() {

        if (trim ( $this->team_id == '' )) {
            $this->setError ( JText::_ ( 'HOC_NO_NAME_TEAM' ) );
            return false;
        }
        
        if (trim ( $this->id_system == '' )) {
            $this->setError ( JText::_ ( 'HOC_NO_QSEASNON' ) );
            return false;
        }

        return true;
    }

}
?>