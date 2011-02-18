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

class HockeyModelModcal extends JModel {

    var $_id = null;

    function __construct() {
        parent::__construct ();
        $this->_id = (int) JRequest::getVar('id', 0, 'get', 'INT');
    }

    function getList() {
        if ($this->_id != 0) {
            $query = "SELECT t2.name AS home, t3.name AS visitor, t1.druzyna1, t1.druzyna2, t1.data,"
                    . "t1.wynik_1, t1.wynik_2, t2.logo AS logo1, t3.logo AS logo2 "
                    . "FROM #__hockey_match t1 "
                    . "LEFT JOIN #__hockey_teams t2 ON ( t2.id = t1.druzyna1 ) "
                    . "LEFT JOIN #__hockey_teams t3 ON ( t3.id = t1.druzyna2 ) "
                    . "WHERE t1.id =" . $this->_db->Quote($this->_id);
        } else {
            return NULL;
        }
        $this->_db->setQuery($query);
        return $this->_db->loadAssoc();
    }
}
?>