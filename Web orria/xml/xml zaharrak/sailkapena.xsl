<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" encoding="UTF-8" indent="yes" />

    <xsl:template match="/">
        <section class="w3-card-4 w3-container w3-round-large Sailkapena">
            <h2>Sailkapena</h2>

            <div class="w3-container w3-padding">
                <label for="denboraldi-selector">Aukeratu Denboraldia: </label>
                <select id="denboraldi-selector" class="w3-select w3-border">
                    <xsl:for-each select="denboraldiak/denboraldi">
                        <xsl:sort select="@id" data-type="number" order="ascending" />
                        <option
                            value="temp-{@id}">
                            <xsl:value-of select="izena" />
                        </option>
                    </xsl:for-each>
                </select>
            </div>

            <article>
                <xsl:for-each select="denboraldiak/denboraldi">
                    <div id="temp-{@id}" class="denboraldi-taula" style="display:none;">

                        <table class="sailkapenaTabla w3-table-all">
                            <thead>
                                <tr>
                                    <th>Posisioa</th>
                                    <th>Taldea</th>
                                    <th>Puntuak</th>
                                    <th>Aldeko Golak</th>
                                    <th>Kontrako Golak</th>
                                </tr>
                            </thead>
                            <tbody>
                                <xsl:for-each select="taldea">
                                    <xsl:sort select="ligako_puntuak" data-type="number"
                                        order="descending" />
                                    <xsl:sort
                                        select="aldeko_golak - kontrako_golak" data-type="number"
                                        order="descending" />
                                    <xsl:sort select="aldeko_golak"
                                        data-type="number" order="descending" />
                                    <xsl:sort
                                        select="kontrako_golak" data-type="number" order="ascending" />
                                    <xsl:sort
                                        select="izena" order="ascending" />

                                    <tr>
                                        <td class="posisioa">
                                            <h1><xsl:value-of select="position()" />.</h1>
                                        </td>
                                        <td>
                                            <div class="sailkapen_talde">
                                                <img src="irudiak/eskutua/{irudia}" alt="Eskutua" />
                                                <xsl:value-of select="izena" />
                                            </div>
                                        </td>
                                        <td>
                                            <xsl:value-of select="ligako_puntuak" />
                                        </td>
                                        <td>
                                            <xsl:value-of select="aldeko_golak" />
                                        </td>
                                        <td>
                                            <xsl:value-of select="kontrako_golak" />
                                        </td>
                                    </tr>
                                </xsl:for-each>
                            </tbody>
                        </table>
                    </div>
                </xsl:for-each>
            </article>
        </section>
    </xsl:template>
</xsl:stylesheet>