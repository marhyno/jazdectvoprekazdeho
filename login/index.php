<!DOCTYPE html>
<html lang="en">

<head>
	<?php include('../meta.php'); ?>
	<title>Prihlásiť sa / Registrovať -
		<?php echo $siteName; ?>
	</title>
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="/css/main.css">
	<!--===============================================================================================-->
</head>

<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="overlay overlay-bg"></div>
			<div class="wrap-login100" style="display: inline-block;text-align: center;">
				<a href="../index.php">
					<img class="img-fluid" src="../img/logo.png" alt="">
				</a>

				<form class="login100-form validate-form" style="text-align: center;margin-left: auto;margin-right: auto;">
					<span class="login100-form-title">
						Prihlásiť sa
					</span>

					<div class="wrap-input100 validate-input" data-validate="Email musí mať správny tvar: ex@abc.xyz">
						<input id="email" class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Heslo je potrebné vyplniť">
						<input id="password" class="input100" type="password" name="pass" placeholder="Heslo">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Prihlásiť sa
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Zabudol som
						</span>
						<a class="txt2" href="#">
							Heslo ?
						</a>
					</div>
				</form>
				<div class="text-center p-t-136"  style="padding-top:50px;float:right;">
						<a class="txt4 createAccount" href="#">
							Registrovať sa
						</a>
				</div>
				<a class="txt4" href="../" style="float: left;padding-top: 50px;">
					<i class="fa fa-long-arrow-left m-l-5" aria-hidden="true"></i>
					Späť
				</a>
			</div>
		</div>
	</div>




	<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script>
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
	<!--===============================================================================================-->
	<script src="js/main.js"></script>
	<?php
	include('../footerScripts.php');
	?>
</body>

</html>