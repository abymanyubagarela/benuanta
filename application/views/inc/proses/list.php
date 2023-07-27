<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->load->view('layout-b/head') ?>
    </head>
    <body>
        <div id="global-loader">
            <div class="whirly-loader"> </div>
        </div>
        <div class="main-wrapper">
            <?php $this->load->view('layout-b/header') ?>
            <?php $this->load->view('layout-b/navigation') ?>
           
            <div class="page-wrapper">
                <div class="content">
                    <div class="page-header">
                        <div class="page-title">
                            <h4><?= $title ?> List</h4>
                            <h6>Manage <?= $title ?></h6>
                        </div>
                        <div class="page-btn">
                            <a href="<?= base_url().'proses/create'; ?>" class="btn btn-added">
                                <img src="https://dreamspos.dreamguystech.com/html/template/assets/img/icons/plus.svg" alt="img" class="me-2">Add <?= $title ?>
                            </a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table class="table dataTable no-footer table-responsive">
                            <thead>
                                <tr role="row" >
                                    <th>No</th>
                                    <th>Partai</th>
                                    <th>Kategori</th>
                                    <th>Total</th>
                                    <th>Bukti</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $i = 1 ;
                                    foreach ($list as $key =>$row) { ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= ucwords($row->partai) ?></td>
                                            <td><?= ucwords($row->kategori) ?></td>
                                            <td><?= number_format($row->total) ?></td>
                                            <td><?= number_format($row->kwi_tot) ?></td>
                                            <td><?= $row->total == $row->kwi_tot ? '<span class="badges bg-lightgreen">Sesuai</span>' : '<span class="badges bg-lightred">Tidak Sesuai</span>' ?></td>
                                            <td>
                                                <?php if ($row->is_proceed > 0): ?>
                                                    <button class="btn btn-outline-warning btn-icon details" type="button" data-id="<?= $row->id; ?>">
                                                        <span class="ul-btn__icon">
                                                            <i class="i-Pen-3">Detail</i>
                                                        </span>
                                                    </button>       
                                                <?php else: ?>
                                                    <button class="btn btn-outline-info btn-icon process" type="button" data-id="<?= $row->id; ?>">
                                                        <span class="ul-btn__icon">
                                                            <i class="i-Pen-3">Proceed</i>
                                                        </span>
                                                    </button>       
                                                <?php endif ?>
                                                
                                                <button class="btn btn-outline-danger btn-icon delete" type="button" data-id="<?= $row->id; ?>">
                                                    <span class="ul-btn__icon">
                                                        <i class="i-Close-Window">Del</i>
                                                    </span>
                                                </button>                                         
                                            </td>
                                        </tr>
                                    <?php } ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php $this->load->view('layout-b/footer') ?>

        <script type="text/javascript">
            var url = "<?= base_url().$controller ?>";
            var alias = "<?= base_url().$redirect ?>";

            $('.process').click(function(){
				var idforproses = $(this).data('id');
				var time =  Math.floor((Math.random() * 4000)+4000) 

				$('#global-loader').show();
				const myTimeout = setTimeout(loaders, time);

				function loaders() {
					$('#global-loader').hide();
					window.location.href = alias + '/procedd/' + idforproses;
				}
              
            })

			
            $('.details').click(function(){
                window.location.href = alias + '/details/' + $(this).data('id');
            })

            $('.delete').click(function () {
                var id = $(this).data('id') ;
                Swal.fire({
                    title: 'Apakah yakin data ini ingin di hapus? ',
                    showCancelButton: true,
                    confirmButtonColor: '#4caf50',
                    cancelButtonColor: '#f44336',
                    confirmButtonText: 'Ya, Lanjutkan hapus!',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                  if (result.isConfirmed) {
                    window.location = url + '/delete/' + id ;
                  }
                })
            });
        </script>
    </body>
    
</html>
