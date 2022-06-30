<?php 
						error_reporting(0);
						$b=$brg->row_array();
					?>
					<table>
						<tr>
		                    <th style="width:200px;"></th>
		                    <th>Nama Barang</th>
		                    <th>Satuan</th>
		                    <th>Harga Pokok</th>
		                    <th>Jual Eceran</th>
							<th>Jual Grosir</th>
							<th>Jual Grosir Umum</th>
		                    <th>Jumlah</th>
		                </tr>
						<tr>
							<td style="width:200px; margin-right:5px;"></td>
							<td><input type="text" name="nabar" value="<?php echo $b['barang_nama'];?>" style="width:250px;margin-right:5px;" class="form-control input-sm" readonly></td>
		                    <td><input type="text" name="satuan" value="<?php echo $b['barang_satuan'];?>" style="width:100px;margin-right:5px;" class="form-control input-sm" readonly></td>
		                    <td><input type="text" name="harpok" id="harpok" value="<?php echo number_format($b['barang_harpok']);?>" style="width:100px;margin-right:5px;" class="form-control input-sm" required></td>
							<input type="hidden" name="hide_harpok" id="hide_harpok" value="<?php echo $b['barang_harpok'];?>">
		                    
							<td><input type="text" name="harjul" id="harjul" value="<?php echo number_format($b['barang_harjul']);?>" style="width:120px;margin-right:5px;" class="form-control input-sm" required></td>
							<input type="hidden" name="hide_harjul" id="hide_harjul" value="<?php echo (int)$b['barang_harjul'];?>">
							
							<td><input type="text" name="harjul_grosir" id="harjul_grosir" value="<?php echo number_format($b['barang_harjul_grosir']);?>" style="width:120px;margin-right:5px;" class="form-control input-sm" required></td>
							<input type="hidden" name="hide_harjul_grosir" id="hide_harjul_grosir" value="<?php echo (int)$b['barang_harjul_grosir'];?>">
							
							<td><input type="text" name="harjul_grosir_umum" id="harjul_grosir_umum" value="<?php echo number_format($b['barang_harjul_grosir_umum']);?>" style="width:150px;margin-right:5px;" class="form-control input-sm" required></td>
							<input type="hidden" name="hide_harjul_grosir_umum" 	id="hide_harjul_grosir_umum" value="<?php echo (int)$b['barang_harjul_grosir_umum'];?>">
		                    
							<td><input type="text" name="jumlah" id="jumlah" class="form-control input-sm" style="width:90px;margin-right:5px;" required></td>
		                    <td><button type="submit" class="btn btn-sm btn-primary">Ok</button></td>
						</tr>
					</table>


					<script type="text/javascript">
						$(document).ready(function(){ 
							$("#harpok").keyup(function(){
								var old_harpok = $("#hide_harpok").val();
								var new_harpok = $("#harpok").val();
								var gap_harpok = parseFloat(new_harpok.replace(/,/g, '')) - parseFloat(old_harpok.replace(/,/g, ''));
								var old_harjul = $("#hide_harjul").val();
								var old_harjul_grosir = $("#hide_harjul_grosir").val();
								var old_harjul_grosir_umum = $("#hide_harjul_grosir_umum").val();
								console.log(old_harjul_grosir,old_harjul_grosir_umum);
								if (parseInt(gap_harpok) >= 0) {
									var new_harjul = gap_harpok + parseFloat(old_harjul.replace(/,/g, ''));
									var new_harjul_grosir = gap_harpok + parseFloat(old_harjul_grosir.replace(/,/g, ''));
									var new_harjul_grosir_umum = gap_harpok + parseFloat(old_harjul_grosir_umum.replace(/,/g, ''));
									$("#harjul").val(new_harjul);
									$("#harjul_grosir").val(new_harjul_grosir);
									$("#harjul_grosir_umum").val(new_harjul_grosir_umum);
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