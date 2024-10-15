<?php
// Form buka utk delete multiple
echo form_open(base_url('undangan/proses'));
?>
<input type="hidden" name="pengalihan" value="<?php echo str_replace('index.php/', '', current_url()) ?>">
<!-- <p>
<div class="btn-group">
  <a href="<?php echo base_url('undangan/tambah') ?>" class="btn btn-success btn-md">
    <i class="fa fa-plus"></i> Tambah</a>

  <a href="<?php echo base_url('undangan/import') ?>" class="btn btn-warning btn-md">
    <i class="fa fa-file-excel-o"></i> Import</a>
</div>
</p> -->

<div class="table-responsive mailbox-messages">
  <table id="data-tables2" class="table table-bordered table-striped small">
    <thead>
      <tr>
        <th>#</th>
        <th>Code</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>

      <?php
      // Looping data undangan dg foreach
      $i = 1;
      foreach ($undangan as $undangan) {
      ?>

        <tr>
          <td><?php echo $i ?></td>
          <td><?php echo $undangan->code ?></td>
          <td><?php echo $undangan->status ?></td>
          <td>
            <div class="btn-group">
              <a href="<?php echo base_url('undangan/edit/' . $undangan->code) ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
              <a href="<?php echo base_url('undangan/delete/' . $undangan->code) ?>" class="btn btn-danger btn-sm" onclick="confirmation(event)"><i class="fa fa-trash-o"></i> Hapus</a>
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
<?php
// Form tutup
echo form_close();
?>