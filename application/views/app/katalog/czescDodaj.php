<!-- Full Width Column -->
<div class="content-wrapper">
	<div class="container-fluid">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Dodaj część <small></small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> hackSOFT</a></li>
				<li><a href="<?php echo base_url('App/katalog'); ?>">Katalog</a></li>
				<li class="active">Dodaj część</li>
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
                    <?php echo form_open('App/czescDodaj'); ?>
                    
                    <div class="row">

						<div class="col-md-12">

							<div class="form-group">
								<label for="qr">Wygenerowany unikatowy qr kod (można zmienić na własny) <span class="text-danger">*</span></label>
								<input type="text" class="form-control" id="qr" name="qr" value="<?php echo $qr; ?>>">
								<?php echo form_error('qr', '<p class="text-danger">', '</p>'); ?>
							</div>

							<div class="form-group">
								<label for="nazwa">Nazwa części <span class="text-danger">*</span></label>
								<input type="text" class="form-control" id="nazwa"
									name="nazwa">
								<?php echo form_error('nazwa', '<p class="text-danger">', '</p>'); ?>
							</div>

							<div class="form-group">
								<label for="sku">SKU</label>
								<input type="text" class="form-control" id="sku" name="sku">
								<?php echo form_error('sku', '<p class="text-danger">', '</p>'); ?>
							</div>

							<div class="form-group">
								<label for="stan_w_magazynie">Stan w magazynie</label>
								<input type="text" class="form-control" id="stan_w_magazynie" name="stan_w_magazynie" value="0">
								<?php echo form_error('stan_w_magazynie', '<p class="text-danger">', '</p>'); ?>
							</div>

							<div class="form-group">
								<label for="kategorie_id">Kategoria</label> 
								<select class="form-control" id="kategorie_id" name="kategorie_id">
									<option value="0">Brak kategori</option>
									<?php foreach ( $kategorie as $kategoria ) { ?>
									<option value="<?php echo $kategoria->id; ?>"><?php echo $kategoria->nazwa; ?></option>
									<?php } ?>
								</select>
								<?php echo form_error('kategorie_id', '<p class="text-danger">', '</p>'); ?>
							</div>

							<div class="form-group">
								<label for="projekty_id">Projekt</label> 
								<select class="form-control" id="projekty_id" name="projekty_id">
									<option value="0">Brak projektu</option>
									<?php foreach ( $projekty as $projekt ) { ?>
									<option value="<?php echo $projekt->id; ?>"><?php echo $projekt->nazwa; ?></option>
									<?php } ?>
								</select>
								<?php echo form_error('projekty_id', '<p class="text-danger">', '</p>'); ?>
							</div>

							<div class="form-group">
								<label for="wymagana_ilosc_w_projekcie">Wymagana ilosc w projekcie</label>
								<input type="text" class="form-control" id="wymagana_ilosc_w_projekcie" name="wymagana_ilosc_w_projekcie" value="0">
								<?php echo form_error('wymagana_ilosc_w_projekcie', '<p class="text-danger">', '</p>'); ?>
							</div>

							<div class="form-group">
								<label for="katalog_statusy_id">Status części</label> 
								<select class="form-control" id="katalog_statusy_id" name="katalog_statusy_id">
									<option value="0">Brak kategori</option>
									<?php foreach ( $statusy as $status ) { ?>
									<option value="<?php echo $status->id; ?>"><?php echo $status->nazwa; ?></option>
									<?php } ?>
								</select>
								<?php echo form_error('katalog_statusy_id', '<p class="text-danger">', '</p>'); ?>
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