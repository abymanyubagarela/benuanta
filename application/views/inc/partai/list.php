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
                            <a href="<?= base_url().'partai/create'; ?>" class="btn btn-added">
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
                                    <th>Nama</th>
                                    <th align="center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $i = 1 ;
                                    foreach ($list as $key =>$row) { ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= ucwords($row->name) ?></td>
                                            <td>
                                                <button class="btn btn-outline-warning btn-icon edit" type="button" data-id="<?= $row->id; ?>">
                                                    <span class="ul-btn__icon">
                                                        <i class="i-Pen-3">Edit</i>
                                                    </span>
                                                </button>   
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

            $('.edit').click(function(){
                window.location.href = alias + '/edit/' + $(this).data('id');
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
                }).then(function () {
                    window.location = url + '/delete/' + id ;
                })
            });
        </script>
    </body>
    
</html>