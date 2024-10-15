<!-- <input type="hidden" name="pengalihan" value="<?php echo str_replace('index.php/', '', current_url()) ?>"> -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <?php if ($this->session->flashdata('message')) {
                    echo $this->session->flashdata('message');
                }
                ?>
                <form method="POST" name="myForm" id="myForm">
                    <div class="input-group">
                        <input type="text" name="code" id="code" class="form-control form-control-lg" value="<?php echo set_value('code') ?>" placeholder="Scan Barcode Here" autocomplete="off" autofocus>
                        <input type="hidden" name="status" id="status" value="Hadir">
                    </div>
                </form>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-8 offset-md-2">
                <div class="list-group">
                    <div class="list-group-item">
                        <div class="row">
                            <div class="card-body table-responsive">
                                <table id="data_scan" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Code</th>
                                            <th>Status</th>
                                            <th>Entry Time</th>
                                            <th>Prodi</th>
                                            <th>Pendamping</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    var reg_table;
    var base_url = '<?php echo base_url(); ?>';

    $(document).ready(function() {
        //datatables
        reg_table = $('#data_scan').DataTable({

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "serverMethod": 'post',
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": false,
            "info": true,
            "autoWidth": true,
            "bDeferRender": true,
            "order": [], //Initial no order.
            "pageLength": 10,

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?= base_url() ?>tes/ajax_list",
                "type": "POST",
                "data": function(data) {
                    data.code = $('#code').val();
                }
            },
            //Set column definition initialisation properties.
            "columns": [
                null,
                null,
                null,
                null,
                null,
            ],
        });
        $('#code').change(function() {
            reg_table.draw();
        });
    });
</script>

<script type="text/javascript">
    $(function() {
        $('input[type=text]').keyup(function() {
            var elem = $(this);
            clearTimeout($(this).data('timer'));
            $(this).data('timer', setTimeout(function() {
                sendValue(elem.attr('code'), elem.val());
            }, 500));
        });
        $('input[type=text]').change(function() {
            sendValue($(this).attr('code'), $(this).val());
            frm.reset();
        });
    });

    function sendValue() {
        var code = $("#code").val();
        var status = $("#status").val();

        if (code != 0) {
            $.ajax({
                url: '<?php echo base_url() ?>tes/insert_data',
                method: 'post',
                data: {
                    code: code,
                    status: status
                },

                success: function(response) {
                    console.log(response);
                    // location.reload();
                    document.getElementById("code").value = "";
                }
            });
            document.getElementById("code").value = "";
            $("#code").focus();
            location.reload();
        } else {
            // eraseText();
            document.getElementById("code").value = "";
            $("#code").focus();
            location.reload();
        }

    }
</script>