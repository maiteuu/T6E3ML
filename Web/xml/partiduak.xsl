<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" encoding="UTF-8" indent="yes" />

    <xsl:template match="/">
        <div class="jornadas-lista">
            <xsl:for-each select="denboraldia/jaurdunaldiak/jaurdunaldia">
                <div class="jaurdunaldia-blokea">
                    <h2 class="jaurdunaldia-izenburua">
                        <xsl:value-of select="@zenbakia"/>. JARDUNALDIA
                    </h2>
                    
                    <table class="partiduak-taula">
                        <thead>
                            <tr>
                                <th>Etxean</th>
                                <th>Emaitza</th>
                                <th>Kanpoan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <xsl:for-each select="partiduak/partidua">
                                <tr>
                                    <td class="talde-izena"><xsl:value-of select="Talde_Lok"/></td>
                                    <td class="markagailua">
                                        <span class="gola"><xsl:value-of select="Emaitza_Lok"/></span>
                                        <span class="banatzailea">-</span>
                                        <span class="gola"><xsl:value-of select="Emaitza_Bis"/></span>
                                    </td>
                                    <td class="talde-izena"><xsl:value-of select="Talde_Bis"/></td>
                                </tr>
                            </xsl:for-each>
                        </tbody>
                    </table>
                </div>
            </xsl:for-each>
        </div>
    </xsl:template>
</xsl:stylesheet>