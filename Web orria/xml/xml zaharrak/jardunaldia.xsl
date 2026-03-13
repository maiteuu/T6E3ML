<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" encoding="UTF-8" indent="yes" />
    <xsl:template match="/">
        
        <section class="w3-center taldeFlex">
            
            <xsl:for-each select="jardunaldiak/jardunaldia">
            <xsl:sort select="zenbakia" data-type="number" order="ascending"></xsl:sort>
                
                <article>
                    <div class="w3-container w3-round-large w3-card-4 w3-padding-16 cardBisuala">
                        
                        <h3><xsl:value-of select="zenbakia"/>. Jadunaldia</h3>
                        
                        <div class="taldeFlex">
                            <xsl:for-each select="partiduak/partidua">

                                <div class=" partidarikOnena">

                                    <div>
                                        <p><xsl:value-of select="data"/></p>
                                    </div>

                                    <div class="partidarikOnenaEmaitza">
                                        <div class="w3-container w3-padding-16 cardBisuala">
                                            
                                            <h3><xsl:value-of select="etxeko_taldea_izena"/></h3>
                                            
                                            <div class="eskutu-kontainer">
                                                <img src="irudiak/eskutua/{etxeko_taldea_eskutua}" alt="Taldearen eskutua"/>
                                            </div>

                                        </div>

                                        <p><xsl:value-of select="etxeko_golak"/>-<xsl:value-of select="kanpoko_golak"/></p>
                                        
                                        <div class="w3-container w3-padding-16 cardBisuala">
                                            
                                            <h3><xsl:value-of select="kanpoko_taldea_izena"/></h3>
                                            
                                            <div class="eskutu-kontainer">
                                                <img src="irudiak/eskutua/{kanpoko_taldea_eskutua}" alt="Taldearen eskutua"/>
                                            </div>

                                        </div>
                                        
                                    </div>
                                </div>

                            </xsl:for-each>
                        </div>

                    </div>
                </article>
            </xsl:for-each>
        </section>
    </xsl:template>
</xsl:stylesheet>