<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" encoding="UTF-8" indent="yes" omit-xml-declaration="yes" />

    <xsl:template match="/">

        <div id="taldeak-nagusia" class="w3-animate-opacity">

            <div class="w3-container w3-center w3-padding-32">
                <h2
                    style="color: #871521; font-weight:bold; text-transform:uppercase; letter-spacing:2px; text-shadow: 1px 1px 0 #ddd;">
        Talde Guztiak
                </h2>
                <div class="w3-center">
                    <span
                        style="display:inline-block; width: 80px; height: 4px; background-color: #871521; border-radius: 2px;"></span>
                </div>
            </div>

            <xsl:if test="count(//TaldeGuztiak/Talde) = 0">
                <div class="w3-panel w3-leftbar w3-padding-16 w3-margin"
                    style="background-color: #f9f4f1; border-color: #871521 !important; color: #534b4e;">
                    <h3 style="color: #871521;">⚠️ Datuak ez dira aurkitu</h3>
                    <p>Ziurtatu JavaScript fitxategian <b>xml/federazioa.xml</b> kargatzen ari
        zarela.</p>
                </div>
            </xsl:if>

            <section class="w3-center taldeFlex"
                style="display: flex; flex-wrap: wrap; justify-content: center; gap: 30px; max-width: 1200px; margin: 0 auto; padding-bottom: 50px;">

                <xsl:for-each select="//TaldeGuztiak/Talde">
                    <xsl:variable name="taldeId" select="generate-id(.)" />

                    <article
                        class="articleTaldeak" style="margin: 0;">
                        <div class="w3-card w3-hover-shadow w3-round-xlarge"
                            style="width: 280px; overflow: hidden; transition: transform 0.3s; background-color: white; border-top: 6px solid #871521;">

                            <div class="w3-padding-16"
                                style="background-color: #f9f4f1; border-bottom: 1px solid #eee;">
                                <h3
                                    style="font-size: 1.2em; font-weight: bold; margin: 0; color: #534b4e; min-height: 50px; display: flex; align-items: center; justify-content: center;">
                                    <xsl:value-of select="Izena" />
                                </h3>
                            </div>

                            <div class="w3-container w3-padding-24"
                                style="background-color: #fff; display:flex; flex-direction:column; align-items:center; min-height: 150px; justify-content: center;">
                                <div class="eskutu-kontainer" style="transition: transform 0.2s;">
                                    <img src="irudiak/eskutua/{Ezkutua}.png" alt="{Izena}"
                                        style="width: 130px; height: 130px; object-fit: contain; filter: drop-shadow(2px 4px 6px rgba(0,0,0,0.1));" />
                                </div>
                            </div>

                            <div class="w3-container w3-padding-16" style="background-color: #fff;">
                                <button
                                    onclick="document.getElementById('{$taldeId}').style.display='block'"
                                    class="w3-button w3-block w3-round-large w3-hover-dark-grey"
                                    style="background-color: #871521; color: white; font-weight: bold; letter-spacing: 1px; transition: 0.3s;">
        IKUSI PLANTILLA
                                </button>
                            </div>
                        </div>
                    </article>
                </xsl:for-each>
            </section>

            <div id="modales-container">
                <xsl:for-each select="//TaldeGuztiak/Talde">
                    <xsl:variable name="taldeId" select="generate-id(.)" />

                    <div id="{$taldeId}"
                        class="w3-modal" style="z-index: 9999; padding-top: 30px;">
                        <div class="w3-modal-content w3-animate-zoom w3-card-4 w3-round-large"
                            style="max-width: 650px; overflow: hidden;">

                            <header class="w3-container w3-padding-16"
                                style="background-color: #871521; color: white; position: relative;">
                                <span
                                    onclick="document.getElementById('{$taldeId}').style.display='none'"
                                    class="w3-button w3-display-topright w3-hover-white w3-large"
                                    style="font-weight:bold;">&#215;</span>
                                <h3 style="margin:0; font-weight:bold; font-size: 1.2em;">JOKALARIEN
        ZERRENDA</h3>
                            </header>

                            <div class="w3-container w3-padding-large"
                                style="background-color: #f9f4f1;">

                                <div class="w3-padding-16 w3-margin-bottom"
                                    style="border-bottom: 2px solid #e0d8d0; display: flex; align-items: center; gap: 20px;">

                                    <div style="flex-shrink: 0;">
                                        <img src="irudiak/eskutua/{Ezkutua}.png" alt="{Izena}"
                                            style="width: 90px; height: 90px; object-fit: contain; filter: drop-shadow(1px 2px 3px rgba(0,0,0,0.2));" />
                                    </div>

                                    <div style="flex-grow: 1;">
                                        <h2
                                            style="margin: 0; font-size: 1.5em; font-weight: bold; color: #871521;">
                                            <xsl:value-of select="Izena" />
                                        </h2>

                                        <p
                                            style="margin: 5px 0 0 0; color: #534b4e; font-size: 1em;">
                                            <span
                                                style="font-weight: bold; text-transform: uppercase;">
        Hiria:</span>
                                            <xsl:text> </xsl:text>
                                            <i class="fa fa-map-marker"
                                                style="color: #871521; margin-left: 5px;"></i>
                                            <xsl:value-of select="Hiria" />
                                        </p>
                                    </div>
                                </div>

                                <table class="w3-table w3-white w3-card-2 w3-round w3-small">
                                    <thead style="background-color: #534b4e; color: white;">
                                        <tr>
                                            <th class="w3-center">#</th>
                                            <th>Jokalaria</th>
                                            <th>Posizioa</th>
                                        </tr>
                                    </thead>
                                    <tbody style="color: #534b4e;">
                                        <xsl:for-each select="Jokalariak/Jokalari">
                                            <xsl:sort select="@dortsala" data-type="number"
                                                order="ascending" />
                                            <tr class="w3-hover-light-grey"
                                                style="border-bottom: 1px solid #eee;">
                                                <td class="w3-center"
                                                    style="font-weight: bold; color: #871521; width:50px;">
                                                    <xsl:value-of select="@dortsala" />
                                                </td>
                                                <td style="font-weight:500;">
                                                    <xsl:value-of select="Izena" />
                                                    <xsl:text> </xsl:text>
                                                    <strong style="color: #000;">
                                                        <xsl:value-of select="Abizena" />
                                                    </strong>
                                                </td>
                                                <td style="font-style:italic; opacity: 0.8;">
                                                    <xsl:value-of select="Posizioa" />
                                                </td>
                                            </tr>
                                        </xsl:for-each>
                                    </tbody>
                                </table>

                                <xsl:if test="not(Jokalariak/Jokalari)">
                                    <div class="w3-panel w3-border w3-padding"
                                        style="background-color: #fff; border-color: #eeb !important; color: #534b4e;">
                                        <p>Ez dago jokalaririk erregistratuta.</p>
                                    </div>
                                </xsl:if>
                            </div>

                            <footer class="w3-container w3-padding w3-border-top"
                                style="background-color: #eee;">
                                <button class="w3-button w3-hover-black w3-round w3-right w3-small"
                                    style="background-color: #871521; color: white;"
                                    onclick="document.getElementById('{$taldeId}').style.display='none'">
        ITXI LEHIOA
                                </button>
                            </footer>
                        </div>
                    </div>
                </xsl:for-each>
            </div>
        </div>
    </xsl:template>
</xsl:stylesheet>