<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" encoding="UTF-8" indent="yes" />

    <xsl:template match="/">
        <div class="w3-container w3-center w3-padding-32">
            <h2
                style="color: #871521; font-weight:bold; text-transform:uppercase; letter-spacing:2px; text-shadow: 1px 1px 0 #ddd;">
        Emaitzak eta Jardunaldiak
            </h2>
            <div class="w3-center">
                <span
                    style="display:inline-block; width: 80px; height: 4px; background-color: #871521; border-radius: 2px;"></span>
            </div>
        </div>
    <section
            class="w3-center taldeFlex w3-container w3-card-4 w3-round"
            style="padding: 20px; display: flex; flex-direction: column; align-items: center; max-width: 1200px; margin: 0 auto;">


            <div class="w3-container w3-padding w3-center" style="margin-bottom: 20px;">
                <label for="temporada-selector" style="font-weight:bold; margin-right:10px;">Aukeratu
        Denboraldia: </label>
                <select id="temporada-selector" class="w3-select w3-border"
                    style="width: 200px; display:inline-block;">
                    <xsl:for-each select="//Denboraldia">
                        <xsl:sort select="@urtea" data-type="number" order="descending" />
                        <option
                            value="temp-{@urtea}">
                            <xsl:value-of select="@urtea" />/<xsl:value-of select="@urtea + 1" />
                        </option>
                    </xsl:for-each>
                </select>
            </div>

            <div id="contenedor-jardunaldiak" style="width:100%">
                <xsl:for-each select="//Denboraldia">

                    <div id="temp-{@urtea}" class="tabla-temporada" style="display:none;">

                        <h3 class="w3-text-grey">Denboraldia: <xsl:value-of select="@urtea" /></h3>

                        <xsl:for-each select="Jardunaldiak/Jardunaldi">
                            <xsl:sort select="@zenbakia" data-type="number" order="ascending" />

                            <article
                                style="margin-bottom: 30px;">
                                <div
                                    class="w3-container w3-round-large w3-card-4 w3-padding-16 cardBisuala"
                                    style="background-color: #f9f9f9;">

                                    <h4 style="color:#871521; font-weight:bold;">
                                        <xsl:value-of select="@zenbakia" />. Jardunaldia </h4>

                                    <div class="taldeFlex"
                                        style="display: flex; flex-wrap: wrap; justify-content: center; gap: 15px;">

                                        <xsl:for-each select="Partidua">

                                            <xsl:variable name="etxekoG"
                                                select="number(Emaitza/@etxekoGolak)" />
                                            <xsl:variable
                                                name="kanpokoG"
                                                select="number(Emaitza/@kanpokoGolak)" />
                                            <xsl:variable
                                                name="jokatuta" select="boolean(Emaitza)" />

                                            <div
                                                class="partidua-card w3-white w3-card-2 w3-round"
                                                style="width: 300px; padding: 10px; cursor: pointer; transition: transform 0.2s;"
                                                onclick="ikusiPartidua('{@id}')"
                                                onmouseover="this.style.transform='scale(1.02)'"
                                                onmouseout="this.style.transform='scale(1.0)'">

                                                <div
                                                    style="display: flex; justify-content: space-between; align-items: center;">

                                                    <div>
                                                        <xsl:attribute name="style"> text-align:
        center; width: 35%; <xsl:if test="$jokatuta">
                                                                <xsl:if
                                                                    test="$etxekoG &gt; $kanpokoG">font-weight:bold;
        color:#000; transform:scale(1.05);</xsl:if>
                                                                <xsl:if test="$etxekoG &lt; $kanpokoG">opacity:
        0.5;</xsl:if>
                                                            </xsl:if>
                                                        </xsl:attribute>

                                                        <img
                                                            src="irudiak/eskutua/{EtxekoEzkutua}.png"
                                                            alt="{EtxekoTaldea}"
                                                            style="width:40px; height:40px; object-fit:contain;"
                                                            onerror="this.src='irudiak/eskutua/defecto.png'" />
                                                        <p style="font-size: 0.8em; margin: 5px 0;">
                                                            <xsl:value-of select="EtxekoTaldea" />
                                                        </p>
                                                    </div>

                                                    <div style="text-align: center; width: 30%;">
                                                        <xsl:choose>
                                                            <xsl:when test="Emaitza">
                                                                <span
                                                                    style="font-weight: bold; font-size: 1.3em; color: #333; background:#eee; padding:5px 10px; border-radius:10px;">
                                                                    <xsl:value-of select="$etxekoG" />
        - <xsl:value-of select="$kanpokoG" />
                                                                </span>
                                                            </xsl:when>
                                                            <xsl:otherwise>
                                                                <span
                                                                    style="color: #999; font-size: 0.8em; font-style:italic;">
        VS</span>
                                                            </xsl:otherwise>
                                                        </xsl:choose>
                                                    </div>

                                                    <div>
                                                        <xsl:attribute name="style"> text-align:
        center; width: 35%; <xsl:if test="$jokatuta">
                                                                <xsl:if
                                                                    test="$kanpokoG &gt; $etxekoG">font-weight:bold;
        color:#000; transform:scale(1.05);</xsl:if>
                                                                <xsl:if test="$kanpokoG &lt; $etxekoG">opacity:
        0.5;</xsl:if>
                                                            </xsl:if>
                                                        </xsl:attribute>

                                                        <img
                                                            src="irudiak/eskutua/{KanpokoEzkutua}.png"
                                                            alt="{KanpokoTaldea}"
                                                            style="width:40px; height:40px; object-fit:contain;"
                                                            onerror="this.src='irudiak/eskutua/defecto.png'" />
                                                        <p style="font-size: 0.8em; margin: 5px 0;">
                                                            <xsl:value-of select="KanpokoTaldea" />
                                                        </p>
                                                    </div>

                                                </div>
                                            </div>
                                        </xsl:for-each>
                                    </div>
                                </div>
                            </article>
                        </xsl:for-each>
                    </div>
                </xsl:for-each>
            </div>

        </section>
    </xsl:template>
</xsl:stylesheet>