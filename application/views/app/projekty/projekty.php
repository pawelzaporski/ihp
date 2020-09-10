<!-- Full Width Column -->
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Projekty
                <small>Tutaj możesz dodawać, edytować i usuwać projekty</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> hackSOFT</a></li>
                <!--                            <li><a href="#">Layout</a></li>-->
                <li class="active">Projekty</li>
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
                    <?php if ( $this->session->userdata('uprawnienia_projekty') > 1 ) { ?>
                    <button style="margin: 10px;" type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-dodaj-projekt">Dodaj</button>

                    <div class="modal fade" id="modal-dodaj-projekt" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <?php echo form_open('App/projektDodaj'); ?>

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title">Dodaj projekt</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="nazwa">Nazwa <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nazwa" name="nazwa" required>
                                        <?php echo form_error('nazwa', '<p class="text-danger">', '</p>'); ?>
                                    </div>
                                    <p>
                                        Pola z <span class="text-danger">*</span> są wymagane
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left"
                                        data-dismiss="modal">Zamknij</button>
                                    <button type="submit" class="btn btn-primary">Dodaj</button>
                                </div>

                                <?php echo form_close(); ?>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <?php } ?>

                    <br>
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>Nazwa</th>
                                <th>Akcje</th>
                            </tr>
                            <?php foreach ($projekty as $projekt) : ?>
                            <tr id="wiersz-id-<?php echo $projekt->id; ?>">
                                <td><?php echo $projekt->nazwa; ?></td>
                                <td>
                                    <button style="margin: 10px;" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-Popraw-projekt-<?php echo $projekt->id; ?>">Popraw</button>
                                    <a href="<?php echo base_url('App/projektUsun/' . $projekt->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Czy napewno chcesz usunąć kategorie ?')">Usuń</a>
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

<!-- poprawianie kategori kategorii -->
<?php if ( $this->session->userdata('uprawnienia_projekty') > 2 ) {
    foreach ( $projekty as $projekt ) { ?>

                    <div class="modal fade" id="modal-Popraw-projekt-<?php echo $projekt->id; ?>" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <?php echo form_open('App/projektPopraw/' . $projekt->id); ?>

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title">Popraw projekt</h4>
                                </div>

                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="nazwa">Nazwa <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nazwa" name="nazwa" required value="<?php echo $projekt->nazwa; ?>">
                                        <?php echo form_error('nazwa', '<p class="text-danger">', '</p>'); ?>
                                    </div>
                                    <p>
                                        Pola z <span class="text-danger">*</span> są wymagane
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left"
                                        data-dismiss="modal">Zamknij</button>
                                    <button type="submit" class="btn btn-primary">Zapisz</button>
                                </div>

                                <?php echo form_close(); ?>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <?php }
                } ?>
<!-- koniec dodawanie sub kategorii -->
