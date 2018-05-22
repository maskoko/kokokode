<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: tna_kd.php (admin), v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
?>

<script type="text/javascript" src="js/tna_kd.js"></script>

        <!--Body content-->
        <div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">
                    <h3>TNA Online - Kompetensi Dasar</h3>                    
                </div><!-- End .heading-->
    				
                <!-- Build page from here: Usual with <div class="row-fluid"></div> -->
							
<?php switch(Filter::$action): case "edit": ?>

                <div class="row-fluid">
                    <div class="span12">

                        <div id="msgholder"></div>
                        
                        <div class="box">

                            <div class="title">
                                <h4> 
                                    <span>Edit Kompetensi Dasar</span>
                                </h4>								
                            </div>

                            <div class="content">
							
                                <?php 
                                    $row = Core::getRowById("kd", Filter::$id);                                    
                                    $kk = $content->getKKList();
                                ?>
    
                                <form id="admin_form" class="form-horizontal" method="post" action="">			
                                <fieldset>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">No. Urut:</label>
                                                <input type="text" class="span2 required" name="kdindex" id="kdindex" value="<?php echo $row->kdindex;?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">                             
                                                <label class="form-label span4" for="normal">Nomor:</label>
                                                <input type="text" class="span2 required" name="kdno" id="kdno" value="<?php echo $row->kdno;?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="checkboxes">Paket Keahlian :</label>
                                                <div class="span8 controls">
                                                    <select name="kkid" id="kkid">
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                        <?php if ($kk):?>
                                                            <?php foreach ($kk as $prow):?>
                                                                <option value="<?php echo $prow->id;?>" <?php if($prow->id == $row->kkid)echo 'selected="selected"';?>><?php echo $prow->nama_kompetensi;?></option>
                                                            <?php endforeach;?>
                                                            <?php unset($prow);?>
                                                        <?php endif;?>
                                                    </select>					
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Nama Kompetensi:</label>
                                                <input type="text" class="span8 required" name="nama_kompetensi" id="nama_kompetensi" value="<?php echo $row->nama_kompetensi;?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-info">Save</button>
                                        <button type="button" class="btn" onclick="history.back()">Kembali</button>
                                    </div>

                                    <input name="id" type="hidden" value="<?php echo Filter::$id;?>" />
                                    <input name="userid" type="hidden" value="<?php echo $row->userid;?>" />

                                </fieldset>
                                </form>       

                            <?php echo Core::doForm("processKD"); ?> 	
                                
                            </div> <!-- end .content -->

                        </div><!-- End .box -->

                    </div><!-- End .span12 -->
                </div><!-- End .row-fluid -->  

                <div class="row-fluid">
                    <div class="span12">

                        <div class="box">

                            <?php $rows = $content->getKD_Indikator(Filter::$id);?>

                            <div class="title">
                                <h4>
                                    <span class="icon16 icomoon-icon-equalizer-2"></span>
                                    <span>Indikator</span>                                       
                                </h4>
                            </div>
                            
                            <div class="content">

                                <table class="responsive table table-striped table-bordered table-sorting table-condensed"> 

                                    <thead>
                                        <tr>
                                            <th width="50">No.</th>
                                            <th>Nama Indikator</th>
                                            <th width="100"><button type="button" class="btn btn-mini" onclick="location.href='index.php?do=tna_kd_indikator&amp;action=add&amp;kdid=<?php echo Filter::$id; ?>'"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                    <?php if(!$rows):?>
                                        <tr>
                                            <td colspan="3"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                        </tr>

                                    <?php else:?>

                                    <?php 
                                        $i = 0;
                                        foreach ($rows as $row):
                                    ?>

                                        <tr>
                                            <td style="text-align: right;"><?php $i++; echo $i;?>.</td>
                                            <td style="text-align: left;"><?php echo $row->nama_indikator;?></td>
                                            <td align="center">
                                                <a href="index.php?do=tna_kd_indikator&amp;action=edit&amp;kdid=<?php echo Filter::$id; ?>&amp;id=<?php echo $row->id;?>" title="Edit" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a>
                                                <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-id="<?php echo $row->id;?>"><span class="icon12 icomoon-icon-remove"></span></a>
                                            </td>
                                        </tr>

                                    <?php endforeach;?>
                                    <?php unset($row);?>
                                    <?php endif;?>                  

                                    </tbody>

                                </table>
                                
                            </div> <!-- End .content -->

                            <?php echo Core::doDelete(lang('DELCONFIRM_TITLE'), "deleteKD_Indikator");?>

                        </div><!-- End .box -->

                    </div><!-- End .span12 -->
                </div><!-- End .row-fluid -->  

