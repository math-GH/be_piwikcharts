<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/***
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
 * @author     µaTh (+ Caro (ct9))
 * @package    be_piwikcharts
 * @license    GNU/LGPL 
 * @filesource
 *
 * // Piwik-API: http://piwik.org/docs/analytics-api/metadata/#toc-static-image-graphs
 */

class bepiwikcharts extends BackendModule {

  protected $strTemplate = 'be_piwikcharts';

  // Default-Werte (Demo-Modus)
  public $url = "http://demo.piwik.org/"; // inkl. http(s), mit / am Ende
  public $piwik_IDsite = 3;
  public $piwik_TOKENauth = "anonymous";  
  
  
  public $tableMaxRows = 10;
  public $modus = 0;      // 0 = Demo, 1 = normal
  public $username = "";
  public $password = "";
  
  public function compile() {}
    
  
  /**
  * Konstruktor
  **/
  function __construct() { 
    // Super-Konstruktor (von BackendModule) aufrufen
    parent::__construct();
    
    // Daten der Einstellungen holen. Daten nur nutzen, wenn alle 3 Daten in den Einstellungen eingetragen wurden
    if ( (strlen( $GLOBALS["TL_CONFIG"]['piwikchartsURL']) > 0) && (strlen($GLOBALS["TL_CONFIG"]['piwikchartsSiteID']) > 0) && (strlen($GLOBALS["TL_CONFIG"]['piwikchartsAuthCode']) > 0) ) {
        $this->url = $GLOBALS["TL_CONFIG"]['piwikchartsURL'];
        $this->piwik_IDsite = $GLOBALS["TL_CONFIG"]['piwikchartsSiteID'];
        $this->piwik_TOKENauth = $GLOBALS["TL_CONFIG"]['piwikchartsAuthCode'];
        $this->username = $GLOBALS["TL_CONFIG"]['piwikchartsUsername'];
        $this->password = $GLOBALS["TL_CONFIG"]['piwikchartsPassword'];
        $this->modus = 1; //1 = Normalmodus
    }
  }
  
