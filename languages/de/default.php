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
 * Fehlemeldungen
 */
$GLOBALS['TL_LANG']['be_piwikcharts']['errormsg'][1] = "be_piwikcharts: Fehler#1: Verbindung zum Piwik-Server konnte nicht hergestellt werden. Bitte Verbindungseinstellungen prüfen.";

$GLOBALS['TL_LANG']['be_piwikcharts']['template']['dashboard']['headline'] = "Besucherstatistiken";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['dashboard']['live']['headline'] = "Anzahl Besucher";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['dashboard']['live']['last30minutes'] = "letzte 30 Minuten";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['dashboard']['live']['last24hours'] = "letzte 24 Stunden";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['dashboard']['optOut'] = "Optout: Eigene Besuche auf der Webseite nicht mehr erfassen";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['dashboard']['newVersionHint'] = "Ein neues Update der Piwik-Software ist verfügbar";

$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['headline'] = "Statistiken Besucher mit Piwik";

$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['live']['headline'] = "Anzahl Besucher";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['live']['last30minutes'] = "letzte 30 Minuten";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['live']['last24hours'] = "letzte 24 Stunden";

$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['menu']['settings'] = "Zu den Einstellungen";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['menu']['settings_title'] = "Zu den Einstellungen";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['menu']['print'] = "Seite drucken";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['menu']['print_title'] = "Statistiken ausdrucken";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['menu']['optout'] = "OptOut";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['menu']['optout_title'] = "Einstellungen: Eigene Besuche nicht mehr erfassen";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['menu']['login'] = "Login Piwik";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['menu']['login_title'] = "Login Piwik-Server";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['menu']['update'] = "Update verfügbar";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['menu']['update_title'] = "Ein neues Update der Piwik-Software ist verfügbar";

$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['graph']['visitors_last30days_headline'] = "letzte 30 Tage";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['graph']['visitors_last24months_headline'] = "letzte 24 Monate";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['graph']['visitors_visitsPerServerTime_headline'] = "Besuchszeiten (Serverzeit)";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['graph']['visitors_visitTimeByDayOfWeek_headline'] = "Besuchertage";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['graph']['visitors_userBrowser_headline'] = "Browser";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['graph']['visitors_userCountry_headline'] = "Besucher aus";

$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['keywords_headline'] = "Top-Suchwörter, die auf die Webseite geführten hatten (Zeitraum: letzte 30 Tage)";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['keywords_header_keyword'] = "Suchwort";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['keywords_header_count'] = "Aufrufe";

$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['fromWebsite_headline'] = "Von diesen Webseiten kamen Ihre Besucher auf Ihre Webseite (Zeitraum: letzte 30 Tage)";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['fromWebsite_header_website'] = "Von Webseite";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['fromWebsite_header_count'] = "Aufrufe";

$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['visitedPages_headline'] = "Die am häufigsten besuchten Seiten (Zeitraum: letzte 30 Tage)";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['visitedPages_header_page'] = "Seite";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['visitedPages_header_count'] = "Aufrufe";

$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['downloads_headline'] = "Die häufigsten Downloads (Zeitraum: letzte 30 Tage)";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['downloads_header_domain'] = "Domain";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['downloads_header_file'] = "Datei";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['downloads_header_count'] = "Downloads";

$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['piwikinfo'] = "<p>Piwik ist eine Open-Source (GPL lizenzierte) Webanalyse-Software, die heruntergeladen werden kann. Piwik bietet Ihnen detaillierte Echtzeit-Berichte über die Besucher Ihrer Homepage, die genutzten Suchmaschinen und Suchbegriffe, die Sprache, Ihre beliebten Seiten… und vieles mehr.</p><p>Das Ziel von Piwik ist es, eine Open-Source Alternative zu Google Analytics zu bieten. Piwik wird bereits auf mehr als 320.000 Webseiten eingesetzt.</p><p>Weitere Informationen auf <a href='http://de.piwik.org/' onclick='window.open(this.href); return false;'>www.piwik.org</a></p>";


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