<?php break; ?>

    <!------------------------ add ----------------------------------------------->


<?php case "add": ?>

                <div class="row-fluid">
                    <div class="span12">

                        <div id="msgholder"></div>
                        
                        <div class="box">

                            <div class="title">
                                <h4> 
                                    <span>Tambah Kompetensi Dasar</span>
                                </h4>								
                            </div>

                            <div class="content">

                                <?php $kk = $content->getKKList();?>
    
                                <form id="admin_form" class="form-horizontal" method="post" action="">			
                                <fieldset>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">No. Urut:</label>
                                                <input type="text" class="span2 required" name="kdindex" id="kdindex" value=""/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">                             
                                                <label class="form-label span4" for="normal">Nomor:</label>
                                                <input type="text" class="span2 required" name="kdno" id="kdno" value=""/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="checkboxes">Paket Keahlian:</label>
                                                <div class="span8 controls">											
                                                    <select name="kkid" id="kkid">
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                        <?php if ($kk):?>
                                                            <?php foreach ($kk as $prow):?>
                                                                <option value="<?php echo $prow->id;?>"><?php echo $prow->nama_kompetensi;?></option>
                                                            <?php endforeach;?>
                                                            <?php unset($prow);?>
                                                        <?php endif;?>
                                                    </select>						
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Nama Kompetensi:</label>
                                                <input type="text" class="span8 required" name="nama_kompetensi" id="nama_kompetensi" value=""/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-info">Save</button>
                                        <button type="button" class="btn" onclick="history.back()">Kembali</button>
                                    </div>

                                    <input name="userid" type="hidden" value="<?php echo $user->uid;?>" />

                                </fieldset>
                                </form>       

			<?php echo Core::doForm("processKD"); ?> 	

                            </div> <!-- end .content -->
                              
                        </div><!-- End .box -->

                    </div><!-- End .span12 -->
                </div><!-- End .row-fluid -->  

<?php break; ?>


    <!------------------------ list ----------------------------------------------->
	

