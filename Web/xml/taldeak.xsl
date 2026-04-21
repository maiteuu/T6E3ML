<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" encoding="UTF-8" indent="yes" />
    
    <xsl:decimal-format name="euro" decimal-separator="," grouping-separator="." />

    <xsl:template match="/">
        <div class="profil-kontenedorea">
            
            <div class="talde-blokea" style="border-bottom: 2px solid #e5e5e5; padding-bottom: 30px; margin-bottom: 40px;">
                <div class="talde-goiko-aldea">
                    <div class="talde-logo-kaxa">
                        <img>
                            <xsl:attribute name="src"><xsl:value-of select="talde_profila/taldea/logoa" /></xsl:attribute>
                            <xsl:attribute name="alt"><xsl:value-of select="talde_profila/taldea/Talde_Izena" /> Logo</xsl:attribute>
                            <xsl:attribute name="class">talde-ezkutu-klikagarria</xsl:attribute>
                            <xsl:attribute name="style">cursor: default; transform: none;</xsl:attribute>
                        </img>
                    </div>

                    <div class="talde-informazioa">
                        <p><strong>Sorrera:</strong> <xsl:value-of select="talde_profila/taldea/Sorrera_Data" /></p>
                        <p><strong>Presidentea:</strong> <xsl:value-of select="talde_profila/taldea/Lehendakari_Izena" /></p>
                        <p><strong>Bazkideak:</strong> <xsl:value-of select="talde_profila/taldea/N_Bazkideak" /></p>
                        <p class="talde-testua" style="margin-top: 15px;">
                            <xsl:value-of select="talde_profila/taldea/deskribapena" />
                        </p>
                    </div>
                </div>
            </div>

            <h2 class="titulu-gorri-pilula" style="font-size: 1.5rem; margin-bottom: 30px;">PLANTILLA</h2>

            <xsl:choose>
                <xsl:when test="count(talde_profila/jokalari_zerrenda/jokalaria) > 0">
                    <div class="jokalari-sarea">
                        <xsl:for-each select="talde_profila/jokalari_zerrenda/jokalaria">
                            <div class="jokalari-txartela">
                                <div class="txartel-argazki-kaxa">
                                    <img src="irudiak/fotojugador.png" alt="Jokalaria" class="txartel-argazkia" />
                                </div>
                                <div class="txartel-informazioa">
                                    <h2 class="jokalari-izena">
                                        <xsl:value-of select="Jok_Izena" />
                                        <xsl:text> </xsl:text>
                                        <xsl:value-of select="Jok_Abizena" />
                                    </h2>
                                    <p class="jokalari-datua"><strong>Posizioa:</strong> <xsl:value-of select="Posizioa" /></p>
                                    <p class="jokalari-datua"><strong>Jaioteguna:</strong> <xsl:value-of select="Jaio_Data" /></p>
                                    <p class="jokalari-datua"><strong>Prezioa:</strong> 
                                        <xsl:value-of select="format-number(Merka_Prezioa, '#.##0', 'euro')" /> €
                                    </p>
                                </div>
                            </div>
                        </xsl:for-each>
                    </div>
                </xsl:when>
                <xsl:otherwise>
                    <p style="text-align:center; font-weight:bold;">Ez dago jokalaririk talde honetan.</p>
                </xsl:otherwise>
            </xsl:choose>
        </div>
    </xsl:template>
</xsl:stylesheet>