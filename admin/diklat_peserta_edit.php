    <script type="text/javascript" src="js/diklat_peserta_edit.js"></script>

	<?php $row = $content->getDiklat_PesertaById(Filter::$id);	
	
		if (($row) && ($row->kamarid))
			$gedungid = $content->getGedungIdByKamarId($row->kamarid);
		else
			$gedungid = 0;
				
	?>

                        <div class="box">

                            <div id="msgholder"></div>

                            <div class="title">
                                <h4> 
                                    <span>Registrasi Peserta Diklat</span>
                                </h4>								
                            </div>

                            <div class="content">
							
                                <form id="admin_form" class="form-horizontal" method="post" action="">
                                <fieldset>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">                             
                                                <label class="form-label span4" for="foto">Foto Peserta:
                                                    <span class="help-block">Max. ukuran foto 1MB</span>
                                                </label>
                                                <div class="span2 controls">
                                                     <img src='../foto/foto_peserta_diklat/<?php echo ( ($row->foto) ? ($row->dir_foto).'/'.($row->foto) : 'poto_kosong.png');?>   ' title='Poto Peserta' id="poto_peserta" name="poto_peserta" width="150" height="120"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">                             
                                                <label class="form-label span4" for="foto"> 
                                                    <span class="help-block"></span>
                                                </label>
                                                <div class="controls">
                                                    <input type="file" id="foto" name="foto"  accept=".jpg, .jpeg, .png" name="<?php if ($row) echo $row->foto;?>">
													<a id="btnwebcam" class="btn btn-info">Webcam</a>
                                                    <input type="hidden" name="dir" value="<?php if ($row) echo $row->dir_foto;?>">
													<input type="hidden" id="camfoto" name="camfoto"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">NUPTK:</label>
                                                <input type="text" class="span2" name="nuptk" id="nuptk" value="<?php if ($row) echo $row->nuptk;?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Nama Lengkap:</label>
                                                <input type="text" class="span8" name="nama_lengkap" id="nuptk" value="<?php if ($row) echo $row->nama_lengkap;?>"/>
                                            </div>
                                        </div>
                                    </div>									

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">NIP:</label>
                                                <input type="text" class="span2" name="nip" id="nip" value="<?php if ($row) echo $row->nip;?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Sekolah:</label>
                                                <input type="text" class="span8" name="nama_sekolah" id="nama_sekolah" value="<?php if ($row) echo $row->nama_sekolah;?>" disabled="disabled"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Propinsi:</label>
                                                <input type="text" class="span8" name="nama_propinsi" id="nama_propinsi" value="<?php if ($row) echo $row->nama_propinsi;?>" disabled="disabled"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Kota:</label>
                                                <input type="text" class="span8" name="nama_kota" id="nama_kota" value="<?php if ($row) echo $row->nama_kota;?>" disabled="disabled"/>
                                            </div>
                                        </div>
                                    </div>
                                                                        
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Angkatan:</label>
                                                <input type="text" class="span2" name="angkatan" id="angkatan" maxlength="5" value="<?php if ($row->angkatan) echo $row->angkatan; ?>"/>
                                            </div> 													
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Kelas:</label>
                                                <input type="text" class="span2" name="kelas" id="kelas" maxlength="5" value="<?php if ($row->kelas) echo $row->kelas; ?>"/>
                                            </div> 													
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Tanggal Undangan:</label>
                                                <input type="text" class="span2 datepickerField" name="reg_undang" id="reg_undang" value="<?php if ($row->reg_undang) echo ($row->reg_undang);?>"/>
                                            </div> 													
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Tanggal Reg Ulang:</label>
                                                <input type="text" class="span2 datepickerField" name="reg_ulang" id="reg_ulang" value="<?php if ($row->reg_ulang) echo ($row->reg_ulang);?>"/>
                                            </div> 													
                                        </div>
                                    </div>

                                    <?php $gedung = $content->getGedungList();?>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="checkboxes">Gedung:</label>
                                                <div class="span8 controls">
                                                    <select name="gedungid" id="gedungid">
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                        <?php if ($gedung):?>
                                                            <?php foreach ($gedung as $prow):?>
                                                                <option value="<?php echo $prow->id;?>" <?php if ($prow->id == $gedungid) echo 'selected="selected"';?>><?php echo $prow->nama_gedung;?></option>
                                                            <?php endforeach;?>
                                                            <?php unset($prow);?>
                                                        <?php endif;?>
                                                    </select>						
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php $kamar = $content->getKamarList();?>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="checkboxes">Kamar:</label>
                                                <div class="span8 controls">
                                                    <select name="kamarid" id="kamarid">
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                        <?php if ($kamar):?>
                                                            <?php foreach ($kamar as $prow):?>
                                                                <option value="<?php echo $prow->id;?>" <?php if(($row->kamarid) && ($prow->id == $row->kamarid))echo 'selected="selected"';?>><?php echo $prow->kode.' / '.$prow->jenis;?></option>
                                                            <?php endforeach;?>
                                                            <?php unset($prow);?>
                                                        <?php endif;?>
                                                    </select>						
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php $bed = $content->getKamar_BedList();?>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="checkboxes">Bed:</label>
                                                <div class="span8 controls">
                                                    <select name="bedid" id="bedid">
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                        <?php if ($bed):?>
                                                            <?php foreach ($bed as $prow):?>
                                                                <option value="<?php echo $prow->id;?>" <?php if(($row->bedid) && ($prow->id == $row->bedid))echo 'selected="selected"';?>><?php echo $prow->kode.' / '.$prow->status;?></option>
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
                                                <label class="form-label span4" for="normal">Catatan:</label>
                                                <textarea name="keterangan" class="span8" cols="45" rows="5"><?php if ($row->keterangan) echo $row->keterangan;?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-info">Save</button>
                                        <button type="button" class="btn" onclick="history.back()">Kembali</button>
                                    </div>

                                    <input name="id" type="hidden" value="<?php echo Filter::$id;?>" /> <!-- pesertaid -->
                                    <input name="userid" type="hidden" value="<?php echo $user->uid;?>" />

                                </fieldset>	
                                </form>

                            </div><!-- End .content -->	
                            
                        </div><!-- End .box -->		


