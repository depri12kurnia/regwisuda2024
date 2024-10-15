<!-- Info boxes -->
<div class="row">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fa fa-archive"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Semua Data Wisuda</span>
                <span class="info-box-number">
                    <?php echo $this->dasbor_model->all()->total; ?>
                    <small>Data</small>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.row -->

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-success elevation-1"><i class="fa fa-check"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Hadir</span>
                <span class="info-box-number">
                    <?php echo $this->dasbor_model->hadir()->total; ?>
                    <small>Hadir</small>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.row -->
</div>