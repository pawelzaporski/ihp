<!-- Full Width Column -->
<div class="content-wrapper">
	<div class="container-fluid">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Część <?php echo $czesc[0]->nazwa; ?><small><?php echo $czesc[0]->sku; ?></small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> hackSOFT</a></li>
				<li><a href="<?php echo base_url('App/katalog'); ?>">Katalog</a></li>
				<li class="active">Część <?php echo $czesc[0]->nazwa; ?></li>
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
					<li class="active"><a href="#ogolne" data-toggle="tab"
						aria-expanded="true"><i class="fa fa-cog" aria-hidden="true"></i> Ogólne</a></li>
					
					<li class=""><a href="#pliki" data-toggle="tab" aria-expanded="false"><i class="fa fa-files-o" aria-hidden="true"></i> Pliki</a>

					<li class=""><a href="<?php echo base_url('App/drukujKodQR/' . $czesc[0]->id); ?>" aria-expanded="false" target="_blank"><i class="fa fa-qrcode" aria-hidden="true"></i> Drukuj kod QR</a>

					<li class=""><a href="<?php echo base_url('App/dodajDoKoszyka/' . $czesc[0]->id); ?>" aria-expanded="false" target="_blank"><i class="fa fa-cart-plus" aria-hidden="true"></i> Dodaj do koszyka</a>

					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
						<i class="fa fa-search" aria-hidden="true"></i> Pokaż <span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
						<li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url("App/katalog/" . $czesc[0]->kategorie_id ."/0"); ?>">wszystkie części z kategorii</a></li>
						<li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url("App/katalog/0/" . $czesc[0]->projekty_id); ?>">wszystkie części z projektu</a></li>
						<li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url("App/katalog/" . $czesc[0]->kategorie_id . "/" . $czesc[0]->projekty_id); ?>">wszystkie części z projektu i projektu</a></li>
						<!-- <li role="presentation" class="divider"></li> -->
						<!-- <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li> -->
						</ul>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="ogolne">

                            <?php echo form_open('App/czescPoprawOgolne/' . $czesc[0]->id); ?>

								<div class="form-group">
									<label for="qr">Wygenerowany unikatowy qr kod (można zmienić na własny) <span class="text-danger">*</span></label>
									<input type="text" class="form-control" id="qr" name="qr" value="<?php echo $czesc[0]->qr; ?>>" required>
									<?php echo form_error('qr', '<p class="text-danger">', '</p>'); ?>

									<canvas id="qr-code"></canvas>
									<br>
									<a target="_blank" href="<?php echo base_url('App/drukujKodQR/' . $czesc[0]->id); ?>" class="btn btn-default btn-sm">Drukuj kod QR</a>
        							<script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
									<script>
										/* JS comes here */
										var qr;
										(function() {
												qr = new QRious({
												element: document.getElementById('qr-code'),
												size: 200,
												value: '<?php echo $czesc[0]->qr; ?>'
											});
										})();
									</script>
								</div>

								<div class="form-group">
									<label for="nazwa">Nazwa części <span class="text-danger">*</span></label>
									<input type="text" class="form-control" id="nazwa" name="nazwa" value="<?php echo $czesc[0]->nazwa; ?>" required>
									<?php echo form_error('nazwa', '<p class="text-danger">', '</p>'); ?>
								</div>

								<div class="form-group">
									<label for="sku">SKU</label>
									<input type="text" class="form-control" id="sku" name="sku" value="<?php echo $czesc[0]->sku; ?>">
									<?php echo form_error('sku', '<p class="text-danger">', '</p>'); ?>
								</div>

								<div class="form-group">
									<label for="stan_w_magazynie">Stan w magazynie</label>
									<input type="text" class="form-control" id="stan_w_magazynie" name="stan_w_magazynie" value="<?php echo $czesc[0]->stan_w_magazynie; ?>">
									<?php echo form_error('stan_w_magazynie', '<p class="text-danger">', '</p>'); ?>
								</div>

								<div class="form-group">
									<label for="kategorie_id">Kategoria</label> 
									<select class="form-control" id="kategorie_id" name="kategorie_id">
										<?php foreach ( $kategorie as $kategoria ) { if ( $czesc[0]->kategorie_id == $kategoria->id ) { ?>
											<option value="<?php echo $kategoria->id; ?>"><?php echo $kategoria->nazwa; ?></option>
										<?php } } ?>

										<option value="0">Brak kategori</option>

										<?php foreach ( $kategorie as $kategoria ) { if ( $czesc[0]->kategorie_id != $kategoria->id ) { ?>
											<option value="<?php echo $kategoria->id; ?>"><?php echo $kategoria->nazwa; ?></option>
										<?php } } ?>
									</select>
									<?php echo form_error('kategorie_id', '<p class="text-danger">', '</p>'); ?>
								</div>

								<div class="form-group">
									<label for="projekty_id">Projekt</label> 
									<select class="form-control" id="projekty_id" name="projekty_id">

										<?php foreach ( $projekty as $projekt ) { if ( $czesc[0]->projekty_id == $projekt->id ) { ?>
											<option value="<?php echo $projekt->id; ?>"><?php echo $projekt->nazwa; ?></option>
										<?php } } ?>

										<option value="0">Brak projektu</option>

										<?php foreach ( $projekty as $projekt ) { if ( $czesc[0]->projekty_id != $projekt->id ) { ?>
											<option value="<?php echo $projekt->id; ?>"><?php echo $projekt->nazwa; ?></option>
										<?php } } ?>

									</select>
									<?php echo form_error('projekty_id', '<p class="text-danger">', '</p>'); ?>
								</div>

								<div class="form-group">
									<label for="wymagana_ilosc_w_projekcie">Wymagana ilosc w projekcie</label>
									<input type="text" class="form-control" id="wymagana_ilosc_w_projekcie" name="wymagana_ilosc_w_projekcie" value="<?php echo $czesc[0]->wymagana_ilosc_w_projekcie; ?>">
									<?php echo form_error('wymagana_ilosc_w_projekcie', '<p class="text-danger">', '</p>'); ?>
								</div>

								<div class="form-group">
									<label for="katalog_statusy_id">Status części</label> 
									<select class="form-control" id="katalog_statusy_id" name="katalog_statusy_id">
										<?php foreach ( $statusy as $status ) { if ( $czesc[0]->katalog_statusy_id == $status->id ) { ?>
											<option value="<?php echo $status->id; ?>"><?php echo $status->nazwa; ?></option>
										<?php } } ?>

										<option value="0">Brak kategori</option>

										<?php foreach ( $statusy as $status ) { if ( $czesc[0]->katalog_statusy_id != $status->id ) { ?>
											<option value="<?php echo $status->id; ?>"><?php echo $status->nazwa; ?></option>
										<?php } } ?>

									</select>
									<?php echo form_error('katalog_statusy_id', '<p class="text-danger">', '</p>'); ?>
								</div>

								<p>
									Pola z <span class="text-danger">*</span> są wymagane
								</p>
								<button type="submit" class="btn btn-primary">Zapisz</button>

            					
                            <?php echo form_close(); ?>

                        </div>
					
					<!-- /.tab-pane -->
					<div class="tab-pane" id="pliki">
					
					<div class="table-responsive">
                    <button style="margin-bottom: 10px;" class="btn btn-default" data-toggle="modal" data-target="#modal-dodaj-plik">Dodaj plik</button>
                    <br>

					<div class="modal fade" id="modal-dodaj-plik" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <?php echo form_open_multipart('App/czescDodajPlik/' . $czesc[0]->id); ?>

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title">Dodaj plik</h4>
                                </div>
                                <div class="modal-body">

                                    <div class="form-group">
                                        <label for="nazwa_pliku">Plik (pdf, doc, docx, csv, jpg, mp4, xls, xlsx)<span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" id="nazwa_pliku" name="nazwa_pliku" required>
                                        <?php echo form_error('nazwa_pliku', '<p class="text-danger">', '</p>'); ?>
                                    </div>

									<div class="form-group">
                                        <label for="opis_pliku">Opis</label>
                                        <textarea type="text" class="form-control" id="opis_pliku" name="opis_pliku"></textarea>
                                        <?php echo form_error('opis_pliku', '<p class="text-danger">', '</p>'); ?>
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

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>Nazwa pliku</th>
                            	<th style="width: 60%;">Opis</th>
                                <th>Akcje</th>
                            </tr>
                            <?php foreach ($pliki as $plik) : ?>
                                <tr>
                                    <td><a href="<?php echo base_url("assets/upload/" . $plik->nazwa_pliku); ?>" target="_blank"><?php echo $plik->nazwa_pliku; ?></a></td>

                                    <td><?php echo $plik->opis_pliku; ?></td>

                                    <td>
                                        <a href="<?php echo base_url("assets/upload/" . $plik->nazwa_pliku); ?>" target="_blank" class="btn btn-primary btn-sm">Zobacz</a>

										<?php if ( $this->session->userdata('uprawnienia_katalog') > 3 ) { ?>
                                        	<a href="<?php echo base_url('App/czescUsunPlik/' . $plik->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Czy napewno chcesz usunąć plik ?')">Usuń</a>
										<?php } ?>
									
									</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
					
					</div>
					<!-- /.tab-pane -->
				</div>
				<!-- /.tab-content -->
			</div>

		</section>
		<!-- /.content -->
	</div>
	<!-- /.container -->
</div>
<!-- /.content-wrapper -->


