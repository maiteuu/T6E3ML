<?php session_start(); ?>
<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="irudiak/Ikono-removebg-preview.png" type="image/x-icon">
    <link rel="stylesheet" href="estiloa/nireestiloa.css">
    <title>FNFS - Taldeak</title>
</head>

<body>
    <header>
        <a href="index.php" class="logo-link">
            <img src="irudiak/FNFS Logo blanco transparente.png" alt="FNFS Logo" class="logoa">
        </a>
        
        <nav>
            <div class="menuBotoia"><a href="kontaktu.php">Iradokizunak</a></div>
            <div class="menuBotoia"><a href="taldeak.php">Taldeak</a></div>
            <div class="menuBotoia"><a href="index.php">Hasiera</a></div>
            <div class="menuBotoia"><a href="">Sailkapena</a></div>
            <div class="menuBotoia"><a href="">Fitxaketak</a></div>
            <div class="menuBotoia"><a href="">Partiduak</a></div>
        </nav>

        <div class="saioa-kontenedorea">
            <?php if (!isset($_SESSION["nombreUsuario"])): ?>
                <a href="login.php" class="hasi-saioa-botoia">Saioa Hasi</a>
            <?php else: ?>
                <a href="itxi.php" class="hasi-saioa-botoia">Itxi Saioa</a>
            <?php endif; ?>
        </div>
    </header>

    <main class="taldeak-main-orria">
        
        <div class="titulu-kaxa-zentratua">
            <h1 class="titulu-gorri-pilula">Gure taldeak</h1>
        </div>

        <div class="taldeen-zerrenda">
            <?php
            // XML fitxategiaren izena (karpeta barruan).
            $fitxategia = 'xml/users.xml';

            // Fitxategia badagoela ziurtatu.
            if (file_exists($fitxategia)) {
                
                // XML-a kargatu.
                $xml = simplexml_load_file($fitxategia);
                $talde_guztiak = $xml->xpath('//taldeak/taldea');

                if ($talde_guztiak !== false) {
                    foreach ($talde_guztiak as $taldea) {
                        
                        // Datuak hartu.
                        $izena = $taldea->Talde_Izena;
                        $logoa = $taldea->logoa;
                        $deskribapena = $taldea->deskribapena;

                        echo '<div class="talde-blokea">';
                            echo '<div class="talde-goiko-aldea">';
                                
                                // Ezkerraldea: Logoa formulario baten barruan.
                                echo '<div class="talde-logo-kaxa">';
                                    // Formularioa POST bidez bidaltzeko.
                                    echo '<form action="jokalariak.php" method="POST" class="ezkutu-formularioa">';
                                        
                                        // Botoiak berak bidaltzen du taldearen izena (name eta value erabiliz).
                                        echo '<button type="submit" name="taldea" value="' . $izena . '" class="ezkutu-botoia">';
                                            echo '<img src="' . $logoa . '" alt="Logoa" class="talde-ezkutu-klikagarria">';
                                        echo '</button>';
                                        
                                    echo '</form>';
                                echo '</div>';
                                
                                // Eskuinaldea: Izena eta testua.
                                echo '<div class="talde-informazioa">';
                                    echo '<h2 class="talde-izen-grisa">' . $izena . '</h2>';
                                    echo '<p class="talde-testua">' . $deskribapena . '</p>';
                                echo '</div>';

                            echo '</div>'; // Goiko aldearen amaiera.
                        echo '</div>'; // Blokearen amaiera.
                    }
                } else {
                    echo '<p>Ez da talderik aurkitu XML fitxategian.</p>';
                }
            } else {
                echo '<p>Errorea: Ez da talderik aurkitu (XML fitxategia falta da).</p>';
            }
            ?>
        </div>

    </main>

    <footer>
        <div class="kontaktua">
            <a href="https://www.google.com/maps/place/P.%C2%BA+de+la+Castellana,+151,+4%C2%BAB,+Tetu%C3%A1n,+28046+Madrid/@40.4608003,-3.6930766,663m/data=!3m2!1e3!4b1!4m6!3m5!1s0xd42291b0928b133:0x9b65449e87642aa0!8m2!3d40.4608003!4d-3.6905017!16s%2Fg%2F11lkzhrg_k?entry=ttu&g_ep=EgoyMDI1MTAwNi4wIKXMDSoASAFQAw%3D%3D" target="_blank">P.º de la Castellana, 151, 4ºB</a>
            <p>+34 91 350 25 01</p>
            <a href="mailto:fnfs@fnfs.es">fnfs@fnfs.es</a>
        </div>
        <div class="links">
            <a href="https://www.instagram.com/lnfs89" class="icono instagram" target="_blank"></a>
            <a href="https://www.youtube.com/channel/UCiSSamUOaeCFQS9MXVqhOPw" class="icono youtube" target="_blank"></a>
            <a href="https://www.tiktok.com/@lnfs89?lang=es" class="icono tiktok" target="_blank"></a>
        </div>
    </footer>
</body>
</html>