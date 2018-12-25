<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
	<?php include('meta.php'); ?>
	<meta name="description" content="Jazdectvo je naozaj pre všetkých, nie len pre určitú skupinu ľudí. Objavte čaro prepojenia medzi človekom a koňom. Všetky potrebné informácie, udalosti, blogy nájdete na tejto stránke.">	
		<title>Forum - <?php echo $siteName; ?></title>
		<?php
        include('styleSheets.php');
        ?>
		</head>
		<body>
		<?php 
			$hladam = "menu-active";
			include('header.php'); 
        ?>
        <section>
            <iframe src="/forum/index.php" scrolling="yes" sandbox="allow-forms allow-popups allow-pointer-lock allow-same-origin allow-scripts" style="width: 80%;"></iframe>
        </section>
			<?php include('footer.php'); ?>
			<?php include('footerScripts.php'); ?>	

		</body>
	</html>



