<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" encoding="UTF-8" indent="yes" />

    <xsl:template match="/">
        <div class="iritziak-kontenedorea">
            <xsl:for-each select="iradokizunak/iradokizuna">
                <div class="iritzi-txartela">
                    
                    <div class="iritzi-goiburua">
                        <img src="irudiak/foto_perfil_predefinido.webp" alt="Erabiltzailea" class="iritzi-avatar" />
                        <span class="goiburua-testua">
                            <xsl:value-of select="izena" />
                            <xsl:text> </xsl:text>
                            <xsl:value-of select="abizena" />
                            <xsl:text> - </xsl:text>
                            <xsl:value-of select="data" />
                        </span>
                    </div>
                    
                    <div class="iritzi-gorputza">
                        <p class="iritzi-gaia">
                            <strong>Gaia: </strong><xsl:value-of select="gaia" />
                        </p>
                        <p class="iritzi-mezua">
                            <xsl:value-of select="mezua" />
                        </p>
                    </div>

                </div>
            </xsl:for-each>
        </div>
    </xsl:template>
</xsl:stylesheet>