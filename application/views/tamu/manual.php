<?php
// Form buka utk delete multiple
echo form_open(base_url('tamu/proses'));
?>
<input type="hidden" name="pengalihan" value="<?php echo str_replace('index.php/', '', current_url()) ?>">

<div class="table-responsive mailbox-messages">
  <table id="data-tables2" class="table table-bordered table-striped small">
    <thead>
      <tr>
        <th>#</th>
        <th>Code</th>
        <th>Asal</th>
        <th>Jam Hadir</th>
        <th>Status</th>
        <th>Jumlah</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Looping data tamu dg foreach
      $i = 1;
      foreach ($tamu as $tamu) {
      ?>
        <tr>
          <td><?php echo $i ?></td>
          <td><?php echo $tamu->code ?></td>
          <td><?php echo $tamu->asal_tamu ?></td>
          <td><?php echo $tamu->entry_time ?></td>
          <td><?php echo $tamu->status ?></td>
          <td><?php echo $tamu->jumlah ?></td>
          <td>
            <div class="btn-group">
              <a href="<?php echo base_url('tamu/hadir/' . $tamu->id_tamu) ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Hadir</a>
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