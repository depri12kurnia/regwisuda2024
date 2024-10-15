<?php
// Notifikasi error
echo validation_errors('<p class="alert alert-warning">', '</p>');

// Form open
echo form_open(base_url('wisuda/edit/' . $wisuda->id_wd));
?>
<div class="row">
	<div class="col-md-3">

	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>code <span class="text-danger">*</span></label>
			<input type="text" name="code" class="form-control form-control-md" value="<?php echo $wisuda->code ?>" required>

			<label>Prodi <span class="text-danger">*</span></label>
			<select name="prodi" class="form-control form-control-md">
				<option value="Profesi Bidan" <?php if ($wisuda->prodi == "Profesi Bidan") {
													echo "selected";
												} ?>>Profesi Bidan</option>
				<option value="Profesi Ners" <?php if ($wisuda->prodi == "Profesi Ners") {
													echo "selected";
												} ?>>Profesi Ners</option>
				<option value="Profesi Fisioterapis" <?php if ($wisuda->prodi == "Profesi Fisioterapis") {
															echo "selected";
														} ?>>Profesi Fisioterapis</option>
				<option value="ST Fisioterapi" <?php if ($wisuda->prodi == "ST Fisioterapi") {
													echo "selected";
												} ?>>ST Fisioterapi</option>
				<option value="ST Keperawatan" <?php if ($wisuda->prodi == "ST Keperawatan") {
													echo "selected";
												} ?>>ST Keperawatan</option>
				<option value="ST Kebidanan" <?php if ($wisuda->prodi == "ST Kebidanan") {
													echo "selected";
												} ?>>ST Kebidanan</option>
				<option value="ST TLM" <?php if ($wisuda->prodi == "ST TLM") {
											echo "selected";
										} ?>>ST TLM</option>
				<option value="ST Promkes" <?php if ($wisuda->prodi == "ST Promkes") {
											echo "selected";
										} ?>>ST Promkes</option>
				<option value="DIII TLM" <?php if ($wisuda->prodi == "DIII TLM") {
												echo "selected";
											} ?>>DIII TLM</option>
				<option value="DIII Keperawatan" <?php if ($wisuda->prodi == "DIII Keperawatan") {
														echo "selected";
													} ?>>DIII Keperawatan</option>
				<option value="DIII Kebidanan" <?php if ($wisuda->prodi == "DIII Kebidanan") {
													echo "selected";
												} ?>>DIII Kebidanan</option>

			</select>

			<label>nim <span class="text-danger">*</span></label>
			<input type="text" name="nim" class="form-control form-control-md" value="<?php echo $wisuda->nim ?>" required>

			<label>nama <span class="text-danger">*</span></label>
			<input type="text" name="nama" class="form-control form-control-md" value="<?php echo $wisuda->nama ?>" required>

			<label>ttl <span class="text-danger">*</span></label>
			<input type="text" name="ttl" class="form-control form-control-md" value="<?php echo $wisuda->ttl ?>" required>

			<label>nik <span class="text-danger">*</span></label>
			<input type="text" name="nik" class="form-control form-control-md" value="<?php echo $wisuda->nik ?>" required>

			<label>telepon <span class="text-danger">*</span></label>
			<input type="text" name="telepon" class="form-control form-control-md" value="<?php echo $wisuda->telepon ?>" required>

			<label>email <span class="text-danger">*</span></label>
			<input type="text" name="email" class="form-control form-control-md" value="<?php echo $wisuda->email ?>" required>

		</div>
		<div class="form-group">
			<div class="btn-group">
				<button class="btn btn-success btn-md" name="submit" type="submit">
					<i class="fa fa-save"></i> Save
				</button>
				<a href="<?php echo base_url('kehadiran') ?>" class="btn btn-warning btn-md">
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