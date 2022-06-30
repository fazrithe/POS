
   

					<?php 
						error_reporting(0);
						$b=$brg->row_array();
						$harjul = "0";
						if ($b['tipe_harjul'] == "grosir") {
							$harjul = $b['barang_harjul_grosir'];
						}else if ($b['tipe_harjul'] == "grosir-umum") {
							$harjul = $b['barang_harjul_grosir_umum'];
						}else {
							$harjul = $b['barang_harjul'];
						}						
					?>
					<table>
						<tr>
		                    <!--<th style="width:200px;"></th>-->
		                    <th>Nama Barang</th>
		                    <th>Satuan</th>
		                    <th>Stok</th>
							<th>Tipe</th>
		                    <th>Harga(Rp)</th>		                    
		                    <th>Jumlah</th>
		                </tr>
						<tr>
							<!--<td style="width:200px;"></td>-->
							<td><input type="text" name="nabar" value="<?php echo $b['barang_nama'];?>" style="width:200px;margin-right:5px;" class="form-control input-sm" readonly></td>
		                    <td><input type="text" name="satuan" value="<?php echo $b['barang_satuan'];?>" style="width:120px;margin-right:5px;" class="form-control input-sm" readonly></td>
		                    <td><input type="text" name="stok" value="<?php echo number_format($b['barang_stok']);?>" style="width:100px;margin-right:5px;" class="form-control input-sm" readonly></td>
							<!-- <td><input type="text" name="diskon" id="diskon" value="0" min="0" class="form-control input-sm" style="width:130px;margin-right:5px;" required></td> -->
							<td>
								<select id ="tipe_jual" name="tipe_jual" class="form-control" data-live-search="true" title="Pilih Harga" data-width="100%" style="width:100px;" required>
									<?php 
										$diskon_1 = $b['barang_harjul'];
										$diskon_2 = $b['barang_harjul_grosir'];
										$diskon_3 = $b['barang_harjul_grosir_umum'];
										print_r($diskon_1,$diskon_2,$diskon_3);
										if ($b['barang_harjul']==""){
											$diskon_1=0;	
										}
										if ($b['barang_harjul_grosir']==""){
											$diskon_2=0;	
										}
										if ($b['barang_harjul_grosir_umum']==""){
											$diskon_3=0;
										} 	
											if ($b['tipe_harjul'] == "eceran"){
												echo "<option value='$diskon_1'selected>Eceran</option>";
												echo "<option value='$diskon_2'>Grosir</option>";
												echo "<option value='$diskon_3'>Grosir Umum</option>";
											}else if ($b['tipe_harjul'] == "grosir"){
												echo "<option value='$diskon_1'>Eceran</option>";
												echo "<option value='$diskon_2'selected>Grosir</option>";
												echo "<option value='$diskon_3'>Grosir Umum</option>";
											}else if ($b['tipe_harjul'] == "grosir-umum"){
												echo "<option value='$diskon_1'>Eceran</option>";
												echo "<option value='$diskon_2'>Grosir</option>";
												echo "<option value='$diskon_3'selected>Grosir Umum</option>";
											}
									?>
                    			</select>
							</td>
							<td><input id="harjul" type="text" name="harjul" value="<?php echo number_format($harjul);?>" style="width:150px;margin-left:5px;margin-right:5px;text-align:right;" class="form-control input-sm"></td>
		                    <td><input type="number" name="qty" id="qty" value="0" min="1" max="<?php echo $b['barang_stok'];?>" class="form-control input-sm" style="width:120px;margin-right:5px;" required></td>
		                    <td><button type="submit" class="btn btn-sm btn-primary">Ok</button></td>
						</tr>
					</table>



					<script type="text/javascript">
						$(document).ready(function(){
							$("#tipe_jual").change(function(){
								$("#harjul").val(addCommas($(this).val()));
							});
							
							$("#qty").focus(function(){
								$("#qty").val("");
							})

							$("#harpok").keyup(function(){
								var old_harpok = $("#hide_harpok").val();
								var new_harpok = $("#harpok").val();
								var gap_harpok = new_harpok - old_harpok;
								var old_harjul = $("#hide_harjul").val();
								console.log(gap_harpok);
								if (parseInt(gap_harpok) >= 0) {
									var new_harjul = parseInt(gap_harpok) + parseInt(old_harjul);
									$("#harjul").val(new_harjul);
								}  				
            				}); 
							
							$("#harpok,#harjul,#harjul_grosir,#harjul_grosir_umum,#jumlah").keyup(function(){							
								oldVal = this.value;
								this.value = addCommas(oldVal);
							})
						});	

						function addCommas(nStr) {
    						var val = nStr;
  							val = val.replace(/[^0-9\.]/g,'');
							if(val != "") {
								valArr = val.split('.');
								valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
								val = valArr.join('.');
							}
  							return val;
						}

					</script>
					

	<!-- Bootstrap Core JavaScript -->
	
    				
