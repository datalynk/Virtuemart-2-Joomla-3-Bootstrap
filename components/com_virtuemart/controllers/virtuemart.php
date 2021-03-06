<?php
/**
*
* Base controller Frontend
*
* @package		VirtueMart
* @subpackage
* @author Max Milbers
* @link http://www.virtuemart.net
* @copyright Copyright (c) 2011 VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: virtuemart.php 5310 2012-01-23 21:34:19Z Milbo $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

/**
 * VirtueMart Component Controller
 *
 * @package		VirtueMart
 */
class VirtueMartControllerVirtuemart extends JControllerLegacy
{

	function __construct() {
		parent::__construct();

	}

	function display() {

		if (VmConfig::get('shop_is_offline') == '1') {
			$this->input->set('layout', 'off_line');
		}
		// Display it all
		$safeurlparams = array('virtuemart_category_id'=>'INT','virtuemart_currency_id'=>'INT','return'=>'BASE64','lang'=>'CMD');
		return parent::display(true, $safeurlparams);
	}
}
 //pure php no closing tag
