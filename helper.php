<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_flcontactinfo
 *
 * @copyright   Copyright (C) 2017 Vitaliy Moskalyuk. All rights reserved.
 * @license     GNU General Public License version 2 or later.
 */

defined('_JEXEC') or die;

class ModFlcontactHelper
{
	public static function getContact($params)
	{
		static $contacts = array();
		
		$cid = $params->get('cid', 0);
		
		if($cid)
		{
			if (isset($contacts[$cid]))
			{
				return $contacts[$cid];
			}
		}
		else
		{
			return null;
		}
		
		// Get database
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		
		$query->select('*');
		$query->from('#__contact_details');
		$query->where('id=' . $cid);
		$query->where('published=1');
		
		// Filter by language
		if (JLanguageMultilang::isEnabled() === true)
		{
			$query->where('(language in '
				. '(' . $db->quote(JFactory::getLanguage()->getTag()) . ',' . $db->quote('*') . ') ' . ' OR language IS NULL)');
		}
		
		$db->setQuery($query);
		
		$result = $db->loadObject();
		
		if($result)
		{
			$result->params = json_decode($result->params);
			$result->metadata = json_decode($result->metadata);
			
			$contacts[$cid] = $result;
		}
		
		return $contacts[$cid];
	}
	
	public static function phoneLink($phone, $trim = '', $attribs = null)
	{
		$phone = trim($phone);
		
		$phoneRegExp = "~[^\d\+]~";
		
		$link = 'tel:' . preg_replace($phoneRegExp,'', $phone);
		
		if($trim)
		{
			$phone = str_replace($trim, '', $phone);
			$phone = trim($phone);
		}
		
		return JHtml::link($link, $phone, $attribs);
	}
}
