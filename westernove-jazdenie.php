<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <?php include($_SERVER["DOCUMENT_ROOT"].'/meta.php'); ?>
    <meta name="description" content="Jazdectvo je naozaj pre všetkých, nie len pre určitú skupinu ľudí. Objavte čaro prepojenia medzi človekom a koňom. Všetky potrebné informácie, udalosti, blogy nájdete na tejto stránke.">
    <title>Westernové jazdenie -
        <?php echo $siteName; ?>
    </title>
    <?php
        include($_SERVER["DOCUMENT_ROOT"].'/styleSheets.php');
        ?>
</head>

<body>
    <?php 
			$education = "menu-active";
			include($_SERVER["DOCUMENT_ROOT"].'/header.php'); 
		?>
    <!-- start banner Area -->
    <section class="banner-area relative" id="home">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="about-content col-lg-12">
                    <h2 class="text-white">
                        Westernové jazdenie
                    </h2>
                    <p class="text-white">História - Základné pojmy - Výbava jazdca a koňa</p>
                    <p class="text-white link-nav"><a href="/">Domov </a> <span class="lnr lnr-arrow-right"></span> <a
                            href="javascript:history.go(-1)">Krok Späť</a></p>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container pt-10 pb-10 text-center">
        <h2>Pripravujeme</h2>
        </div>
    </section>
    <!-- End banner Area -->
    <?php include($_SERVER["DOCUMENT_ROOT"].'/footer.php'); ?>
    <?php include($_SERVER["DOCUMENT_ROOT"].'/footerScripts.php'); ?>

</body>

</html>