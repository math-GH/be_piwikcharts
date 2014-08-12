<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2011 Leo Feyer
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
 * @filesource
 */

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_settings']['piwikcharts_legend'] = 'Piwik: Statistiken Besucher (be_piwikcharts)';

$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['URL'] = array("URL","URL zu der Piwik-Installation: (http(s)://sub.domain.tld/subfolder/)");
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['URL']['absoluteUrl_regExp'] = 'Bitte geben Sie ein gültiges URL-Format ein und kodieren Sie Sonderzeichen! (http(s)://sub.domain.tld/subfolder/)';
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['siteID'] = array("SiteID","Webseiten-ID: idSite-Variable aus der Piwik-Installation. Bei Piwik-Installationen, die nur eine Webseite erfassen ist 1 der Standard. DenWert der idSite-Variabe findet man in der URL, wenn man sich das Dashboards auf dem Piwik-Server anschaut.");
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['authCode'] = array("AuthCode","AuthCode für die Verbindung mit Piwik um die Statistiken im Backendmodul anzeigen zu können.");
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['username'] = array("Benutzername","Benutzername für den Auto-Login in Piwik (optional)");
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['password'] = array("Passwort","Passwort für den Auto-Login mit Piwik (optional)");
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['welcomePageAdmin'] = array("BE-Startseite: Statistiken anzeigen (nur für Admins)","Nur für Admin-User: Zeigt eine Auswahl von Statistiken auf der ersten Seite nach dem Login an. Zusätzlich wird geprüft ob ein Update von Piwik bereit steht.");
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['welcomePage'] = array("BE-Startseite: Statistiken im Backend anzeigen (für alle User)","Für alle User (inkl. Admins): Zeigt eine Auswahl von Statistiken auf der ersten Seite nach dem Login an.");
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['welcomePageUpdate'] = array("BE-Startseite: Über Piwik-Update informieren (für Nicht-Admins)","Zeigt für Nicht-Admins eine Information an, wenn ein Update von Piwik bereit steht. Admins werden immer informiert.");
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['welcomePageOptout'] = array("Optout-Link (für Nicht-Admins)","Zeigt für Nicht-Admins neben der Überschrift ein Icon an, über dessen Link die Erfassung von Piwik deaktiviert werden kann.");
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['redirect'] = array("Redirects auf der Piwik-Domain", "wenn man z.B. von nicht-www auf www umschreibt etc.. Aktivierung kann zur PHP-Warnung führen: CURLOPT_FOLLOWLOCATION cannot be activated"); 


?>