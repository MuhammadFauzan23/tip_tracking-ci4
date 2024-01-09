<?= $this->extend('layout/template') ?>
<?= $this->extend('layout/sidebar') ?>
<?= $this->section('footer') ?>

<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
        Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
</footer>

<!-- REQUIRED SCRIPTS -->

<!-- SweetAlert2 -->
<script src="<?= base_url('template') ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('template') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('template') ?>/dist/js/adminlte.min.js"></script>

<?= $this->endSection(); ?>