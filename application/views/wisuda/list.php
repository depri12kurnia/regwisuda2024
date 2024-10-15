<?php
// Form buka utk delete multiple
echo form_open(base_url('wisuda/proses'));
?>
<input type="hidden" name="pengalihan" value="<?php echo str_replace('index.php/', '', current_url()) ?>">
<p>
<div class="btn-group">
  <a href="<?php echo base_url('wisuda/tambah') ?>" class="btn btn-success btn-md">
    <i class="fa fa-plus"></i> Tambah</a>

  <a href="<?php echo base_url('wisuda/import') ?>" class="btn btn-warning btn-md">
    <i class="fa fa-file-excel-o"></i> Import</a>
</div>
</p>

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
        <th>Action</th>
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
          <td>
            <div class="btn-group">
              <a href="<?php echo base_url('wisuda/edit/' . $wisuda->id_wd) ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
              <a href="<?php echo base_url('wisuda/delete/' . $wisuda->id_wd) ?>" class="btn btn-danger btn-sm" onclick="confirmation(event)"><i class="fa fa-trash-o"></i> Hapus</a>
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