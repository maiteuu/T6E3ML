<?php 
session_start(); 

// 1. POST bidez datorren taldearen izena jasotzen dugu
$talde_izena = isset($_POST['taldea']) ? $_POST['taldea'] : '';

// 2. Talderik aukeratu ez bada (adibidez, menutik zuzenean sartuta), sailkapenera bidali
// Geroago hemen "Talde guztien zerrenda" bat jarri dezakezu nahi baduzu.
if (empty($talde_izena)) {
    header("Location: sailkapena.php");
    exit(); 
}
?>
<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="irudiak/Ikono-removebg-preview.png" type="image/x-icon">
    <link rel="stylesheet" href="estiloa/nireestiloa.css">
    <title>FNFS - <?php echo htmlspecialchars($talde_izena); ?></title>
</head>

<body>
    <header>
        <a href="index.php" class="logo-link">
            <img src="irudiak/FNFS Logo blanco transparente.png" alt="FNFS Logo" class="logoa">
        </a>
        
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
                <span class="erabiltzaile-testua">Kaixo, <?php echo $_SESSION["nombreUsuario"]; ?> (<?php echo $_SESSION["tipoUsuario"]; ?>)</span>
                <a href="itxi.php" class="hasi-saioa-botoia">Itxi Saioa</a>
            <?php endif; ?>
        </div>
    </header>

    <main class="jokalariak-main-orria">
        <div class="titulu-kaxa-zentratua">
            <h1 class="titulu-gorri-pilula"><?php echo htmlspecialchars($talde_izena); ?></h1>
        </div>

        <?php
        $fitxategia = 'xml/users.xml';

        if (file_exists($fitxategia)) {
            $xmlOriginal = new DOMDocument();
            $xmlOriginal->load($fitxategia);
            $xpath = new DOMXPath($xmlOriginal);
            
            // Bilatu taldearen informazioa
            $taldeaNode = $xpath->query("//taldeak/taldea[Talde_Izena='$talde_izena']")->item(0);
            // Bilatu talde honetako jokalariak
            $jokalariakNodes = $xpath->query("//jokalariak/jokalaria[Talde_Izena='$talde_izena']");

            if ($taldeaNode) {
                // XML berri bat sortu XSL-ari pasatzeko (Profil osoa)
                $xmlKalkulatua = new DOMDocument('1.0', 'UTF-8');
                $root = $xmlKalkulatua->createElement('talde_profila');
                $xmlKalkulatua->appendChild($root);

                // Taldea gehitu
                $root->appendChild($xmlKalkulatua->importNode($taldeaNode, true));

                // Jokalariak gehitu
                $jok_container = $xmlKalkulatua->createElement('jokalari_zerrenda');
                foreach ($jokalariakNodes as $jok) {
                    $jok_container->appendChild($xmlKalkulatua->importNode($jok, true));
                }
                $root->appendChild($jok_container);

                // XSLT kargatu (Orain 'taldeak.xsl' deitzen da)
                $xsl = new DOMDocument();
                $xsl->load("xml/taldeak.xsl");

                $proc = new XSLTProcessor();
                $proc->importStyleSheet($xsl);
                echo $proc->transformToXML($xmlKalkulatua);

            } else {
                echo '<p class="errorea">Ez da taldearen informaziorik aurkitu XML fitxategian.</p>';
            }
        } else {
            echo '<p class="errorea">Errorea: Ezin izan da XML fitxategia kargatu.</p>';
        }
        ?>

        <div class="itzuli-kaxa">
            <a href="sailkapena.php" class="bueltatu-botoia">Sailkapenera Itzuli</a>
        </div>
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