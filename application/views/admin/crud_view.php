<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Produk By CV. Dua Sekawan">
    <meta name="author" content="CV. Dua Sekawan">
    <title>Star POS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    
    <link rel="stylesheet" href="<?=base_url();?>assets/bootstrap-4/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
    <!-- <link href="<?php echo base_url().'assets/css/bootstrap.min.css'?>" rel="stylesheet">     -->
    <!-- <link href="<?php echo base_url().'assets/css/bootstrap.min.css'?>" rel="stylesheet">	            	 -->
</head>

<style>
    table{
        table-layout: fixed;
        width: 100%;
        border:1px solid;
        margin-top:20px;
        border-collapse: collapse;
    }
    thead,tfoot{
        font-family:Verdana, Geneva, Tahoma, sans-serif; 
        font-size: 13px;
        text-align: center;
    }
    tbody{
        font-family:Arial, Helvetica, sans-serif;
        font-size:13px;
    }

</style>
<body>

    <?php 
        $this->load->view('admin/menu');
    ?>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Data
                    <small>Barang</small>
                    <!-- <div class="pull-right"><a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#largeModal"><span class="fa fa-plus"></span> Tambah Barang</a></div> -->
                </h1>
            </div>
        </div>
       
        <div class="mt-5 mb-4">
            <!-- <h4 class="card-title text-center">Data Barang</h4> -->
            <button class="btn btn-sm btn-primary" onclick="add_barang()"><i class="fa fa-plus"></i> Tambah Barang</button>
            <button class="btn btn-sm btn-secondary" onclick="reload_ajax()"><i class="fa fa-refresh"></i> Reload</button>
        </div>

        <table id="barang" class="table table-striped table-bordered">
            <thead>.
                <tr>
                    <th>No.</th>                    
                    <th>Nama Barang</th>
                    <th>Satuan</th>
                    <th>Stok</th>
                    <th>Harga Pokok</th>
                    <th>Hrg Jual Grosir</th>
                    <th>Hrg Jual Grosir Umum</th>
					<th>Hrg Jual Eceran</th>
                    <th>Min Stok</th>
                    <th>Kategori</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
                <tr>
                    <th>No.</th>
                    <th>Nama Barang</th>
                    <th>Satuan</th>
                    <th>Stok</th>
                    <th>Harga Pokok</th>            
                    <th>Hrg Jual Grosir</th>
                    <th>Hrg Jual Grosir Umum</th>
					<th>Hrg Jual Eceran</th>
                    <th>Min Stok</th>
                    <th>Kategori</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Bootstrap modal -->
    <div class="modal fade" id="modal_form" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title">Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body form">
                    <form action="#" id="form">
                        <input type="hidden" value="" name="id"/> 
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label">Nama Barang</label>
                                <input name="barang_nama" class="form-control" type="text">
                                <span class="invalid-feedback"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Satuan</label>
                                <input name="satuan" class="form-control" type="text">
                                <span class="invalid-feedback"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Stok</label>
                                <input name="stok" class="form-control" type="text">
                                <span class="invalid-feedback"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Harga Pokok</label>
                                <input name="harpok" class="form-control" type="text">
                                <span class="invalid-feedback"></span>
                            </div>                     
                            <div class="form-group">
                                <label class="control-label">Hrg Jual Grosir</label>
                                <input name="grosir" class="form-control" type="text">
                                <span class="invalid-feedback"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Hrg Jual Grosir Umum</label>
                                <input name="grosir_umum" class="form-control" type="text">
                                <span class="invalid-feedback"></span>
                            </div>
							<div class="form-group">
                                <label class="control-label">Hrg Jual Eceran</label>
                                <input name="eceran" class="form-control" type="text">
                                <span class="invalid-feedback"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Minimal Stok</label>
                                <input name="minstok" class="form-control" type="text">
                                <span class="invalid-feedback"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Kategori</label>
                                <select name="kategori" class="form-control">
                                    <option value="">-- Pilh --</option>
                                </select>
                                <span class="invalid-feedback"></span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- End Bootstrap modal -->

    <script src="<?=base_url();?>assets/jquery-3.3.1/jquery-3.3.1.min.js"></script>
    <script src="<?=base_url();?>assets/popper/popper.min.js"></script>
    <script src="<?=base_url();?>assets/bootstrap-4/js/bootstrap.min.js"></script>
    <script src="<?=base_url();?>assets/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="<?=base_url();?>assets/DataTables-1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?=base_url();?>assets/sweetalert2/sweetalert2.all.min.js"></script>

    <script type="text/javascript">
    var save_label;
    var table;

    $(document).ready(function() {

        $("[name='harpok'],[name='eceran'],[name='stok'],[name='grosir'],[name='grosir_umum'],[name='minstok']").keyup(function(){							
			oldVal = this.value;
			this.value = addCommas(oldVal);
		})
        
        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
    	{
			return {
				"iStart": oSettings._iDisplayStart,
				"iEnd": oSettings.fnDisplayEnd(),
				"iLength": oSettings._iDisplayLength,
				"iTotal": oSettings.fnRecordsTotal(),
				"iFilteredTotal": oSettings.fnRecordsDisplay(),
				"iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
				"iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
			};
		};        
        
        table = $("#barang").DataTable({
			initComplete: function() {
				var api = this.api();
				$('#barang_filter input')
					.off('.DT')
					.on('keyup.DT', function(e) {
                        api.search(this.value).draw();
                    });
			},
			oLanguage: {
                sProcessing: "loading..."
			},
			processing: true,
			serverSide: true,
			ajax: {
                "url": "<?php echo base_url().'admin/Crud/get_guest_json'?>",
                "type": "POST"
            },            
			columns: [
                {                    
                    "data": "barang_id",
                    "orderable": false,
                    "searchable": false,
                },
				{"data": "barang_nama","autowidth": true},				
                {"data": "barang_satuan","autowidth": true},
                {"data": "barang_stok",render: $.fn.dataTable.render.number( ',', '.', 0, ),"autowidth": true},
                {"data": "barang_harpok",render: $.fn.dataTable.render.number( ',', '.', 0, ),"autowidth": true},            
                {"data": "barang_harjul_grosir",render: $.fn.dataTable.render.number( ',', '.', 0, ),"autowidth": true},
                {"data": "barang_harjul_grosir_umum",render: $.fn.dataTable.render.number( ',', '.', 0, ),"autowidth": true},
				{"data": "barang_harjul",render: $.fn.dataTable.render.number( ',', '.', 0, ),"autowidth": true},
                {"data": "barang_min_stok",render: $.fn.dataTable.render.number( ',', '.', 0, ),"autowidth": true},
				{"data": "kategori_barang","autowidth": true},
				{
                    "data": "view",
                    "orderable": false,
                    "searchable": false,
                    "width": "13%"
                }
			],
			order: [[1, 'asc']],
			rowId: function(a){
                return a;
            },
            rowCallback: function(row, data, iDisplayIndex) {
				var info = this.fnPagingInfo();
				var page = info.iPage;
				var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
				$('td:eq(0)', row).html(index);
			}
		});

        $('#modal_form').on('shown.bs.modal', function (e) {  
            // alert("cek");          
            load_kategori();
        });

        $('#modal_form').on('hidden.bs.modal', function (e) {
            var inputs = $('#form input, #form textarea, #form select');
            inputs.removeClass('is-valid is-invalid');
        });
    });

    function load_kategori(){
        $.ajax({
            url: "<?=base_url('admin/Crud/getKategori')?>",
            method: 'GET',
            dataType: 'JSON',
            success: function(categories){
                console.log(categories);
                var opsi_kategori;
                $('[name="kategori"]').html('');
                $.each(categories, function(key, val){
                    opsi_kategori = `<option value="${val.id_kategori}">${val.kategori_barang}</option>`;
                    $('[name="kategori"]').append(opsi_kategori);
                });
            }
        });
    }

    function reload_ajax(){
        table.ajax.reload(null, false);
    }

    function swalert(method){
        Swal({
            title: 'Success',
            text: 'Data berhasil '+method,
            type: 'success'
        });
    };

    function add_barang()
    {
        save_label = 'add';        
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal_form').modal('show'); // show bootstrap modal
        $('.modal-title').text('Tambah Barang'); // Set Title to Bootstrap modal title
    }

    function edit_barang(id)
    {
        // alert(id);
        save_label = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url : "<?=base_url('admin/Crud/edit/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('[name="id"]').val(data.barang_id);
                $('[name="barang_nama"]').val(data.barang_nama);                
                $('[name="satuan"]').val(data.barang_satuan);
                $('[name="stok"]').val(addCommas(data.barang_stok));
                $('[name="harpok"]').val(addCommas(data.barang_harpok));
                $('[name="eceran"]').val(addCommas(data.barang_harjul));
                $('[name="grosir"]').val(addCommas(data.barang_harjul_grosir));
                $('[name="grosir_umum"]').val(addCommas(data.barang_harjul_grosir_umum));
                $('[name="minstok"]').val(addCommas(data.barang_min_stok));
                $('[name="kategori"]').val(data.barang_kategori_id);
                // console.log($('[name="kategori"]').val());
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Barang'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function save()
    {
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable 
        var url, method;

        if(save_label == 'add') {
            url = "<?=base_url('admin/Crud/add')?>";
            method = 'disimpan';
        } else {
            url = "<?=base_url('admin/Crud/update')?>";
            method = 'diupdate';
        }

        // ajax adding data to database
        $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "json",
            success: function(data)
            {
                // console.log(data);
                if(data.status) //if success close modal and reload ajax table
                {
                    $('#modal_form').modal('hide');
                    reload_ajax();
                    swalert(method);
                }
                else
                {
                    $.each(data.errors, function(key, value){
                        $('[name="'+key+'"]').addClass('is-invalid'); //select parent twice to select div form-group class and add has-error class
                        $('[name="'+key+'"]').next().text(value); //select span help-block class set text error string
                        if(value == ""){
                            $('[name="'+key+'"]').removeClass('is-invalid');
                            $('[name="'+key+'"]').addClass('is-valid');
                        }
                    });
                }
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 
            }
        });

        $('#form input').on('keyup', function(){
            $(this).removeClass('is-valid is-invalid');            
        });
        $('#form select').on('change', function(){
            $(this).removeClass('is-valid is-invalid');
        });
    }

    function addCommas(nStr) {
    	var val = nStr;
        if (val == null || val == "") {
            console.log("cekk");
            return 0;
        }
  		val = val.replace(/[^0-9\.]/g,'');
		if(val != "") {
			valArr = val.split('.');
			valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
			val = valArr.join('.');
		}
  		return val;
	}

    function hapus_barang(id)
    {
        Swal({
            title: 'Anda yakin?',
            text: "Data barang akan dihapus!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus data!'
        }).then((result) => {
            if(result.value) {
                $.ajax({
                    url : "<?=base_url('admin/Crud/delete/')?>/"+id,
                    type: "POST",
                    success: function(data)
                    {
                        reload_ajax();
                        swalert('dihapus');
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error deleting data');
                    }
                });
            }
        });
    }
    </script>
</body>
</html>