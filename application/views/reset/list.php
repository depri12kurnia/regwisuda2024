<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Reset Data Wisuda (<?php echo $this->reset_model->totalWisuda()->total; ?>)</label>
            <a href="<?php echo base_url('reset/reset_wisuda') ?>" class="btn btn-danger btn-md" onclick="confirmation(event)"><i class="fa fa-trash-o"></i> Reset Wisuda</a>
        </div>
    </div>
    <div class="col-md-6">
        <label>Reset Data Undangan (<?php echo $this->reset_model->totalUndangan()->total; ?>)</label>
        <a href="<?php echo base_url('reset/reset_undangan') ?>" class="btn btn-danger btn-md" onclick="confirmation(event)"><i class="fa fa-trash-o"></i> Reset Undangan</a>
    </div>
    
    <div class="col-md-6">
        <div class="form-group">
            <label>Reset Data Wisuda (<?php echo $this->reset_model->totalWisuda()->total; ?>)</label>
            <a href="<?php echo base_url('reset/backup_db') ?>" class="btn btn-success btn-md"><i class="fa fa-database"></i> Backup DB</a>
        </div>
    </div>
</div>