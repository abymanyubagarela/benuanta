<script src="https://dreamspos.dreamguystech.com/html/template/assets/js/jquery-3.6.0.min.js"></script>
<script src="https://dreamspos.dreamguystech.com/html/template/assets/js/feather.min.js"></script>
<script src="https://dreamspos.dreamguystech.com/html/template/assets/js/jquery.slimscroll.min.js"></script>
<script src="https://dreamspos.dreamguystech.com/html/template/assets/js/jquery.dataTables.min.js"></script>
<script src="https://dreamspos.dreamguystech.com/html/template/assets/js/dataTables.bootstrap4.min.js"></script>
<script src="https://dreamspos.dreamguystech.com/html/template/assets/js/bootstrap.bundle.min.js"></script>
<script src="https://dreamspos.dreamguystech.com/html/template/assets/plugins/select2/js/select2.min.js"></script>
<script src="https://dreamspos.dreamguystech.com/html/template/assets/js/moment.min.js"></script>
<script src="https://dreamspos.dreamguystech.com/html/template/assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://dreamspos.dreamguystech.com/html/template/assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
<script src="https://dreamspos.dreamguystech.com/html/template/assets/plugins/sweetalert/sweetalerts.min.js"></script>
<script src="https://dreamspos.dreamguystech.com/html/template/assets/js/script.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.all.min.js"></script>

<script type="text/javascript">
    <?php if ($this->session->flashdata('success')): ?>
        Swal.fire({
            title: 'Berhasil',
            text : '<?=$_SESSION["success"] ?>',
            type : 'success',
            confirmButtonColor: '#4fa7f3'
        });
    <?php endif; ?>

    <?php if ($this->session->flashdata('failed')): ?>
        Swal.fire({
            title: 'Failed',
            text : '<?=$_SESSION["failed"] ?>',
            type : 'error',
            confirmButtonColor: '#d57171'
        });
    <?php endif; ?>
</script>