<div id="cammodal" class="modal hide">
<div class="modal-content">
    <div class="container">
        <div id="camera_info"></div>
    <div id="camera"></div>
    <button id="take_snapshots" class="btn btn-success btn-sm" onClick="take_snapshot()"style="margin-top: 10px;">Take Snapshot</button>
    <button id="cancel_webcam" class="btn btn-failed btn-sm"style="margin-top: 10px;">Cancel</button>
	</div>
</div>
</div>
<style>
/* The Modal (background) */
.modal {
	width:355px;
	height:300px;
    background-color: rgba(0,0,0),0.4); /* Black w/ opacity */
}
/* Modal Content/Box */
.modal-content {
	position: relative;
    background-color: #fefefe;
    margin: auto;
	width: 90%;
	}
#camera{
	margin-top: 12px;
}
</style>
	<script type="text/javascript" src="plugins/webcam/webcam.min.js"></script>
	<!-- Configure a few settings and attach camera -->
	<script language="JavaScript">
		Webcam.set({
				// live preview size
				width: 320,
				height: 240,
				
				// format and quality
				image_format: 'jpeg',
				jpeg_quality: 100
		});
	</script>

		<!-- Code to handle taking the snapshot and displaying it locally -->
	<script language="JavaScript">
		function take_snapshot() {
			// take snapshot and get image data
			Webcam.snap( function(data_uri) {
				// display results in page
				$('#poto_peserta').attr('src',data_uri);
				document.getElementById('camfoto').value = data_uri;
				
					var modal = document.getElementById('cammodal');
					modal.style.display = "none";

			} );
		}
	</script>
						
<script type="text/javascript">
	var modal = document.getElementById('cammodal');
	var btn = document.getElementById("btnwebcam");
	var cancel = document.getElementById("cancel_webcam");

	btn.onclick = function() {
		 Webcam.reset();
			
 		 Webcam.attach( '#camera' );
    modal.style.display = "block";

Webcam.on( 'error', function(err) {
if (location.protocol == 'http:'){
if(confirm("Webcam membutuhkan protokol https, Silahkan reload browser")){
document.location="https:" + window.location.href.substring(window.location.protocol.length, window.location.href.length);
}
modal.style.display = "none";
}

else{
if(err){
    alert(err.message);
    modal.style.display = "none";
}else{
    modal.style.display = "block";
}
}

} );
	}
	
	cancel.onclick = function(){
		modal.style.display = "none";
	}

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

		$(document).ready(function(){
			$("#gedungid").change(function(){
				var id = $("#gedungid").val();
				
				$.ajax({
					type: 'post',
					url: "controller.php",
					data: "loadKamarList=" + id,
					cache: false,
					success: function(html){
						$("#kamarid").html(html); 
					}
				});

			$("#kamarid").val("");

			});
			
			$("#kamarid").change(function(){
				var id = $("#kamarid").val();
				
				$.ajax({
					type: 'post',
					url: "controller.php",
					data: "loadKamar_BedList=" + id,
					cache: false,
					success: function(html){
						$("#bedid").html(html); 
					}
				});

			$("#bedid").val("");

			});
			
		});

    $(function(){
        $("#foto").on('change', function(event) {
            var file = event.target.files[0];
            var filePath = $(this).val();

            if(file.size>=1*1024*1024) {
                alert("Ukuran file gambar maksimum adalah 2MB");
                $("#form-id").get(0).reset(); //the tricky part is to "empty" the input file here I reset the form.
                return;
            }

            if((!file.type.match('image/jp.*'))) {
                alert("Harus berupa file gambar JPG");
                $("#form-id").get(0).reset(); //the tricky part is to "empty" the input file here I reset the form.
                return;
            }

            var fileReader = new FileReader();
            fileReader.onload = function(e) {
                var int32View = new Uint8Array(e.target.result);
                //verify the magic number
                // for JPG is 0xFF 0xD8 0xFF 0xE0 (see https://en.wikipedia.org/wiki/List_of_file_signatures)
                if(!int32View.length>4 && !int32View[0]==0xFF && !int32View[1]==0xD8 && !int32View[2]==0xFF && !int32View[3]==0xE0) {
                    alert("Harus berupa file gambar JPG");
                    $("#form-id").get(0).reset(); //the tricky part is to "empty" the input file here I reset the form.
                    return;
                }
                else
                    {   
                        // alert(file.name);
                        // $("#poto_peserta").attr("src",file.name);
                        var reader = new FileReader();

                                        reader.onload = function (e) {
                                            $('#poto_peserta').attr('src', e.target.result);
                                        }

                                        reader.readAsDataURL(event.target.files[0]);
                    }
            };
            fileReader.readAsArrayBuffer(file);
        });
    });

	  
	</script>		
						
												
<?php echo Core::doForm("processDiklat_Peserta"); ?> 	
