<!-- Full Width Column -->
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Koszyk części
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> hackSOFT</a></li>
                <!--                            <li><a href="#">Layout</a></li>-->
                <li class="active">Kategorie</li>
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
                                <th>Nazwa</th>
                                <th>Projekt</th>
                                <th>Wymagana<br>liczba w projekcie</th>
                                <th>Akcje</th>
                            </tr>
                            <?php foreach ($pozycje as $pozycja) : ?>
                            <tr>
                                <td><a href="<?php echo base_url('App/czescPopraw/' . $pozycja->katalog_id); ?>"><?php echo $pozycja->katalog_nazwa; ?></a></td>

                                <td><?php
                                    if ( $pozycja->projekty_id == 0 ) {
                                        echo "Brak";
                                    }
                                    foreach ( $projekty as $projekt ) {
                                        if ( $projekt->id == $pozycja->projekty_id ) {
                                            echo $projekt->nazwa;
                                        }
                                    }
                                ?></td>

                                <td><?php echo $pozycja->katalog_wymagana_ilosc_w_projekcie; ?></td>

                                <td>
                                    <a href="<?php echo base_url('App/czescPopraw/' . $pozycja->katalog_id); ?>" class="btn btn-primary btn-sm">Zobacz</a>
                                    <a href="<?php echo base_url('App/usunPozycjeZKoszyka/' . $pozycja->id); ?>" class="btn btn-danger btn-sm">Usuń z koszyka</a>
                                </td>
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
