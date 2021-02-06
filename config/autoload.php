<?php

/**
 * Contao Open Source CMS
 * 
 * Copyright (C) 2005-2012 Leo Feyer
 * 
 * @package Bepiwikcharts
 * @link    http://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	'bepiwikcharts' => 'system/modules/be_piwikcharts/bepiwikcharts.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'be_piwikcharts'         => 'system/modules/be_piwikcharts/templates'
));
