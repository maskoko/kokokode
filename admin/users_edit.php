
	<?php 
		$row = Core::getRowById("users", Filter::$id, false, false);
                
        $ptkid = 0;
        $nuptk = '';
        $ptk_nama = '';
        $profilemodules = array();
                
		if ($row) {
			if ($row->ptkid)
                $ptkid = $row->ptkid; 
			
			if (($row->profileid) && ($row->profileid > 0)) { 
				$uprow = Core::getRowById("user_profiles", $row->profileid, false, false);
                if (($uprow) && ($uprow->usermode))
                    $usermode = $uprow->usermode;
                else
                    $usermode = 'G';
								
			} else
				$usermode = 'G';								
                        
            if ($usermode == 'P') {

                if ($ptkid > 0) { 
                    $ptkrow = Core::getRowById("ptk", $ptkid, false, false);
                    if ($ptkrow) {
                            $nuptk = $ptkrow->nuptk;
                            $ptk_nama = $ptkrow->nama_lengkap; 
                    }
                }

            } else if ($usermode == 'S') {

                if ($ptkid > 0) { 
                    $ptkrow = Core::getRowById("staff", $ptkid, false, false);
                    if ($ptkrow) {
                            $nuptk = $ptkrow->nuptk;
                            $ptk_nama = $ptkrow->nama_lengkap; 
                    }
                }

            }
                                                                        
		}

	?>

                <div class="row-fluid">
                    <div class="span12">

                        <div id="msgholder"></div>
                        
                        <div class="box">
										
                            <?php $profiles = $user->getUser_ProfileList();?>
						
                            <div class="title">
                                <h4> 
                                    <span>Edit Data User Login</span>
                                </h4>								
                            </div>

                            <div class="content">

                                <form id="admin_form" class="form-horizontal" method="post" action="">			
                                <fieldset>

                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">								
                                                    <label class="form-label span4" for="normal">Username:</label>
                                                    <input name="username" type="text" disabled="disabled" class="span2 required" value="<?php echo $row->username;?>" readonly="readonly" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">								
                                                    <label class="form-label span4" for="normal">Password:</label>
                                                    <input name="password" type="password" class="span4 required" maxlength="20" placeholder="Masukkan password" />
                                                    <input name="passwordretype" type="password" class="span4 required" maxlength="20" placeholder="Ulangi password" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">								
                                                    <label class="form-label span4" for="normal">E-Mail:</label>
                                                    <input name="email" type="text" class="span8 required" value="<?php echo $row->email;?>" />
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
                                                                    <option value="<?php echo $prow->id;?>" <?php if($prow->id == $row->profileid)echo 'selected="selected"';?>><?php echo $prow->usermode." : ".$prow->profilename;?></option>
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
                                                    <label class="form-label span4" for="normal">Link Nama GTK / Staff:</label></label>
                                                    <input name="link_nama_lengkap" id="link_nama_lengkap" type="text" class="span8" value="<?php if ($ptk_nama) echo $ptk_nama; ?>" disabled="disabled"/>
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid" id="ptkonly">								
                                                    <label class="form-label span4" for="normal">Cari : <span class="help-block">(Hanya untuk GTK & Staff : Quick Search)</span></label></label>
                                                    <input name="nuptksearch" id="nuptksearch" type="text" class="span2" value="<?php echo $nuptk; ?>" <?php if ($usermode != 'P') echo 'disabled="disabled"'; ?>/>
                                                    <input type="radio" name="optionsNUPTK" id="optionNUPTK" value="nuptk" checked="checked" /> : NUPTK&nbsp;
                                                    <input type="radio" name="optionsNUPTK" id="optionNIP" value="nip" /> : NIP
                                                </div>
                                            </div>
                                        </div>                                    

                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid" id="ptkonly">
                                                    <label class="form-label span4" for="normal">Hasil cari GTK / Staff:</label></label>
                                                    <input name="nama_lengkap" id="nama_lengkap" type="text" class="span8" value="" disabled="disabled"/>
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">								
                                                    <label class="form-label span4" for="normal">Created:</label>
                                                    <input name="created" type="text" disabled="disabled" class="span4" value="<?php echo setToStrdatetime($row->created);?>" size="20" readonly="readonly" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">								
                                                    <label class="form-label span4" for="normal">Waktu Login terakhir:</label>
                                                    <input name="lastlogin" type="text" disabled="disabled" class="span4" value="<?php if ($row->lastlogin && $row->lastlogin != '0000-00-00 00:00:00') echo setToStrdatetime($row->lastlogin);?>" size="20" readonly="readonly" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">								
                                                    <label class="form-label span4" for="normal">IP Login terakhir:</label>
                                                    <input name="lastip" type="text" disabled="disabled" class="span2" value="<?php echo $row->lastip;?>" size="20" readonly="readonly" />
                                                </div>
                                            </div>
                                        </div>

                                    <!-- <div class="form-row row-fluid">
                                        <div class="span12">
                                            
                                            <?php 
                                                
                                                $mrows = $content->getModules(); 
                                                                                            
                                            ?>
                                            
                                            <table class="responsive table table-bordered">

                                                <thead>					
                                                    <tr>
                                                        <th>Modul</th>
                                                        <th width="30">C</th>
                                                        <th width="30">R</th>
                                                        <th width="30">U</th>
                                                        <th width="30">D</th>
                                                        <th width="30">L</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    
                                                    <?php if(!$mrows):?>
                                                    <tr>
                                                        <td colspan="5"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                                    </tr>

                                                    <?php else:?>
                                                    <?php foreach ($mrows as $mrow):?>
                                                                                                        
                                                    <tr>
                                                        <input name="moduleid[]" type="hidden" value="<?php echo $mrow->id; ?>" />
                                                        <td style="text-align: left;"><?php echo $mrow->modulename; ?></td>
                                                        <td align="center"><input type="checkbox" name="cC[]" value="<?php echo $mrow->id; ?>"
                                                            <?php if (array_key_exists($mrow->id, $user->profilemodules)) {if (strrpos($user->profilemodules[$mrow->id], 'C') !== FALSE) echo " checked";} ?> disabled="disable"/></td>
                                                        <td align="center"><input type="checkbox" name="cR[]" value="<?php echo $mrow->id; ?>"
                                                            <?php if (array_key_exists($mrow->id, $user->profilemodules)) {if (strrpos($user->profilemodules[$mrow->id], 'R') !== FALSE) echo " checked";} ?> disabled="disable"/></td>
                                                        <td align="center"><input type="checkbox" name="cU[]" value="<?php echo $mrow->id; ?>"
                                                            <?php if (array_key_exists($mrow->id, $user->profilemodules)) {if (strrpos($user->profilemodules[$mrow->id], 'U') !== FALSE) echo " checked";} ?> disabled="disable"/></td>
                                                        <td align="center"><input type="checkbox" name="cD[]" value="<?php echo $mrow->id; ?>"
                                                            <?php if (array_key_exists($mrow->id, $user->profilemodules)) {if (strrpos($user->profilemodules[$mrow->id], 'D') !== FALSE) echo " checked";} ?> disabled="disable"/></td>
                                                        <td align="center"><input type="checkbox" name="cL[]" value="<?php echo $mrow->id; ?>"
                                                            <?php if (array_key_exists($mrow->id, $user->profilemodules)) {if (strrpos($user->profilemodules[$mrow->id], 'L') !== FALSE) echo " checked";} ?> disabled="disable"/></td>
                                                    </tr>
                                                    
                                                    <?php endforeach;?>
                                                    <?php unset($mrow);?>
                                                    <?php endif;?>					
                                                                                                        
                                                </tbody>

                                            </table>
                                            
                                        </div>
                                    </div> -->
                                                                        
                                    
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-info">Save</button>
                                            <button type="button" class="btn" onclick="history.back()">Kembali</button>
                                        </div>

                                        <input name="id" type="hidden" value="<?php echo Filter::$id;?>" />
                                        <input name="ptkid" id="ptkid" type="hidden" value="<?php echo $ptkid;?>" />
                                        <input name="username" type="hidden" value="<?php echo $row->username;?>" />
                                        <input name="created" type="hidden" value="<?php echo $row->created;?>" />

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
                        map = {};

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
                