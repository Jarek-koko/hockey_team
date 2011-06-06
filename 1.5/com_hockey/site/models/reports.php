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

class HockeyModelReports extends JModel {

    var $_list = null;
    var $_idsezon = null;

    function __construct() {
        parent::__construct ();
        $session = &JFactory::getSession();
        $this->_idsezon = (int) $session->get('idsezon' , 0);
    }

    function setSezon($idsezon, $show) {
        $idsezon = (int) $idsezon;
        $show = (int) $show;
        
        if (($this->_idsezon == 0) || ($show == 0)) {
            $this->_idsezon = $idsezon;
        } 
    }

    function getSezon(){
        return $this->_idsezon;
    }

    //list of season in system
    function getData() {
        $query = 'SELECT id AS value, nazwa AS text FROM #__hockey_system ORDER BY id DESC;';
        $this->_db->setQuery($query);
        return $this->_db->loadObjectList();
    }

    // list of reports in season
    function getList() {
        $query = "SELECT M.id,M.data,T1.name AS druzyna1,T2.name AS druzyna2,M.wynik_1,M.wynik_2, M.type_of_match as type ,M.w1p1,M.w2p1,M.w1p2,M.w2p2,M.w1p3,M.w2p3,M.w1ot,M.w2ot,M.w1so,M.w2so "
                . "FROM #__hockey_match M  "
                . "INNER JOIN #__hockey_match_rapport R ON (R.id_match=M.id) "
                . "INNER JOIN #__hockey_teams T1 ON (M.druzyna1=T1.id) "
                . "INNER JOIN #__hockey_teams T2 ON (M.druzyna2=T2.id) "
                . "WHERE M.published='1' AND M.id_system=" . $this->_db->Quote($this->_idsezon)
                . " ORDER BY M.type_of_match, M.data";
        $this->_list = $this->_getList($query, 0, 0);
        return $this->_list;
    }
}
?>