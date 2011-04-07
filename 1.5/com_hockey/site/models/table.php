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

class HockeyModelTable extends JModel {

    var $_list = null;        
    var $_idsezon = null;    

    function __construct() {
        parent::__construct ();
        $session = &JFactory::getSession();
        $this->_idsezon = (int) $session->get('idsezon', 0);
    }

    function getData() {
        if (!$this->_list) {
            $this->_list = $this->_getList($this->_setQuery(), 0, 0);
        }
        return $this->_list;
    }

    function _setQuery() {
        $query = "SELECT  N.name AS nazwa_d, T.*"
                . "FROM #__hockey_tabela T "
                . "LEFT JOIN #__hockey_teams N ON (T.team_id = N.id) "
                . "WHERE T.id_system=".$this->_db->Quote($this->_idsezon)." AND T.published=1 "
                . "ORDER BY grupa ASC, punkty DESC, ordering ASC";
        return $query;
    }

    function setSezon($idsezon) {
        $idsezon = (int) $idsezon;
        if ($this->_idsezon == 0) {
            $this->_idsezon = $idsezon;
        }
    }

    function getSezon(){
        return $this->_idsezon;
    }

    function getSezonList() {
        $query = 'SELECT id AS value, nazwa AS text FROM #__hockey_system ORDER BY id DESC;';
        $this->_db->setQuery($query);
        return $this->_db->loadObjectList();
    }

    function getInfoSezon() {
        $query = "SELECT * FROM #__hockey_system WHERE id=".$this->_db->Quote($this->_idsezon);
        $this->_db->setQuery($query);
        return $this->_db->loadAssoc();
    }
}
?>