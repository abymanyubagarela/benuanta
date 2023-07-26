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
                            <h6>Procedd <?= $title ?></h6>
                        </div>
                        <div class="page-btn">
                            <button class="btn btn-added" id="process-button">
                            Simpan
                            </button>
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
                                            <td><input type="text" name="toko" class="form-control" value="<?= ucwords($row['tokok']) ?>"></td>
                                            <td><input type="number" name="total" class="form-control" value="<?= ucwords($row['total']) ?>"></td>
                                            <td>
                                                <select class="form-select" name="isPKP">
                                                    <option value="0" <?= $row['ispkp'] == 0 ? 'selected':'' ?> >Non PKP</option>
                                                    <option value="1" <?= $row['ispkp'] == 1 ? 'selected':'' ?> >PKP</option>
                                                </select>
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

        <script>
        $(document).ready(function() {
            // Function to get input values from each row and process them
            function processTableRows() {
                var data = []; // Array to store the data from each row

                // Loop through each table row
                $('table tbody tr').each(function() {
                    var rowData = {}; // Object to store data for each row

                    // Get the input values from the current row
                    var namaToko = $(this).find('input[name="toko"]').val();
                    var total = $(this).find('input[name="total"]').val();
                    var isPKP = $(this).find('select[name="isPKP"]').val();

                    // Populate the rowData object with the data from the current row
                    rowData.namaToko = namaToko;
                    rowData.total = total;
                    rowData.isPKP = isPKP;

                    // Add the rowData object to the data array
                    data.push(rowData);
                });

                // Now the 'data' array contains all the data from each row
                console.log(data); // You can use 'data' as needed (e.g., send it to the server using Ajax)


                 $.ajax({
                    url: "<?php echo site_url('cproses/insert_data'); ?>",
                    type: "POST",
                    data: { data: data, id_trx: <?= $list_edit->id ?> },
                    dataType: "json",
                    success: function(response) {
                        // Handle the response from the server (e.g., show a success message)
                        console.log(response);
                        alert('Berhasil Update');
                    },
                    error: function(xhr, status, error) {
                        // Handle error response if necessary
                        console.error(error);
                    },
                    complete: function() {
                        // Code to execute after the Ajax request (regardless of success or error)
                        // For example, you can redirect here
                        window.location.href = "<?php echo site_url('proses'); ?>";
                    }
                });
            }

            // Call the processTableRows() function when the button is clicked
            $('#process-button').on('click', function() {
                processTableRows();
            });
        });
        </script>
    </body>
</html>