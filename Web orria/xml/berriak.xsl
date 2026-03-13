<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" encoding="UTF-8" indent="yes" />
    <xsl:template match="/">
        <div class="w3-container w3-center w3-padding-32">
            <h2
                style="color: #871521; font-weight:bold; text-transform:uppercase; letter-spacing:2px; text-shadow: 1px 1px 0 #ddd;">
        Berriak
            </h2>
            <div class="w3-center">
                <span
                    style="display:inline-block; width: 80px; height: 4px; background-color: #871521; border-radius: 2px;"></span>
            </div>
        </div>
        <section
            class="w3-container w3-center berriakMultzoa">
            <xsl:for-each select="berriak/berria">
                <article class="w3-container w3-round-large w3-card-4 berriakBakoitza">
                    <a href="{esteka}" target="_blank">
                        <img class="w3-image" src="irudiak/berriak/{irudia}" alt="Berriaren irudia" />
                    </a>
                    <p>
                        <xsl:value-of select="deskribapena"></xsl:value-of>
                    </p>
                </article>
            </xsl:for-each>
        </section>
    </xsl:template>
</xsl:stylesheet>