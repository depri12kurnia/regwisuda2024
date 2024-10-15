<?php
// Form buka utk delete multiple
echo form_open(base_url('wisuda/proses'));
?>
<input type="hidden" name="pengalihan" value="<?php echo str_replace('index.php/', '', current_url()) ?>">

<div class="table-responsive mailbox-messages">
  <table id="data-tables2" class="table table-bordered table-striped small">
    <thead>
      <tr>
        <th>#</th>
        <th>Code</th>
        <th>Prodi</th>
        <th>NIM</th>
        <th>Nama</th>
        <th>TTL</th>
        <th>NIK</th>
        <th>Telepon</th>
        <th>Email</th>

      </tr>
    </thead>
    <tbody>

      <?php
      // Looping data wisuda dg foreach
      $i = 1;
      foreach ($wisuda as $wisuda) {
      ?>

        <tr>
          <td><?php echo $i ?></td>
          <td><?php echo $wisuda->code ?></td>
          <td><?php echo $wisuda->prodi ?></td>
          <td><?php echo $wisuda->nim ?></td>
          <td><?php echo $wisuda->nama ?></td>
          <td><?php echo $wisuda->ttl ?></td>
          <td><?php echo $wisuda->nik ?></td>
          <td><?php echo $wisuda->telepon ?></td>
          <td><?php echo $wisuda->email ?></td>

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