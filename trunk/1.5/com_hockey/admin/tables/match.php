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

class TableMatch extends JTable {
	
	var $id = null;
	var $druzyna1 = null;
	var $druzyna2 = null;
	var $wynik_1 = null;
	var $wynik_2 = null;
	var $m_dogr = null;
	var $m_karne = null;
	var $id_kolejka = null;
	var $data = null;
	var $info = null;
	var $id_system = null;
	var $published = null;
        var $type_of_match = null;
        var $w1p1 = null;
        var $w2p1 = null;
        var $w1p2 = null;
        var $w2p2 = null;
        var $w1p3 = null;
        var $w2p3 = null;
        var $w1ot = null;
        var $w2ot = null;
        var $w1so = null;
        var $w2so = null;
        var $uscore = null;

	
	function __construct(&$db) {
		parent::__construct ( '#__hockey_match', 'id', $db );
	}
	function check() {
		
		if (trim ( $this->druzyna1 == '' )) {
			$this->setError ( JText::_ ( 'HOC_NO_HOME_NAME' ) );
			return false;
		}
		if (trim ( $this->druzyna2 == '' )) {
			$this->setError ( JText::_ ( 'HOC_NO_VISITORS_NAME' ) );
			return false;
		}
		if (trim ( $this->data == '' )) {
			$this->setError ( JText::_ ( 'HOC_NO_DAYDATE' ) );
			return false;
		}
		if (trim ( $this->id_kolejka == '' )) {
			$this->setError ( JText::_ ( 'HOC_NO_QMATCHEDEY' ) );
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