<?php

if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/* * *
* @copyright  µaTh 2014-2020
* @author     µaTh (+ Caro (ct9))
* @package    be_piwikcharts
* @license    GNU/LGPL 
* @filesource
*
* // Piwik wurde 2018 (mit Version 3.3.0) zu Matomo umbenannt
* // Matomo-API: https://developer.matomo.org/api-reference/reporting-api
* // Standard-API: https://developer.matomo.org/api-reference/reporting-api#standard-api-parameters
*/

class bepiwikcharts extends BackendModule {
    
    protected $strTemplate = 'be_piwikcharts';
    // Default-Werte (Demo-Modus)
    public $url = "http://demo.matomo.org/"; // inkl. http(s), mit / am Ende
    public $piwik_IDsite = 3;
    public $piwik_TOKENauth = "anonymous";
    public $piwik_period = 30;
    private $tableMaxRows = 10;
    public $modus = 0;      // 0 = Demo, 1 = normal
    private $username = "";
    private $password = "";
    private $error = FALSE;
    private $errorCode = 0;
    private $version_installed = "";
    
    public function compile() {
        
    }
    
    /**
        * Konstruktor
    * */
    function __construct() {
        // Super-Konstruktor (von BackendModule) aufrufen
        parent::__construct();
        
        // Daten der Einstellungen holen. Daten nur nutzen, wenn alle 3 Daten in den Einstellungen eingetragen wurden
        if ((strlen($GLOBALS["TL_CONFIG"]['piwikchartsURL']) > 0) && (strlen($GLOBALS["TL_CONFIG"]['piwikchartsSiteID']) > 0) && (strlen($GLOBALS["TL_CONFIG"]['piwikchartsAuthCode']) > 0)) {
            $this->url = $GLOBALS["TL_CONFIG"]['piwikchartsURL'];
            $this->piwik_IDsite = $GLOBALS["TL_CONFIG"]['piwikchartsSiteID'];
            $this->piwik_TOKENauth = $GLOBALS["TL_CONFIG"]['piwikchartsAuthCode'];
            if ($GLOBALS["TL_CONFIG"]['piwikchartsPeriod'] != "") {
                $this->piwik_period = intval($GLOBALS["TL_CONFIG"]['piwikchartsPeriod']);
            }
            $this->username = $GLOBALS["TL_CONFIG"]['piwikchartsUsername'];
            $this->password = $GLOBALS["TL_CONFIG"]['piwikchartsPassword'];
            $this->modus = 1; //1 = Normalmodus;
        }
    }
    
    /**
        * checkUpdate - prüft auf Updates
        * @return String - wenn neue Version vorliegt: neue Versionsnummer. Wenn keine neue Version vorliegt: Leerstring
    */
    function checkUpdate() {
        if ($this->modus == 1) {
            // nur im Produktivmodus nutzen. nicht im Demo-Modus
            try {
                // aktuelle Version vom Server lesen
                $xml = new SimpleXMLElement($this->readfile($this->url . "index.php?module=API&method=API.getPiwikVersion&format=xml&token_auth=" . $this->piwik_TOKENauth));
                $this->version_installed = trim($xml[0]);
                
                // neuste Version vom Piwik-Server lesen
                $version_newest = trim($this->readfile("http://api.piwik.org/1.0/getLatestVersion/"));
                
                if ($version_newest == $this->version_installed) {
                    return "";
                    } else {
                    return $version_newest;
                }
                } catch (Exception $e) {
                $this->error = TRUE;
                $this->errorCode = 1;
                return "";
            }
            } else {
            return "";
        }
    }
    
