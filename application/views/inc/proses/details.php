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
                            <h4><?= $title ?></h4>
                            <h6>Detail <?= $title ?></h6>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table class="table dataTable no-footer table-responsive">
                            <thead>
                                <tr role="row" >
                                    <th>No</th>
                                    <th>Nama Toko</th>
                                    <th>Total</th>
                                    <th>isPKP</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $i = 1 ;
                                    foreach ($list as $key =>$row) { ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= ucwords($row->tokok) ?></td>
                                            <td><?= number_format($row->total) ?></td>
                                            
                                            <td><?= $row->ispkp > 0 ? '<span class="badges bg-lightgreen">PKP</span>' : '<span class="badges bg-lightred">Non PKP</span>' ?></td>
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

       
    </body>
</html>