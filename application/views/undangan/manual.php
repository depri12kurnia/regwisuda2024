<?php
// Notifikasi error
// echo validation_errors('<p class="alert alert-warning">', '</p>');

// Form open
echo form_open(base_url('undangan/tambah'));
?>
<div class="row">
    <div class="col-md-12">
        <?php if ($this->session->flashdata('message')) {
            echo $this->session->flashdata('message');
        }
        ?>
        <?php if ($this->session->flashdata('error')) {
            echo $this->session->flashdata('error');
        } ?>
        <?php if (validation_errors()) { ?>
            <div class="alert alert-danger">
                <?php echo validation_errors(); ?>
            </div>
        <?php
        } ?>
        <label>Contoh Entry Manual = P37320120001 <span class="text-danger"></span></label>
    </div>
    <div class="col-md-2">
        <label>Tambah Code Manual <span class="text-danger">: </span></label>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <!-- <select class="form-control form-control-md" id='selWisuda' name="code" style="width: 100%;">
            </select>
            </br>
            <select class="form-control form-control-md select2" style="width: 100%;">
                <option value='0'>-- Select user --</option>
                <option value='0'>1</option>
                <option value='0'>2</option>
                <option value='0'>3</option>
            </select> -->

            <input type="text" name="code" class="form-control form-control-md" value="<?php echo set_value('code') ?>" autocomplete="off" autofocus>
        </div>
    </div>
    <div class="col-md-4">
        <button class="btn btn-success btn-md" name="submit" type="submit">
            <i class="fa fa-save"></i> Tambah
        </button>
    </div>
</div>
<!-- Script -->
<!-- <script type="text/javascript">
    $(document).ready(function() {
        $("#selWisuda").select2({
            theme: 'bootstrap4',
            // minimumInputLength: 1,
            placeholder: 'Input Code Barcode',
            ajax: {
                url: '<?php echo base_url() ?>index.php/undangan/getWisuda',
                type: "POST",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        searchTerm: params.term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
    });
</script> -->
<?php
// Form close
echo form_close();
?>
<div class="table-responsive mailbox-messages">
    <table id="data-tables2" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Status</th>
                <th>Entry Time</th>
                <th>Prodi</th>
                <th>Pendamping</th>
            </tr>
        </thead>
        <tbody>

            <?php
            // Looping data user dg foreach
            $i = 1;
            foreach ($undangan as $dt) {
            ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $dt->code ?></td>
                    <td><?php echo $dt->status ?></td>
                    <td><?php echo $dt->entry_time ?></td>
                    <td><?php echo $dt->prodi ?></td>
                    <td><?php echo $dt->pendamping ?></td>

                </tr>
            <?php $i++;
            } //End looping 
            ?>
        </tbody>
    </table>

</div>
<!-- /.mail-box-messages -->