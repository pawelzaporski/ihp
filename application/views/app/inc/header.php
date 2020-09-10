<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>hackSOFT</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/_all-skins.min.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!--tiny start-->
        <script type="text/javascript" src='https://cdn.tiny.cloud/1/klo3hctzzoyw10kfoat9ep8oyb9e0g5714vwe405idvw36qq/tinymce/5/tinymce.min.js' referrerpolicy="origin"></script>
        <script type="text/javascript">
            tinymce.init({
                selector: '#tinyMCE1',
                plugins: [
                    'advlist autolink link lists charmap print preview hr anchor pagebreak spellchecker',
                    'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                    'save table directionality emoticons template paste'
                ],
                content_css: 'css/content.css',
                toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons'
            });
        </script>
        <!--tiny start-->

        <!-- do full calendar -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
        <!-- koniec do full calendar -->
        
        <!-- moje style -->
        <style>
           @media (max-width: 767px) {
                .skin-green .main-header .navbar .dropdown-menu li a {
                    color: #666666!important;
                }
                .skin-green .main-header .navbar .dropdown-menu li a:hover {
                    background-color: #d2d6de!important;
                }
            }
            /* kolorow tabow aktywnych 
            .nav-tabs-custom>.nav-tabs>li.active {
                border-top-color: #0ca659!important;
            }*/
        </style>
        <!-- koniec moje style -->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
    <body class="hold-transition skin-blue layout-top-nav">
        <div class="wrapper">

            <header class="main-header">
                <nav class="navbar navbar-static-top">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <a href="<?php echo base_url(); ?>" class="navbar-brand"><b>hackSOFT</b></a>
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                                <i class="fa fa-bars"></i>
                            </button>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                            <ul class="nav navbar-nav">
                                <!--<li><a href="<?php echo base_url(); ?>">Pulpit</a></li>-->
                                <?php if ( $this->session->userdata('uprawnienia_skaner') > 0 ) { ?>
                                    <li><a href="<?php echo base_url("App/skanerQR"); ?>">Skaner QR</a></li>
                                <?php } ?>
                                
                                <?php if ( $this->session->userdata('uprawnienia_katalog') > 0 ) { ?>
                                    <li><a href="<?php echo base_url("App/katalog"); ?>">Katalog części</a></li>
                                <?php } ?>
                                
                                <?php if ( $this->session->userdata('uprawnienia_kategorie') > 0 ) { ?>
                                    <li><a href="<?php echo base_url("App/kategorie"); ?>">Kategorie</a></li>
                                <?php } ?>

                                <?php if ( $this->session->userdata('uprawnienia_projekty') > 0 ) { ?>
                                    <li><a href="<?php echo base_url("App/projekty"); ?>">Projekty</a></li>
                                <?php } ?>

                                <?php if ( $this->session->userdata('uprawnienia_uzytkownicy') > 0 ) { ?>
                                    <li><a href="<?php echo base_url("App/uzytkownicy"); ?>">Uzytkownicy</a></li>
                                <?php } ?>

                                <?php if ( $this->session->userdata('uprawnienia_logi') > 0 ) { ?>
                                    <li><a href="<?php echo base_url("App/logi"); ?>">Logi</a></li>
                                <?php } ?>
                                <!--
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">One more separated link</a></li>
                                    </ul>
                                </li>
                                -->
                            </ul>
                            <!--
                            <form class="navbar-form navbar-left" role="search">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="navbar-search-input" placeholder="Search">
                                </div>
                            </form>
                            -->
                        </div>
                        <!-- /.navbar-collapse -->
                        <!-- Navbar Right Menu -->

                        <div class="navbar-custom-menu">
                            
                            	<!-- oddziały -->
                                <ul class="nav navbar-nav">
                                
                                    <li><a href="<?php echo base_url("App/koszykPozycje"); ?>">Koszyk <b>(<?php echo $ilosc_pozycji_w_koszyku; ?>)</b></a></li>

                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->session->userdata('imie') . " " . $this->session->userdata('nazwisko'); ?> <span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="<?php echo base_url("App/mojeKonto/"); ?>">Konto</a></li>
                                            <li><a href="<?php echo base_url("App/wylogujSie"); ?>">Wyloguj się</a></li>
                                        </ul>
                                	</li>

                                </ul>
                        </div>

                        <!-- /.navbar-custom-menu -->
                    </div>
                    <!-- /.container-fluid -->
                </nav>
            </header>