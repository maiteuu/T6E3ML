<?php
session_start();

// XML fitxategi nagusia kargatu (partiduak irakurtzeko)
$xmlOriginal = new DOMDocument();
$xmlOriginal->load("xml/users.xml");
$xpath = new DOMXPath($xmlOriginal);

// 1. DENBORALDIA KUDEATU
if (isset($_POST['urtea'])) {
    $_SESSION['denboraldia'] = $_POST['urtea'];
}
$urtea = isset($_SESSION['denboraldia']) ? $_SESSION['denboraldia'] : '2024';

// Lortu XML-an dauden urte guztiak combobox-erako
$urteak_nodos = $xpath->query("//denboraldiak/denboraldia/Urtea");
$urte_zerrenda = [];
foreach ($urteak_nodos as $nodo) {
    $urte_zerrenda[] = $nodo->nodeValue;
}
$urte_zerrenda = array_unique($urte_zerrenda);
rsort($urte_zerrenda);

// 2. TALDEAK HASIERATU (0 punturekin)
$taldeak = [];
$talde_nodos = $xpath->query("//taldeak/taldea/Talde_Izena");
foreach ($talde_nodos as $nodo) {
    $izena = trim($nodo->nodeValue);
    $taldeak[$izena] = [
        'izena' => $izena, 'J' => 0, 'G' => 0, 'E' => 0, 'P' => 0,
        'GF' => 0, 'GC' => 0, 'DG' => 0, 'PTS' => 0
    ];
}

// 3. PARTIDUAK IRAKURRI ETA PUNTUAK KALKULATU (Urte horretakoak bakarrik)
$partiduak = $xpath->query("//denboraldia[Urtea='$urtea']/jaurdunaldiak/jaurdunaldia/partiduak/partidua");

foreach ($partiduak as $partidua) {
    $lok = trim($partidua->getElementsByTagName('Talde_Lok')->item(0)->nodeValue);
    $bis = trim($partidua->getElementsByTagName('Talde_Bis')->item(0)->nodeValue);
    $g_lok = (int)$partidua->getElementsByTagName('Emaitza_Lok')->item(0)->nodeValue;
    $g_bis = (int)$partidua->getElementsByTagName('Emaitza_Bis')->item(0)->nodeValue;

    // Suposatzen dugu emaitza biak 0 badira eta partidu bat jokatu gabe badago... 
    // Baina momentuz XMLko partidu guztiak prozesatuko ditugu.
    
    // Partidu jokatua (+1)
    $taldeak[$lok]['J']++;
    $taldeak[$bis]['J']++;
    
    // Golak
    $taldeak[$lok]['GF'] += $g_lok;
    $taldeak[$lok]['GC'] += $g_bis;
    $taldeak[$bis]['GF'] += $g_bis;
    $taldeak[$bis]['GC'] += $g_lok;

    // Emaitzaren araberako puntuak
    if ($g_lok > $g_bis) { 
        if (isset($taldeak[$lok])) { $taldeak[$lok]['G']++; $taldeak[$lok]['PTS'] += 3; }
        if (isset($taldeak[$bis])) { $taldeak[$bis]['P']++; }
    } elseif ($g_lok < $g_bis) { 
        if (isset($taldeak[$bis])) { $taldeak[$bis]['G']++; $taldeak[$bis]['PTS'] += 3; }
        if (isset($taldeak[$lok])) { $taldeak[$lok]['P']++; }
    } else { 
        if (isset($taldeak[$lok])) { $taldeak[$lok]['E']++; $taldeak[$lok]['PTS'] += 1; }
        if (isset($taldeak[$bis])) { $taldeak[$bis]['E']++; $taldeak[$bis]['PTS'] += 1; }
    }
}

// Gol Diferentzia kalkulatu
foreach ($taldeak as &$taldea) {
    $taldea['DG'] = $taldea['GF'] - $taldea['GC'];
}

// 4. ORDENATU (Lehenengo Puntuak, gero Gol Diferentzia)
usort($taldeak, function($a, $b) {
    if ($a['PTS'] == $b['PTS']) {
        return $b['DG'] <=> $a['DG']; // Berdinketa badago, DG handiena lehenengo
    }
    return $b['PTS'] <=> $a['PTS']; // Bestela PTS handiena lehenengo
});

// 5. XML BERRI BAT SORTU MEMORIAN XSL-ri PASATZEKO
$xmlKalkulatua = new DOMDocument('1.0', 'UTF-8');
$root = $xmlKalkulatua->createElement('sailkapen_taula');
$xmlKalkulatua->appendChild($root);

foreach ($taldeak as $pos => $t) {
    // Bakarrik erakutsiko ditugu partiduren bat jokatu duten taldeak urte horretan
    // Edo denak erakutsi nahi badituzu, kendu if hau.
    if ($t['J'] > 0) { 
        $nodo_taldea = $xmlKalkulatua->createElement('taldea');
        $nodo_taldea->appendChild($xmlKalkulatua->createElement('posizioa', $pos + 1));
        $nodo_taldea->appendChild($xmlKalkulatua->createElement('izena', $t['izena']));
        $nodo_taldea->appendChild($xmlKalkulatua->createElement('jokatuak', $t['J']));
        $nodo_taldea->appendChild($xmlKalkulatua->createElement('irabaziak', $t['G']));
        $nodo_taldea->appendChild($xmlKalkulatua->createElement('berdinduak', $t['E']));
        $nodo_taldea->appendChild($xmlKalkulatua->createElement('galduak', $t['P']));
        $nodo_taldea->appendChild($xmlKalkulatua->createElement('alde', $t['GF']));
        $nodo_taldea->appendChild($xmlKalkulatua->createElement('aurka', $t['GC']));
        $nodo_taldea->appendChild($xmlKalkulatua->createElement('diferentzia', $t['DG'] > 0 ? '+'.$t['DG'] : $t['DG']));
        $nodo_taldea->appendChild($xmlKalkulatua->createElement('puntuak', $t['PTS']));
        $root->appendChild($nodo_taldea);
    }
}
?>
<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="irudiak/Ikono-removebg-preview.png" type="image/x-icon">
    <link rel="stylesheet" href="estiloa/nireestiloa.css">
    <title>FNFS - Sailkapena</title>
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
                <span class="erabiltzaile-testua">Kaixo, <?php echo $_SESSION["nombreUsuario"]; ?>
                    (<?php echo $_SESSION["tipoUsuario"]; ?>)</span>
                <a href="itxi.php" class="hasi-saioa-botoia">Itxi Saioa</a>
            <?php endif; ?>
        </div>
    </header>

    <main>
        <div class="sailkapena-container">
            <h1 class="sailkapena-izenburua">SAILKAPENA - <?php echo $urtea; ?> Denboraldia</h1>
            
            <form method="POST" action="sailkapena.php" class="form-urtea">
                <label for="urtea">Aukeratu denboraldia:</label>
                <select name="urtea" id="urtea" onchange="this.form.submit()">
                    <?php foreach ($urte_zerrenda as $u): ?>
                        <option value="<?php echo $u; ?>" <?php echo ($u == $urtea) ? 'selected' : ''; ?>>
                            <?php echo $u; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>

            <?php
            // XSLT-ri GURE XML BERRIA PASATZEN DIOGU
            $xsl = new DOMDocument();
            $xsl->load("xml/sailkapena.xsl"); 

            $proc = new XSLTProcessor();
            $proc->importStyleSheet($xsl);
            
            // Hemen transformToXML funtzioari guk memorian sortutako XML berria pasatzen diogu
            echo $proc->transformToXML($xmlKalkulatua);
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