
                <div class="row-fluid">
                    <div class="span12">

                        <div id="msgholder"></div>
						
                        <div class="box">

                            <?php $profiles = $user->getUser_ProfileList();?>
						
                            <div class="title">
                                <h4> 
                                    <span>Tambah Data User Login</span>
                                </h4>								
                            </div>

                            <div class="content">

                                <form id="admin_form" class="form-horizontal" method="post" action="">			
                                <fieldset>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Username:</label>
                                                <input name="username" type="text" class="span2 required" maxlength="50" value="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="password">Password:</label>
                                                <input name="password" type="password" class="span4 required" maxlength="20" placeholder="Masukkan password" />
                                                <input name="passwordretype" type="password" class="span4 required" maxlength="20" placeholder="Ulangi password" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">E-Mail:</label>
                                                <input name="email" type="text" class="span8 required" value="" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="checkboxes">Profile:</label>
                                                <div class="span8 controls">											  
                                                    <select name="profileid" id="profileid" <?php if (!$user->is_Admin()) echo "disabled=\"disabled\""; ?>>
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                        <?php if ($profiles):?>
                                                            <?php foreach ($profiles as $prow):?>
                                                                <option value="<?php echo $prow->id;?>"><?php echo $prow->usermode." : ".$prow->profilename;?></option>
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
                                            <div class="row-fluid" id="ptkonly">								
                                                <label class="form-label span4" for="normal">Cari : <span class="help-block">(Hanya untuk GTK & STAFF : Quick Search)</span></label></label>
                                                <input name="nuptksearch" id="nuptksearch" type="text" class="span2" value="" disabled="disabled"/>
                                                <input type="radio" name="optionsNUPTK" id="optionNUPTK" value="nuptk" checked="checked" /> : NUPTK&nbsp;
                                                <input type="radio" name="optionsNUPTK" id="optionNIP" value="nip" /> : NIP
                                            </div>
                                        </div>
                                    </div>                                    

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid" id="ptkonly">                                
                                                <label class="form-label span4" for="normal">Nama GTK / Staff:</label></label>
                                                <input name="nama_lengkap" id="nama_lengkap" type="text" class="span8" value="" disabled="disabled"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-info">Save</button>
                                        <button type="button" class="btn" onclick="history.back()">Kembali</button>
                                    </div>

                                    <input name="ptkid" id="ptkid" type="hidden" value="" />
                                    <input name="created" type="hidden" value="now()" />

                                </fieldset>
                                </form>
                                
                            </div><!-- End .content -->
                            
                        </div><!-- End .box -->

                    </div><!-- End .span12 -->
                </div><!-- End .row-fluid -->

<?php echo Core::doForm("processUser"); ?> 	

	<script type="text/javascript">

            $(document).ready(function(){
                                                 
                $('#profileid').change(function () {
                    //var value = $("#profileid option:selected").text;
                    var value = $("#profileid option:selected").text();
                    value = value.substring(0, 1);
                                        
                    //if (value == 'P') {alert('show!');$('#ptkonly').show();} else {alert('hide!');$('#ptkonly').hide();}
                    
                    if ((value == "P") || (value == "S")) {
                        $('#nuptksearch').removeAttr("disabled");
                    } else { 
                        $('#nuptksearch').attr('disabled', 'disabled');
                    }
                                                                                                                                            
                })
                
                
                $('#nuptksearch').typeahead({
                   //
                   source: function(query, process){
                        data = [];
                        map = {}; alert ("aaa");

                        var profile = $("#profileid option:selected").text();
                        profile = profile.substring(0, 1);
                        var optionsNUPTK = $("input[name=optionsNUPTK]:checked").val();

                        $.ajax({
                            type: 'get',
                            url: "controller_ptk.php",
                            data: "nuptksearch=" + query + "&from=" + profile + "&field=" + optionsNUPTK,
                            dataType: 'json',
                            success: function (res) { 

                                $.each(res, function (i, dt) {
                                    map[dt.nuptk] = dt;
                                    data.push(dt.nuptk);
                                }); 

                                process(data); 
                            }
                        });
                   },

                   // panjang string (query) minimal untuk dikirim ke server
                   minLength:3,

                   updater: function (item) {
                        // lakukan apapun yang ingin dilakukan dengan ID data terpilih
                        selectedItem = map[item].nuptk;

                        $('#nama_lengkap').val(map[item].nama_lengkap);
                        $('#ptkid').val(map[item].id);

                        // penting! jangan hapus kode di bawah ini (used by typeahead)
                        return item;
                   }
                });                
                                                  
            });
	  
	</script>		
                