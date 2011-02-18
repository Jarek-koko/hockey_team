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

class TableReferees extends JTable {
	
	var $id = null;
	var $lname = null;
	var $fname = null;
	var $published = 0;
	var $review_date = null;
	
	function __construct(&$db) {
		parent::__construct ( '#__hockey_referee', 'id', $db );
	}
	
	function check() {
	
		if (trim($this->lname == '')) {
			$this->setError(JText::_( 'HOC_INSERT_NAME_REFERER' ));
			return false;
		}
		if (trim($this->fname == '')) {
			$this->setError(JText::_( 'HOC_INSERT_FIRST_NAME_REFERER' ));
			return false;
		}
		return true;
	}

}
?>