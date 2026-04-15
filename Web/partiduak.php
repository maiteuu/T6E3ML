<?php
session_start();

if (isset($_POST['urtea'])) {
    $_SESSION['denboraldia'] = $_POST['urtea'];
}

if (!isset($_SESSION['denboraldia'])) {
    $_SESSION['denboraldia'] = "2024"; 
}

$urtea_hautatuta = $_SESSION['denboraldia'];
?>
<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="irudiak/Ikono-removebg-preview.png" type="image/x-icon">
    <link rel="stylesheet" href="estiloa/nireestiloa.css">
    <title>FNFS - Partiduak</title>
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

    <main class="partiduak-main">
        <div class="titulu-kaxa-zentratua">
            <h1 class="titulu-gorri-pilula">PARTIDUAK - <?php echo $urtea_hautatuta; ?></h1>
        </div>

        <div class="filtro-kaxa">
            <form action="partiduak.php" method="POST" class="denboraldia-form">
                <label for="urtea">Denboraldia aldatu:</label>
                <select name="urtea" id="urtea" onchange="this.form.submit()">
                    <option value="2024" <?php if($urtea_hautatuta == "2024") echo "selected"; ?>>2024</option>
                    <option value="2025" <?php if($urtea_hautatuta == "2025") echo "selected"; ?>>2025</option>
                </select>
            </form>
        </div>

        <div class="partiduak-container">
            <?php
            $fitxategia = "xml/users.xml";
            if (file_exists($fitxategia)) {
                $xmlDoc = new DOMDocument();
                $xmlDoc->load($fitxategia);
                $xpath = new DOMXPath($xmlDoc);

                // Buscamos solo el nodo de la temporada elegida
                $query = "/fnfs/denboraldiak/denboraldia[Urtea='$urtea_hautatuta']";
                $nodoa = $xpath->query($query)->item(0);

                if ($nodoa) {
                    // Creamos un XML temporal para la transformación
                    $tempXml = new DOMDocument('1.0', 'UTF-8');
                    $tempXml->appendChild($tempXml->importNode($nodoa, true));

                    $xsl = new DOMDocument();
                    $xsl->load("xml/partiduak.xsl");

                    $proc = new XSLTProcessor();
                    $proc->importStyleSheet($xsl);
                    echo $proc->transformToXML($tempXml);
                } else {
                    echo "<p class='errorea'>Ez da daturik aurkitu denboraldia honetarako.</p>";
                }
            }
            ?>
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