<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!'); ?>

<?php 
if ($this->errorMessage) { 
echo $this->errorMessage; 
}else{ 
?>

<div style='display:inline-block;height:155px;position:relative;top:0px;background:url("system/modules/be_piwikcharts/assets/laden.gif") no-repeat 150px 50px;width:335px;'>
  <?php echo $this->chart_evolutionVisitsSummaryDay; ?>
</div>

<div style='display:inline-block;height:155px;position:absolute;top:0px;background:url("system/modules/be_piwikcharts/assets/laden.gif") no-repeat 80px 20px;width:335px;'>
  <?php echo $this->chart_evolutionVisitsSummaryMonth; ?>
  <br />



  <table style="position:absolute;right:0px;">
    <tr>
      <td>Anzahl Besucher</td>
      <td></td>
    </tr>
    <tr>
      <td>letzte 30 Minuten:</td>
      <td><?php echo $this->visitsLast30Minutes; ?></td>
    </tr>
    <tr>
      <td>letzte 24 Stunden:</td>
      <td><?php echo $this->visitsLast24Hours; ?></td>
    </tr>
  </table>



</div>

<div style="position:absolute;right:0px;top:0px;width:20px;text-align:center;">
  <?php if($this->showOptOut): ?>
  <a class="optOut" href="<?php echo $this->link_optOut ?>" onclick="window.open(this.href);
      return false;" title="Optout: Eigene Besuche auf der Webseite nicht mehr erfassen"><img src="<?php echo $this->optOutIcon ?>" style="margin-bottom:5px" /></a>
  <?php endif; ?>
  <?php if($this->update && $this->showUpdate): ?>
  <a class="update" href="<?php echo $this->link_server ?>" onclick="window.open(this.href);
      return false;" title="Ein Update der Piwik-Software auf Version <?php echo $this->update ?> ist verfügbar."><img src="<?php echo $this->updateIcon ?>" style="margin-bottom:10px;" /></a>
  <?php endif; ?>

</div>


<?php } ?>
