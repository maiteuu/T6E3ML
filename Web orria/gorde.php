<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $gaia = $_POST['gaia'];
    $mezua = $_POST['mezua'];
    $izena = $_POST['izena'];
    $abizena = $_POST['abizena'];
    $email = $_POST['email'];
    $telefonoa = $_POST['telefonoa'];
    
    // Eguna eta ordua gordetzen ditugu
    $data_ordua = date('Y-m-d H:i:s');

    $fitxategia = 'xml/iradokizunak.xml';

    // Fitxategia existitzen den begiratzen dugu
    if (file_exists($fitxategia)) {
        $xml = simplexml_load_file($fitxategia);
    } else {
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><iradokizunak></iradokizunak>');
    }

    $iradokizun_berria = $xml->addChild('iradokizuna');
    $iradokizun_berria->addChild('data', $data_ordua);
    $iradokizun_berria->addChild('gaia', $gaia);
    $iradokizun_berria->addChild('mezua', $mezua);
    $iradokizun_berria->addChild('izena', $izena);
    $iradokizun_berria->addChild('abizena', $abizena);
    $iradokizun_berria->addChild('email', $email);
    $iradokizun_berria->addChild('telefonoa', $telefonoa);

    
    // XML dokumentu berri bat prestatzen dugu formatua emateko
    $dom = new DOMDocument('1.0');
    // Aurretik zeuden zuriuneak ahazteko esaten diogu
    $dom->preserveWhiteSpace = false;
    // Saltoak eta tabulazioak aktibatzen ditugu
    $dom->formatOutput = true;

    $dom->loadXML($xml->asXML());
    
    $dom->save($fitxategia);

    header("Location: kontaktu.php?egoera=ondo");
    exit();

} else {
    // Norbait formularioa bete gabe sartzen bada
    header("Location: index.php");
    exit();
}
?>