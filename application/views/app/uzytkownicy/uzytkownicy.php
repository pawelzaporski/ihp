
<!-- Full Width Column -->
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Użytkownicy
                <small>Tutaj możesz dodawać, edytować i usuwać użytkowników</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> hackSOFT</a></li>
                <!--                            <li><a href="#">Layout</a></li>-->
                <li class="active">Użytkownicy</li>
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
                    <a style="margin: 10px;" href="<?php echo base_url('App/uzytkownikDodaj'); ?>" class="btn btn-default">Dodaj</a>
                    <br>
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                            	<th>Imię i nazwisko</th>
                            	<th>Numer telefonu</th>
                                <th>Email</th>
                                <th>Stanowisko</th>
                                <th>Aktywny</th>
                                <th>Akcje</th>
                            </tr>
                            <?php foreach ($uzytkownicy as $uzytkownik) : ?>
                                <tr>
                                    <td><?php echo $uzytkownik->imie . ' ' . $uzytkownik->nazwisko; ?></td>
                                    <td><?php echo $uzytkownik->numer_telefonu; ?></td>
                                    <td><?php echo $uzytkownik->email; ?></td>
                                    <td><?php echo $uzytkownik->stanowisko; ?></td>
                                    <td>
                                        <?php
                                        if ($uzytkownik->konto_aktywne == 1) {
                                            echo '<span class="label label-success">Tak</span>';
                                        } else {
                                            echo '<span class="label label-danger">Nie</span>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url('App/uzytkownikPopraw/' . $uzytkownik->id); ?>" class="btn btn-primary btn-sm">Popraw</a>
                                        <a href="<?php echo base_url('App/uzytkownikUsun/' . $uzytkownik->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Czy napewno chcesz usunąć użytkownika ?')">Usuń</a>
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
