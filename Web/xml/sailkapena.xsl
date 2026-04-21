<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    
    <xsl:output method="html" encoding="UTF-8" indent="yes" />

    <xsl:template match="/">
        <table class="tabla-sailkapena">
            <thead>
                <tr>
                    <th>POS</th>
                    <th>EQUIPO</th>
                    <th>J</th>
                    <th>G</th>
                    <th>E</th>
                    <th>P</th>
                    <th>GF</th>
                    <th>GC</th>
                    <th>DG</th>
                    <th>PTOS</th>
                </tr>
            </thead>
            <tbody>
                <xsl:for-each select="sailkapen_taula/taldea">
                    <tr>
                        <td><xsl:value-of select="posizioa" /></td>
                        <td>
                            <form action="taldeak.php" method="POST" style="display:inline;">
                                <input type="hidden" name="taldea">
                                <xsl:attribute name="value"><xsl:value-of select="izena"/></xsl:attribute>
                                </input>
                                <button type="submit" class="tabla-link-botoia">
                                <xsl:value-of select="izena"/>
                                </button>
                            </form>
                        </td>
                        <td><xsl:value-of select="jokatuak" /></td>
                        <td><xsl:value-of select="irabaziak" /></td>
                        <td><xsl:value-of select="berdinduak" /></td>
                        <td><xsl:value-of select="galduak" /></td>
                        <td><xsl:value-of select="alde" /></td>
                        <td><xsl:value-of select="aurka" /></td>
                        <td><xsl:value-of select="diferentzia" /></td>
                        <td class="puntos-destacados"><xsl:value-of select="puntuak" /></td>
                    </tr>
                </xsl:for-each>
            </tbody>
        </table>
        
        <xsl:if test="count(sailkapen_taula/taldea) = 0">
            <div style="text-align: center; padding: 2rem; color: var(--granatea); font-weight: bold;">
                <p>Ez dago daturik denboraldi honetarako.</p>
            </div>
        </xsl:if>
    </xsl:template>
</xsl:stylesheet>