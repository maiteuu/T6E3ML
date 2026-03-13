<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" encoding="UTF-8" indent="yes" />

    <xsl:template match="/">
        <div class="w3-container w3-center w3-padding-32">
            <h2 style="color: #871521; font-weight:bold; text-transform:uppercase; letter-spacing:2px; text-shadow: 1px 1px 0 #ddd;">
                Sailkapena
            </h2>
            <div class="w3-center">
                <span style="display:inline-block; width: 80px; height: 4px; background-color: #871521; border-radius: 2px;"></span>
            </div>
        </div>
        <section class="w3-card-4 w3-container w3-round-large Sailkapena"
            style="margin: 20px auto; padding: 20px; background-color: white; max-width: 1200px;">

            <div class="w3-container w3-padding w3-center">
                <label for="temporada-selector" style="font-weight:bold; margin-right:10px;">Aukeratu Denboraldia: </label>
                <select id="temporada-selector" class="w3-select w3-border"
                    style="width: 200px; display:inline-block;">
                    <xsl:for-each select="//Denboraldia">
                        <xsl:sort select="@urtea" data-type="number" order="descending" />
                        <option value="temp-{@urtea}">
                            <xsl:value-of select="@urtea" />/<xsl:value-of select="@urtea + 1" />
                        </option>
                    </xsl:for-each>
                </select>
            </div>

            <article>
                <xsl:for-each select="//Denboraldia">
                    <div id="temp-{@urtea}" class="tabla-temporada"
                        style="display:none; animation: fadeIn 0.5s;">

                        <h3 class="w3-center"><xsl:value-of select="@urtea" /> - <xsl:value-of select="@urtea + 1" /> Denboraldia</h3>

                        <div class="w3-responsive">

                            <table class="w3-table-all w3-hoverable w3-small">
                                <thead>
                                    <tr class="w3-light-grey">
                                        <th>Pos</th>
                                        <th>Taldea</th>
                                        <th>Pt</th>
                                        <th>J</th>
                                        
                                        <th class="w3-hide-small">I</th>
                                        <th class="w3-hide-small">B</th>
                                        <th class="w3-hide-small">G</th>
                                        <th class="w3-hide-small">AG</th>
                                        <th class="w3-hide-small">KG</th>
                                        <th class="w3-hide-small">DG</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <xsl:for-each select="Sailkapena/Lerroa">
                                        <tr>
                                            <td class="posizioa" style="font-weight:bold;">
                                                <xsl:if test="Posizioa &lt;= 4">
                                                    <span style="color:green;">
                                                        <xsl:value-of select="Posizioa" />
                                                    </span>
                                                </xsl:if>
                                                <xsl:if test="Posizioa > 4">
                                                    <xsl:value-of select="Posizioa" />
                                                </xsl:if>
                                            </td>

                                            <td style="display: flex; align-items: center;">
                                                <img src="irudiak/eskutua/{Ezkutua}.png" alt=""
                                                    style="width:25px; height:25px; margin-right:10px;"
                                                    onerror="this.style.display='none'" />
                                                <span style="font-weight:bold;">
                                                    <xsl:value-of select="Taldea" />
                                                </span>
                                            </td>

                                            <td>
                                                <strong>
                                                    <xsl:value-of select="Puntuak" />
                                                </strong>
                                            </td>
                                            
                                            <td>
                                                <xsl:value-of select="Jokatuak" />
                                            </td>
                                            
                                            <td class="w3-hide-small">
                                                <xsl:value-of select="Irabaziak" />
                                            </td>
                                            <td class="w3-hide-small">
                                                <xsl:value-of select="Berdinduak" />
                                            </td>
                                            <td class="w3-hide-small">
                                                <xsl:value-of select="Galduak" />
                                            </td>
                                            <td class="w3-hide-small">
                                                <xsl:value-of select="AldekoGolak" />
                                            </td>
                                            <td class="w3-hide-small">
                                                <xsl:value-of select="AurkakoGolak" />
                                            </td>
                                            <td class="w3-hide-small">
                                                <xsl:value-of select="AldekoGolak - AurkakoGolak" />
                                            </td>
                                        </tr>
                                    </xsl:for-each>
                                </tbody>
                            </table>
                        </div>
                        <xsl:if test="not(Sailkapena/Lerroa)">
                            <p class="w3-center w3-text-grey">Sailkapena ez dago erabilgarri denboraldi honetan.</p>
                        </xsl:if>
                    </div>
                </xsl:for-each>
            </article>
        </section>
    </xsl:template>
</xsl:stylesheet>