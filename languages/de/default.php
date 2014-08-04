<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2010 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  µaTh 2014 
 * @author     µaTh
 * @package    be_piwikcharts
 * @license    GNU/LGPL 
 */


/**
 * Load on be_welcome
 */
if (TL_MODE == 'BE') {
	if (!strlen($_GET['do'])) {
		$bepiwikcharts = new bepiwikcharts();
		$GLOBALS['TL_LANG']['MSC']['welcomeTo'] .= '</h1>' . $bepiwikcharts->dashboardWelcomePage() . '<h1 style="display:none">&nbsp;';
	}
}

