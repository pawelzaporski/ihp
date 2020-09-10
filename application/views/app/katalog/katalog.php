
<!-- Full Width Column -->
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Katalog części
                <small>Tutaj możesz dodawać, edytować i usuwać części <?php //echo $kategorie_id . " / " . $projekty_id ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> hackSOFT</a></li>
                <!--                            <li><a href="#">Layout</a></li>-->
                <li class="active">Katalog części</li>
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
                    <a style="margin: 10px;" href="<?php echo base_url('App/czescDodaj'); ?>" class="btn btn-default">Dodaj część</a>
                    <button style="margin: 10px 0px;" type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-szukaj">Filtruj</button>
                    <br>
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>Id</th>
                            	<th>Nazwa</th>
                            	<th>Kategoria</th>
                            	<th>SKU</th>
                                <th>Projekt</th>
                                <th>Wymagana<br>ilość w projekcie</th>
                                <th>Stan<br>w magazynie</th>
                                <th>Status</th>
                                <th>Akcje</th>
                            </tr>
                            <?php foreach ($katalog as $czesc) : ?>
                                <tr>
                                    <td><?php echo $czesc->id; ?></td>

                                    <td><a href="<?php echo base_url('App/czescPopraw/' . $czesc->id); ?>"><?php echo $czesc->nazwa; ?></a></td>

                                    <td><?php
                                    if ( $czesc->kategorie_id == 0 ) {
                                        echo "Brak";
                                    }
                                    foreach ( $kategorie as $kategoria ) {
                                        if ( $kategoria->id == $czesc->kategorie_id ) {
                                            echo $kategoria->nazwa;
                                        }
                                    }
                                    ?></td>

                                    <td><?php echo $czesc->sku; ?></td>

                                    <td><?php
                                    if ( $czesc->projekty_id == 0 ) {
                                        echo "Brak";
                                    }
                                    foreach ( $projekty as $projekt ) {
                                        if ( $projekt->id == $czesc->projekty_id ) {
                                            echo $projekt->nazwa;
                                        }
                                    }
                                    ?></td>

                                    <td><?php echo $czesc->wymagana_ilosc_w_projekcie; ?></td>

                                    <td><?php echo $czesc->stan_w_magazynie; ?></td>

                                    <td><?php
                                    if ( $czesc->katalog_statusy_id == 0 ) {
                                        echo "Brak";
                                    }
                                    foreach ( $statusy as $status ) {
                                        if ( $status->id == $czesc->katalog_statusy_id ) {
                                            echo '<span style="background-color: ' . $status->bg_color . ';" class="label label-success">' . $status->nazwa . '</span>';
                                        }
                                    }
                                    ?></td>

                                    <td>
                                        <?php if ( $this->session->userdata('uprawnienia_katalog') > 2 ) { ?>
                                            <a href="<?php echo base_url('App/czescPopraw/' . $czesc->id); ?>" class="btn btn-primary btn-sm">Popraw</a>
                                        <?php } ?>
                                        
                                        <?php if ( $this->session->userdata('uprawnienia_katalog') > 3 ) { ?>
                                            <a href="<?php echo base_url('App/czescUsun/' . $czesc->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Czy napewno chcesz usunąć część ?')">Usuń</a>
                                        <?php } ?>
                                        
                                        <a href="<?php echo base_url('App/dodajDoKoszyka/' . $czesc->id); ?>" class="btn btn-success btn-sm">Dodaj do koszyka</a>
                                        <a target="_blank" href="<?php echo base_url('App/drukujKodQR/' . $czesc->id); ?>" class="btn btn-default btn-sm">Drukuj kod QR</a>
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

<!-- szukaj -->
<div class="modal fade" id="modal-szukaj" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <?php echo form_open('App/szukajCzesci'); ?>

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title">Filtruj</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="kategorie_id">Kategoria <span class="text-danger">*</span></label>
                                        <select class="form-control" id="kategorie_id" name="kategorie_id" required>
                                            <option value="0">Wszystkie kategorie</option>
                                            <?php foreach ( $kategorie as $kategoria ) { ?>
                                                <option value="<?php echo $kategoria->id; ?>"><?php echo $kategoria->nazwa; ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php echo form_error('kategorie_id', '<p class="text-danger">', '</p>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="projekty_id">Projekt <span class="text-danger">*</span></label>
                                        <select class="form-control" id="projekty_id" name="projekty_id" required>
                                            <option value="0">Wszystkie kategorie</option>
                                            <?php foreach ( $projekty as $projekt ) { ?>
                                                <option value="<?php echo $projekt->id; ?>"><?php echo $projekt->nazwa; ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php echo form_error('projekty_id', '<p class="text-danger">', '</p>'); ?>
                                    </div>
                                    <p>
                                        Pola z <span class="text-danger">*</span> są wymagane
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left"
                                        data-dismiss="modal">Zamknij</button>
                                    <button type="submit" class="btn btn-primary">Szukaj</button>
                                </div>

                                <?php echo form_close(); ?>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
<!-- koniec szukaj -->