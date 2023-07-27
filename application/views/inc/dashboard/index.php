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
                           
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
							<div class="row">
								<div class="col-md-4">
								<div id="chart"> </div>
								</div>
								<div class="col-md-8">
								<div id="chartBar"> </div>
								</div>
							</div>

						  
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php $this->load->view('layout-b/footer') ?>
		<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script type="text/javascript">
		

		// array sum 
		function sumArray(array) {
		return array.reduce(function (accumulator, currentValue) {
			return accumulator + currentValue;
		}, 0);
}

		var dataBar = JSON.parse(<?php echo json_encode($barChart); ?>)

		var groupedData = {
		sesuai: [],
		tidak_sesuai: []
		};

		// Mengelompokkan data berdasarkan key 'sesuai' dan 'tidak_sesuai'
		dataBar.forEach(function(item) {
		groupedData.sesuai.push(item.sesuai);
		groupedData.tidak_sesuai.push(item.tidak_sesuai);
		});
		
		var sesuaiPie = sumArray(groupedData.sesuai);
		var tidaksesuaiPie = sumArray(groupedData.tidak_sesuai);

		dataBar.sort(function(a, b) {
			return a.name_partai.localeCompare(b.name_partai);
		});

		var categoriesBar = dataBar.map(function(item) {
			return item.name_partai;
		});
	
        var options = {
          series: [sesuaiPie, tidaksesuaiPie],
          chart: {
          width: 480,
          type: 'pie',
        },
        labels: ['Sesuai', 'Tidak Sesuai'],
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();


		// BARCHART 

		
		
		
		var optionsBar = {
          series: [{
          name: 'Sesuai',
          data: groupedData.sesuai
        }, {
          name: 'Tidak Sesuai',
          data: groupedData.tidak_sesuai
        }],
          chart: {
          type: 'bar',
          height: 350,
          stacked: true,
          toolbar: {
            show: true
          },
          zoom: {
            enabled: true
          }
        },
        responsive: [{
          breakpoint: 480,
          options: {
            legend: {
              position: 'bottom',
              offsetX: -10,
              offsetY: 0
            }
          }
        }],
        plotOptions: {
          bar: {
            horizontal: false,
            borderRadius: 10,
            dataLabels: {
              total: {
                enabled: true,
                style: {
                  fontSize: '13px',
                  fontWeight: 900
                }
              }
            }
          },
        },
        xaxis: {
          type: 'text',
          categories: categoriesBar
          
        },
        legend: {
          position: 'right',
          offsetY: 40
        },
        fill: {
          opacity: 1
        }
        };

        var chartBar = new ApexCharts(document.querySelector("#chartBar"), optionsBar);
        chartBar.render();


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
