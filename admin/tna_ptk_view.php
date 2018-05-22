	
                        <div class="page-header">
                            <h4>Data Hasil Self-Assesment TNA Online untuk PTK</h4>
                        </div>

                        <div style="margin-bottom: 20px;">
                            <ul id="myTab" class="nav nav-tabs pattern">
                                <li class="active"><a href="#tab1" data-toggle="tab">Hasil</a></li>
                                <li><a href="#tab2" data-toggle="tab">Grafik</a></li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="tab1">

                                    <?php 
                                        
                                        $row = $content->getTNA_PTKById(Filter::$id);

                                        echo "<p>NUPTK : <strong>" . $row->nuptk . "</strong></p>"; 
                                        echo "<p>Nama : <strong>" . $row->nama_lengkap . "</strong></p>";
                                        echo "<p>Sekolah <strong>: " . $row->nama_sekolah . "</strong></p>";

                                        if ($row->nilai_instrumen != 0)
                                            $nilai = (int)(($row->nilai_total / $row->nilai_instrumen) * 100 + .5);
                                        else
                                            $nilai = 0;

                                        echo "<p>Nilai Kompeten <strong>: " . $nilai . "&nbsp;%</strong></p>";
										
                                        $ptk_kdrows = $content->getTNA_PTK_KD($row->id); 
                                        $ptk_kdrowcount = count($ptk_kdrows); 
                                    ?>
										
                                    <form id="kd_form" class="form-horizontal" method="post" action="">			
                                    <fieldset>
                                        
                                        <input name="do" type="hidden" value="tna" />

                                        <table class="responsive table table-bordered">

                                            <thead>					
                                                <tr>
                                                    <th rowspan="2" width="50" style="text-align: center;">No.</th>
                                                    <th rowspan="2" >KOMPETENSI DASAR</th>
                                                    <th colspan="2" width="100">TINGKAT PENCAPAIAN KOMPETENSI</th>
                                                </tr>

                                                <tr>
                                                    <th width="50" style="text-align: center;">Ya</th>
                                                    <th width="50" style="text-align: center;">Tdk</th>
                                                </tr>										
                                            </thead>

                                            <tbody>

                                                <?php

                                                    // -- count ya / tdk --

                                                    $yacount = 0;
                                                    $tdkcount = 0;

                                                    $i = 0;
                                                    while ($i < $ptk_kdrowcount)  {
                                                        
                                                        if ($ptk_kdrows[$i]->kd_value == 1)
                                                            $yacount++;
                                                        elseif ($ptk_kdrows[$i]->kd_value == 0)
                                                            $tdkcount++;

                                                            $i++;
                                                            
                                                    }

                                                    if ($ptk_kdrows) :

                                                        foreach ($ptk_kdrows as $kdrow) :

                                                ?>

                                                                    <tr>
                                                                        <td align="right"><?php echo $kdrow->kdno; ?></td>
                                                                        <td style="text-align: left;"><?php echo $kdrow->nama_kompetensi; ?></td>
                                                                        <td align="center"><input type="radio" disabled name="<?php echo 'kd_'.$kdrow->id; ?>" id="radioYes" value="1" class="required" <?php if ($kdrow->kd_value == 1) echo "checked=\"checked\""; ?>/></td>
                                                                        <td align="center"><input type="radio" disabled name="<?php echo 'kd_'.$kdrow->id; ?>" id="radioNo" value="0" class="required" <?php if ($kdrow->kd_value == 0) echo "checked=\"checked\""; ?>/></td>
                                                                    </tr>

                                                <?php 

                                                        endforeach;
                                                        unset($kdrow);

                                                    endif; ?>

                                            </tbody>

                                        </table>

                                        <button type="button" class="btn" onclick="history.back()">Kembali</button>
                                        
                                        <input name="id" type="hidden" value="<?php echo Filter::$id;?>" />

                                    </fieldset>
                                    </form>    

                                </div> <!-- end tab1 -->
									
                                <div class="tab-pane fade" id="tab2">
                                        
                                    <div class="box chart">

                                        <div class="title">
                                            <h4>
                                                <span class="icon16 icomoon-icon-bars"></span>
                                                <span>Nilai Kompetensi</span>
                                            </h4>
                                        </div>
                                        
                                        <div class="content">
                                            <div class="tna-pie" style="height: 420px;width:100%;"> </div>
                                        </div>

                                    </div><!-- End .box -->
																																															
                                </div> <!-- end .tab2 -->
                                
                            </div> <!-- end tab content -->
                        </div> <!-- end .style="margin-bottom: -->
														
<script type="text/javascript">

	$(function () {

		var data = [
		    { label: "Ya",  data: <?php echo $yacount; ?>, color: "#88bbc8"},
		    { label: "Tidak",  data: <?php echo $tdkcount; ?>, color: "#ed7a53"}
		];

	    $.plot($(".tna-pie"), data, 
		{
			series: {
				pie: { 
					show: true,
					highlight: {
						opacity: 0.1
					},
					radius: 1,
					stroke: {
						color: '#fff',
						width: 2
					},
					startAngle: 2,
				    combine: {
	                    color: '#353535',
	                    threshold: 0.05
	                },
	                label: {
	                    show: true,
	                    radius: 1,
	                    formatter: function(label, series){
	                        return '<div class="pie-chart-label">'+label+'&nbsp;'+Math.round(series.percent)+'%</div>';
	                    }
	                }
				},
				grow: {	active: false}
			},
			legend:{show:false},
			grid: {
	            hoverable: true,
	            clickable: true
	        },
	        tooltip: true, //activate tooltip
			tooltipOpts: {
				content: "%s : %y.1"+"%",
				shifts: {
					x: -30,
					y: -50
				}
			}
		});
	
	});
</script>		

