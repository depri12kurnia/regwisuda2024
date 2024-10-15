<div class="table-responsive mailbox-messages">
    <table id="data-tables2" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Status</th>
                <th>Entry Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            <?php
            // Looping data user dg foreach
            $i = 1;
            foreach ($wisuda as $wisuda) {
            ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $wisuda->code ?></td>
                    <td>
                        <?php
                        if ($wisuda->status == 'Hadir') { ?>
                            <button class="btn btn-success btn-sm"><i class="fa fa-check-circle"></i> Hadir</button>
                        <?php } else { ?>
                            <button class="btn btn-danger btn-sm"><i class="fa fa-close"></i> Belum</button>
                        <?php } ?>
                    </td>
                    <td><?php echo $wisuda->entry_time ?></td>
                    <td>
                        <div class="btn-group">
                            <?php
                            if ($wisuda->status == 'Hadir') { ?>
                                <button class="btn btn-success btn-sm"><i class="fa fa-check-circle"></i> Sudah</button>
                            <?php } else { ?>
                                <?php echo anchor('presensi/hadir/' . $wisuda->id_undangan . '', ' Hadir', 'class="btn btn-primary btn-sm fa fa-check-circle"'); ?>
                            <?php } ?>

                        </div>
                    </td>
                </tr>
            <?php $i++;
            } //End looping 
            ?>
        </tbody>
    </table>

</div>
<!-- /.mail-box-messages -->