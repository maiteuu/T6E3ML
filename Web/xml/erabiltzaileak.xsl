<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" encoding="UTF-8" indent="yes" />

    <xsl:template match="/">
        <div class="taula-kontenedorea">
            <table class="erabiltzaile-taula">
                <thead>
                    <tr>
                        <th>Erabiltzailea</th>
                        <th>Funtzioa (Rola)</th>
                    </tr>
                </thead>
                <tbody>
                    <xsl:for-each select="/fnfs/erabiltzaileak/erabiltzailea">
                        <tr>
                            <td>
                                <div class="erabiltzaile-info">
                                    <img src="irudiak/foto_perfil_predefinido.webp" alt="Avatar" class="avatar-txikia" />
                                    <strong><xsl:value-of select="erabiltzaile_izena" /></strong>
                                </div>
                            </td>
                            <td>
                                <span>
                                    <xsl:attribute name="class">
                                        rol-pilula <xsl:value-of select="erabiltzaile_mota" />
                                    </xsl:attribute>
                                    
                                    <xsl:value-of select="erabiltzaile_mota" />
                                </span>
                            </td>
                        </tr>
                    </xsl:for-each>
                </tbody>
            </table>
        </div>
    </xsl:template>
</xsl:stylesheet>