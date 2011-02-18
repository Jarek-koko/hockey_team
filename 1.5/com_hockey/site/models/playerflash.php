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
defined ( '_JEXEC' ) or die ( 'Restricted access' );
jimport ( 'joomla.application.component.model' );


class HockeyModelPlayerflash extends JModel {

    function __construct() {
        parent::__construct ();      
    }
  
    function getListPlayers($idsezon) {
        $query = "SELECT  *  FROM #__hockey_players "
        ."WHERE ( published=1 AND klub=(SELECT myteam FROM #__hockey_system WHERE ( id=".$this->_db->Quote($idsezon)."))) "
        ."ORDER BY  nazwisko, imie";
        return $this->_getList ( $query, 0, 0 );
    }
}
?>