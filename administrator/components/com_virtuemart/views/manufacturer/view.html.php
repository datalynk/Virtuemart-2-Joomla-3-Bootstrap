<?php
/**
 *
 * Manufacturer View
 *
 * @package	VirtueMart
 * @subpackage Manufacturer
 * @author Patrick Kohl
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: view.html.php 5601 2012-03-04 18:22:24Z Milbo $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

// Load the view framework
if(!class_exists('VmView')) require(JPATH_VM_ADMINISTRATOR.'/helpers/vmview.php');

/**
 * HTML View class for maintaining the list of manufacturers
 *
 * @package	VirtueMart
 * @subpackage Manufacturer
 * @author Patrick Kohl
 */
class VirtuemartViewManufacturer extends VmView {

	function display($tpl = null) {

		// Load the helper(s)


		$this->loadHelper('html');

		// get necessary models
		$model = VmModel::getModel('manufacturer');

		$categoryModel = VmModel::getModel('manufacturercategories');



		$layoutName = JRequest::getWord('layout', 'default');
		if ($layoutName == 'edit') {

			$manufacturer = $model->getManufacturer();

			$model->addImages($manufacturer);
			$this->manufacturer = $manufacturer ;

			/* Process the images */
			$mediaModel = VmModel::getModel('media');
			$mediaModel -> setId($manufacturer->virtuemart_media_id);
			$image = $mediaModel->getFile('manufacturer','image');

			$manufacturerCategories = $categoryModel->getManufacturerCategories(false,true);
			$this->manufacturerCategories =	$manufacturerCategories ;

			$this->SetViewTitle('',$manufacturer->mf_name);
			$this->addStandardEditViewCommands($manufacturer->virtuemart_manufacturer_id);

			if(!class_exists('VirtueMartModelVendor')) require(JPATH_VM_ADMINISTRATOR.'/models'.DS.'vendor.php');
			$virtuemart_vendor_id = VirtueMartModelVendor::getLoggedVendor();
			$this->virtuemart_vendor_id = $virtuemart_vendor_id ;
			

		}
		else {
			if ( JRequest::getWord('format', '') === 'raw') {
				$tpl = 'results';
			}
			else 
			{
				$this->SetViewTitle();
				$this->addStandardDefaultViewCommands();
			}
			$mainframe = JFactory::getApplication();

			$categoryFilter = $categoryModel->getCategoryFilter();

			$this->addStandardDefaultViewLists($model,'mf_name');

			$this->manufacturers = $model->getManufacturers();
			$this->pagination = $model->getPagination();

			$virtuemart_manufacturercategories_id	= $mainframe->getUserStateFromRequest( 'com_virtuemart.virtuemart_manufacturercategories_id', 'virtuemart_manufacturercategories_id', 0, 'int' );
			$this->lists['virtuemart_manufacturercategories_id'] =  JHTML::_('select.genericlist',   $categoryFilter, 'virtuemart_manufacturercategories_id', ' onChange="Joomla.ajaxSearch(this); return false;" ', 'value', 'text', $virtuemart_manufacturercategories_id );

		}


		parent::display($tpl);
		if ($tpl === 'results') echo $this->AjaxScripts();
	}

}
// pure php no closing tag
