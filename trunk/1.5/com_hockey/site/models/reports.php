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
        $this->_idsezon = (int) JRequest::getVar('sezon', 0, 'post', 'int');
    }

    function setSezon($idsezon) {
        $idsezon = (int) $idsezon;
        if ($this->_idsezon == 0) {
            $this->_idsezon = $idsezon;
        }
    }

    //list of season in system
    function getData() {
        $query = 'SELECT id AS value, nazwa AS text FROM #__hockey_system ORDER BY id DESC;';
        $this->_db->setQuery($query);
        return $this->_db->loadObjectList();
    }

    // list of reports in season
    function getList() {
        $query = "SELECT M.id,M.data,T1.name AS druzyna1,T2.name AS druzyna2,M.wynik_1,M.wynik_2, M.type_of_match as type "
                . "FROM #__hockey_match M  "
                . "LEFT JOIN #__hockey_match_rapport R ON (R.id_match=M.id) "
                . "LEFT JOIN #__hockey_teams T1 ON (M.druzyna1=T1.id) "
                . "LEFT JOIN #__hockey_teams T2 ON (M.druzyna2=T2.id) "
                . "WHERE M.published='1' AND M.id_system=".$this->_db->Quote($this->_idsezon)
                . " ORDER BY M.type_of_match, M.data";
        $this->_list = $this->_getList($query, 0, 0);
        return $this->_list;
    }
}
?>