  /**
  * generate() - wird von Contao automatisch geladen
  *
  * Templatevariablen belegen
  */
  public function generate() {
    // pruefen, ob die Seite im Backend aufgerufen wird
    if (TL_MODE == 'BE') {
      // Objekt vom Template "be_piwikcharts" erzeugen
      $objTemplate = new BackendTemplate('be_piwikcharts');
      
      
      // Userklasse laden. Wird zum Prüfen benötigt, ob der User ein Admin ist
      $this->import('BackendUser', 'User');
      $objTemplate->isAdmin = $this->User->isAdmin;
      
      // Steuerelemente
      $objTemplate->link_settings = $this->Environment->path."/contao/main.php?do=settings#pal_piwikcharts_legend";

	  if(!empty($this->username) && !empty($this->password)){
	      $hashed = hash('md5', @Encryption::decrypt($this->password));
		  $objTemplate->link_server_login = $this->url.'index.php?module=Login&action=logme&login='.$this->username.'&password='.$hashed;
	  }

	  $objTemplate->link_server = $this->url;


      $objTemplate->piwik_IDsite = $this->piwik_IDsite;
      $objTemplate->link_optOut = $this->url."index.php?module=CoreAdminHome&action=optOut";
      $objTemplate->update = $this->checkUpdate();
      $objTemplate->showUpdate = $this->User->isAdmin || $GLOBALS["TL_CONFIG"]['piwikchartsWelcomePageUpdate'];
      
      // 30 Tage Besuchergraf
      $objTemplate->chart_evolutionVisitsSummaryDay = $this->printChart( "evolution", "VisitsSummary", "day", "previous30", 400, 200, 80, "get" );
      
      // 24 Monate Besuchergraf
      $objTemplate->chart_evolutionVisitsSummaryMonth = $this->printChart( "evolution", "VisitsSummary", "month", "previous24", 400, 200, 80, "get", "&colors=,,ff0000" );
      
      // Diagramm Besuchszeiten
      $objTemplate->chart_verticalBarVisitsPerServerTime = $this->printChart( "verticalBar", "VisitTime", "range", "previous30", 400, 200, 80, "getVisitInformationPerServerTime" );
      
      // Diagramm Besuchertage
      $objTemplate->chart_verticalBarVisitTimeByDayOfWeek = $this->printChart( "verticalBar", "VisitTime", "range", "previous30", 400, 200, 80, "getByDayOfWeek" );
      
      // Diagramm Browser
      $objTemplate->chart_horizontalBarUserBrowser = $this->printChart( "horizontalBar", "UserSettings", "range", "previous30", 400, 200, 80, "getBrowser" );
      
      // Diagramm Länder
      $objTemplate->chart_horizontalBarUserCountry = $this->printChart( "horizontalBar", "UserCountry", "range", "previous30", 400, 200, 80, "getCountry" );
      
      //Tabelle: Suchworte von Suchmaschinen
      $objTemplate->table_keywords = $this->printTable($this->PHPload($this->buildURL( "Referers.getKeywords", "range", "previous30", "&format=php&filter_limit=20"), array("label", "nb_visits")), array("Suchwort","Aufrufe"), "data");
      
      //Tabelle: Besucher von Webseite
      $objTemplate->table_fromWebsite = $this->printTable($this->PHPload($this->buildURL( "Referers.getWebsites", "range", "previous30", "&format=php&filter_limit=20"), array("label", "nb_visits")), array("Von Webseite","Aufrufe"), "data");
      
      // Tabelle: angeschaute Seiten
      $objTemplate->table_visitedPages = $this->printTable($this->PHPload($this->buildURL( "Actions.getPageUrls", "range", "previous30", "&format=php&filter_limit=20"), array("label", "nb_visits")), array("Seite","Aufrufe"), "data");
      
      // Tabelle: Downloads
      $objTemplate->table_downloads = $this->printTable_downloads($this->PHPload($this->buildURL( "Actions.getDownloads", "range", "previous30", "&format=php&filter_limit=20&expanded=1&filter_limit=10"), array("label", "subtable")), "downloads");
      
      // Zusammenfassung (letzte 30 Minuten/letzte 24 Stunden)

     //im Demo-Modus ist die Anzeige letzte 30Min/24h deaktivert
      if ( $this->modus > 0 ) { 
        $temp = $this->PHPload($this->buildURL( "Live.getCounters", "", "", "&format=php&lastMinutes=".(60*24)), array("visits"));
        $objTemplate->visitsLast30Minutes = $temp[0];
        $temp = $this->PHPload($this->buildURL( "Live.getCounters", "", "", "&format=php&lastMinutes=".(60*24)), array("visits"));
        $objTemplate->visitsLast24Hours = $temp[0];
        } else {
        $objTemplate->visitsLast30Minutes = "(disabled)";
        $objTemplate->visitsLast24Hours = "(disabled)";
      }
      
      return $objTemplate->parse();
    }

    // generate() von der Oberklasse (BackendModule) aufrufen
    return parent::generate();
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
    for ( $i = 0; $i < count($xml->row); $i++) {
      foreach ($xml->row[$i] as $item => $titel) {
        if (in_array($item, $parameter, true)) {
          $ausgabe[] = $titel;
        }
      }
    }
    return $ausgabe;
  }
  
  
  /**
  * Abfrage des PIWIK- Servers
  * @param $url string  Url- Fragment mit Abfrage zum PIWIK- Server
  * @return Array mit den abgefragten Werten
  **/
  function readfile($url) {    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout = 5);
    if ($GLOBALS["TL_CONFIG"]['piwikchartsSSHconnection'] == true ) {
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    }
    if ($GLOBALS["TL_CONFIG"]['piwikchartsRedirect'] == true ) {
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    } 
    $file = curl_exec($ch);
    curl_close($ch);
    return $file;
  }
    
  /**
  * PHPfile_read - Liest das unserialisierte PHP-Array ein und erstellt ein neues Array mit den Werten aus $parameter
  *
  **/
  function PHPload( $url, $parameter ) {
    $unserializedArray = unserialize( $this->readfile($url) );

    
    for ( $i = 0; $i < count($unserializedArray); $i++) {
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
  function printTable_downloads($inhalte, $cssklasse="") {
    $tabelle = "<table class=\"".$cssklasse."\">";
    $tabelle .= "<tr><th class=\"col0\">Domain</th><th class=\"col1\">Datei</th><th class=\"col2\">Downloads</th></tr>";
    for ($i = 0; $i <= count($inhalte)/2; $i = $i + 2 ) {
      $maxZeilen = $this->tableMaxRows;
      if ($maxZeilen > count($inhalte[$i+1] )) {
        $maxZeilen = count($inhalte[$i+1]);
      }
      for ($j = 0; $j < $maxZeilen; $j++) {
        $tabelle .= "<tr>";
        $tabelle .= "<td class=\"col0\">".$inhalte[$i]."</td>";
        $path_parts = pathinfo( $inhalte[$i+1][$j]['label'] );
        $tabelle .= "<td class=\"col1\"><a href=\"".$inhalte[$i+1][$j]['url']."\" target=\"_blank\" title=\"".$inhalte[$i+1][$j]['label']."\">".$path_parts['basename']."</a></td>";
        $tabelle .= "<td class=\"col2\">".($inhalte[$i+1][$j]['nb_visits'])."</td>";
        $tabelle .= "</tr>";
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
  function printTable($inhalte, $spalten, $cssklasse="") {
    // Anzahl Inhaltszeilen der Tabelle festlegen
    $rowsPerTable = $this->tableMaxRows;
    if ( count($inhalte)/count($spalten) < $rowsPerTable ) {
      $rowsPerTable = count($inhalte)/count($spalten);
    }
    
    // falls keine Daten gefunden werden, hier abbrechen
    if ($rowsPerTable < 1) {
      return "<table><tr><td>Found no Data</td></table>";
    }
    
    // Anzahl der Tabellen nebeneinader ist abhängig von der Größe des Arrays $inhalte und der Zeilenanzahl der Tabelle ($rowsPerTable)
    $tabellen = ceil(count($inhalte)/($rowsPerTable*count($spalten)));
    
    // resultTable wird nun aufgebaut und am Ende als return-Wert zurückgegeben
    $resultTable = "<table class=\"".$cssklasse."\">";
    
    // Tabellenkopf
    $resultTable .= "<tr>";
    for ( $i = 0; $i < count($spalten)*$tabellen; $i++ ) {
        $resultTable .= "<th class=\"col".($i%count($spalten))."\">".$spalten[$i%count($spalten)]."</th>";
    }
    $resultTable .= "</tr>";
    
    // Tabelleninhalt
    for ( $row = 0; $row < $rowsPerTable; $row++ ) {
      
      $resultTable .= "<tr>";
      
      // $tabellenspalte = Index der Tabelle, die nebeneinander angezeit wird
      for ( $tabellenspalte = 0; $tabellenspalte < $tabellen; $tabellenspalte++ ) {
      
        for ( $spalte = 0; $spalte < count($spalten); $spalte++ ) {
        
          // Prüfen, ob das Array groß genug ist um den Inhalt auszugeben oder nur eine leere Zelle zu erzeugen
          if ( (( $row*count($spalten)+$spalte )+$tabellenspalte*$rowsPerTable*count($spalten)) < count($inhalte) ) {
            $resultTable .= "<td class=\"col".$spalte."\">";
            $resultTable .= $inhalte[($row*count($spalten)+$spalte)+$tabellenspalte*$rowsPerTable*count($spalten)];
            $resultTable .= "</td>";
          } else {
            // leere Zelle
            $resultTable .= "<td class=\"col".$spalte."\"></td>";
          }
        }
      }
      $resultTable .= "</tr>";
    }
    $resultTable .= "</table>";
    
    return $resultTable;
  }
  
  
  /**
  * buildURL - baut die Aufruf-URL für Piwik auf
  *
  * @param $method      Methode der Abfrage
  * @param $period      kleinstes Intervall ('day', 'week', 'month', 'year', 'range')
  * @param $date        untersuchtes Datum/Zeitintervall ('today', 'yesterday','previous30','YYYY-MM-DD%2CYYYY-MM-DD')
  * @param $additional  (optionaler Parameter) für weitere API-Parameter. Muss mit & beginnen. Schema: '&parameter=wert'
  */
  function buildURL( $method, $period, $date, $additional ) {
    $url = $this->url;
    $url.= 'index.php?module=API';
    $url.= '&method='.$method;
    $url.= '&idSite='.$this->piwik_IDsite;
    $url.= '&token_auth='.$this->piwik_TOKENauth;
    $url.= '&period='.$period;
    $url.= '&date='.$date;
    $url.= $additional;
    
    return $url;
  }
  
  
  /**
  * printChart - Grafiken anzeigen
  *
  * @param $graphType   Grafentyp: 'evolution' (Liniendiagramm), 'horizontalBar' (horizontales Balkendiagramm), 'verticalBar' (Balkendiagramm) and 'pie' (2D Kreisdiagramm)
  * @param $apiModule   Bezeichnung Piwikmodul (z.B. Besucherverlauf: 'VisitsSummary')
  * @param $period      kleinstes Intervall ('day', 'week', 'month', 'year', 'range')
  * @param $date        untersuchtes Datum/Zeitintervall ('today', 'yesterday','previous30','YYYY-MM-DD%2CYYYY-MM-DD')
  * @param $width, $height  Breite, Höhe der zu generierenden Grafik
  * @param $scale       Skalierung in Prozent
  * @param $apiAction   abhängig von $apiModule
  * @param $additional  (optionaler Parameter) für weitere API-Parameter. Muss mit & beginnen. Schema: '&parameter=wert'
  * @param $cssStyle    (optionaler Parameter) CSS-Style Attribut
  */
  function printChart( $graphType, $apiModule, $period, $date, $width, $height, $scale, $apiAction, $additional = "", $cssStyle = "" ) {
    return '<img src="'.$this->buildURL( "ImageGraph.get", $period, $date, '&apiModule='.$apiModule.'&apiAction='.$apiAction.'&graphType='.$graphType.'&width='.$width.'&height='.$height.$additional).'" alt="" width="'.($width*$scale/100).'" style="'.$cssStyle.'" />';
  }
  
  /**
  * checkUpdate - prüft auf Updates
  * @return wenn neue Version vorliegt: neue Versionsnummer. Wenn keine neue Version vorliegt: Leerstring
  */
  function checkUpdate() {
    if ($this->modus == 1) {
      // aktuelle Version vom Server lesen
      $xml = new SimpleXMLElement($this->readfile($this->url."index.php?module=API&method=API.getPiwikVersion&format=xml&token_auth=".$this->piwik_TOKENauth));
      $version_installed = trim($xml[0]);
      
      // neuste Version vom Piwik-Server lesen
      $version_newest = trim($this->readfile("http://api.piwik.org/1.0/getLatestVersion/"));

      if ($version_newest == $version_installed) {
        return "";
        } else {
        return $version_newest;
      }
      } else {
      return "";
    }
  }
  /**
  * dashboardWelcomePage - Statistiken auf der Welcomepage nach dem Login anzeigen
  */
  function dashboardWelcomePage() {

    // pruefen, ob die Seite im Backend aufgerufen wird
    if (TL_MODE == 'BE') {
      $this->import('BackendUser', 'User');
     
      if ($GLOBALS["TL_CONFIG"]['piwikchartsWelcomePage'] || ($this->User->isAdmin && $GLOBALS["TL_CONFIG"]['piwikchartsWelcomePageAdmin']) ) {
        $strBuffer = '<div id="welcomepagePiwikcharts" style="margin:18px;">';

        $objTemplate = new BackendTemplate('ce_headline');
        $objTemplate->hl = 'h2';
        $objTemplate->class = 'ce_headline';
        $objTemplate->style = 'background:none repeat scroll 0 0 #F6F6F6;border: solid #E9E9E9; border-width: 1px 0px 1px 0px; margin:18px 0px 6px; padding: 2px 6px 3px;';
        $objTemplate->headline = 'Besucherstatistiken';

        $strHeadline = $objTemplate->parse();
        $strBuffer .= $strHeadline;

        $objTemplate = new BackendTemplate('ce_text');
        $objTemplate->class = 'ce_text';
        $objTemplate->style = 'position:relative;';

        $objTemplate2 = new BackendTemplate('be_piwikcharts_welcome');

        $objTemplate2->chart_evolutionVisitsSummaryDay .= $this->printChart( "evolution", "VisitsSummary", "day", "previous30", 400,180, 80, "get", "", "margin-right:20px;" );
        $objTemplate2->chart_evolutionVisitsSummaryMonth .= $objTemplate->chart_evolutionVisitsSummaryMonth = $this->printChart( "evolution", "VisitsSummary", "month", "previous24", 400, 100, 80, "get", "&colors=,,ff0000", "margin-bottom: 10px;" );

        //im Demo-Modus ist die Anzeige letzte 30Min/24h deaktivert
        if ( $this->modus > 0 ) { 
          $temp = $this->PHPload($this->buildURL( "Live.getCounters", "", "", "&format=php&lastMinutes=".(60*24)), array("visits"));
          $objTemplate2->visitsLast30Minutes = $temp[0];
          $temp = $this->PHPload($this->buildURL( "Live.getCounters", "", "", "&format=php&lastMinutes=".(60*24)), array("visits"));
          $objTemplate2->visitsLast24Hours = $temp[0];
          } else {
          $objTemplate2->visitsLast30Minutes = "(disabled)";
          $objTemplate2->visitsLast24Hours = "(disabled)";
        }

        $objTemplate2->link_optOut = $this->url."index.php?module=CoreAdminHome&action=optOut";
        $objTemplate2->showOptOut = $GLOBALS["TL_CONFIG"]['piwikchartsWelcomePageOptout'] || $this->User->isAdmin;
        $objTemplate2->optOutIcon = "system/modules/be_piwikcharts/assets/optout.png";

        $objTemplate2->update = $this->checkUpdate();

        $objTemplate2->showUpdate = $this->User->isAdmin || $GLOBALS["TL_CONFIG"]['piwikchartsWelcomePageUpdate'];
        $objTemplate2->updateIcon = "system/modules/be_piwikcharts/assets/update.png";
        $objTemplate2->link_server = $this->url;


        $objTemplate->text = $objTemplate2->parse();
        $strBuffer .= $objTemplate->parse();

        $strBuffer .= '</div>';

        return $strBuffer;
        
        
        } else {
        // Statistiken nicht anzeigen, weil die Einstellungen so sind.
        return "";
      }
      
      } else {
      return "";
    }
  }

}
?>