<?php
  /**
   * Index
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: ptk_public.php, v1.00 2011-07-10 10:12:05 gewa Exp $
   */
  define("_VALID_PHP", true);
  require_once("init.php");
  
  if ($user->logged_in)
      redirect_to("account.php");
	  	  
  if (isset($_POST['doLogin']))
      : $result = $user->login($_POST['username'], $_POST['password']);
  
  /* Login Successful */
  if ($result)
      : redirect_to("account.php");
  endif;
  endif;
?>

<?php include("header_public.php");?>

        <!--Body content-->
        <div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">
                    <h3>Data Pengajar dan Tenaga Kependidikan (PTK)</h3>                    
                </div><!-- End .heading-->
    				
                <!-- Build page from here: Usual with <div class="row-fluid"></div> -->
							
	<?php		
        
            if(isset(Filter::$get['propinsi_kode']))
                $propinsi_kode = Filter::$get['propinsi_kode'];
            else
                $propinsi_kode = '';

            if(isset(Filter::$get['kota_kode']))
                $kota_kode= Filter::$get['kota_kode'];
            else
                $kota_kode= '';

            if(isset(Filter::$get['searchfield']))
                $searchfield = Filter::$get['searchfield'];
            else
                $searchfield = 'nama';

            if(isset(Filter::$get['searchtext']))
                $searchtext = Filter::$get['searchtext'];
            else
                $searchtext = '';
                                
            if(isset(Filter::$get['sortfield']))
                $sortfield = Filter::$get['sortfield'];
            else
                $sortfield = 'pt.nama_lengkap';

            if(isset(Filter::$get['sorttype']))
                $sorttype = Filter::$get['sorttype'];
            else
                $sorttype = 'ASC';
                                
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

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span2" for="checkboxes">Propinsi:</label>
                                                <div class="span4 controls">
                                                    <?php $propinsi = $content->getPropinsiList();?>						
                                                    <select name="propinsi_kode" id="propinsi_kode" style="width:100%;" placeholder="Select...">
                                                        <option value=""><?php echo lang('SELECT_ALL');?></option>
                                                        <?php if ($propinsi):?>
                                                            <?php foreach ($propinsi as $prow):?>
                                                                <option value="<?php echo $prow->kode;?>" <?php if($prow->kode == $propinsi_kode)echo 'selected="selected"';?>><?php echo $prow->nama_propinsi;?></option>
                                                            <?php endforeach;?>
                                                            <?php unset($prow);?>
                                                        <?php endif;?>						
                                                    </select>
                                                </div>
                                                
                                                <label class="form-label span2" for="checkboxes">Kota/Kab:</label>
                                                <div class="span4 controls">
                                                    <?php $kota = $content->getKotaByPropinsiList($propinsi_kode);?>
                                                    <select name="kota_kode" id="kota_kode" style="width:100%;" placeholder="Select...">
                                                        <option value=""><?php echo lang('SELECT_ALL');?></option>
                                                        <?php if ($kota):?>
                                                            <?php foreach ($kota as $prow):?>
                                                                <option value="<?php echo $prow->kode;?>" <?php if($prow->kode == $kota_kode)echo 'selected="selected"';?>><?php echo $prow->nama_kota;?></option>
                                                            <?php endforeach;?>
                                                            <?php unset($prow);?>
                                                        <?php endif;?>						
                                                    </select>
                                                </div>
                                            </div>  <!-- end .row-fluid -->
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span2" for="checkboxes">Search:</label>
                                                <div class="span2 controls">
                                                    <select name="searchfield" id="searchfield" placeholder="Select..." style="width: 100%;">
                                                        <option value="pt.nama_lengkap" <?php if($searchfield == 'pt.nama_lengkap') echo 'selected="selected"';?>>Nama PTK</option>
                                                        <option value="pt.nip" <?php if($searchfield == 'pt.nip') echo 'selected="selected"';?>>NIP</option>
                                                        <option value="pt.nuptk" <?php if($searchfield == 'pt.nuptk') echo 'selected="selected"';?>>NUPTK</option>
                                                        <option value="s.nama_sekolah" <?php if($searchfield == 's.nama_sekolah') echo 'selected="selected"';?>>Nama Sekolah</option>
                                                    </select>
                                                </div>
                                                
                                                <label class="form-label span2" for="searchtext">Teks:</label>
                                                <input class="span4" type="text" name="searchtext" id="searchtext" value="<?php echo $searchtext; ?>" maxlength="50">
                                                <button type="submit" class="btn btn-info">Cari</button>
                                            </div>
                                        </div>
                                    </div>
                                        
                                    <input type="hidden" name="sortfield" id="sortfield" value="<?php echo $sortfield; ?>" >
                                    <input type="hidden" name="sorttype" id="sorttype" value="<?php echo $sorttype; ?>" >
                                </fieldset>
                                </form>								
                            </div>

                        </div><!-- End filter .box -->

                    </div><!-- End .span12 -->
                </div><!-- End .row-fluid -->  

        <?php $rows = $content->getPTK();?>

                <div class="row-fluid">
                    <div class="span12">

                        <table class="responsive table table-bordered table-striped table-sorting table-condensed">

                            <thead>
                                <tr>
                                    <th id="pt.nuptk" <?php
                                        if ($sortfield == "pt.nuptk") { 
                                            if ($sorttype == "ASC") 
                                                echo 'class="sorting_asc"'; 
                                            elseif ($sorttype == "DESC") 
                                                echo 'class="sorting_desc"'; 
                                            else 
                                                echo 'class="sorting"'; 
                                        } else 
                                            echo 'class="sorting"'; ?> width="70">NUPTK</th>
                                    <th id="pt.nama_lengkap" <?php
                                        if ($sortfield == "pt.nama_lengkap") { 
                                            if ($sorttype == "ASC") 
                                                echo 'class="sorting_asc"'; 
                                            elseif ($sorttype == "DESC") 
                                                echo 'class="sorting_desc"'; 
                                            else 
                                                echo 'class="sorting"'; 
                                        } else 
                                            echo 'class="sorting"'; ?>>Nama Lengkap</th>
                                    <th id="pt.nip" <?php
                                        if ($sortfield == "pt.nip") { 
                                            if ($sorttype == "ASC") 
                                                echo 'class="sorting_asc"'; 
                                            elseif ($sorttype == "DESC") 
                                                echo 'class="sorting_desc"'; 
                                            else 
                                                echo 'class="sorting"'; 
                                        } else 
                                            echo 'class="sorting"'; ?> width="70">NIP</th>
                                    <th id="s.nama_sekolah" <?php
                                        if ($sortfield == "s.nama_sekolah") { 
                                            if ($sorttype == "ASC") 
                                                echo 'class="sorting_asc"'; 
                                            elseif ($sorttype == "DESC") 
                                                echo 'class="sorting_desc"'; 
                                            else 
                                                echo 'class="sorting"'; 
                                        } else 
                                            echo 'class="sorting"'; ?>>Sekolah</th>
                                    <th>Alamat Sekolah</th>
                                    <th id="p.nama_propinsi" <?php
                                        if ($sortfield == "p.nama_propinsi") { 
                                            if ($sorttype == "ASC") 
                                                echo 'class="sorting_asc"'; 
                                            elseif ($sorttype == "DESC") 
                                                echo 'class="sorting_desc"'; 
                                            else 
                                                echo 'class="sorting"'; 
                                        } else 
                                            echo 'class="sorting"'; ?>>Propinsi</th>
                                    <th id="k.nama_kota" <?php
                                        if ($sortfield == "k.nama_kota") { 
                                            if ($sorttype == "ASC") 
                                                echo 'class="sorting_asc"'; 
                                            elseif ($sorttype == "DESC") 
                                                echo 'class="sorting_desc"'; 
                                            else 
                                                echo 'class="sorting"'; 
                                        } else 
                                            echo 'class="sorting"'; ?>>Kota/Kabupaten</th>
                                    <th width="50">Action</th>
                                </tr>
                            </thead>

                            <tbody>

                            <?php if(!$rows):?>
                                <tr>
                                    <td colspan="8"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                </tr>

                            <?php else:?>
                            <?php foreach ($rows as $row):?>

                                <tr>
                                    <td align="center"><?php echo $row->nuptk;?></td>
                                    <td style="text-align: left;"><?php echo $row->nama_lengkap;?></td>
                                    <td style="text-align: left;"><?php echo $row->nip;?></td>
                                    <td style="text-align: left;"><?php echo $row->nama_sekolah;?></td>
                                    <td style="text-align: left;"><?php echo $row->alamat;?></td>
                                    <td style="text-align: left;"><?php echo $row->nama_propinsi;?></td>
                                    <td style="text-align: left;"><?php echo $row->nama_kota;?></td>
                                    <td align="center">
                                        <a href="javascript:void(0)" data-id="<?php echo $row->id; ?>" title="Info" class="tip view" data-toggle="modal"><span class="icon12 icomoon-icon-search-3"></span></a>
                                    </td>
                                </tr>

                            <?php endforeach;?>
                            <?php unset($row);?>
                            <?php endif;?>					

                            </tbody>

                            <tfoot>
                                <tr>
                                    <td colspan="7">
                                        <div class="span4">
                                            <strong>Data&nbsp;:&nbsp;<span class="label label-info"><?php echo number_format($pager->items_total);?></span></strong>
                                        </div>
                                        <div class="span8">
                                            <div class="right">
                                                <?php echo $pager->display_pages();?>
                                            </div>
                                        </div>
                                    </td>											
                                </tr>										
                            </tfoot>

                        </table>
												
                    </div><!-- End .span12 -->
                </div><!-- End .row-fluid -->  
																				
            </div><!-- End contentwrapper -->
        </div><!-- End #content -->
    		
    </div><!-- End #wrapper -->
        
    <!-- Boostrap view modal dialog -->
    <div id="ptkviewModal" class="modal hide fade" style="display: none;">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span class="icon12 minia-icon-close"></span></button>
            <h3>Data Pendidik dan Tenaga Kependidikan</h3>
        </div>

        <div class="modal-body">		
            <div id="modalContent" style="display:none;">
            </div>
        </div>

        <div class="modal-footer">
            <a href="#" class="btn" data-dismiss="modal">Close</a>
        </div>
    </div>
        
    <script type="text/javascript">

        $(document).ready(function () {

              $("#propinsi_kode").change(function(){
                      var kode = $("#propinsi_kode").val();

                      $.ajax({
                              type: 'post',
                              url: "ajax/controller_public.php",
                              data: "loadKotaList=" + kode,
                              cache: false,
                              success: function(html){
                                      $("#kota_kode").html(html);
                              }
                      });

                      $("#kota_kode").val("");

              });

              $('a.tip.view').live('click', function () {

                    $('#ptkviewModal').modal();

                    return false;
                    
                });

              $("a[data-toggle=modal]").click(function() {   
                      var id = $(this).data('id');

                      $.ajax({
                              cache: false,
                              type: 'GET',
                              url: 'ajax/controller_public.php',
                              data: 'viewPTK=' + id,
                              success: function(data) 
                              {
                                    $('#ptkviewModal').show();
                                    $('#modalContent').show().html(data);                                    
                              }
                      });
              }); 

              $(".sorting, .sorting_asc, .sorting_desc").click(function(){

                    var sortfield  = $(this).attr("id");
                    var tclass =  $(this).attr("class");

                    if (tclass == "sorting_asc")
                        sorttype = "DESC"
                    else
                        sorttype = "ASC";

                    $('input[name=sortfield]').val(sortfield);
                    $('input[name=sorttype]').val(sorttype);

                    var values = $("#filter_form").serialize();

                    location.href = "ptk_public.php?" + values;

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
    <script type="text/javascript" src="js/ptk_public.js"></script>

<?php include("footer_public.php");?>
