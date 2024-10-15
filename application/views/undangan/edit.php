<?php
// Notifikasi error
echo validation_errors('<p class="alert alert-warning">', '</p>');

// Form open
echo form_open(base_url('undangan/edit/' . $undangan->code));
?>
<div class="row">
	<div class="col-md-3">
		<input type="hidden" name="entry_time" value="<?php echo $undangan->entry_time ?>">
	</div>
	<div class="col-md-6">
		<div class="form-group">

			<label>Code <span class="text-danger">*</span></label>
			<input type="text" name="code" class="form-control form-control-md" value="<?php echo $undangan->code ?>" readonly>

			<label>Status <span class="text-danger">*</span></label>
			<select name="status" class="form-control form-control-md">
				<option value="Hadir" <?php if ($undangan->status == "Hadir") {
											echo "selected";
										} ?>>Hadir</option>
				<option value="Tidak" <?php if ($undangan->status == "Tidak") {
											echo "selected";
										} ?>>Tidak</option>
			</select>

		</div>
		<div class="form-group">
			<div class="btn-group">
				<button class="btn btn-success btn-md" name="submit" type="submit">
					<i class="fa fa-save"></i> Save
				</button>
				<a href="<?php echo base_url('undangan') ?>" class="btn btn-warning btn-md">
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