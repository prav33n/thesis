<?php
/*
  All Emoncms code is released under the GNU Affero General Public License.
  See COPYRIGHT.txt and LICENSE.txt.

  ---------------------------------------------------------------------
  Emoncms - open source energy visualisation
  Part of the OpenEnergyMonitor project:
  http://openenergymonitor.org
*/
  
global $path, $useckeditor;
?>

<span style="float:left; color:#000; font: 20px sans-serif; font-weight:bold; margin:5px "><?php echo _("Dashboards:"); ?></span>
<ul id="submenu" class="nav nav-pills" >
  <?php echo $menu; ?>

<div align="right" style="padding:4px; visibility:hidden">
  <?php if ($type=="view") { ?>
    <a href="<?php echo $path; ?>dashboard/edit?id=<?php echo $id; ?>" title="<?php echo _("Draw Editor"); ?>" ><i class="icon-edit"></i></a>
    
    <?php if ($useckeditor) { ?>
      <a href="<?php echo $path; ?>dashboard/ckeditor?id=<?php echo $id; ?>" title="CKEditor" >
      <img src="<?php echo $path; ?>/Includes/editors/images/ckicon.png" style="margin-top:-5px;"/></a>
    <?php } ?>
  <?php } ?>

  <?php if ($type=="edit" || $type=="ckeditor") { ?>
    <a href="<?php echo $path; ?>dashboard/view?id=<?php echo $id; ?>" title="<?php echo _("View mode"); ?>"><i class="icon-eye-open"></i></a>
  <?php } ?>
    
  <a  data-toggle="modal" href="#myModal"><i class="icon-wrench" title="<?php echo _("Config"); ?>"></i></a>
  <a href="#" onclick="$.ajax({type : 'POST',url :  path + 'dashboard/new.json  ',data : '',dataType : 'json',success : location.reload()});" title="<?php echo _("New"); ?>"><i class="icon-plus-sign"></i></a>
  <a href="<?php echo $path; ?>dashboard/thumb"><i class="icon-th-large" title="<?php echo _("Thumb view"); ?>"></i></a>
  <a href="<?php echo $path; ?>dashboard/list"><i class="icon-th-list" title="<?php echo _("List view"); ?>"></i></a>   
</div>
</ul>