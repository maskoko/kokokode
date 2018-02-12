<?php
  /**
   * Index
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: diklat_public.php, v1.00 2011-07-10 10:12:05 gewa Exp $
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
                    <h3>Katalog Diklat</h3>                    
                </div><!-- End .heading-->
    				
                <!-- Build page from here: Usual with <div class="row-fluid"></div> -->							
                
	<?php		
                
            if(isset(Filter::$get['departemenid']))
                $departemenid = Filter::$get['departemenid'];
            else
                $departemenid = 0;
                                    
            if(isset(Filter::$get['searchfield']))
                $searchfield = Filter::$get['searchfield'];
            else
                $searchfield = 'nama_diklat';
                
            if(isset(Filter::$get['searchtext']))
                $searchtext = Filter::$get['searchtext'];
            else
                $searchtext = '';
                       
            if(isset(Filter::$get['sortfield']))
                $sortfield = Filter::$get['sortfield'];
            else
                $sortfield = 'dk.nama_diklat';

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
                                                <label class="form-label span2" for="checkboxes">Departemen:</label>
                                                <div class="span8 controls">
                                                    <?php $departemen = $content->getDepartemenList();?>						
                                                    <select name="departemenid" id="departemenid" style="width:100%;" placeholder="Select...">
                                                        <option value="0"><?php echo lang('SELECT_ALL');?></option>
                                                        <?php if ($departemen):?>
                                                            <?php foreach ($departemen as $prow):?>
                                                                <option value="<?php echo $prow->id;?>" <?php if($prow->id == $departemenid)echo 'selected="selected"';?>><?php echo $prow->nama_departemen;?></option>
                                                            <?php endforeach;?>
                                                            <?php unset($prow);?>
                                                        <?php endif;?>						
                                                    </select>
                                                </div>
                                            </div> <!-- end row-fluid -->
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span2" for="checkboxes">Search:</label>
                                                <div class="span2 controls">
                                                    <select name="searchfield" id="searchfield" placeholder="Select..." style="width: 100%;">
                                                        <option value="nama_diklat" <?php if($searchfield == 'nama_diklat') echo 'selected="selected"';?>>Nama</option>
                                                        <option value="kode" <?php if($searchfield == 'kode') echo 'selected="selected"';?>>Kode</option>
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

                        <?php $rows = $content->getDiklat();?>

                        <div class="box">

                            <table class="responsive table table-bordered table-striped table-sorting table-condensed">

                                <thead>
                                    <tr>
                                        <th id="dk.kode" <?php
                                            if ($sortfield == "dk.kode") { 
                                                if ($sorttype == "ASC") 
                                                    echo 'class="sorting_asc"'; 
                                                elseif ($sorttype == "DESC") 
                                                    echo 'class="sorting_desc"'; 
                                                else 
                                                    echo 'class="sorting"'; 
                                            } else 
                                                echo 'class="sorting"'; ?> width="50">Kode</th>
                                        <th id="dk.nama_diklat" <?php
                                            if ($sortfield == "dk.nama_diklat") { 
                                                if ($sorttype == "ASC") 
                                                    echo 'class="sorting_asc"'; 
                                                elseif ($sorttype == "DESC") 
                                                    echo 'class="sorting_desc"'; 
                                                else 
                                                    echo 'class="sorting"'; 
                                            } else 
                                                echo 'class="sorting"'; ?>>Nama Diklat</th>
                                        <th width="50">Tingkat</th>
                                        <th width="50">Jenis</th>
                                        <th width="75">Pola/Jam</th>
                                        <th>Departemen</th>
                                    </tr>
                                </thead>

                                <tbody>

                                <?php if(!$rows):?>
                                    <tr>
                                        <td colspan="6"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                    </tr>

                                <?php else:?>
                                <?php foreach ($rows as $row):?>

                                    <tr>
                                        <td align="center"><?php echo $row->kode;?></td>
                                        <td style="text-align: left;"><a href="javascript:void(0)" data-id="<?php echo $row->id; ?>" title="Info" class="tip view" data-toggle="modal"><?php echo $row->nama_diklat;?></a></td>
                                        <td><?php echo $row->tingkat;?></td>
                                        <td><?php echo $row->jenis;?></td>
                                        <td><?php echo $row->jml_jam;?></td>
                                        <td style="text-align: left;"><?php echo $row->nama_departemen;?></td>
                                    </tr>

                                <?php endforeach;?>
                                <?php unset($row);?>
                                <?php endif;?>					

                                </tbody>

                                <tfoot>
                                    <tr>
                                        <td colspan="6">
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

                        </div><!-- End .box -->
                            
                    </div> <!-- end .span12 -->
                </div><!-- End .row-fluid -->
                                                               
            </div><!-- End contentwrapper -->
        
        </div><!-- End #content -->
    
    </div><!-- End #wrapper -->
    
    <!-- Boostrap view modal dialog -->
    <div id="dkviewModal" class="modal hide fade" style="display: none;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span class="icon12 minia-icon-close"></span></button>
          <h3>Diklat</h3>
        </div>

        <div class="modal-body">
            <div id="dkmodalContent" style="display:none;">
            </div>
        </div>

        <div class="modal-footer">
            <a href="#" class="btn" data-dismiss="modal">Close</a>
        </div>
    </div>    
    
    <script type="text/javascript">

        $(document).ready(function () {

            $('a.tip.view').live('click', function () {

                    $('#dkviewModal').modal();

                    return false;
                    
              });

            $("a[data-toggle=modal]").click(function() {   

                    var id = $(this).data('id');

                    $.ajax({
                            cache: false,
                            type: 'GET',
                            url: 'ajax/controller_public.php',
                            data: 'viewDiklat=' + id,
                            success: function(data) {
                                $('#dkviewModal').show();
                                $('#dkmodalContent').show().html(data);
                            }
                    });

            }); 

            $(".sorting, .sorting_asc, .sorting_desc").click(function() {

                  var sortfield  = $(this).attr("id");                              
                  var tclass =  $(this).attr("class");

                  if (tclass == "sorting_asc")
                    sorttype = "DESC"
                  else
                    sorttype = "ASC";

                  $('input[name=sortfield]').val(sortfield);
                  $('input[name=sorttype]').val(sorttype);

                  var values = $("#filter_form").serialize();

                  location.href = "diklat_public.php?" + values;

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

<?php include("footer_public.php");?>
