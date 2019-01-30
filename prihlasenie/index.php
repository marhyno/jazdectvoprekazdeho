<!DOCTYPE html>
<html lang="en">

<head>
	<?php include('../meta.php'); ?>
	<?php include('../animationsAndMessages.php'); ?>
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
	<link rel="stylesheet" type="text/css" href="css/main.css?<?php echo rand(0,5000); ?>">
	<link rel="stylesheet" type="text/css" href="/css/main.css?<?php echo rand(0,5000); ?>">
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
				<!-- LOGIN FORM -->
				<form id="loginform" class="login100-form validate-form" style="text-align: center;margin-left: auto;margin-right: auto;display:none">
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
						<button class="login100-form-btn" id="logIn">
							Prihlásiť sa
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Zabudol som
						</span>
						<a class="txt2 changeForm" id="showresetform" href="#">
							Heslo ?
						</a>
					</div>
				</form>
				<!-- GENERATE RESET LINK FORM -->
				<form id="resetform" class="login100-form validate-form" style="text-align: center;margin-left: auto;margin-right: auto;display:none">
					<span class="login100-form-title">
						Obnoviť heslo
						<p>
						Link na obnovenie hesla vám bude zaslaný na emailovú adresu
						</p>
					</span>

					<div class="wrap-input100 validate-input" data-validate="Email musí mať správny tvar: ex@abc.xyz">
						<input id="email" class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" id="sendNewPassword">
							Obnoviť
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Späť na 
						</span>
						<a class="txt2 changeForm" id="showloginform" href="#">
							Prihlásenie
						</a>
					</div>
                </form>
                <!-- GENERATE RESET LINK FORM -->
				<form id="ResendRegistrationLink" class="login100-form validate-form" style="text-align: center;margin-left: auto;margin-right: auto;display:none">
					<span class="login100-form-title">
						Odoslať registračný link znovu
						<p>
						Link na potvrdenie registrácie vám bude zaslaný na emailovú adresu
						</p>
					</span>

					<div class="wrap-input100 validate-input" data-validate="Email musí mať správny tvar: ex@abc.xyz">
						<input id="email" class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" id="resendRegisterLink">
							Odoslať
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Späť na 
						</span>
						<a class="txt2 changeForm" id="showloginform" href="#">
							Prihlásenie
						</a>
					</div>
                </form>
                <!-- RESET PASSWORD FORM -->
				<form id="setNewPassword" class="login100-form validate-form" style="text-align: center;margin-left: auto;margin-right: auto;display:none">
					<span class="login100-form-title">
						Vytvorte si nové heslo
					</span>

					<div class="wrap-input100 validate-input" data-validate="Heslo je potrebné vyplniť">
						<input id="setPassword" class="input100" type="password" name="pass" placeholder="Heslo">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Heslo je potrebné vyplniť">
						<input id="repeatPassword" class="input100" type="password" name="pass" placeholder="Zopakujte heslo">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" id="saveNewPassword">
							Uložiť
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Späť na 
						</span>
						<a class="txt2 changeForm" id="showloginform" href="#">
							Prihlásenie
						</a>
					</div>
				</form>
				<!-- REGISTRATION FORM -->
				<form id="registerform" class="login100-form validate-form" style="text-align: center;margin-left: auto;margin-right: auto;display:none">
					<span class="login100-form-title">
						Registrovať sa 
					</span>

					<div class="wrap-input100 validate-input" data-validate="Meno musí byť zadané">
						<input id="fullName" class="input100" type="text" name="fullName" placeholder="Vaše meno a priezvisko">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Email musí mať správny tvar: ex@abc.xyz">
						<input id="email" class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Heslo je potrebné vyplniť">
						<input id="setPassword" class="input100" type="password" name="pass" placeholder="Heslo">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Heslo je potrebné vyplniť">
						<input id="repeatPassword" class="input100" type="password" name="pass" placeholder="Zopakujte heslo">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" id="createAccount">
							Registrovať
						</button>
                    </div>
                    
                    <div class="text-center p-t-12">
						<span class="txt1">
							Odoslať znovu
						</span>
						<a class="txt2 changeForm" id="showResendRegistrationLink" href="#">
							Registráčný link
						</a>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Späť na 
						</span>
						<a class="txt2 changeForm" id="showloginform" href="#">
							Prihlásenie
						</a>
					</div>
                </form>
                <p>Prihlásiť sa pomocou Facebooku / Google</p>
						<fb:login-button 
							scope="public_profile,email"
							onlogin="checkLoginState();">
						</fb:login-button>
						<a class="btn btn-social btn-google" id="googleSignIn"><span class="fa fa-google"></span> Prihlásiť sa</a>
				<div class="text-center p-t-136"  style="padding-top:50px;float:right;">
						<a class="txt4 changeForm" href="#" id="showregisterform">
							Registrovať sa
						</a>
				</div>
				<a class="txt4" href="#" id="goBack" style="float: left;padding-top: 50px;">
					<i class="fa fa-long-arrow-left m-l-5" aria-hidden="true"></i>
					Späť na stránku
				</a>
			</div>
		</div>
	</div>




	<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
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
    
	<?php
	include('../footerScripts.php');
    ?>
    
    <script src="js/main.js"></script>
	<script src="js/fbLogin.js"></script>
	<script src="js/gmailLogin.js"></script>
</body>

</html>