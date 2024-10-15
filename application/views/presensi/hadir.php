<?php
// Notifikasi error
echo validation_errors('<p class="alert alert-warning">', '</p>');

// Form open
echo form_open(base_url('presensi/update/' . $wisuda->id_undangan));
?>
<div class="row">
	<input type="hidden" name="status" value="Hadir">

	<div class="col-md-3">

	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Prodi <span class="text-danger">*</span></label>
			<input type="text" name="prodi" class="form-control form-control-md" value="<?php echo $wisuda->prodi ?>" readonly>

			<label>Code <span class="text-danger">*</span></label>
			<input type="text" name="code" class="form-control form-control-md" value="<?php echo $wisuda->code ?>" readonly>

			<label>Nama Ortu/Wali <span class="text-danger">*</span></label>
			<input type="text" name="nama_ortu" class="form-control form-control-md" value="<?php echo $wisuda->nama_ortu ?>" placeholder="Nama Ortu/Wali" autofocus>

			<label>Nama Wisudawan</label>
			<select class="form-control form-control-md" id='selWisuda' name="id_wisuda" style="width: 100%;">
				<option value='0'>-- Select Wisudawan --</option>
			</select>
		</div>
		<div class="form-group">
			<div class="btn-group">
				<button class="btn btn-success btn-md" name="submit" type="submit">
					<i class="fa fa-save"></i> Update
				</button>
				<a href="<?php echo base_url('presensi') ?>" class="btn btn-warning btn-md">
					<i class="fa fa-backward"></i> Kembali
				</a>
			</div>
		</div>
	</div>


	<div class="col-md-3">

	</div>
</div>
<!-- Script -->
<script type="text/javascript">
	$(document).ready(function() {

		$("#selWisuda").select2({
			ajax: {
				url: '<?= base_url() ?>index.php/Presensi/getWisuda',
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function(params) {
					return {
						searchTerm: params.term // search term
					};
				},
				processResults: function(response) {
					return {
						results: response
					};
				},
				cache: true
			}
		});
	});
</script>
<?php
// Form close
echo form_close();
?>