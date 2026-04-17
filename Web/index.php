<?php
session_start();
if (!isset($_SESSION['denboraldia'])) {
    $_SESSION['denboraldia'] = "2024";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="irudiak/Ikono-removebg-preview.png" type="image/x-icon">
    <link rel="stylesheet" href="estiloa/nireestiloa.css">
    <title>FNFS - Hasiera</title>
</head>

<body>
    <header>
        <div class="header-ezkerra">
            <a href="index.php" class="logo-link">
                <img src="irudiak/FNFS Logo blanco transparente.png" alt="FNFS Logo" class="logoa">
            </a>

            <span class="denboraldi-etiketa">
                <?php echo $_SESSION['denboraldia']; ?> Denboraldia
            </span>
        </div>

        <nav>
            <?php if (isset($_SESSION["tipoUsuario"]) && $_SESSION["tipoUsuario"] === 'presidentea'): ?>
                <div class="menuBotoia"><a href="iritziak.php">Iritziak</a></div>
            <?php endif; ?>

            <?php if (isset($_SESSION["tipoUsuario"]) && $_SESSION["tipoUsuario"] === 'entrenatzailea'): ?>
                <div class="menuBotoia"><a href="kontaktua.php">FeedBack</a></div>
            <?php endif; ?>

            <?php if (isset($_SESSION["tipoUsuario"]) && $_SESSION["tipoUsuario"] === 'administratzailea'): ?>
                <div class="menuBotoia"><a href="erabiltzaileak.php">Erabiltzaileak</a></div>
            <?php endif; ?>

            <div class="menuBotoia"><a href="index.php">Hasiera</a></div>
            <div class="menuBotoia"><a href="sailkapena.php">Sailkapena</a></div>
            <div class="menuBotoia"><a href="partiduak.php">Partiduak</a></div>
        </nav>

        <div class="saioa-kontenedorea">
            <?php if (!isset($_SESSION["nombreUsuario"])): ?>
                <a href="login.php" class="hasi-saioa-botoia">Saioa Hasi</a>
            <?php else: ?>
                <span class="erabiltzaile-testua">Kaixo, <?php echo $_SESSION["nombreUsuario"]; ?></span>
                <a href="itxi.php" class="hasi-saioa-botoia">Itxi Saioa</a>
            <?php endif; ?>
        </div>
    </header>
    <main>
        <section>
            <article>
                <h1 class="hasierakoTitulua">Nortzuk Gara?</h1>
                <div class="hasieraArtikulo">
                    <img src="irudiak/PortadaIrudi.jpeg" alt="logo">
                    <p>
                        Ongi etorri FNFS-ra. Gu areto futbola antolatu, sustatu eta garatzeaz arduratzen den federazioa
                        gara. Gure helburu nagusia kirol honenganako pasioa bazter guztietara zabaltzea da, oinarrizko
                        mailetatik hasi eta kategoria gorenetaraino. Uste irmoa dugu kirola gizartea eraldatzeko eta
                        pertsonak batzeko tresna indartsua dela, eta horregatik, kalitatezko lehiaketak eskaintzeko lan
                        egiten dugu egunero, beti ere gure kideen gozamena lehenetsiz.
                        <br><br>
                        Gure jardunaren ardatza kantxan ematen den jokoa baino askoz haratago doa. FNFS-n talde-lana,
                        kiroltasuna, errespetua eta esfortzua bezalako oinarrizko balioak bultzatzen ditugu. Jokalarien
                        garapen integrala bilatzen dugu, arlo fisikoan zein pertsonalean hazteko aukera eskainiz, eta
                        guztiontzako gune seguru, inklusibo eta parekide bat bermatuz. Areto futbola ez da soilik baloi
                        bat ate batean sartzea; laguntasuna, disziplina eta ilusioa partekatzea da.
                        <br><br>
                        Beraz, jokalaria, entrenatzailea, epailea zein zalea izan, hemen zure etxea aurkituko duzu. Gure
                        txapelketetan parte hartzera, gure proiektuetan murgiltzera eta astebururo kantxako emozio oro
                        gurekin partekatzera gonbidatzen zaitugu. Egin bat gure komunitatearekin, jantzi zapatilak eta
                        bizi areto futbola gurekin!
                    </p>
                </div>
            </article>
            <article>
                <h1 class="hasierakoTitulua">Highlights</h1>
                <div class="hasieraArtikulo">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/BKzfnyR_QZ8?si=sf311o9hboDDu8kK"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    <br>
                    <p>Pista gainean dena ematen dute taldeek, eta hemen daukazu horren froga. Gozatu asteburuko gol,
                        geldiketa eta izkiratze (regates) ikusgarrienekin. Hau da gure liga, hau da gure pasioa!</p>
                </div>
            </article>
        </section>
    </main>
    <footer>
        <div class="kontaktua">
            <a href="https://www.google.com/maps/place/P.%C2%BA+de+la+Castellana,+151,+4%C2%BAB,+Tetu%C3%A1n,+28046+Madrid/@40.4608003,-3.6930766,663m/data=!3m2!1e3!4b1!4m6!3m5!1s0xd42291b0928b133:0x9b65449e87642aa0!8m2!3d40.4608003!4d-3.6905017!16s%2Fg%2F11lkzhrg_k?entry=ttu&g_ep=EgoyMDI1MTAwNi4wIKXMDSoASAFQAw%3D%3D"
                target="_blank" class="">P.º de la Castellana, 151, 4ºB</a>
            <p>+34 91 350 25 01</p>
            <a href="mailto:fnfs@fnfs.es" class="">fnfs@fnfs.es</a>
        </div>
        <div class="links">
            <a href="https://www.instagram.com/lnfs89" class="icono instagram" target="_blank"></a>
            <a href="https://www.youtube.com/channel/UCiSSamUOaeCFQS9MXVqhOPw" class="icono youtube"
                target="_blank"></a>
            <a href="https://www.tiktok.com/@lnfs89?lang=es" class="icono tiktok" target="_blank"></a>
        </div>
    </footer>
</body>

</html>