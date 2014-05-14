<?php
defined ('_JEXEC') or die();
/**
 *
 * @package    VirtueMart
 * @subpackage Models - fields
 * @author Valérie Isaksen
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2011 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id:$
 */
 
jimport('joomla.form.formfield');
/**
 * Return the Order States list.
 *
 *
 */
class JFormFieldVmOrderState extends JFormFieldList {

	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  11.1
	 */
	public $type = 'vmOrderStates';

	protected function getOptions()
	{
		$options = array();
		$db = JFactory::getDBO ();

		$query = 'SELECT `order_status_code` AS value, `order_status_name` AS text
                 FROM `#__virtuemart_orderstates`
                 WHERE `virtuemart_vendor_id` = 1
                 ORDER BY `ordering` ASC ';

		$db->setQuery ($query);
		$values = $db->loadObjectList ();
		$class = '';
		foreach ($values as $v) {
			$options[] = JHtml::_('select.option', $v->value, $v->text);
		}
		// Merge any additional options in the XML definition.
		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}

}