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

class HockeyModelModmatch extends JModel {

    var $_id = null;
    var $_sez = null;
    var $_short = null;

    function __construct() {
        parent::__construct ();
        $this->_id = (int) JRequest::getVar('id', 0, 'get', 'INT');
        $this->_sez = (int) JRequest::getVar('sez', 0, 'get', 'INT');
        $this->_short = (int) JRequest::getVar('st', 0, 'get', 'INT');
    }

    function getList() {
       $sname = ($this->_short) ? ' short ' : ' name ';
       if (($this->_sez != 0) AND ($this->_id != 0)) {
            $query = "SELECT t3.$sname as druzyna1,t2.$sname as druzyna2,t1.wynik_1,t1.wynik_2 "
                    . "FROM #__hockey_match t1 "
                    . "INNER JOIN #__hockey_teams t2 ON (t2.id = t1.druzyna2) "
                    . "INNER JOIN #__hockey_teams t3 ON (t3.id = t1.druzyna1) "
                    . "WHERE t1.published=1 AND t1.id_system="
                    . $this->_db->Quote($this->_sez) . " AND t1.id_kolejka=" . $this->_db->Quote($this->_id) ." AND t1.type_of_match=0 ";
        } else {
            return NULL;
        }
        $this->_db->setQuery($query);
        return $this->_db->loadObjectList();
    }
}
?>