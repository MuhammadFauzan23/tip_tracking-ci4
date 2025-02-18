<?= $this->extend('layout/tamplate') ?>
<?= $this->extend('layout/sidebar') ?>
<?= $this->section('content') ?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">


        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <style>
                        .data-user {
                            display: flex;
                            justify-content: center;
                            flex-direction: row;
                        }
                    </style>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row data-user">

                            <div class="col-md-4">
                                <!-- Profile Image -->
                                <div class="card card-primary card-outline">
                                    <div class="card-body box-profile">
                                        <h3 class="profile-username text-center"><?= session()->get('username') ?></h3>

                                        <p class="text-muted text-center"> Full Name : <?= session()->get('fullname') ?></p>
                                        <p class="text-muted text-center" id="position"> Position: <?= session()->get('position') ?></p>


                                        <ul class="list-group list-group-unbordered mb-3">
                                            <li class="list-group-item">
                                                <b> Dibuat</b> <a class="float-right" id="tgl-buat"> <?= session()->get('fullname') ?></a>
                                            </li>
                                            <li class="list-group-item">
                                                <b> NIK :</b> <a class="float-right" id="nik"> <?= session()->get('nik') ?></a>
                                            </li>
                                            <li class="list-group-item">
                                                <b> Privilege :</b>
                                                <a class="float-right" id="privilege">
                                                    <?php
                                                    $privilege = 7;
                                                    if (session()->get('privilege') == 7) {
                                                        echo "Store";
                                                    } elseif (session()->get('privilege') == 4) {
                                                        echo "CS";
                                                    } else {
                                                        echo "Engineering";
                                                    }
                                                    ?>
                                                </a>
                                            </li>


                                        </ul>

                                        <a href="<?= base_url('user/edit_profile') ?>" class="btn btn-info btn-block" data-toggle="modal" data-target="#exampleModal"><b>Edit Profile</b></a>
                                        <a href="<?= base_url('user/edit_profile') ?>" class="btn btn-warning btn-block" data-toggle="modal" data-target="#exampleModal2"><b>Edit Password</b></a>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>

                        </div>
                    </div>
                    <!-- ./card-body -->

                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->



    </div>
    <!--/. container-fluid -->
</section>
<!-- /.content -->
<!-- modal edit Profile start-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form class="m-2 p-2 was-validated" action="<?= base_url() ?>/user/edit_user?stts=userUpdate" method="POST">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Edit Profile</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="username" class="col-sm-2 col-form-label">Username :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control " id="username" name="username" value="<?= session()->get('username') ?>" required>
                            <div class="invalid-feedback">
                                Username kosong...
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="fullname" class="col-sm-2 col-form-label">Fullname :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control " id="fullname" name="fullname" value="<?= session()->get('fullname') ?>" required>
                            <div class="invalid-feedback">
                                data url kosong...
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- skill modal end -->

<!-- modal edit password start-->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form class="m-2 p-2 was-validated" action="<?= base_url() ?>/user/edit_user?stts=userPass" method="POST">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Edit Profile</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="old_pass" class="form-label">Password lama:</label>
                        <div class="col">
                            <input type="text" class="form-control" id="old_pass" name="old_pass" required>
                            <div class="invalid-feedback">
                                Silahkan masukkan password lama...
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="new_pass" class="form-label">Password baru:</label>
                        <div class="col">
                            <input type="text" class="form-control" id="new_pass" name="new_pass" required>
                            <div class="invalid-feedback">
                                Silahkan masukkan password baru...
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $.ajax({
            type: "post",
            url: "<?= base_url('user/user') ?>",
            data: {
                'nik': "<?= session()->get('nik') ?>"
                'fullname': "<?= session()->get('fullname') ?>"
                'username': "<?= session()->get('username') ?>"
                'privilege': "<?= session()->get('privilege') ?>"
            },
            dataType: "json",
            success: function(response) {
                $('#tgl-buat').text(response.created_date)
                $('#nik').text(response.nik)
                $('#posisi').text("posisi : " + response.positiondesc)
                $('#privilege').text(response.privilege_name)
            }
        });
    });
</script>
<?= $this->endSection(); ?>