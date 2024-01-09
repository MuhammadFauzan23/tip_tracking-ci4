<?= $this->extend('layout/template') ?>
<?= $this->extend('layout/sidebar') ?>
<?= $this->section('content') ?>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-header">
                        <p>Edit Tip Tracking</p>
                    </div>
                    <div class="card-body">
                        <?php
                        foreach ($data_list as $list) :
                        ?>
                            <form action="<?= base_url('Tip/editListTip') ?>" method="Post">
                                <?= csrf_field() ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- ID Tip -->
                                        <input type="text" class="form-control" name="id" id="" value="<?= $list['id'] ?>" hidden>
                                        <!--  -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Start Time</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="time" id="" value="<?= $list['start_time'] ?>" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">End Time</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="time" id="" value="<?= $list['end_time'] ?>" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Trip</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="trip" id="" value="<?= $list['trip'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Value</label>
                                            <div class="input-group">
                                                <select class="form-control select2" style="width: 100%;" name="value" id="">
                                                    <?php foreach ($data_value as $value) : ?>
                                                        <?php if ($value['value_tip'] == $list['value_tip']) { ?>
                                                            <option value="<?= $value['value_tip'] ?>" selected>Rp.<?= $value['value_tip'] ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?= $value['value_tip'] ?>">Rp.<?= $value['value_tip'] ?></option>
                                                        <?php } ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Driver</label>
                                                    <div class="input-group">
                                                        <select class="form-control select2" style="width: 100%;" name="driver" id="">
                                                            <?php foreach ($data_driver as $driver) : ?>
                                                                <?php if ($driver['name_driver'] == $list['driver']) { ?>
                                                                    <option value="<?= $driver['name_driver'] ?>" selected><?= $driver['name_driver'] ?></option>
                                                                <?php } else { ?>
                                                                    <option value="<?= $driver['name_driver'] ?>"><?= $driver['name_driver'] ?></option>
                                                                <?php } ?>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">BP Lorry</label>
                                                    <div class="input-group">
                                                        <select class="form-control select2" style="width: 100%;" name="lorry" id="">
                                                            <?php foreach ($data_lorry as $lorry) : ?>
                                                                <?php if ($lorry['plat_lorry'] == $list['lorry']) { ?>
                                                                    <option value="<?= $lorry['plat_lorry'] ?>" selected><?= $lorry['plat_lorry'] ?></option>
                                                                <?php } else { ?>
                                                                    <option value="<?= $lorry['plat_lorry'] ?>"><?= $lorry['plat_lorry'] ?></option>
                                                                <?php } ?>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">DO No</label>
                                            <div class="input-group">
                                                <select class="form-control select2 Dono" style="width: 100%;" name="Dono[]" id="Dono_id" multiple="multiple">
                                                    <option value="">-- Select DO No --</option>
                                                    <?php foreach ($data_dono_edit as $dono) : ?>
                                                        <?php if ($dono['dono'] == $list['dono']) { ?>
                                                            <option value="<?= $dono['dono'] ?>" selected><?= $dono['dono'] ?> |---| <?= $dono['customername'] ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?= $dono['dono'] ?>"><?= $dono['dono'] ?> |---| <?= $dono['customername'] ?></option>
                                                        <?php } ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Remark</label>
                                            <div class="input-group">
                                                <textarea name="remarks" id="" class="form-control" cols="12" rows="5"><?= $list['remarks'] ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        <?php
                        endforeach;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    //javascript switch alert
    <?php $pesan = session()->getFlashdata('pesan') ?>
    $(function() {
        <?php if ($pesan) { ?>
            <?php if ($pesan['stts'] != true) { ?>
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Terjadi Kesalahan Proses!',
                    text: '<?= $pesan['msg'] ?>',
                    timer: 2500
                })
            <?php } else { ?>
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Proses OK!',
                    text: '<?= $pesan['msg'] ?>',
                    timer: 2500
                })
        <?php }
        } ?>
    });
    //.........................................................................................................

    //JAVASCRIPT DATATABLE
    $(function() {
        $('.tableView').DataTable({
            stateSave: true,
            "searching": true,
            "ordering": false,
            "scrollX": true,
            fixedColumns: {
                left: 4,
                right: 1
            },
            lengthMenu: [
                [-1],
                ["All"]
            ],
        });
    });
    //----------------------------------------------------------------------------------------------------------


    //JAVASCRIPT MULTIPLE SELECT PADA DO
    $(document).ready(function() {
        $("#Dono_id").select2({
            placeholder: "-- Select DO No --"
        });

    });
    //----------------------------------------------------------------------------------------------------------
</script>
<?= $this->endSection() ?>