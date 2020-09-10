<!-- Full Width Column -->
<div class="content-wrapper">
	<div class="container-fluid">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Dodaj użytkownika <small></small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> hackSOFT</a></li>
				<li><a href="<?php echo base_url('App/uzytkownicy'); ?>">Użytkownicy</a></li>
				<li class="active">Dodaj</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
            <?php
            // wiadomosci sesji
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

				<div class="box-body">
                    <?php echo form_open('App/uzytkownikDodaj'); ?>
                    
                    <div class="row">

						<div class="col-md-12">

							<div class="form-group">
								<label for="login">Login <span class="text-danger">*</span></label>
								<input type="text" class="form-control" id="login" name="login">
                        <?php echo form_error('login', '<p class="text-danger">', '</p>'); ?>
                    </div>

							<div class="form-group">
								<label for="haslo">Hasło<span class="text-danger">*</span></label>
								<input type="password" class="form-control" id="haslo"
									name="haslo">
                        <?php echo form_error('haslo', '<p class="text-danger">', '</p>'); ?>
                    </div>

							<div class="form-group">
								<label for="imie">Imię<span class="text-danger">*</span></label>
								<input type="text" class="form-control" id="imie" name="imie">
                        <?php echo form_error('imie', '<p class="text-danger">', '</p>'); ?>
                    </div>

							<div class="form-group">
								<label for="nazwisko">Nazwisko<span class="text-danger">*</span></label>
								<input type="text" class="form-control" id="nazwisko"
									name="nazwisko">
                        <?php echo form_error('nazwisko', '<p class="text-danger">', '</p>'); ?>
                    </div>

							<div class="form-group">
								<label for="numer_telefonu">Numer telefonu</label> <input
									type="text" class="form-control" id="numer_telefonu"
									name="numer_telefonu">
                        <?php echo form_error('numer_telefonu', '<p class="text-danger">', '</p>'); ?>
                    </div>

							<div class="form-group">
								<label for="email">Email uzytkownika</label> <input
									type="text" class="form-control" id="email"
									name="email">
                        <?php echo form_error('email', '<p class="text-danger">', '</p>'); ?>
                    </div>

							<div class="form-group">
								<label for="stanowisko">Stanowisko</label> <input type="text"
									class="form-control" id="stanowisko" name="stanowisko">
                        <?php echo form_error('stanowisko', '<p class="text-danger">', '</p>'); ?>
                    </div>

							<div class="form-group">
								<label for="konto_aktywne">Konto aktywne ?</label> 
								<select class="form-control" id="konto_aktywne" name="konto_aktywne">
									<option value="0">nie</option>
									<option value="1">tak</option>
								</select>
                        <?php echo form_error('aktywny', '<p class="text-danger">', '</p>'); ?>
                    </div>



						</div>





					</div>

					<div class="row">
						<div class="col-md-12">
							<p>
								Pola z <span class="text-danger">*</span> są wymagane
							</p>
							<button type="submit" class="btn btn-primary">Dodaj</button>
						</div>
					</div>
					
                    <?php echo form_close(); ?>
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