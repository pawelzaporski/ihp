<!-- Full Width Column -->
<div class="content-wrapper">
	<div class="container-fluid">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Popraw użytkownika <small></small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> hackSOFT</a></li>
				<li><a href="<?php echo base_url('App/uzytkownicy'); ?>">Użytkownicy</a></li>
				<li class="active">Popraw</li>
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
						aria-expanded="true">Ogólne</a></li>
					
					<li class=""><a href="#uprawnienia" data-toggle="tab"
						aria-expanded="false">Uprawnienia</a>
				
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="ogolne">

                            <?php echo form_open('App/uzytkownikPoprawOgolne/' . $uzytkownik[0]->id); ?>

							<div class="form-group">
								<label for="imie">Login<span class="text-danger">*</span></label>
								<input type="text" class="form-control"value="<?php echo $uzytkownik[0]->login; ?>" disabled>
							</div>
            
							<div class="form-group">
								<label for="imie">Imię<span class="text-danger">*</span></label>
								<input type="text" class="form-control" id="imie" name="imie" value="<?php echo $uzytkownik[0]->imie; ?>">
								<?php echo form_error('imie', '<p class="text-danger">', '</p>'); ?>
							</div>

						<div class="form-group">
							<label for="nazwisko">Nazwisko<span class="text-danger">*</span></label>
							<input type="text" class="form-control" id="nazwisko"
								name="nazwisko" value="<?php echo $uzytkownik[0]->nazwisko; ?>">
                                            <?php echo form_error('nazwisko', '<p class="text-danger">', '</p>'); ?>
                                        </div>

						<div class="form-group">
							<label for="numer_telefonu">Numer telefonu</label> <input
								type="text" class="form-control" id="numer_telefonu"
								name="numer_telefonu"
								value="<?php echo $uzytkownik[0]->numer_telefonu; ?>">
                                            <?php echo form_error('numer_telefonu', '<p class="text-danger">', '</p>'); ?>
                                        </div>

						<div class="form-group">
							<label for="email">Email użytkownika</label> <input
								type="text" class="form-control" id="email"
								name="email"
								value="<?php echo $uzytkownik[0]->email; ?>">
                                            <?php echo form_error('email', '<p class="text-danger">', '</p>'); ?>
                                        </div>

						<div class="form-group">
							<label for="stanowisko">Stanowisko</label> <input type="text"
								class="form-control" id="stanowisko" name="stanowisko"
								value="<?php echo $uzytkownik[0]->stanowisko; ?>">
                                            <?php echo form_error('stanowisko', '<p class="text-danger">', '</p>'); ?>
                                        </div>

						<div class="form-group">
							<label for="konto_aktywne">Konto aktywne ?</label> <select
								class="form-control" id="konto_aktywne" name="konto_aktywne">
								<?php if ( $uzytkownik[0]->konto_aktywne == 0 ) { ?>
									<option value="0">nie</option>
									<option value="1">tak</option>
								<?php } else { ?>
									<option value="1">tak</option>
									<option value="0">nie</option>
								<?php } ?>
							</select>
                                            <?php echo form_error('aktywny', '<p class="text-danger">', '</p>'); ?>
                                        </div>
						<p>
							Pola z <span class="text-danger">*</span> są wymagane
						</p>
						<button type="submit" class="btn btn-primary">Zapisz</button>

            					
                                <?php echo form_close(); ?>

                        </div>
					
					<!-- /.tab-pane -->
					<div class="tab-pane" id="uprawnienia">
					
						<?php echo form_open('App/uzytkownikPoprawUprawnienia/' . $uzytkownik[0]->id); ?>
                        	
                        	<?php
                        	function rysujUprawnienia($posiadaneUprawnienie) {
                        	    $uprawnienia = array(
                        	        array(0, "brak uprawnień"),
                        	        array(1, "odczyt"),
                        	        array(2, "odczyt, dodawanie"),
                        	        array(3, "odczyt, dodawanie, edycja"),
                        	        array(4, "odczyt, dodawanie, edycja, usuwanie"),
                        	    );
                        	    
                        	    echo '<option value="' . $uprawnienia[$posiadaneUprawnienie][0] . '">' . $uprawnienia[$posiadaneUprawnienie][1] . '</option>';
                        	    
                        	    for($i = 0; $i < count($uprawnienia); $i++) {
                        	        if($uprawnienia[$i][0] != $posiadaneUprawnienie) {
                        	            echo '<option value="' . $uprawnienia[$i][0] . '">' . $uprawnienia[$i][1] . '</option>';
                        	        }
                        	    }
                        	}
                        	?>
    
    						<div class="form-group">
    							<label for="uprawnienia_skaner">Uprawnienia skaner</label> 
    							<select class="form-control" id="uprawnienia_skaner" name="uprawnienia_skaner">
    								<?php rysujUprawnienia($uzytkownik[0]->uprawnienia_skaner); ?>
    							</select>
                            <?php echo form_error('uprawnienia_skaner', '<p class="text-danger">', '</p>'); ?>
                        	</div>
                        	<div class="form-group">
    							<label for="uprawnienia_katalog">Uprawnienia katalog</label> 
    							<select class="form-control" id="uprawnienia_katalog" name="uprawnienia_katalog">
    								<?php rysujUprawnienia($uzytkownik[0]->uprawnienia_katalog); ?>
    							</select>
                            <?php echo form_error('uprawnienia_katalog', '<p class="text-danger">', '</p>'); ?>
                        	</div>
                        	<div class="form-group">
    							<label for="uprawnienia_kategorie">Uprawnienia kategorie</label> 
    							<select class="form-control" id="uprawnienia_kategorie" name="uprawnienia_kategorie">
    								<?php rysujUprawnienia($uzytkownik[0]->uprawnienia_kategorie); ?>
    							</select>
                            <?php echo form_error('uprawnienia_kategorie', '<p class="text-danger">', '</p>'); ?>
                        	</div>
                        	<div class="form-group">
    							<label for="uprawnienia_projekty">Uprawnienia projekty</label> 
    							<select class="form-control" id="uprawnienia_projekty" name="uprawnienia_projekty">
    								<?php rysujUprawnienia($uzytkownik[0]->uprawnienia_projekty); ?>
    							</select>
                            <?php echo form_error('uprawnienia_projekty', '<p class="text-danger">', '</p>'); ?>
                        	</div>
                        	<div class="form-group">
    							<label for="uprawnienia_uzytkownicy">Uprawnienia uzytkownicy</label> 
    							<select class="form-control" id="uprawnienia_uzytkownicy" name="uprawnienia_uzytkownicy">
    								<?php rysujUprawnienia($uzytkownik[0]->uprawnienia_uzytkownicy); ?>
    							</select>
                            <?php echo form_error('uprawnienia_uzytkownicy', '<p class="text-danger">', '</p>'); ?>
                        	</div>
                        	<div class="form-group">
    							<label for="uprawnienia_logi">Uprawnienia logi</label> 
    							<select class="form-control" id="uprawnienia_logi" name="uprawnienia_logi">
    								<?php rysujUprawnienia($uzytkownik[0]->uprawnienia_logi); ?>
    							</select>
                            <?php echo form_error('uprawnienia_logi', '<p class="text-danger">', '</p>'); ?>
                        	</div>
							<p>
								Pola z <span class="text-danger">*</span> są wymagane
							</p>
							<button type="submit" class="btn btn-primary">Zapisz</button>
					
                    <?php echo form_close(); ?>
					
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


