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

class TableTeams extends JTable {

    var $id = null;
    var $name = null;
    var $short = null;
    var $logo = null;
    var $description = null;
    var $published = 0;
    var $review_date = null;

    function __construct(&$db) {
        parent::__construct ( '#__hockey_teams', 'id', $db );
    }

    function check() {

        if (trim($this->name == '')) {
            $this->setError(JText::_( 'HOC_NO_NAME_TEAM' ));
            return false;
        }
        if (trim($this->short == '')) {
            $this->setError(JText::_( 'HOC_NO_SHORT_NAME_TEAM' ));
            return false;
        }

        return true;
    }

}
?>