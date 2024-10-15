<div class="table-responsive">
    <table id="data-scanner" class="table table-striped">
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
            foreach ($scanner as $scanner) {
            ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $scanner->code ?></td>
                    <td>
                        <?php
                        if ($scanner->status == 'Hadir') { ?>
                            <button class="btn btn-success btn-sm"><i class="fa fa-check-circle"></i> Hadir</button>
                        <?php } else { ?>
                            <button class="btn btn-danger btn-sm"><i class="fa fa-close"></i> Belum</button>
                        <?php } ?>
                    </td>
                    <td><?php echo $scanner->entry_time ?></td>
                    <td>
                        <div class="btn-group">
                            <?php
                            if ($scanner->status == 'Hadir') { ?>
                                <button class="btn btn-success btn-sm"><i class="fa fa-check-circle"></i> Sudah</button>
                            <?php } else { ?>
                                <?php echo anchor('presensi/hadir/' . $scanner->id_undangan . '', ' Hadir', 'class="btn btn-primary btn-sm fa fa-check-circle"'); ?>
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