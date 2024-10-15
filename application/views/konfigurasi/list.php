<?php
// Session 
if ($this->session->flashdata('sukses')) {
    echo '<div class="alert alert-success  alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
    echo $this->session->flashdata('sukses');
    echo '</div>';
}
// Error
echo validation_errors('<div class="alert alert-success  alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><div class="alert alert-success">', '</div></div>');
?>

<?php echo form_open(base_url('konfigurasi')) ?>
<div class="row">
    <input type="hidden" name="id_konfigurasi" value="<?php echo $site->id_konfigurasi ?>">

    <div class="col-md-6">
        <h3>Basic information:</h3>
        <hr>
        <div class="form-group">
            <label>Company name</label>
            <input type="text" name="namaweb" placeholder="Nama organisasi/perusahaan" value="<?php echo $site->namaweb ?>" required class="form-control">
        </div>

        <div class="form-group">
            <label>Singkatan</label>
            <input type="text" name="singkatan" placeholder="Singkatan organisasi/perusahaan" value="<?php echo $site->singkatan ?>" required class="form-control">
        </div>

        <div class="form-group">
            <div class="form-group btn-group">
                <input type="submit" name="submit" value="Save Configuration" class="btn btn-success btn-md">
                <input type="reset" name="reset" value="Reset" class="btn btn-primary btn-md">
            </div>
        </div>
    </div>

</div>
</form>