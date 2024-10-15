<?php
// Form buka utk delete multiple
echo form_open(base_url('barcode/proses'));
?>
<input type="hidden" name="pengalihan" value="<?php echo str_replace('index.php/', '', current_url()) ?>">
<p>
<div class="btn-group">
  <button class="btn btn-info btn-md" name="generate" type="submit">
    <i class="fa fa-barcode"></i> Generate
  </button>
  <!-- <button class="btn btn-default btn-md" name="print" type="submit">
    <i class="fa fa-print"></i> Print
  </button>
  <button class="btn btn-primary btn-md" name="kirim" type="submit">
    <i class="fa fa-send"></i> Kirim
  </button> -->
</div>
</p>
<p>
<div class="btn-group">
  <a href="<?php echo site_url('barcode/download_folder'); ?>" target="_blank" class="btn btn-success btn-md"><i class="fa fa-download"></i> Download Barcode</a>
</div>
</p>
<!-- UNTUK MENGOSONGKAN FILE BARCODE DAN TABEL WISUDA DAN UNDANGAN -->
<p>
<div class="btn-group">
  <a href="<?php echo site_url('barcode/empty_folder'); ?>" class="btn btn-danger btn-md" onclick="confirmation(event)"><i class="fa fa-trash"></i> Kosongkan Folder Barcode, Tabel Wisuda & Undangan</a>
</div>
</p>

<div class="table-responsive mailbox-messages">
  <table id="data-barcode" class="table table-bordered table-striped small">
    <thead>
      <tr>
        <th class="text-center" width="5%">
          <!-- Check all button -->
          <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
          </button>
        </th>
        <th>#</th>
        <th>Code</th>
        <th>Barcode</th>
        <th>Status Send</th>
      </tr>
    </thead>
    <tbody>

      <?php
      // Looping data undangan dg foreach
      $i = 1;
      foreach ($undangan as $undangan) {
      ?>

        <tr>
          <td class="text-center">
            <input type="checkbox" name="code[]" value="<?php echo $undangan->code ?>">
          </td>
          <td><?php echo $i ?></td>
          <td><?php echo $undangan->code ?></td>
          <td><?php echo $undangan->barcode ?></td>
          <td><?php echo $undangan->status_send ?></td>
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