    /**
        * Abfrage des Matomo-Servers
        * @param $url string  Url- Fragment mit Abfrage zum Matomo-Server
        * @return Array mit den abgefragten Werten
    * */
    function readfile($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout = 5);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        if ($GLOBALS["TL_CONFIG"]['piwikchartsRedirect'] == true) {
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        }
        $file = curl_exec($ch);
        curl_close($ch);
        return $file;
    }
    
    /**
        * XMLload() - lädt XML-Datei
        *
        * @param $request_url   URL zu der XML-Datei, inkl. http://
        * @param $parameter     Array mit den Knotennamen, die ausgelesen werden
    */
    function XMLload($request_url, $parameter) {
        
        $data = readfile($request_url);
        $xml = new SimpleXMLElement($data);
        
        $ausgabe = array();
        
        // Kindknoten von <row> laden
        for ($i = 0; $i < count($xml->row); $i++) {
            foreach ($xml->row[$i] as $item => $titel) {
                if (in_array($item, $parameter, true)) {
                    $ausgabe[] = $titel;
                }
            }
        }
        return $ausgabe;
    }
    
    /**
    * PHPload - Liest das unserialisierte PHP-Array ein und erstellt ein neues Array mit den Werten aus $parameter
    * DEPRECATED - wird ersetzt durch JSONload
    * */
    function PHPload($url, $parameter) {
        $unserializedArray = unserialize($this->readfile($url));
        
        for ($i = 0; $i < count($unserializedArray); $i++) {
            foreach ($unserializedArray[$i] as $item => $titel) {
                if (in_array($item, $parameter, true)) {
                    $foundContent[] = $titel;
                }
            }
        }
        
        return $foundContent;
    }
    
    /**
    * JSONload - Liest das JSON ein und erstellt ein neues Array mit den Werten aus $parameter
    * 
    * */
    function JSONload($url, $parameter) {
        $unserializedArray = json_decode($this->readfile($url));
        $foundContent = [];
        
        for ($i = 0; $i < count($unserializedArray); $i++) {
            foreach ($unserializedArray[$i] as $item => $titel) {
                if (in_array($item, $parameter, true)) {
                    $foundContent[] = $titel;
                }
            }
        }
        
        return $foundContent;
    }
    
    /**
        * printTable_downloads() - gibt eine Tabelle speziell für Downloads aus
        *
        * @param  $inhalte  Array
        * @param  $cssklasse  (optional) CSS-Klasse für die Tabelle
    */
    function printTable_downloads($inhalte, $cssklasse = "") {
        $tabelle = "<table class=\"" . $cssklasse . "\">";
        $tabelle .= "<tr><th class=\"col0\">" . $GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['downloads_header_domain'] . "</th><th class=\"col1\">" . $GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['downloads_header_file'] . "</th><th class=\"col2\">" . $GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['downloads_header_count'] . "</th></tr>";

        if (!empty($inhalte)) {
            for ($i = 0; $i <= count($inhalte) / 2; $i = $i + 2) {
                $maxZeilen = $this->tableMaxRows;

                if ($maxZeilen > count($inhalte[$i + 1])) {
                    $maxZeilen = count($inhalte[$i + 1]);
                }

                for ($j = 0; $j < $maxZeilen; $j++) {
                    $tabelle .= "<tr>";
                    $tabelle .= "<td class=\"col0\">" . $inhalte[$i] . "</td>";
                    $path_parts = pathinfo($inhalte[$i + 1][$j]->label);
                    $tabelle .= "<td class=\"col1\"><a href=\"" . $inhalte[$i + 1][$j]->url . "\" target=\"_blank\" title=\"" . $inhalte[$i + 1][$j]->label . "\">" . $path_parts['basename'] . "</a></td>";
                    $tabelle .= "<td class=\"col2\">" . ($inhalte[$i + 1][$j]->nb_visits) . "</td>";
                    $tabelle .= "</tr>";
                }
            }
        }

        $tabelle .= "</table>";
        
        return $tabelle;
    }
    
    /**
        * printTable() - gibt eine HTML-Tabelle aus
        *
        * @param  $inhalte  Array
        * @param  $spalten  Tabellenkopfbezeichnungen
        * @param  $cssklasse  (optional) CSS-Klasse für die Tabelle
    */
    function printTable($inhalte, $spalten, $cssklasse = "") {
        // Anzahl Inhaltszeilen der Tabelle festlegen
        $rowsPerTable = $this->tableMaxRows;
        if (count($inhalte) / count($spalten) < $rowsPerTable) {
            $rowsPerTable = count($inhalte) / count($spalten);
        }
        
        // falls keine Daten gefunden werden, hier abbrechen
        if ($rowsPerTable < 1) {
            return "<table><tr><td>".$inhalte."Found no Data</td></table>";
        }
        
        // Anzahl der Tabellen nebeneinader ist abhängig von der Größe des Arrays $inhalte und der Zeilenanzahl der Tabelle ($rowsPerTable)
        $tabellen = ceil(count($inhalte) / ($rowsPerTable * count($spalten)));
        
        // resultTable wird nun aufgebaut und am Ende als return-Wert zurückgegeben
        $resultTable = "<table class=\"" . $cssklasse . "\">";
        
        // Tabellenkopf
        $resultTable .= "<tr>";
        for ($i = 0; $i < count($spalten) * $tabellen; $i++) {
            $resultTable .= "<th class=\"col" . ($i % count($spalten)) . "\">" . $spalten[$i % count($spalten)] . "</th>";
        }
        $resultTable .= "</tr>";
        
        // Tabelleninhalt
        for ($row = 0; $row < $rowsPerTable; $row++) {
            
            $resultTable .= "<tr>";
            
            // $tabellenspalte = Index der Tabelle, die nebeneinander angezeit wird
            for ($tabellenspalte = 0; $tabellenspalte < $tabellen; $tabellenspalte++) {
                
                for ($spalte = 0; $spalte < count($spalten); $spalte++) {
                    
                    // Prüfen, ob das Array groß genug ist um den Inhalt auszugeben oder nur eine leere Zelle zu erzeugen
                    if ((( $row * count($spalten) + $spalte ) + $tabellenspalte * $rowsPerTable * count($spalten)) < count($inhalte)) {
                        $resultTable .= "<td class=\"col" . $spalte . "\">";
                        $resultTable .= $inhalte[($row * count($spalten) + $spalte) + $tabellenspalte * $rowsPerTable * count($spalten)];
                        $resultTable .= "</td>";
                        } else {
                        // leere Zelle
                        $resultTable .= "<td class=\"col" . $spalte . "\"></td>";
                    }
                }
            }
            $resultTable .= "</tr>";
        }
        $resultTable .= "</table>";
        
        return $resultTable;
    }
    
    /**
        * buildURL - baut die Aufruf-URL für Matomo auf
        *
        * @param $method      Methode der Abfrage
        * @param $period      kleinstes Intervall ('day', 'week', 'month', 'year', 'range')
        * @param $date        untersuchtes Datum/Zeitintervall ('today', 'yesterday','previous30','YYYY-MM-DD%2CYYYY-MM-DD')
        * @param $additional  (optionaler Parameter) für weitere API-Parameter. Muss mit & beginnen. Schema: '&parameter=wert'
    */
    function buildURL($method, $period, $date, $additional) {
        $url = $this->url;
        $url.= 'index.php?module=API';
        $url.= '&method=' . $method;
        $url.= '&idSite=' . $this->piwik_IDsite;
        $url.= '&token_auth=' . $this->piwik_TOKENauth;
        $url.= '&period=' . $period;
        $url.= '&date=' . $date;
        $url.= $additional;
        
        return $url;
    }
    
    /**
        * printChart - Grafiken anzeigen
        *
        * @param $graphType   Grafentyp: 'evolution' (Liniendiagramm), 'horizontalBar' (horizontales Balkendiagramm), 'verticalBar' (Balkendiagramm) and 'pie' (2D Kreisdiagramm)
        * @param $apiModule   Bezeichnung Matomomodul (z.B. Besucherverlauf: 'VisitsSummary')
        * @param $period      kleinstes Intervall ('day', 'week', 'month', 'year', 'range')
        * @param $date        untersuchtes Datum/Zeitintervall ('today', 'yesterday','previous30','YYYY-MM-DD%2CYYYY-MM-DD')
        * @param $width, $height  Breite, Höhe der zu generierenden Grafik
        * @param $scale       Skalierung in Prozent
        * @param $apiAction   abhängig von $apiModule
        * @param $additional  (optionaler Parameter) für weitere API-Parameter. Muss mit & beginnen. Schema: '&parameter=wert'
        * @param $cssStyle    (optionaler Parameter) CSS-Style Attribut
    */
    function printChart($graphType, $apiModule, $period, $date, $width, $height, $scale, $apiAction, $additional = "", $cssStyle = "") {
        return '<img src="' . $this->buildURL("ImageGraph.get", $period, $date, '&apiModule=' . $apiModule . '&apiAction=' . $apiAction . '&graphType=' . $graphType . '&width=' . $width . '&height=' . $height . $additional) . '" alt="" width="' . ($width * $scale / 100) . '" style="' . $cssStyle . '" />';
    }
    
    /*   * *****************************************
        * Templates mit Inhalten füllen
    * **************************************** */
    
    /**
        * dashboardWelcomePage - Statistiken auf der Welcomepage nach dem Login anzeigen
    */
    function dashboardWelcomePage() {
        
        // wenn nicht Backend, dann abbrechen
        if (TL_MODE != 'BE') {
            return "";
        }  
        
        if ( !( $GLOBALS["TL_CONFIG"]['piwikchartsWelcomePage'] || ($this->User->isAdmin && $GLOBALS["TL_CONFIG"]['piwikchartsWelcomePageAdmin'] ) ) ) {
            // Statistiken nicht anzeigen, weil die Einstellungen so sind.
            return "";
        }
        
        //$strBuffer = '<div id="welcomepagePiwikcharts" style="margin:18px;">';
        $strBuffer = '<div id="welcomepagePiwikcharts">';
        
        $objTemplate_head = new BackendTemplate('ce_headline');
        $objTemplate_head->hl = 'h2';
        $objTemplate_head->class = 'ce_headline';
        //$objTemplate_head->style = 'background:none repeat scroll 0 0 #F6F6F6;border: solid #E9E9E9; border-width: 1px 0px 1px 0px; margin:18px 0px 6px; padding: 2px 6px 3px;';
        $objTemplate_head->headline = $GLOBALS['TL_LANG']['be_piwikcharts']['template']['dashboard']['headline'];
        
        $strBuffer .= $objTemplate_head->parse();
        
        $objTemplate_text = new BackendTemplate('ce_text');
        $objTemplate_text->class = 'ce_text';
        $objTemplate_text->style = 'position:relative;';
        
        
        $objTemplate_content = new BackendTemplate('be_piwikcharts_welcome');
        $objTemplate_content->update = $this->checkUpdate();
        if ($this->error) {
            $objTemplate_content->errorMessage = $GLOBALS['TL_LANG']['be_piwikcharts']['errormsg'][1];
            $objTemplate_text->text = $objTemplate_content->parse();
            $strBuffer .= $objTemplate_text->parse();
            
            $strBuffer .= '</div>';
            
            return $strBuffer;
        }
        
        // Text-Labels im Template bequem zur Verfügung stellen
        $objTemplate_content->lang = (object) $GLOBALS['TL_LANG']['be_piwikcharts']['template']['dashboard'];
        
        // Diagramme
        $objTemplate_content->chart_evolutionVisitsSummaryDay .= $this->printChart("evolution", "VisitsSummary", "day", "previous".$this->piwik_period, 400, 180, 100, "get", "", "");
        $objTemplate_content->chart_evolutionVisitsSummaryMonth .= $this->printChart("evolution", "VisitsSummary", "month", "previous24", 400, 100, 100, "get", "&colors=,,ff0000", "");
        
        //im Demo-Modus (0) ist die Anzeige letzte 30Min/24h deaktivert
        if ($this->modus > 0) {
            $temp = $this->JSONload($this->buildURL("Live.getCounters", "", "", "&format=json&lastMinutes=30"), array("visitors"));
            $objTemplate_content->visitsLast30Minutes = $temp[0];
            $temp = $this->JSONload($this->buildURL("Live.getCounters", "", "", "&format=json&lastMinutes=".(60*24)), array("visitors"));
            $objTemplate_content->visitsLast24Hours = $temp[0];
            } else {
            $objTemplate_content->visitsLast30Minutes = "(disabled)";
            $objTemplate_content->visitsLast24Hours = "(disabled)";
        }
        
        $objTemplate_content->link_optOut = $this->url . "index.php?module=CoreAdminHome&action=optOut";
        $objTemplate_content->showOptOut = $GLOBALS["TL_CONFIG"]['piwikchartsWelcomePageOptout'] || $this->User->isAdmin;
        $objTemplate_content->optOutIcon = "system/modules/be_piwikcharts/assets/optout.png";
        
        
        $objTemplate_content->showUpdate = $this->User->isAdmin || $GLOBALS["TL_CONFIG"]['piwikchartsWelcomePageUpdate'];
        $objTemplate_content->updateIcon = "system/modules/be_piwikcharts/assets/update.png";
        $objTemplate_content->link_server = $this->url;
        
        $this->import('BackendUser', 'User');
        if ($this->User->hasAccess('be_piwikcharts', 'modules')) {
            $objTemplate_content->moreLinkAccess = true;
            $objTemplate_content->zoomIcon = "system/modules/be_piwikcharts/assets/zoom.png";
            } else {
            $objTemplate_content->moreLinkAccess = false;
        }
        
        $objTemplate_text->text = $objTemplate_content->parse();
        $strBuffer .= $objTemplate_text->parse();
        
        $strBuffer .= '</div>';
        
        return $strBuffer;
    }
    
    /**
        * generate() - wird von Contao automatisch geladen
        *
        * Templatevariablen belegen
    */
    public function generate() {
        // wenn nicht Backend, dann abbrechen
        if (TL_MODE != 'BE') {
            // generate() von der Oberklasse (BackendModule) aufrufen
            return parent::generate();
        } 
        
        // Objekt vom Template "be_piwikcharts" erzeugen
        $objTemplate = new BackendTemplate('be_piwikcharts');
        
        $objTemplate->lang = (object) $GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet'];
        
        $objTemplate->update = $this->checkUpdate();
        if ($this->error) {
            $objTemplate->errorMessage = $GLOBALS['TL_LANG']['be_piwikcharts']['errormsg'][1];
            return $objTemplate->parse();
        }
        
        // Userklasse laden. Wird zum Prüfen benötigt, ob der User ein Admin ist
        $this->import('BackendUser', 'User');
        $objTemplate->isAdmin = $this->User->isAdmin;
        
        // Steuerelemente
        $objTemplate->link_settings = $this->Environment->path . "/contao/main.php?do=settings#pal_piwikcharts_legend";
        
        if (!empty($this->username) && !empty($this->password)) {
            $hashed = hash('md5', @Encryption::decrypt($this->password));
            $objTemplate->link_server_login = $this->url . 'index.php?module=Login&action=logme&login=' . $this->username . '&password=' . $hashed;
        }
        
        $objTemplate->link_server = $this->url;
        
        $objTemplate->piwik_period = $this->piwik_period;
        
        
        $objTemplate->piwik_IDsite = $this->piwik_IDsite;
        $objTemplate->link_optOut = $this->url . "index.php?module=CoreAdminHome&action=optOut";
        
        $objTemplate->showUpdate = $this->User->isAdmin || $GLOBALS["TL_CONFIG"]['piwikchartsWelcomePageUpdate'];
        
        // 30 Tage Besuchergraf
        $objTemplate->chart_evolutionVisitsSummaryDay = $this->printChart("evolution", "VisitsSummary", "day", "previous".$this->piwik_period, 400, 200, 100, "get");
        
        // 24 Monate Besuchergraf
        $objTemplate->chart_evolutionVisitsSummaryMonth = $this->printChart("evolution", "VisitsSummary", "month", "previous24", 400, 200, 100, "get", "&colors=,,ff0000");
        
        // Diagramm Besuchszeiten
        $objTemplate->chart_verticalBarVisitsPerServerTime = $this->printChart("verticalBar", "VisitTime", "range", "previous".$this->piwik_period, 400, 200, 100, "getVisitInformationPerServerTime");
        
        // Diagramm Besuchertage
        $objTemplate->chart_verticalBarVisitTimeByDayOfWeek = $this->printChart("verticalBar", "VisitTime", "range", "previous".$this->piwik_period, 400, 200, 100, "getByDayOfWeek");
        
        // Diagramm Browser
        $objTemplate->chart_horizontalBarUserBrowser = $this->printChart("horizontalBar", "DevicesDetection", "range", "previous".$this->piwik_period, 400, 200, 100, "getBrowsers");
        
        $version = explode(".", $this->version_installed);
        
        if (intval($version[0])<2 || (intval($version[0])<2 &&  intval($version[1])<10) ) {
            // in der Piwik Version 2.10 wurde die API angepasst. Ab Version 2.14 wurde "UserSettings" abgeschaltet. Fuer die Rueckwaertskompatibilitaet
            $objTemplate->chart_horizontalBarUserBrowser = $this->printChart("horizontalBar", "UserSettings", "range", "previous".$this->piwik_period, 400, 200, 100, "getBrowser");
        }
        
        // Diagramm Länder
        $objTemplate->chart_horizontalBarUserCountry = $this->printChart("horizontalBar", "UserCountry", "range", "previous".$this->piwik_period, 400, 200, 100, "getCountry");
        
        //Tabelle: Suchworte von Suchmaschinen
        $objTemplate->table_keywords = $this->printTable(
            $this->JSONload(
                $this->buildURL(
                    "Referrers.getKeywords", "range", "previous".$this->piwik_period, "&format=json&filter_limit=20"
                ), array("label", "nb_visits")
            ), array(
                $GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['keywords_header_keyword'],
                $GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['keywords_header_count']
            ), "data"
        );
        
        //Tabelle: Besucher von Webseite
        $objTemplate->table_fromWebsite = $this->printTable(
        $this->JSONload(
            $this->buildURL(
                "Referrers.getWebsites", "range", "previous".$this->piwik_period, "&format=json&filter_limit=20"
                ), array("label", "nb_visits")
            ), array(
                $GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['fromWebsite_header_website'],
                $GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['fromWebsite_header_count']
            ), "data"
        );
        
        // Tabelle: angeschaute Seiten
        $objTemplate->table_visitedPages = $this->printTable(
            $this->JSONload(
                $this->buildURL(
                    "Actions.getPageUrls", "range", "previous".$this->piwik_period, "&format=json&filter_limit=20"
                ), array("label", "nb_visits")
            ), array(
                $GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['visitedPages_header_page'],
                $GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['visitedPages_header_count']
            ), "data"
        );
        
        // Tabelle: Downloads
        $objTemplate->table_downloads = $this->printTable_downloads(
            $this->JSONload(
                $this->buildURL(
                    "Actions.getDownloads", "range", "previous".$this->piwik_period, "&format=json&filter_limit=20&expanded=1&filter_limit=10"
                ), array("label", "subtable")
            ), "downloads"
        );
        
        // Zusammenfassung (letzte 30 Minuten/letzte 24 Stunden)
        //im Demo-Modus ist die Anzeige letzte 30Min/24h deaktivert
        if ($this->modus > 0) {
            $temp = $this->JSONload($this->buildURL("Live.getCounters", "", "", "&format=json&lastMinutes=30"), array("visitors"));
            $objTemplate->visitsLast30Minutes = $temp[0];
            $temp = $this->JSONload($this->buildURL("Live.getCounters", "", "", "&format=json&lastMinutes=" . (60 * 24)), array("visitors"));
            $objTemplate->visitsLast24Hours = $temp[0];
            } else {
            $objTemplate->visitsLast30Minutes = "(disabled)";
            $objTemplate->visitsLast24Hours = "(disabled)";
        }
        
        return $objTemplate->parse();
    }
    
    
    
    
    
    /****************************************************************************
    * individuelle rgxp:
    * siehe Contao-Doku: https://contao.org/de/manual/3.3/customizing-contao.html#addcustomregexp
    * ************************************************************************** */
    
    /**
        * checkPiwikUrl: URL-Format prüfen + prüfen ob Piwik-Installation gefunden werden kann.
        * 
        * @param type $strRegexp
        * @param type $varValue
        * @param Widget $objWidget
        * @return boolean
    */
    public function myRegexp_checkMatomoUrl($strRegexp, $varValue, Widget $objWidget) {
        if ($strRegexp == 'checkMatomoUrl') {
            if (substr(trim($varValue), -1, 1) != "/") {
                $varValue .= "/";
            }
            
            if (!preg_match('%^(?:(?:https?)://)(?:\S+(?::\S*)?@|\d{1,3}(?:\.\d{1,3}){3}|(?:(?:[a-z\d\x{00a1}-\x{ffff}]+-?)*[a-z\d\x{00a1}-\x{ffff}]+)(?:\.(?:[a-z\d\x{00a1}-\x{ffff}]+-?)*[a-z\d\x{00a1}-\x{ffff}]+)*(?:\.[a-z\x{00a1}-\x{ffff}]{2,6}))(?::\d+)?(?:[^\s]*)?$%iu', $varValue)) {
                $objWidget->addError($GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['URL']['rgxp_URL']);
                } else {
                $httpCode = $this->getHttpCode($varValue . "piwik.js");
                if ($httpCode != 200) {
                    $objWidget->addError($GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['URL']['rgxp_httpCode'] . $httpCode);
                }
            }
            
            return true;
        }
        
        return false;
    }
    
    /**
        * getHttpCode - ermittelt den HTTP-Code von $url
        * 
        * @param String $url
        * @return integer
    */
    public function getHttpCode($url) {
        $ch = curl_init();
        
        // set URL and other appropriate options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);
        
        return $info['http_code'];
    }
    
    /**
    * checkAuthCode - prüft, ob mit dem AuthCode auf die Matomo-Installation zugegriffen werden kann.
    * 
    * @param type $strRegexp
    * @param type $varValue
    * @param Widget $objWidget
    * @return boolean
    */
    public function myRegexp_checkAuthCode($strRegexp, $varValue, Widget $objWidget) {
        if ($strRegexp == 'checkAuthCode') {
            try {
                $xml = new SimpleXMLElement($this->readfile($GLOBALS["TL_CONFIG"]['piwikchartsURL'] . "index.php?module=API&method=API.getMatomoVersion&format=xml&token_auth=" . $varValue));
                $version_installed = trim($xml[0]);
                if (strlen($version_installed) < 1) {
                    $objWidget->addError($GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['authCode']['rgxp']);
                }
                } catch (Exception $e) {
                return true;
            }
            return true;
        }
        
        return false;
    }
    
}

?>
