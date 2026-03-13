// --- FUNTZIO GLOBALAK (HTML-tik eta edonondik deitzeko) ---

// 1. XML KARGATZAILEA
function kargatuXML(xmlPath, xslPath, callback) {
    $.ajax({
        type: "GET",
        url: xmlPath,
        dataType: "xml",
        success: function (xml) {
            $.ajax({
                type: "GET",
                url: xslPath,
                dataType: "xml",
                success: function (xsl) {
                    try {
                        var xsltProcessor = new XSLTProcessor();
                        xsltProcessor.importStylesheet(xsl);
                        var resultDocument = xsltProcessor.transformToDocument(xml);
                        var resultHtml = new XMLSerializer().serializeToString(resultDocument);

                        $("main").html(resultHtml);

                        if (callback) callback();

                    } catch (e) {
                        console.error("Errorea XSLT transformazioan:", e);
                        $("main").html("<p>Errorea datuak kargatzean.</p>");
                    }
                },
                error: function () { console.log("Errorea XSL kargatzean: " + xslPath); }
            });
        },
        error: function () { console.log("Errorea XML kargatzean: " + xmlPath); }
    });
}

// 2. SELECTORRA AKTIBATU
function aktibatuSelectorra() {
    $(".tabla-temporada").hide();
    var idHasiera = $("#temporada-selector").val();
    if (idHasiera) {
        $("#" + idHasiera).show();
    }
    $("#temporada-selector").on("change", function () {
        var idAukeratua = $(this).val();
        $(".tabla-temporada").hide();
        $("#" + idAukeratua).fadeIn(300);
    });
}

// 3. PARTIDUA IKUSI (Honek irekitzen du fitxa)
function ikusiPartidua(id) {
    console.log("Cargando partido ID: " + id);

    $.ajax({
        type: "GET",
        url: "xml/federazioa.xml",
        dataType: "xml",
        success: function(xml) {
            $.ajax({
                type: "GET",
                url: "xml/partidua.xsl",
                dataType: "xml",
                success: function(xsl) {
                    var xsltProcessor = new XSLTProcessor();
                    xsltProcessor.importStylesheet(xsl);
                    
                    // IMPORTANTE: El parámetro se debe llamar "partiduId"
                    xsltProcessor.setParameter(null, "partiduId", id);
                    
                    var resultDocument = xsltProcessor.transformToDocument(xml);
                    var resultHtml = new XMLSerializer().serializeToString(resultDocument);
                    
                    $("main").html(resultHtml);
                    window.scrollTo(0, 0);
                }
            });
        }
    });
}

// 4. ATZERA BUELTATU
function atzeraJardunaldietara() {
    $("#jornada").click();
}


// --- DOKUMENTUA KARGATZEAN (EVENT LISTENERS) ---
$(document).ready(function () {

    // Hasierako karga
    $("main").load("hasiera.html");

    $("#hasieraLogo, #hasieraNav").on("click", function (e) {
        e.preventDefault();
        $("main").load("hasiera.html");
        document.title = "FNFS - Hasiera";
    });

    // Menuaren botoiak
    $("#taldeak").on("click", function () {
        document.title = "FNFS - Taldeak";
        kargatuXML("xml/federazioa.xml", "xml/taldeak.xsl");
    });

    $("#berriak").on("click", function () {
        document.title = "FNFS - Berriak";
        kargatuXML("xml/berriak.xml", "xml/berriak.xsl");
    });

    $("#jornada").on("click", function () {
        document.title = "FNFS - Jardunaldi";
        kargatuXML("xml/federazioa.xml", "xml/jardunaldia.xsl", aktibatuSelectorra);
    });

    $("#sailkapena").on("click", function () {
        document.title = "FNFS - Sailkapena";
        kargatuXML("xml/federazioa.xml", "xml/sailkapena.xsl", aktibatuSelectorra);
    });

});