<?php default: ?>

        <?php 

            if(isset(Filter::$get['bskid']))
                $bskid = Filter::$get['bskid'];
            else
                $bskid = 0; 
                
            if(isset(Filter::$get['pskid']))
                $pskid = Filter::$get['pskid'];
            else
                $pskid = 0; 

            if(isset(Filter::$get['kkid']))
                $kkid = Filter::$get['kkid'];
            else
                $kkid = 0; 
                
            if(isset(Filter::$get['kelid']))
                $kelid = Filter::$get['kelid'];
            else
                $kelid = 3;

            if(isset(Filter::$get['mp1id']))
                $mp1id = Filter::$get['mp1id'];
            else
                $mp1id = 0;

            if(isset(Filter::$get['mp2id']))
                $mp2id = Filter::$get['mp2id'];
            else
                $mp2id = 0;

        ?>
        
                <div class="row-fluid">
                    <div class="span12">
                
                        <div class="box">                            
                            <div class="title">
                                <h4>
                                    <span>Filter :</span>
                                </h4>
                                <a href="#" class="minimize">Minimize</a>
                            </div>

                            <div class="content">
                                <form id="filter_form" class="form form-horizontal" method="get" action="">
                                <fieldset>
                                    <input type="hidden" name="do" value="tna_kd">

                                    <ul id="tna_tab" class="nav nav-tabs pattern">
                                        <li <?php if ($kelid == 3) echo 'class="active"'; ?>><a href="#P_3" data-toggle="tab">PRODUKTIF</a></li>
                                        <li <?php if ($kelid == 1) echo 'class="active"'; ?>><a href="#P_1" data-toggle="tab">ADAPTIF</a></li>
                                        <li <?php if ($kelid == 2) echo 'class="active"'; ?>><a href="#P_2" data-toggle="tab">NORMATIF</a></li>
                                    </ul>

                                    <div class="tab-content">
                                        <div class="tab-pane fade <?php if ($kelid == 3) echo 'in active'; ?>" id="P_3">
                                            
                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span3" for="checkbox">Bidang Keahlian:</label>
                                                    <div class="span8 controls">
                                                        <select name="bskid" id="bskid">
                                                            <option value=""><?php echo lang('SELECT');?></option>
                                                            <?php 
                                                              $bsk = $content->getBSKList();
                                                              if ($bsk):
                                                            ?>
                                                                <?php foreach ($bsk as $prow):?>
                                                                    <option value="<?php echo $prow->id;?>" <?php if($prow->id == $bskid) echo 'selected="selected"';?>><?php echo $prow->nama_bidang;?></option>
                                                                <?php endforeach;?>
                                                                <?php unset($prow);?>
                                                            <?php endif;?>
                                                        </select>                   
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span3" for="checkbox">Program Keahlian:</label>
                                                    <div class="span8 controls">
                                                        <select name="pskid" id="pskid">
                                                            <option value=""><?php echo lang('SELECT');?></option>
                                                            <?php 

                                                              if ($bskid != 0) $psk = $content->getPSKList(); else $psk = NULL;
                                                              if (isset($psk)):
                                                            ?>
                                                                <?php foreach ($psk as $prow):?>
                                                                    <option value="<?php echo $prow->id;?>" <?php if($prow->id == $pskid) echo 'selected="selected"';?>><?php echo $prow->nama_program;?></option>
                                                                <?php endforeach;?>
                                                                <?php unset($prow);?>
                                                            <?php endif;?>
                                                        </select>                   
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span3" for="checkbox">Paket Keahlian:</label>
                                                    <div class="span8 controls">
                                                        <select name="kkid" id="kkid">
                                                            <option value=""><?php echo lang('SELECT');?></option>
                                                            <?php 
                                                              if ($pskid != 0) $kk = $content->getKKByPSKList($pskid); else $kk = NULL;
                                                              if (isset($kk)):
                                                            ?>
                                                                <?php foreach ($kk as $prow):?>
                                                                    <option value="<?php echo $prow->id;?>" <?php if($prow->id == $kkid) echo 'selected="selected"';?>><?php echo $prow->nama_kompetensi;?></option>
                                                                <?php endforeach;?>
                                                                <?php unset($prow);?>
                                                            <?php endif;?>
                                                        </select>                   
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        </div>
                                        <div class="tab-pane fade <?php if ($kelid == 1) echo 'in active'; ?>" id="P_1">
                                            
                                            <div class="form-row row-fluid">
                                                <div class="span12">
                                                    <div class="row-fluid">
                                                        <label class="form-label span3" for="checkbox">Mata Pelajaran:</label>
                                                        <div class="span8 controls">
                                                            <select name="mp1id" id="mp1id">
                                                                <option value=""><?php echo lang('SELECT');?></option>
                                                                <?php

                                                                  $mp1 = $content->getMataPelajaranList(1);
                                                                  if (isset($mp1)):
                                                                ?>
                                                                    <?php foreach ($mp1 as $prow):?>
                                                                        <option value="<?php echo $prow->id;?>" <?php if($prow->id == $mp1id) echo 'selected="selected"';?>><?php echo $prow->nama_matapelajaran;?></option>
                                                                    <?php endforeach;?>
                                                                    <?php unset($prow);?>
                                                                <?php endif;?>
                                                            </select>                   
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="tab-pane fade <?php if ($kelid == 2) echo 'in active'; ?>" id="P_2">
                                            
                                            <div class="form-row row-fluid">
                                                <div class="span12">
                                                    <div class="row-fluid">
                                                        <label class="form-label span3" for="checkbox">Mata Pelajaran:</label>
                                                        <div class="span8 controls">
                                                            <select name="mp2id" id="mp2id">
                                                                <option value=""><?php echo lang('SELECT');?></option>
                                                                <?php 

                                                                   $mp2 = $content->getMataPelajaranList(2);
                                                                   if (isset($mp2)):

                                                                 ?>
                                                                    <?php foreach ($mp2 as $prow):?>
                                                                        <option value="<?php echo $prow->id;?>" <?php if($prow->id == $mp2id) echo 'selected="selected"';?>><?php echo $prow->nama_matapelajaran;?></option>
                                                                    <?php endforeach;?>
                                                                    <?php unset($prow);?>
                                                                <?php endif;?>
                                                            </select>                   
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    
                                </fieldset>
                                </form>                             
                            </div>

                        </div><!-- End filter .box -->

                    </div><!-- End .span12 -->
                </div><!-- End .row-fluid -->  
 
                <?php if (($kelid == 3 && $kkid > 0) || ($kelid == 1 && $mp1id > 0) || ($kelid == 2 && $mp2id > 0)) : ?>

                <div class="row-fluid">
                    <div class="span12">

                        <div id="msgholder"></div>
                        
                        <div class="box">                                    

                            <div class="title">
                                <h4>
                                    <span class="icon16 icomoon-icon-equalizer-2"></span>
                                    <span>Intrumen Kompetensi Dasar</span>                                       
                                </h4>																				
                            </div>
    
                            <div class="content">
	
                                <table class="responsive table table-striped table-bordered table-sorting table-condensed">

                                    <thead>
                                        <tr>
                                            <th width="50">No.</th>
                                            <th>Nama Kompetensi</th>
                                        <?php if ($kkid == 0): ?>
                                            <th>Paket Keahlian</th>
                                        <?php endif; ?>
                                            <th width="100"><button type="button" class="btn btn-mini" onclick="location.href='index.php?do=tna_kd&amp;action=add'"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                    <?php
                                        if ($kelid == 3)
                                            $rows = $content->getKD($kelid, $kkid);
                                        else if ($kelid == 1)
                                            $rows = $content->getKD($kelid, $mp1id);
                                        else
                                            $rows = $content->getKD($kelid, $mp2id);
                                        if(!$rows):

                                    ?>
                                        <tr>
                                            <td colspan="<?php if ($kkid == 0) echo '4'; else echo '3'; ?>"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                        </tr>

                                    <?php else:?>
                                    <?php foreach ($rows as $row):?>

                                        <tr>
                                            <td style="text-align: right;"><?php echo $row->kdno;?></td>
                                            <td style="text-align: left;"><?php echo $row->nama_kompetensi;?></td>
                                        <?php if ($kkid == 0): ?>
                                            <td style="text-align: left;"><?php echo $row->nama_kk;?></td>
                                        <?php endif; ?>
                                            <td align="center">
                                                <a href="index.php?do=tna_kd&amp;action=edit&amp;id=<?php echo $row->id;?>" title="Edit" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a>
                                                <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-id="<?php echo $row->id;?>"><span class="icon12 icomoon-icon-remove"></span></a>
                                            </td>
                                        </tr>

                                    <?php endforeach;?>
                                    <?php unset($row);?>
                                    <?php endif;?>					

                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <td colspan="4">
                                                <div class="span4">
                                                    <strong>Data&nbsp;:&nbsp;<span class="label label-info"><?php echo number_format($pager->items_total);?></span></strong>
                                                </div><!-- End .span4 -->
                                                <div class="span8">
                                                    <div class="right">
                                                        <?php echo $pager->display_pages();?>
                                                    </div>
                                                </div><!-- End .span8 -->
                                            </td>											
                                        </tr>										
                                    </tfoot>

                                </table>
			
                            <?php echo Core::doDelete(lang('DELCONFIRM_TITLE'), "deleteKD");?>
                                
                            </div> <!-- end .content -->

                        </div><!-- End .box -->

                    </div><!-- End .span12 -->
                </div><!-- End .row-fluid -->  

                <?php endif; ?>

