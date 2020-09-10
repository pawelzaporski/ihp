<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Logowanie</title>
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

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

	<!-- Google Font -->
	<link rel="stylesheet"
		href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition register-page">
	<div class="register-box">
		<div class="register-logo">
			<a href="#"><b>hackSOFT</b></a>
		</div>

		<div class="register-box-body">
			<p class="login-box-msg">Zaloguj się</p>

			<?php
                //wiadomosci sesji 
                echo $this->session->flashdata('message');
                ?>

			<form action="<?php echo base_url('App/autoryzacja'); ?>" method="post">
				<div class="form-group has-feedback">
					<input type="text" class="form-control" name="login" placeholder="login" required>
					<?php echo form_error('login', '<p class="text-danger">', '</p>'); ?>
				</div>

				<div class="form-group has-feedback">
					<input type="password" class="form-control" name="haslo" placeholder="haslo" required>
					<?php echo form_error('haslo', '<p class="text-danger">', '</p>'); ?>
				</div>



				<div class="form-group has-feedback">
					<button type="submit" class="btn btn-primary btn-block btn-flat">Zaloguj się</button>
				</div>

			</form>


			<?php if ( 1 == 0) {//wyłączone ?>
			<div class="social-auth-links text-center">
				<p>lub</p>
			</div>

			<div class="text-center">
				<a href="login.html" class="text-center">Nię pamiętasz hasła ?</a>
				<!-- 				<br> -->
				<!-- 				<a  href="login.html" class="text-center">Jeżeli posadiasz już konto kliknij tutaj.</a> -->
			</div>
			<?php } ?>
		</div>
		<!-- /.form-box -->
	</div>
	<!-- /.register-box -->

	<!-- jQuery 3 -->
	<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	<!-- SlimScroll -->
	<script src="<?php echo base_url(); ?>assets/js/jquery.slimscroll.min.js"></script>
	<!-- FastClick -->
	<script src="<?php echo base_url(); ?>assets/js/fastclick.js"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo base_url(); ?>assets/js/adminlte.min.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="<?php echo base_url(); ?>assets/js/demo.js"></script>


</body>

</html>