<div class="card">
    <div class="card-header">
        <h3 class="card-title">Upload</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"> <i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove"> <i class="fa fa-times"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="form-group">
            <h6>Download Format Import</h6>
        </div>
        <div class="form-group">
            <a href="<?php echo base_url('assets/format_import.xlsx'); ?>" target="_blank">Format Import</a>
        </div>
        <?php
        if ($this->session->flashdata('message')) {
            echo $this->session->flashdata('message');
        }
        ?>
        <form id="form-upload-user" method="post" action="<?php echo base_url('wisuda/import_spreadsheet'); ?>" enctype="multipart/form-data">
            <div class="sub-result"></div>
            <div class="form-group">
                <label class="control-label">Choose File <small class="text-danger">*</small></label>
                <input type="file" class="form-control form-control-sm" id="upload_file" name="upload_file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                <small class="text-danger">Upload excel or csv file only.</small>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light" id="btnUpload">Upload</button>
            </div>
        </form>
    </div>
</div>