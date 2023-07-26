<!DOCTYPE html>
<html lang="en" dir="/">

    <?php $this->load->view('layout/head') ?>

    <body class="text-left">
        <div class="app-admin-wrap layout-sidebar-compact sidebar-dark-purple sidenav-open clearfix">
            <?php $this->load->view('layout/navigation') ?>

            <div class="main-content-wrap d-flex flex-column">
                <?php $this->load->view('layout/header') ?>
                <!-- ============ Body content start ============= -->
                <div class="main-content">
                    <div class="breadcrumb">
                        <ul>
                            <li><a href="#">Referensi</a></li>
                            <li><?= $title ?></li>
                        </ul>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-12 mb-4">
                            <div class="card text-left">
                                <div class="card-body">
                                    <button class="btn btn-info m-1 mb-4 add-button" type="button" data-toggle="modal" data-target="#adding-modal">Tambah</button>

                                    <div class="table-responsive">
                                        <table class="display table table-striped table-bordered" id="zero_configuration_table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <!-- <th>#</th> -->
                                                    <th width="15%">Nama</th>
                                                    <th>NIP</th>
                                                    <th>Unit</th>
                                                    <th>Phone</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                             <tbody>
                                                <?php 
                                                $i = 1 ;
                                                foreach ($list as $key =>$row) { ?>
                                                    <tr>
                                                        <!-- <td><?= $i++ ?></td> -->
                                                        <td><?= ucwords($row->name) ?></td>
                                                        <td align="center"><?= $row->nip ?></td>
                                                        <td align="center"><?= $row->unit ?></td>
                                                        <td align="center"><?= $row->phone ?></td>
                                                        <td align="center">
                                                            <span class="badge badge-pill p-2 m-1 <?= $row->activation == 0 ? 'badge-outline-danger' : 'badge-outline-success' ?>">
                                                                <?= $row->activation == 0 ? 'In Active' : 'Active' ?>
                                                            </span>
                                                        </td>
                                                        <td align="center">
                                                            <button class="btn btn-outline-warning btn-icon edit" type="button" data-id="<?= $row->id; ?>">
                                                                <span class="ul-btn__icon">
                                                                    <i class="i-Pen-3"></i>
                                                                </span>
                                                            </button>   
                                                            <button class="btn btn-outline-danger btn-icon delete" type="button" data-id="<?= $row->id; ?>">
                                                                <span class="ul-btn__icon">
                                                                    <i class="i-Close-Window"></i>
                                                                </span>
                                                            </button>   
                                                            <button class="btn btn-outline-info btn-icon details" type="button" data-id="<?= $row->id; ?>">
                                                                <span class="ul-btn__icon">
                                                                    <i class="i-Eye"></i>
                                                                </span>
                                                            </button>  
                                                            <button class="btn btn-outline-dark btn-icon resets" type="button" data-id="<?= $row->id; ?>">
                                                                <span class="ul-btn__icon">
                                                                    <i class="i-Lock"></i>
                                                                </span>
                                                            </button>                                         
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <!-- <th>#</th> -->
                                                    <th>Nama</th>
                                                    <th>NIP</th>
                                                    <th>Unit</th>
                                                    <th>Phone</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end of col-->
                    </div>
                    <!-- end of main-content -->
                </div><!-- Footer Start -->

                <!--  Modal -->
                <div class="modal fade" id="adding-modal" tabindex="-1" role="dialog" aria-labelledby="adding" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <?php echo form_open_multipart($controller.'/insert'); ?>
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Penambahan Data</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                                <div class="modal-body">                                   
                                    <fieldset>
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input class="form-control" type="text" required name="name">
                                        </div>
                                        <div class="form-group">
                                            <label>NIP</label>
                                            <input class="form-control" type="text" required name="nip">
                                        </div>
                                        <div class="form-group">
                                            <label>Unit Kerja</label>
                                            <select class="form-control" required name="id_unit">
                                                <option>Pilih Unit Kerja</option>
                                                <?php foreach ($unit as $key => $d): ?>
                                                    <option value="<?= $d->id ?>" > <?= $d->name ?> </option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Jabatan</label>
                                            <select class="form-control" required name="id_jabatan">
                                                <option>Pilih Jabatan</option>
                                                <?php foreach ($jabatan as $key => $d): ?>
                                                    <option value="<?= $d->id ?>" > <?= $d->name ?> </option>
                                                <?php endforeach ?>
                                                <option value="0">Lainnya</option>
                                            </select>
                                        </div>                                        
                                        <div class="form-group">
                                            <label>No. Whatsapp</label>
                                            <input class="form-control" type="text" required name="phone">
                                        </div>
                                    </fieldset>                                    
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                    <button class="btn btn-primary ml-2" type="submit">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="modal fade" id="updating-modal" tabindex="-1" role="dialog" aria-labelledby="updating" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <?php echo form_open_multipart($controller.'/update'); ?>
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Perbaharuan Data</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                                <div class="modal-body">
                                    <fieldset>
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input class="form-control" type="text" required name="name" id="name">
                                        </div>
                                        <div class="form-group">
                                            <label>NIP</label>
                                            <input class="form-control" type="text" required name="nip" id="nip">
                                        </div>
                                        <div class="form-group">
                                            <label>Unit Kerja</label>
                                            <select class="form-control" required name="id_unit" id="id_unit">
                                                <option>Pilih Unit Kerja</option>
                                                <?php foreach ($unit as $key => $d): ?>
                                                    <option value="<?= $d->id ?>" > <?= $d->name ?> </option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Jabatan</label>
                                            <select class="form-control" required name="id_jabatan" id="id_jabatan">
                                                <option>Pilih Jabatan</option>
                                                <?php foreach ($jabatan as $key => $d): ?>
                                                    <option value="<?= $d->id ?>" > <?= $d->name ?> </option>
                                                <?php endforeach ?>
                                                <option value="0">Lainnya</option>
                                            </select>
                                        </div>                                        
                                        <div class="form-group">
                                            <label>No. Whatsapp</label>
                                            <input class="form-control" type="text" required name="phone" id="phone">
                                        </div>
                                    </fieldset>                                      
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="id" id="id">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                    <button class="btn btn-primary ml-2" type="submit">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="modal fade" id="details-modal" tabindex="-1" role="dialog" aria-labelledby="details" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Detail Data</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body">
                                <fieldset>
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input class="form-control" type="text" required id="dname" disabled="true">
                                    </div>
                                    <div class="form-group">
                                        <label>NIP</label>
                                        <input class="form-control" type="text" required id="dnip" disabled="true">
                                    </div>
                                    <div class="form-group">
                                        <label>Unit Kerja</label>
                                        <select class="form-control" required id="did_unit" disabled="true">
                                            <option>Pilih Unit Kerja</option>
                                            <?php foreach ($unit as $key => $d): ?>
                                                <option value="<?= $d->id ?>" > <?= $d->name ?> </option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Jabatan</label>
                                        <select class="form-control" required id="did_jabatan" disabled="true">
                                            <option>Pilih Jabatan</option>
                                            <?php foreach ($jabatan as $key => $d): ?>
                                                <option value="<?= $d->id ?>" > <?= $d->name ?> </option>
                                            <?php endforeach ?>
                                            <option value="0">Lainnya</option>
                                        </select>
                                    </div>                                        
                                    <div class="form-group">
                                        <label>No. Whatsapp</label>
                                        <input class="form-control" type="text" required id="dphone" disabled="true">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control" type="text" required id="demail" disabled="true">
                                    </div>
                                     <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control" required id="dactivation" disabled="true">
                                            <option value="1">Active</option>
                                            <option value="0">In Active</option>
                                        </select>
                                    </div>
                                </fieldset>                                      
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  Modal -->
                <?php $this->load->view('layout/footer') ?>
            </div>            
        </div>
    </body>

    <?php $this->load->view('layout/custom') ?>
    <script src="<?= base_url().'dist-assets/'?>js/plugins/datatables.min.js"></script>
    <script src="<?= base_url().'dist-assets/'?>js/scripts/datatables.script.min.js"></script>
    <script type="text/javascript">
        var url = "<?= base_url().$controller ?>";

        $('.edit').click(function(){
            $.ajax({
                url: url + '/edit/' + $(this).data('id'),
                type:'GET',
                dataType: 'json',
                success: function(data){
                    
                    $("#id").val(data['list_edit']['id']);  
                    $("#name").val(data['list_edit']['name']);  
                    $("#id_unit").val(data['list_edit']['id_unit']);                                    
                    $("#id_jabatan").val(data['list_edit']['id_jabatan']);                                    
                    $("#nip").val(data['list_edit']['nip']);  
                    $("#phone").val(data['list_edit']['phone']);  
                    $("#updating-modal").modal('show');
                }                
            }); 
        })

        $('.details').click(function(){
            $.ajax({
                url: url + '/edit/' + $(this).data('id'),
                type:'GET',
                dataType: 'json',
                success: function(data){
                    
                    $("#dname").val(data['list_edit']['name']);  
                    $("#did_unit").val(data['list_edit']['id_unit']);                                    
                    $("#did_jabatan").val(data['list_edit']['id_jabatan']);                                    
                    $("#dnip").val(data['list_edit']['nip']);  
                    $("#dphone").val(data['list_edit']['phone']);  
                    $("#demail").val(data['list_edit']['email']);  
                    $("#dactivation").val(data['list_edit']['activation']);  
                    $("#details-modal").modal('show');
                }                
            }); 
        })

        $('.delete').click(function () {
            var id = $(this).data('id') ;
            swal({
                title: 'Apakah yakin data ini ingin di hapus? ',
                showCancelButton: true,
                confirmButtonColor: '#4caf50',
                cancelButtonColor: '#f44336',
                confirmButtonText: 'Ya, Lanjutkan hapus!',
                cancelButtonText: 'Batal',
            }).then(function () {
                window.location = url + '/delete/' + id ;
            })
        });

        $('.resets').click(function () {
            var id = $(this).data('id') ;
            swal({
                title: 'Apakah yakin reset password ?',
                icon: 'swal2-icon-warning',
                confirmButtonColor: '#4caf50',
                cancelButtonColor: '#f44336',
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: 'Ya, Lanjutkan reset!',
                cancelButtonText: 'Batal',
                html:
                'Reset akan mengubah password pengguna menjadi bentuk default password',
            }).then(function (e) {
                console.log(e);
                if(e) {
                    $.ajax({
                        url: url + '/resets/',
                        type:'POST',
                        dataType: 'json',
                        data: {"id" : id}, 
                        success: function(data){
                            swal({
                                title: 'Berhasil',
                                text : 'Berhasil Mereset Password',
                                type : 'success',
                                confirmButtonColor: '#4fa7f3'
                            });
                        }                
                    }); 
                }
            });
        });
    </script>
</html>