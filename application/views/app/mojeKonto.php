<!-- Full Width Column -->
<div class="content-wrapper">
	<div class="container-fluid">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Moje konto <small></small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> hackSOFT</a></li>
				<!-- <li><a href="<?php echo base_url('App/uzytkownicy'); ?>">Użytkownicy</a></li> -->
				<li class="active">Moje konto</li>
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
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#zmiana-hasla" data-toggle="tab" aria-expanded="true">Zmiana hasła</a></li>
				
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="zmiana-hasla">

						<?php echo form_open('App/mojeKonto/'); ?>

						<div class="form-group">
							<label for="stare_haslo">Stare hasło<span class="text-danger">*</span></label>
							<input type="password" name="stare_haslo" class="form-control">
						</div>

						<div class="form-group">
							<label for="nowe_haslo">Nowe hasło<span class="text-danger">*</span></label>
							<input type="password" name="nowe_haslo" class="form-control">
						</div>

						<p>
							Pola z <span class="text-danger">*</span> są wymagane
						</p>
						<button type="submit" class="btn btn-primary">Zmień hasło</button>

							
						<?php echo form_close(); ?>

                    </div>
					
				</div>
			</div>

		</section>
		<!-- /.content -->
	</div>
	<!-- /.container -->
</div>
<!-- /.content-wrapper -->


