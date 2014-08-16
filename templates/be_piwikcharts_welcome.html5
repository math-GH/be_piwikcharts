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
      <td><?php echo $this->lang->live['headline']; ?></td>
      <td></td>
    </tr>
    <tr>
      <td><?php echo $this->lang->live['last30minutes']; ?>:</td>
      <td><?php echo $this->visitsLast30Minutes; ?></td>
    </tr>
    <tr>
      <td><?php echo $this->lang->live['last24hours']; ?>:</td>
      <td><?php echo $this->visitsLast24Hours; ?></td>
    </tr>
  </table>


</div>

<div style="position:absolute;right:0px;top:0px;width:20px;text-align:center;">
  <?php if($this->showOptOut): ?>
  <a class="optOut" href="<?php echo $this->link_optOut ?>" onclick="window.open(this.href);
      return false;" title="<?php echo $this->lang->optOut; ?>"><img src="<?php echo $this->optOutIcon ?>" style="margin-bottom:5px" /></a>
  <?php endif; ?>
  <?php if($this->update && $this->showUpdate): ?>
  <a class="update" href="<?php echo $this->link_server ?>" onclick="window.open(this.href);
      return false;" title="<?php echo $this->lang->newVersionHint; ?>: <?php echo $this->update ?>"><img src="<?php echo $this->updateIcon ?>" style="margin-bottom:10px;" /></a>
  <?php endif; ?>
  <?php if($this->moreLinkAccess): ?>
  <a href="./contao/main.php?do=be_piwikcharts"><img src="<?php echo $this->zoomIcon ?>" title="<?php echo $this->lang->zoomIt; ?>" /></a>
  <?php endif; ?>

</div>


<?php } ?>
