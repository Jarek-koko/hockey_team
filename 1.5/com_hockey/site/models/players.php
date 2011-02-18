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

class HockeyModelPlayers extends JModel {

    function __construct() {
        parent::__construct ();
    }

    function getListPlayers($id) {
        $id = (int) $id ;
        $query = "SELECT P.*,(YEAR(CURDATE()) - YEAR(P.data_u)) - (RIGHT(CURDATE(), 5) < RIGHT(P.data_u, 5)) AS wiek "
                ."FROM #__hockey_players  P "
                ."WHERE ( P.published =1 AND P.klub= (SELECT myteam FROM #__hockey_system WHERE id =".$this->_db->Quote($id)." )) "
                ."ORDER BY  P.pozycja ,P.nazwisko, P.imie";
        return $this->_getList ( $query, 0, 0 );
    }
}
?>