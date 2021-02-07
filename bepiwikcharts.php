<?php

if (!defined('TL_ROOT')){
    die('You cannot access this file directly!');
}

/* * *
* @copyright  µaTh 2014-2020
* @author     µaTh (+ others. See GitHub)
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
    public $url = "https://demo.matomo.org/"; // inkl. http(s), mit / am Ende
    public $piwik_IDsite = 3;
    public $piwik_TOKENauth = "anonymous";
    public $piwik_period = 30;
    private $chartHeight = 200;
    private $chartWidth = 400;
    private $tableMaxRows = 10;
    const DEMO = 0;
    const CONNECTED = 1;
    private $modus = self::DEMO;      // 0 = Demo, 1 = normal
    private $error = FALSE;
    private $errorCode = 0;
    private $version_installed = "";
    private $apiLatestVersionURL = "https://api.matomo.org/1.0/getLatestVersion/";
    
    public function compile() {
        
    }
    
    /**
     * Konstruktor
     **/
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
            
            $this->modus = bepiwikcharts::CONNECTED;
        }
    }
    
    /**
     * checkUpdate - prüft auf Updates
     * @return String - wenn neue Version vorliegt: neue Versionsnummer. Wenn keine neue Version vorliegt: Leerstring
     **/
    function checkUpdate() {
        
        
        try {
            $this->version_installed = $this->getVersionInstalled();

            if ($this->modus != bepiwikcharts::CONNECTED) {
                // nur im Produktivmodus nutzen. nicht im Demo-Modus
                return "";
            }
            // neuste Version vom Matomo-Server lesen
            $version_newest = $this->getVersionAvailable();
            
            if ($version_newest == $this->version_installed) {
                return "";
            } 
            else {
                return $version_newest;
            }
        }
        catch (Exception $e) {
            $this->error = true;
            $this->errorCode = 1;
            return "";
        }
    }
    
    /*
     * getVersionInstalled() - Installierte Version von Matomo ermitteln
     * return String Versionsnummer
     */
    function getVersionInstalled() {
        try {
            // aktuelle Version vom Server lesen
            $xml = new SimpleXMLElement($this->readfile($this->url . "index.php?module=API&method=API.getMatomoVersion&format=xml&token_auth=" . $this->piwik_TOKENauth));
            return trim($xml[0]);
        }
        catch (Exception $e) {
            $this->error = true;
            $this->errorCode = 1;
            return "";
        }
    }
    
    /*
     * getVersionAvailable() - Verfügbare Version von Matomo ermitteln
     * return String Versionsnummer
     */
    function getVersionAvailable() {
        try {
            return trim($this->readfile($this->apiLatestVersionURL));
        }
        catch (Exception $e) {
            $this->error = true;
            $this->errorCode = 1;
            return "";
        }
    }
    
    /**
     * Abfrage des Matomo-Servers
     * @param $url string  Url- Fragment mit Abfrage zum Matomo-Server
     * @return Array mit den abgefragten Werten
     **/
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
     **/
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
     * @param $url Webadresse, die aufgerufen wird
     * @param $parameter Elemente, die ausgelesen werden sollen
     **/
    function JSONload($url, $parameter) {
        $unserializedArray = json_decode($this->readfile($url."&format=json"));
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
     **/
    function printTable_downloads($inhalte, $cssklasse = "") {
        $tabelle = "<table class=\"" . $cssklasse . "\">";
        $tabelle .= "<tr><th class=\"tl_folder_tlist col0\">" . $GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['downloads_header_domain'] . "</th><th class=\"tl_folder_tlist col1\">" . $GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['downloads_header_file'] . "</th><th class=\"tl_folder_tlist col2\">" . $GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['downloads_header_count'] . "</th></tr>";

        if (!empty($inhalte)) {
            for ($i = 0; $i <= count($inhalte) / 2; $i = $i + 2) {
                $maxZeilen = $this->tableMaxRows;

                if ($maxZeilen > count($inhalte[$i + 1])) {
                    $maxZeilen = count($inhalte[$i + 1]);
                }

                for ($j = 0; $j < $maxZeilen; $j++) {
                    $tabelle .= "<tr class=\"hover-row\">";
                    $tabelle .= "<td class=\"tl_file_list col0\">" . $inhalte[$i] . "</td>";
                    $path_parts = pathinfo($inhalte[$i + 1][$j]->label);
                    $tabelle .= "<td class=\"tl_file_list col1\"><a href=\"" . $inhalte[$i + 1][$j]->url . "\" target=\"_blank\" title=\"" . $inhalte[$i + 1][$j]->label . "\">" . $path_parts['basename'] . "</a></td>";
                    $tabelle .= "<td class=\"tl_file_list col2\">" . ($inhalte[$i + 1][$j]->nb_visits) . "</td>";
                    $tabelle .= "</tr>";
                }
            }
        }

        $tabelle .= "</table>";
        
        return $tabelle;
    }
    // https://psvcottbus-schwimmen.de/mato/index.php?module=API&method=Resolution.getResolution&idSite=1&&period=range&date=previous30&format=tsv&token_auth=8b7d02f9fc1712cf9513b207bff288b4&showColumns=label,nb_visits&filter_sort_column=label&filter_sort_order=desc
    
    
    function summarizeResolution ($inhalte) {
        $aufloesungRanges = "0;";
        // default: 320;480;768;1024;1200
        $aufloesungRanges .= "360;550;950;1200";
        $aufloesungRanges .= ";99999";
        $aufloseungMax = explode(";", $aufloesungRanges);
        $a = 1;
        $zusammenfassung = [];
        $zusammenfassung[$a*2-2] = intval($aufloseungMax[$a-1])+1 . ' - ' .$aufloseungMax[$a];
        $zusammenfassung[$a*2+1-2] = 0;
        
        for ($i = 0; $i < count($inhalte); $i = $i+2) {
            if (strpos($inhalte[$i], "x") > 0) {
                $label = explode("x",$inhalte[$i]);
                // $label[0] enthält die Breite
                if (intval($label[0]) <= intval($aufloseungMax[$a])) {
                    $zusammenfassung[$a*2+1-2] = intval($zusammenfassung[$a*2+1-2]) + intval($inhalte[$i+1]);
                } 
                else {
                    $a++;
                    $zusammenfassung[$a*2-2] = intval($aufloseungMax[$a-1])+1 . ' - ' .$aufloseungMax[$a];
                    $zusammenfassung[$a*2+1-2] = intval($inhalte[$i+1]);
                }

            }
        }
        
        // $zusammengefasst[0] = "test"; 
        // $zusammengefasst[1] = "5"; 
        return $zusammenfassung;
    }
    
    /**
     * printTable() - gibt eine HTML-Tabelle aus
     *
     * @param  $inhalte  Array (1-Dimensional)
     * @param  $spalten  Array Tabellenkopfbezeichnungen
     * @param  $cssklasse  (optional) CSS-Klasse für die Tabelle
     **/
    function printTable($inhalte, $spalten, $cssklasse = "") {
        // Anzahl Inhaltszeilen der Tabelle festlegen
        $rowsPerTable = $this->tableMaxRows;
        if (count($inhalte) / count($spalten) < $rowsPerTable) {
            $rowsPerTable = count($inhalte) / count($spalten);
        }
        
        // falls keine Daten gefunden werden, hier abbrechen
        if ($rowsPerTable < 1) {
            return '<table class="tl_listing data"><tr><th class="tl_folder_tlist"></th></tr><tr class="hover-row"><td class="tl_file_list">No Data Found</td></table>';
        }
        
        // Anzahl der Tabellen nebeneinader ist abhängig von der Größe des Arrays $inhalte und der Zeilenanzahl der Tabelle ($rowsPerTable)
        $tabellen = ceil(count($inhalte) / ($rowsPerTable * count($spalten)));
        
        // resultTable wird nun aufgebaut und am Ende als return-Wert zurückgegeben
        $resultTable = "<table class=\"" . $cssklasse . "\">";
        
        // Tabellenkopf
        $resultTable .= "<tr>";
        for ($i = 0; $i < count($spalten) * $tabellen; $i++) {
            $resultTable .= "<th class=\"tl_folder_tlist col" . ($i % count($spalten)) . "\">" . $spalten[$i % count($spalten)] . "</th>";
        }
        $resultTable .= "</tr>";
        
        // Tabelleninhalt
        for ($row = 0; $row < $rowsPerTable; $row++) {
            
            $resultTable .= "<tr class=\"hover-row\">";
            
            // $tabellenspalte = Index der Tabelle, die nebeneinander angezeit wird
            for ($tabellenspalte = 0; $tabellenspalte < $tabellen; $tabellenspalte++) {
                
                for ($spalte = 0; $spalte < count($spalten); $spalte++) {
                    
                    // Prüfen, ob das Array groß genug ist um den Inhalt auszugeben oder nur eine leere Zelle zu erzeugen
                    if ((( $row * count($spalten) + $spalte ) + $tabellenspalte * $rowsPerTable * count($spalten)) < count($inhalte)) {
                        $resultTable .= "<td class=\"tl_file_list col" . $spalte . "\">";
                        $resultTable .= $inhalte[($row * count($spalten) + $spalte) + $tabellenspalte * $rowsPerTable * count($spalten)];
                        $resultTable .= "</td>";
                        } else {
                        // leere Zelle
                        $resultTable .= "<td class=\"tl_file_list col" . $spalte . "\"></td>";
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
     **/
    function buildURL($method, $period, $date, $filterlimit = 100,$additional = "") {
        $url = $this->url;
        $url.= 'index.php?module=API';
        $url.= '&method=' . $method;
        $url.= '&idSite=' . $this->piwik_IDsite;
        $url.= '&token_auth=' . $this->piwik_TOKENauth;
        $url.= '&period=' . $period;
        $url.= '&date=' . $date;
        $url.= '&filter_limit=' . $filterlimit;
        $url.= $additional;
        
        return $url;
    }
    
    /**
     * urlChart - URL von Grafiken anzeigen
     *
     * @param $graphType   Grafentyp: 'evolution' (Liniendiagramm), 'horizontalBar' (horizontales Balkendiagramm), 'verticalBar' (Balkendiagramm) and 'pie' (2D Kreisdiagramm)
     * @param $apiModule   Bezeichnung Matomomodul (z.B. Besucherverlauf: 'VisitsSummary')
     * @param $period      kleinstes Intervall ('day', 'week', 'month', 'year', 'range')
     * @param $date        untersuchtes Datum/Zeitintervall ('today', 'yesterday','previous30','YYYY-MM-DD%2CYYYY-MM-DD')
     * @param $width, $height  Breite, Höhe der zu generierenden Grafik
     * @param $apiAction   abhängig von $apiModule
     * @param $multiplier Zoom-Faktor (default: 1)
     * @param $additional  (optionaler Parameter) für weitere API-Parameter. Muss mit & beginnen. Schema: '&parameter=wert'
     **/
    function urlChart($graphType, $apiModule, $period, $date, $width, $height, $apiAction, $multiplier = 1, $additional = "") {
        return $this->buildURL("ImageGraph.get", $period, $date, '&apiModule=' . $apiModule . '&apiAction=' . $apiAction . '&graphType=' . $graphType . '&width=' . $width*$multiplier . '&height=' . $height*$multiplier . $additional);
    }
    
    
    /*******************************************
     * Templates mit Inhalten füllen
     ***************************************** */
    
    /**
     * generate() - wird von Contao automatisch geladen
     *
     * Templatevariablen belegen
     **/
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
        
        $objTemplate->link_server = $this->url;
        
        $objTemplate->piwik_period = $this->piwik_period;
        
        
        $objTemplate->piwik_IDsite = $this->piwik_IDsite;
        $objTemplate->link_optOut = $this->url . "index.php?module=CoreAdminHome&action=optOut";
        
        $objTemplate->showUpdate = $this->User->isAdmin;
        
        $objTemplate->chartHeight = $this->chartHeight;
        $objTemplate->chartWidth = $this->chartWidth;
        
        // 30 Tage Besuchergraf
        $objTemplate->url_chart_evolutionVisitsSummaryDay = $this->urlChart("evolution", "VisitsSummary", "day", "previous".$this->piwik_period, $this->chartWidth, $this->chartHeight, "get");
        $objTemplate->urlx2_chart_evolutionVisitsSummaryDay = $this->urlChart("evolution", "VisitsSummary", "day", "previous".$this->piwik_period, $this->chartWidth, $this->chartHeight, "get", 2);
        
        // 24 Monate Besuchergraf
        $objTemplate->url_chart_evolutionVisitsSummaryMonth = $this->urlChart("evolution", "VisitsSummary", "month", "previous24", $this->chartWidth, $this->chartHeight, "get", 1, "&colors=,,ff0000");
        $objTemplate->urlx2_chart_evolutionVisitsSummaryMonth = $this->urlChart("evolution", "VisitsSummary", "month", "previous24", $this->chartWidth, $this->chartHeight, "get", 2, "&colors=,,ff0000");
        
        // Diagramm Besuchszeiten
        $objTemplate->url_chart_verticalBarVisitsPerServerTime = $this->urlChart("verticalBar", "VisitTime", "range", "previous".$this->piwik_period, $this->chartWidth, $this->chartHeight,  "getVisitInformationPerServerTime");
        $objTemplate->urlx2_chart_verticalBarVisitsPerServerTime = $this->urlChart("verticalBar", "VisitTime", "range", "previous".$this->piwik_period, $this->chartWidth, $this->chartHeight,  "getVisitInformationPerServerTime", 2);
        
        // Diagramm Besuchertage
        $objTemplate->url_chart_verticalBarVisitTimeByDayOfWeek = $this->urlChart("verticalBar", "VisitTime", "range", "previous".$this->piwik_period, $this->chartWidth, $this->chartHeight, "getByDayOfWeek");
        $objTemplate->urlx2_chart_verticalBarVisitTimeByDayOfWeek = $this->urlChart("verticalBar", "VisitTime", "range", "previous".$this->piwik_period, $this->chartWidth, $this->chartHeight, "getByDayOfWeek", 2);
        
        // Diagramm Browser
        $objTemplate->url_chart_horizontalBarUserBrowser = $this->urlChart("horizontalBar", "DevicesDetection", "range", "previous".$this->piwik_period, $this->chartWidth, $this->chartHeight, "getBrowsers");
        $objTemplate->urlx2_chart_horizontalBarUserBrowser = $this->urlChart("horizontalBar", "DevicesDetection", "range", "previous".$this->piwik_period, $this->chartWidth, $this->chartHeight, "getBrowsers", 2);
        
        $version = explode(".", $this->version_installed);
        
        if (intval($version[0])<2 || (intval($version[0])<=2 &&  intval($version[1])<10) ) {
            // in der Piwik Version 2.10 wurde die API angepasst. Ab Version 2.14 wurde "UserSettings" abgeschaltet. Fuer die Rueckwaertskompatibilitaet
            $objTemplate->url_chart_horizontalBarUserBrowser = $this->urlChart("horizontalBar", "UserSettings", "range", "previous".$this->piwik_period, $this->chartWidth, $this->chartHeight, "getBrowser");
            $objTemplate->urlx2_chart_horizontalBarUserBrowser = $this->urlChart("horizontalBar", "UserSettings", "range", "previous".$this->piwik_period, $this->chartWidth, $this->chartHeight, "getBrowser", 2);
        }
        
        // Diagramm Länder
        $objTemplate->url_chart_horizontalBarUserCountry = $this->urlChart("horizontalBar", "UserCountry", "range", "previous".$this->piwik_period, $this->chartWidth, $this->chartHeight, "getCountry");
        $objTemplate->urlx2_chart_horizontalBarUserCountry = $this->urlChart("horizontalBar", "UserCountry", "range", "previous".$this->piwik_period, $this->chartWidth, $this->chartHeight, "getCountry", 2);
        
        //Tabelle: Suchworte von Suchmaschinen
        $objTemplate->table_keywords = $this->printTable(
            $this->JSONload(
                $this->buildURL(
                    "Referrers.getKeywords", "range", "previous".$this->piwik_period, 20
                ), 
                array("label", "nb_visits")
            ), 
            array(
                $GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['keywords_header_keyword'],
                $GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['keywords_header_count']
            ), "tl_listing data"
        );
        
        //Tabelle: Besucher von Webseite
        $objTemplate->table_fromWebsite = $this->printTable(
            $this->JSONload(
                $this->buildURL(
                    "Referrers.getWebsites", "range", "previous".$this->piwik_period, 20
                ), 
                array("label", "nb_visits")
            ), 
            array(
                $GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['fromWebsite_header_website'],
                $GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['fromWebsite_header_count']
            ), "tl_listing data"
        );
        
         $objTemplate->table_resolution = $this->printTable(
            $this->summarizeResolution(
                $this->JSONload(
                    $this->buildURL(
                        "Resolution.getResolution", "range", "previous".$this->piwik_period, 100, "&showColumns=label,nb_visits&filter_sort_column=label&filter_sort_order=asc"
                    ),
                    array("label", "nb_visits")
                )
            ), 
            array(
                "Auflösung",
                $GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['fromWebsite_header_count']
            ), "tl_listing data"
        );
        
        // Tabelle: angeschaute Seiten
        $objTemplate->table_visitedPages = $this->printTable(
            $this->JSONload(
                $this->buildURL(
                    "Actions.getPageUrls", "range", "previous".$this->piwik_period, 20
                ), 
                array("label", "nb_visits")
            ), 
            array(
                $GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['visitedPages_header_page'],
                $GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['visitedPages_header_count']
            ), "tl_listing data"
        );
        
        // Tabelle: Downloads
        $objTemplate->table_downloads = $this->printTable_downloads(
            $this->JSONload(
                $this->buildURL(
                    "Actions.getDownloads", "range", "previous".$this->piwik_period, 20, "&expanded=1"
                ), 
                array("label", "subtable")
            ), "tl_listing downloads"
        );
        
        // Zusammenfassung (letzte 30 Minuten/letzte 24 Stunden)
        //im Demo-Modus ist die Anzeige letzte 30Min/24h deaktivert
        switch ($this->modus) {
            case bepiwikcharts::CONNECTED:
                $temp30m = $this->JSONload($this->buildURL("Live.getCounters", "", "", "&lastMinutes=30"), array("visitors"));
                $objTemplate->visitsLast30Minutes = $temp30m[0];
                $temp24h = $this->JSONload($this->buildURL("Live.getCounters", "", "", "&lastMinutes=" . (60 * 24)), array("visitors"));
                $objTemplate->visitsLast24Hours = $temp24h[0];
                break;
            case bepiwikcharts::DEMO:
            default:
                $objTemplate->visitsLast30Minutes = "(DEMO)";
                $objTemplate->visitsLast24Hours = "(DEMO)";
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
     **/
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
     **/
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
     **/
    public function myRegexp_checkAuthCode($strRegexp, $varValue, Widget $objWidget) {
        if ($strRegexp == 'checkAuthCode') {
            try {
                $xml = new SimpleXMLElement($this->readfile($GLOBALS["TL_CONFIG"]['piwikchartsURL'] . "index.php?module=API&method=API.getMatomoVersion&format=xml&token_auth=" . $varValue));
                $version_installed = trim($xml[0]);
                if (strlen($version_installed) < 1) {
                    $objWidget->addError($GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['authCode']['rgxp']);
                }
            } 
            catch (Exception $e) {
                return true;
            }
            return true;
        }
        
        return false;
    }
    
}
