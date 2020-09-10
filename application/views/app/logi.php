<!-- Full Width Column -->
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Logi
                <small>Tutaj możesz przeglądać logi systemowe</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> hackSOFT</a></li>
                <!--                            <li><a href="#">Layout</a></li>-->
                <li class="active">Logi</li>
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

                <div class="box-body table-responsive no-padding">
                    
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>Moduł</th>
                                <th>Treść</th>
                                <th>Data</th>
                                <th>Uzytkownik id</th>
                            </tr>
                            <?php foreach ($logi as $log) : ?>
                            <tr>
                                <td><?php echo $log->modul; ?></td>
                                <td><?php echo $log->tresc; ?></td>
                                <td><?php echo $log->data_logu; ?></td>
                                <td><?php echo $log->uzytkownicy_id; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
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
