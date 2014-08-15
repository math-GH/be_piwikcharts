<?php

if (!defined('TL_ROOT'))
  die('You can not access this file directly!');

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

/*
 * Error messages
 */
$GLOBALS['TL_LANG']['be_piwikcharts']['errormsg'][1] = "be_piwikcharts: Error#1: Connection to Piwik-Server failed. Please check your connection settings.";


/*
 * Template text labels
 */
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['dashboard']['headline'] = "Visitor statistics";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['dashboard']['live']['headline'] = "Visitors";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['dashboard']['live']['last30minutes'] = "last 30 minutes";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['dashboard']['live']['last24hours'] = "last 24 hours";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['dashboard']['optOut'] = "Optout: Do not track own visits on website.";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['dashboard']['newVersionHint'] = "New Piwik update is available";

$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['headline'] = "Visitor statistics with Piwik";

$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['live']['headline'] = "Visitors";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['live']['last30minutes'] = "last 30 minutes";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['live']['last24hours'] = "last 24 hours";

$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['menu']['settings'] = "Settings";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['menu']['settings_title'] = "Settings";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['menu']['print'] = "Print page";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['menu']['print_title'] = "Print this page";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['menu']['optout'] = "OptOut";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['menu']['optout_title'] = "Settings: Do not track own visits on website.";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['menu']['login'] = "Login Piwik";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['menu']['login_title'] = "Login Piwik-Server";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['menu']['update'] = "Update available";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['menu']['update_title'] = "New Piwik software update is available";

$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['graph']['visitors_last30days_headline'] = "last 30 days";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['graph']['visitors_last24months_headline'] = "last 24 months";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['graph']['visitors_visitsPerServerTime_headline'] = "visit time (server time)";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['graph']['visitors_visitTimeByDayOfWeek_headline'] = "visit days";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['graph']['visitors_userBrowser_headline'] = "browser";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['graph']['visitors_userCountry_headline'] = "visitors from";

$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['keywords_headline'] = "Top keywords, that leads to your website (period: last 30 days)";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['keywords_header_keyword'] = "Keyword";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['keywords_header_count'] = "Visits";

$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['fromWebsite_headline'] = "From this websites your visitors came from (period: last 30 days)";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['fromWebsite_header_website'] = "From website";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['fromWebsite_header_count'] = "Visits";

$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['visitedPages_headline'] = "Most visited pages (period: last 30 days)";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['visitedPages_header_page'] = "Page";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['visitedPages_header_count'] = "Visits";

$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['downloads_headline'] = "Most downloaded content (period: last 30 days)";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['downloads_header_domain'] = "Domain";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['downloads_header_file'] = "File";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['downloads_header_count'] = "Downloads";

$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['piwikinfo'] = "<p>Piwik is a free and open source web analytics application.</p><p>Piwik displays reports regarding the geographic location of visits, the source of visits (i.e. whether they came from a website, directly, or something else), the technical capabilities of visitors (browser, screen size, operating system, etc.), what the visitors did (pages they viewed, actions they took, how they left), the time of visits and more.</p><p>More informationen see <a href='http://piwik.org/' onclick='window.open(this.href); return false;'>www.piwik.org</a></p>";


/* 
 * <?php echo $this->lang->menu['optout_title']; ?>
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


