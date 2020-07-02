<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_flcontactinfo
 *
 * @copyright   Copyright (C) 2016 Vitaliy Moskalyuk. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined( '_JEXEC' ) or die();

// Include the archive functions only once
JLoader::register('ModFlcontactHelper', __DIR__ . '/helper.php');

$contact = ModFlcontactHelper::getContact($params);

$is_show = $params->get('show');

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

if (!$contact)
{
	require JModuleHelper::getLayoutPath('mod_flcontact', '_empty');
}
else
{
	require JModuleHelper::getLayoutPath('mod_flcontact', $params->get('layout', 'default'));
}
