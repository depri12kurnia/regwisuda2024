<?php
// Notifikasi error
echo validation_errors('<p class="alert alert-warning">', '</p>');

// Form open
echo form_open(base_url('tamu/tambah'));
?>
<div class="row">
	<!-- =========================== -->
	<div class="col-md-3">

	</div>
	<div class="col-md-6">
		<div class="form-group">
			
			<label>Code <span class="text-danger">*</span></label>
			<input type="text" name="code" class="form-control form-control-md" value="<?php echo set_value('code') ?>" required>

			<label>Asal <span class="text-danger">*</span></label>
			<input type="text" name="asal_tamu" class="form-control form-control-md" value="<?php echo set_value('asal_tamu') ?>" required>


			<input type="hidden" name="status" value="Tidak" required>

		</div>
		<div class="form-group">
			<div class="btn-group">
				<button class="btn btn-success btn-md" name="submit" type="submit">
					<i class="fa fa-save"></i> Save
				</button>
				<a href="<?php echo base_url('tamu') ?>" class="btn btn-warning btn-md">
					<i class="fa fa-backward"></i> Kembali
				</a>
			</div>
		</div>
	</div>
	<div class="col-md-3">

	</div>
	<!-- =========================== -->
</div>
<?php
// Form close
echo form_close();
?>