<?php
// Notifikasi error
echo validation_errors('<p class="alert alert-warning">', '</p>');

// Form open
echo form_open(base_url('wisuda/tambah'));
?>
<div class="row">
	<!-- =========================== -->
	<div class="col-md-3">

	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Code <span class="text-danger">*</span></label>
			<input type="text" name="code" class="form-control form-control-md" value="<?php echo set_value('code') ?>" required>

			<label>Prodi <span class="text-danger">*</span></label>
			<select name="prodi" class="form-control form-control-md">
				<option value="">- Pilih Prodi -</option>
				<option value="Profesi Bidan">Profesi Bidan</option>
				<option value="Profesi Ners">Profesi Ners</option>
				<option value="Profesi Fisioterapis">Profesi Fisioterapis</option>
				<option value="ST Fisioterapi">ST Fisioterapi</option>
				<option value="ST Keperawatan">ST Keperawatan</option>
				<option value="ST Kebidanan">ST Kebidanan</option>
				<option value="ST TLM">ST TLM</option>
				<option value="ST Promkes">ST Promkes</option>
				<option value="DIII TLM">DIII TLM</option>
				<option value="DIII Keperawatan">DIII Keperawatan</option>
				<option value="DIII Kebidanan">DIII Kebidanan</option>
			</select>

			<label>nim <span class="text-danger">*</span></label>
			<input type="text" name="nim" class="form-control form-control-md" value="<?php echo set_value('nim') ?>" required>

			<label>nama <span class="text-danger">*</span></label>
			<input type="text" name="nama" class="form-control form-control-md" value="<?php echo set_value('nama') ?>" required>

			<label>ttl <span class="text-danger">*</span></label>
			<input type="text" name="ttl" class="form-control form-control-md" value="<?php echo set_value('ttl') ?>" required>

			<label>nik <span class="text-danger">*</span></label>
			<input type="text" name="nik" class="form-control form-control-md" value="<?php echo set_value('nik') ?>" required>

			<label>telepon <span class="text-danger">*</span></label>
			<input type="text" name="telepon" class="form-control form-control-md" value="<?php echo set_value('telepon') ?>" required>

			<label>email <span class="text-danger">*</span></label>
			<input type="text" name="email" class="form-control form-control-md" value="<?php echo set_value('email') ?>" required>

		</div>
		<div class="form-group">
			<div class="btn-group">
				<button class="btn btn-success btn-md" name="submit" type="submit">
					<i class="fa fa-save"></i> Save
				</button>
				<a href="<?php echo base_url('wisuda') ?>" class="btn btn-warning btn-md">
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