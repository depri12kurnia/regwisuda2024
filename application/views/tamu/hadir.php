<?php
// Notifikasi error
echo validation_errors('<p class="alert alert-warning">', '</p>');

// Form open
echo form_open(base_url('tamu/hadir/' . $tamu->id_tamu));
?>
<div class="row">
	<div class="col-md-3">

	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>code <span class="text-danger">*</span></label>
			<input type="text" name="code" class="form-control form-control-md" value="<?php echo $tamu->code ?>" readonly>

			<label>Asal <span class="text-danger">*</span></label>
			<input type="text" name="asal_tamu" class="form-control form-control-md" value="<?php echo $tamu->asal_tamu ?>" readonly>

			<label>Nama <span class="text-danger">*</span></label>
			<input type="text" name="nama" class="form-control form-control-md" value="<?php echo $tamu->nama ?>" autofocus required>


			<label>Jumlah <span class="text-danger">*</span></label>
			<input type="number" name="jumlah" class="form-control form-control-md" value="<?php echo $tamu->jumlah ?>" required>

		</div>
		<div class="form-group">
			<div class="btn-group">
				<button class="btn btn-success btn-md" name="submit" type="submit">
					<i class="fa fa-save"></i> Save
				</button>
				<a href="<?php echo base_url('tamu/manual') ?>" class="btn btn-warning btn-md">
					<i class="fa fa-backward"></i> Kembali
				</a>
			</div>
		</div>
	</div>
	<div class="col-md-3">

	</div>
</div>
<?php
// Form close
echo form_close();
?>