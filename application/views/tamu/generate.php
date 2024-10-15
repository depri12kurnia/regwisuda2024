<?php
// Form buka utk delete multiple
echo form_open(base_url('generate_tamu/proses'));
?>
<input type="hidden" name="pengalihan" value="<?php echo str_replace('index.php/', '', current_url()) ?>">
<p>
<div class="btn-group">
  <button class="btn btn-info btn-md" name="generate" type="submit">
    <i class="fa fa-barcode"></i> Generate
  </button>
</div>
</p>
<p>
<div class="btn-group">
  <a href="<?php echo site_url('generate_tamu/download_folder'); ?>" target="_blank" class="btn btn-success btn-md"><i class="fa fa-download"></i> Download Barcode</a>
</div>
</p>
<!-- UNTUK MENGOSONGKAN FILE BARCODE TAMU -->
<p>
<div class="btn-group">
  <a href="<?php echo site_url('generate_tamu/empty_folder'); ?>" class="btn btn-danger btn-md" onclick="confirmation(event)"><i class="fa fa-trash"></i> Kosongkan Folder Barcode & Tabel Tamu</a>
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
        
      </tr>
    </thead>
    <tbody>

      <?php
      // Looping data undangan dg foreach
      $i = 1;
      foreach ($tamu as $tamu) {
      ?>

        <tr>
          <td class="text-center">
            <input type="checkbox" name="code[]" value="<?php echo $tamu->code ?>">
          </td>
          <td><?php echo $i ?></td>
          <td><?php echo $tamu->code ?></td>
          <td><?php echo $tamu->barcode ?></td>
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