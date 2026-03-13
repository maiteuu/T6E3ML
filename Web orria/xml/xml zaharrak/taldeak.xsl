<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" encoding="UTF-8" indent="yes" />
    <xsl:template match="/">
        
        <section class="w3-center taldeFlex">
            
            <xsl:for-each select="taldeak/taldea">
                
                <article class="articleTaldeak">
                    <div class="w3-container w3-round-large w3-card-4 w3-padding-16 cardBisuala">
                        
                        <h3><xsl:value-of select="izena"/></h3>
                        
                        <div class="eskutu-kontainer">
                             <img src="irudiak/eskutua/{irudia}" alt="Taldearen eskutua"/>
                        </div>
                        
                        <div style="flex-grow: 1;">
                            <p><xsl:value-of select="deskribapena"/></p>
                        </div>
                        
                        <div class="akzioak">
                            <a href="{plantilla}" class="taldeaBotoia w3-button w3-round" target="_blank" style="margin-bottom: 15px; display:inline-block;">PLANTILLA</a>
                            
                            <audio controls="controls" style="width: 100%">
                                <source src="audioak/{audioa/mp3}" type="audio/mpeg"/>
                                <source src="audioak/{audioa/ogg}" type="audio/ogg"/>
                            </audio>
                        </div>

                    </div>
                </article>
            </xsl:for-each>
        </section>
    </xsl:template>
</xsl:stylesheet>