<?php break;?>
<?php endswitch;?>

            </div><!-- End contentwrapper -->
        </div><!-- End #content -->
    
    </div><!-- End #wrapper -->

    <script type="text/javascript">

        $(document).ready(function(){

            $("#bskid").change(function(){
                    var id = $("#bskid").val();

                    $.ajax({
                            type: 'post',
                            url: "controller.php",
                            data: "loadPSKList=" + id,
                            cache: false,
                            success: function(html){
                                    $("#pskid").html(html); 
                            }
                    });

                    $("#pskid").val("");
                    $("#kkid").val("");

                    $.uniform.update("#pskid");
                    $.uniform.update("#kkid");

            });


            $("#pskid").change(function(){
                    var id = $("#pskid").val();

                    $.ajax({
                            type: 'post',
                            url: "controller.php",
                            data: "loadKKList=" + id,
                            cache: false,
                            success: function(html){
                                    $("#kkid").html(html); 
                            }
                    });

                    $("#kkid").val("");
                    $.uniform.update("#kkid");

            });

            $("#kkid").change(function(){
                    var bskid = $("#bskid").val();
                    var pskid = $("#pskid").val();
                    var kkid = $("#kkid").val();

                    window.location.href="index.php?do=tna_kd&bskid=" + bskid + "&pskid=" + pskid + "&kkid=" + kkid + "&kelid=3";

            });

            // -- mp1id --

            $("#mp1id").change(function(){
                    var mp1id = $("#mp1id").val();

                    window.location.href="index.php?do=tna_kd&mp1id=" + mp1id + "&kelid=1";

            });

            // -- mp2id --

            $("#mp2id").change(function(){
                    var mp2id = $("#mp2id").val();

                    window.location.href="index.php?do=tna_kd&mp2id=" + mp2id + "&kelid=2";

            });            

        });

    </script>

    <!-- Charts plugins -->
    <script type="text/javascript" src="plugins/charts/sparkline/jquery.sparkline.min.js"></script><!-- Sparkline plugin -->
    
    <!-- Misc plugins -->
    <script type="text/javascript" src="plugins/misc/qtip/jquery.qtip.min.js"></script><!-- Custom tooltip plugin -->
    <script type="text/javascript" src="plugins/misc/totop/jquery.ui.totop.min.js"></script> 

    <!-- Search plugin -->
    <script type="text/javascript" src="plugins/misc/search/tipuesearch_set.js"></script>
    <script type="text/javascript" src="plugins/misc/search/tipuesearch_data.js"></script><!-- JSON for searched results -->
    <script type="text/javascript" src="plugins/misc/search/tipuesearch.js"></script>

    <!-- Form plugins -->
    <script type="text/javascript" src="plugins/forms/watermark/jquery.watermark.min.js"></script>
    <script type="text/javascript" src="plugins/forms/uniform/jquery.uniform.min.js"></script>    
    <script type="text/javascript" src="plugins/forms/validate/jquery.validate.min.js"></script>
            
    <!-- Fix plugins -->
    <script type="text/javascript" src="plugins/fix/ios-fix/ios-orientationchange-fix.js"></script>

    <!-- Table plugins -->
    <script type="text/javascript" src="plugins/tables/responsive-tables/responsive-tables.js"></script><!-- Make tables responsive -->

    <!-- Important Place before main.js  -->
    <script type="text/javascript" src="js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="js/jquery.form.js"></script> 
    <script type="text/javascript" src="plugins/fix/touch-punch/jquery.ui.touch-punch.min.js"></script><!-- Unable touch for JQueryUI -->
	
    <!-- Init plugins -->
    <script type="text/javascript" src="js/main.js"></script><!-- Core js functions -->
