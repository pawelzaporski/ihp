
<!-- Full Width Column -->
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Skaner
                <small>Tutaj możesz skanować kody QR</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> hackSOFT</a></li>
                <!--                            <li><a href="#">Layout</a></li>-->
                <li class="active">Skaner</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <?php
//wiadomosci sesji 
            echo $this->session->flashdata('message');
            ?>

            <!--                        <div class="alert alert-info alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <h4><i class="icon fa fa-info"></i> Podpowiedzi</h4>
                                        Tu będzie ewentualna podpowiedź. 
                                    </div>-->
            <div class="box box-primary">
                <!--                            <div class="box-header with-border">
                                                <h3 class="box-title">Tutaj ustawisz logo oraz kolory transmisji.</h3>
                                            </div>-->

                <div class="box-body ">

                <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
                <div id="qr-reader" style="width:500px"></div>
                <?php echo form_open("App/szukajKodQR", 'id="qr-form"'); ?>
                <input type="text" name="qr" id="qr-reader-results">
                <?php echo form_close(); ?>
                <script>
                var resultContainer = document.getElementById('qr-reader-results');
                var qrForm = document.getElementById('qr-form');
                var lastResult, countResults = 0;

                function onScanSuccess(qrCodeMessage) {
                    if (qrCodeMessage !== lastResult) {
                        ++countResults;
                        lastResult = qrCodeMessage;
                        resultContainer.value = qrCodeMessage;
                        qrForm.submit();
                    }
                }

                var html5QrcodeScanner = new Html5QrcodeScanner(
                    "qr-reader", { fps: 10, qrbox: 250 });
                html5QrcodeScanner.render(onScanSuccess);
                </script>
                </div>


                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.container -->
</div>
<!-- /.content-wrapper -->
