<?php 
session_start(); 

// 1. POST bidez datorren taldearen izena jasotzen dugu
$talde_izena = isset($_POST['taldea']) ? $_POST['taldea'] : '';

// 2. Talderik aukeratu ez bada, zuzenean 'taldeak.php'-ra bidaliko dugu
if (empty($talde_izena)) {
    header("Location: taldeak.php");
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
    <title>FNFS - Jokalariak</title>
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
            <div class="menuBotoia"><a href="sailkapena.php">Sailkapena</a></div>
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

    <main class="jokalariak-main-orria">
        <?php
        echo '<div class="titulu-kaxa-zentratua">';
            echo '<h1 class="titulu-gorri-pilula">' . $talde_izena . ' - Jokalariak</h1>';
        echo '</div>';

        $fitxategia = 'xml/users.xml';

        if (file_exists($fitxategia)) {
            $xml = simplexml_load_file($fitxategia);
            
            // XPath erabiliz, talde honetako jokalariak bilatu
            $jokalariak = $xml->xpath("//jokalariak/jokalaria[Talde_Izena='$talde_izena']");

            if ($jokalariak !== false && count($jokalariak) > 0) {
                
                // TXARTELEN SAREA HASTEN DA
                echo '<div class="jokalari-sarea">'; 
                
                foreach ($jokalariak as $jokalaria) {
                    // Datuak atera
                    $izena = $jokalaria->Jok_Izena;
                    $abizena = $jokalaria->Jok_Abizena;
                    $jaio_data = $jokalaria->Jaio_Data;
                    $posizioa = $jokalaria->Posizioa;
                    $prezioa = $jokalaria->Merka_Prezioa;
                    
                    // Prezioari formatua eman
                    $prezio_formatua = number_format((float)$prezioa, 0, ',', '.');
                    
                    // Irudiaren bidea
                    $argazkia = 'irudiak/fotojugador.png';

                    // TXARTELA INPRIMATU (Argazkia ezkerraldean, testua eskuinaldean)
                    echo '<div class="jokalari-txartela">';
                        echo '<div class="txartel-argazki-kaxa">';
                            echo '<img src="' . $argazkia . '" alt="Jokalaria" class="txartel-argazkia">';
                        echo '</div>';
                        
                        echo '<div class="txartel-informazioa">';
                            echo '<h2 class="jokalari-izena">' . $izena . ' ' . $abizena . '</h2>';
                            echo '<p class="jokalari-datua"><strong>Posizioa:</strong> ' . $posizioa . '</p>';
                            echo '<p class="jokalari-datua"><strong>Jaioteguna:</strong> ' . $jaio_data . '</p>';
                            echo '<p class="jokalari-datua"><strong>Prezioa:</strong> ' . $prezio_formatua . ' €</p>';
                        echo '</div>';
                    echo '</div>';
                }
                
                echo '</div>'; // Sarea amaitu

            } else {
                echo '<p>Ez da jokalaririk aurkitu "' . $talde_izena . '" taldearentzat fitxategian.</p>';
            }
        } else {
            echo '<p>Errorea: Ezin izan da XML fitxategia kargatu.</p>';
        }

        // Itzultzeko botoia
        echo '<div class="itzuli-kaxa">';
            echo '<a href="taldeak.php" class="bueltatu-botoia">Taldeetara Itzuli</a>';
        echo '</div>';
        ?>
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