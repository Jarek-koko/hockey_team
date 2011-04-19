<?php
/**
* @version      $Id: spacer.php 9764 2007-12-30 07:48:11Z ircmaxell $
* @package      Joomla.Framework
* @subpackage	Parameter
* @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
* @license	GNU/GPL, see LICENSE.php
*/

// Check to ensure this file is within the rest of the framework
defined('JPATH_BASE') or die();

/**
 * Renders a spacer element
 *
 * @author 		Johan Janssens <johan.janssens@joomla.org>
 * @package             Joomla.Framework
 * @subpackage		Parameter
 * @since		1.5
 */

class JElementHeading extends JElement
{
	/**
	* Element name
	*
	* @access	protected
	* @var		string
	*/
	var	$_name = 'Heading';

	function fetchTooltip($label, $description, &$node, $control_name, $name) {
		return '&nbsp;';
	}

	function fetchElement($name, $value, &$node, $control_name)
	{
		if ($value) {
			return '<p style="background: #CCE6FF;color: #0069CC;padding:5px"><strong>' . JText::_($value) . '</strong></p>';
		} else {
			return '<hr />';
		}
	}
}