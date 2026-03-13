<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" encoding="UTF-8" indent="yes" />

    <xsl:param name="partiduId" />

    <xsl:template match="/">
        <section class="w3-container w3-padding-32" style="max-width:900px; margin:auto;">
            
            <button onclick="atzeraJardunaldietara()" class="w3-button w3-light-grey w3-margin-bottom w3-round">
                &#8592; Atzera
            </button>

            <xsl:for-each select="//Partidua[@id = $partiduId]">
                
                <xsl:variable name="etxekoIzena" select="normalize-space(EtxekoTaldea)" />
                <xsl:variable name="kanpokoIzena" select="normalize-space(KanpokoTaldea)" />

                <div class="w3-card-4 w3-white w3-round-large w3-padding-large w3-center" style="animation: fadeIn 0.5s;">
                    
                    <h2 class="w3-opacity">Partiduaren Xehetasunak</h2>
                    <hr/>

                    <div class="w3-row-padding w3-margin-top w3-margin-bottom" style="display:flex; align-items:center; justify-content:center;">
                        <div class="w3-col s4">
                            <img src="irudiak/eskutua/{EtxekoEzkutua}.png" style="width:100px; height:100px; object-fit:contain;" onerror="this.src='irudiak/eskutua/defecto.png'"/>
                            <h3 style="font-size:1.2em"><xsl:value-of select="EtxekoTaldea"/></h3>
                        </div>
                        <div class="w3-col s4">
                            <h1 style="font-size: 4em; font-weight:bold;">
                                <xsl:choose>
                                    <xsl:when test="Emaitza">
                                        <xsl:value-of select="Emaitza/@etxekoGolak"/> - <xsl:value-of select="Emaitza/@kanpokoGolak"/>
                                    </xsl:when>
                                    <xsl:otherwise>VS</xsl:otherwise>
                                </xsl:choose>
                            </h1>
                        </div>
                        <div class="w3-col s4">
                            <img src="irudiak/eskutua/{KanpokoEzkutua}.png" style="width:100px; height:100px; object-fit:contain;" onerror="this.src='irudiak/eskutua/defecto.png'"/>
                            <h3 style="font-size:1.2em"><xsl:value-of select="KanpokoTaldea"/></h3>
                        </div>
                    </div>

                    <hr/>

                    <div class="w3-row">
                        
                        <div class="w3-half w3-padding">
                            <h4 class="w3-border-bottom w3-text-red" style="text-align:left">Etxeko Jokalariak</h4>
                            
                            <table class="w3-table w3-striped w3-bordered w3-small w3-hoverable" style="text-align:left">
                                <tr class="w3-light-grey">
                                    <th>#</th>
                                    <th>Izena</th>
                                    <th>Posizioa</th>
                                </tr>
                                <xsl:for-each select="//TaldeGuztiak/Talde[normalize-space(Izena) = $etxekoIzena]/Jokalariak/Jokalari">
                                    <xsl:sort select="@dortsala" data-type="number" order="ascending"/>
                                    <tr>
                                        <td style="font-weight:bold"><xsl:value-of select="@dortsala"/></td>
                                        <td><xsl:value-of select="Izena"/><xsl:text> </xsl:text><xsl:value-of select="Abizena"/></td>
                                        <td><xsl:value-of select="Posizioa"/></td>
                                    </tr>
                                </xsl:for-each>
                            </table>
                        </div>

                        <div class="w3-half w3-padding">
                            <h4 class="w3-border-bottom w3-text-blue" style="text-align:left">Kanpoko Jokalariak</h4>
                            
                            <table class="w3-table w3-striped w3-bordered w3-small w3-hoverable" style="text-align:left">
                                <tr class="w3-light-grey">
                                    <th>#</th>
                                    <th>Izena</th>
                                    <th>Posizioa</th>
                                </tr>
                                <xsl:for-each select="//TaldeGuztiak/Talde[normalize-space(Izena) = $kanpokoIzena]/Jokalariak/Jokalari">
                                    <xsl:sort select="@dortsala" data-type="number" order="ascending"/>
                                    <tr>
                                        <td style="font-weight:bold"><xsl:value-of select="@dortsala"/></td>
                                        <td><xsl:value-of select="Izena"/><xsl:text> </xsl:text><xsl:value-of select="Abizena"/></td>
                                        <td><xsl:value-of select="Posizioa"/></td>
                                    </tr>
                                </xsl:for-each>
                            </table>
                        </div>

                    </div>

                </div>
            </xsl:for-each>
        </section>
    </xsl:template>
</xsl:stylesheet>