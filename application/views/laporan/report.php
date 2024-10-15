<input type="hidden" name="pengalihan" value="<?php echo str_replace('index.php/', '', current_url()) ?>">

<div class="table mailbox-messages">
    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label>Prodi :</label>
                <select class="form-control" name="prodi" id="prodi">
                    <option value="">- Semua -</option>
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
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label>Status :</label>
                <select class="form-control" name="status" id="status">
                    <option value="">- Semua -</option>
                    <option value="">Tidak</option>
                    <option value="Hadir">Hadir</option>
                </select>
            </div>
        </div>
    </div>
    <!-- /.col -->
    <table id="data_report" class="table table-bordered table-hover small">
        <thead>
            <tr>
                <th>#</th>
                <th>Prodi</th> 
                <th>NIM</th>
                <th>Nama</th>
                <th>TTL</th>
                <!-- <th>NIK</th>
                <th>Telepon</th>
                <th>Email</th> -->
                <th>Status</th>
                <th>Entry Time</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

</div>
<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
<!-- /.mail-box-messages -->
<script type="text/javascript">
    var reg_table;
    var base_url = '<?php echo base_url(); ?>';
    $(document).ready(function() {
        var getProdi;
        //datatables
        reg_table = $('#data_report').DataTable({

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "serverMethod": 'post',
            "order": [], //Initial no order.
            "pageLength": 2000,
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'excel',
                    exportOptions: {
                        modifier: {
                            page: 'all',
                            // messageTop: 'Program Studi '
                        }
                    },
                },
                {
                    extend: 'print',
                    title: 'Laporan Kehadiran Tamu Undangan Wisuda</br>Poltekkes Kemenkes Jakarta III</br>Tahun 2024',
                    // messageTop: 'Program Studi : ' + getProdi + ,
                    customize: function(win) {
                        $(win.document.body).find('h1').css('font-size', '15pt');
                        $(win.document.body).find('h1').css('text-align', 'center');
                        $(win.document.messageTop).css('text-align', 'center');
                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    },
                    messageTop: function() {
                        getProdi = $('#prodi').val();
                        return 'Program Studi ' + getProdi;

                    },
                    exportOptions: {
                        modifier: {
                            page: 'all',
                            // messageTop: 'Program Studi '
                        }
                    },
                }
            ],

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?= base_url() ?>report/ajax_list",
                "type": "POST",
                "data": function(data) {
                    data.prodi = $('#prodi').val();
                    data.status = $('#status').val();
                }
            },
            //Set column definition initialisation properties.
            "columns": [
                // null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                // null,
                // null,

            ],
        });

        $('#prodi,#status').change(function() {
            reg_table.draw();
        });
    });
</script>