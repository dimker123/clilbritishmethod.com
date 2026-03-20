<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="2.0"
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
  xmlns:sitemap="http://www.sitemaps.org/schemas/sitemap/0.9">

  <xsl:output method="html" encoding="UTF-8" indent="yes"/>

  <xsl:template match="/">
    <html lang="es">
      <head>
        <title>Sitemap — CLIL British Method</title>
        <meta charset="UTF-8"/>
        <meta name="robots" content="noindex, nofollow"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <style>
          * { box-sizing: border-box; margin: 0; padding: 0; }
          body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; background: #f8fafc; color: #1e293b; }
          header { background: #0f2b5b; color: #fff; padding: 28px 40px; display: flex; align-items: center; gap: 16px; }
          header svg { width: 30px; height: 30px; fill: #e63946; flex-shrink: 0; }
          header h1 { font-size: 1.4rem; font-weight: 700; letter-spacing: -0.5px; }
          header p { font-size: 0.85rem; color: #94a3b8; margin-top: 3px; }
          .container { max-width: 960px; margin: 40px auto; padding: 0 20px; }
          .meta-bar { background: #fff; border: 1px solid #e2e8f0; border-radius: 10px; padding: 18px 24px; display: flex; gap: 40px; margin-bottom: 28px; flex-wrap: wrap; }
          .meta-bar div { display: flex; flex-direction: column; gap: 3px; }
          .meta-bar span:first-child { font-size: 0.72rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1.5px; color: #94a3b8; }
          .meta-bar span:last-child { font-size: 1.1rem; font-weight: 700; color: #0f2b5b; }
          table { width: 100%; border-collapse: collapse; background: #fff; border-radius: 10px; overflow: hidden; border: 1px solid #e2e8f0; }
          thead { background: #0f2b5b; color: #fff; }
          thead th { padding: 14px 20px; text-align: left; font-size: 0.78rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; }
          tbody tr { border-bottom: 1px solid #f1f5f9; transition: background 0.15s; }
          tbody tr:last-child { border-bottom: none; }
          tbody tr:hover { background: #f8fafc; }
          tbody td { padding: 15px 20px; font-size: 0.92rem; }
          td a { color: #e63946; text-decoration: none; font-weight: 500; word-break: break-all; }
          td a:hover { text-decoration: underline; }
          .badge { display: inline-block; padding: 3px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }
          .badge-monthly { background: #dbeafe; color: #1d4ed8; }
          .badge-weekly { background: #dcfce7; color: #15803d; }
          .badge-daily { background: #fef9c3; color: #a16207; }
          .priority { font-weight: 700; }
          .p-high { color: #16a34a; }
          .p-med { color: #d97706; }
          .p-low { color: #94a3b8; }
          footer { text-align: center; padding: 30px; font-size: 0.8rem; color: #94a3b8; }
          footer a { color: #e63946; text-decoration: none; }
        </style>
      </head>
      <body>
        <header>
          <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm1 17.93V18a1 1 0 0 0-2 0v1.93C7.06 19.44 4.56 16.94 4.07 14H6a1 1 0 0 0 0-2H4.07C4.56 9.06 7.06 6.56 10 6.07V8a1 1 0 0 0 2 0V6.07C15.94 6.56 18.44 9.06 18.93 12H17a1 1 0 0 0 0 2h1.93C18.44 16.94 15.94 19.44 13 19.93z"/></svg>
          <div>
            <h1>Sitemap XML — CLIL British Method</h1>
            <p>clilbritishmethod.com</p>
          </div>
        </header>

        <div class="container">
          <div class="meta-bar">
            <div>
              <span>URLs indexadas</span>
              <span><xsl:value-of select="count(sitemap:urlset/sitemap:url)"/></span>
            </div>
            <div>
              <span>Generado</span>
              <span>2026-03-20</span>
            </div>
            <div>
              <span>Formato</span>
              <span>XML Sitemap 0.9</span>
            </div>
          </div>

          <table>
            <thead>
              <tr>
                <th>URL</th>
                <th>Última modificación</th>
                <th>Frecuencia</th>
                <th>Prioridad</th>
              </tr>
            </thead>
            <tbody>
              <xsl:for-each select="sitemap:urlset/sitemap:url">
                <tr>
                  <td>
                    <a href="{sitemap:loc}"><xsl:value-of select="sitemap:loc"/></a>
                  </td>
                  <td><xsl:value-of select="sitemap:lastmod"/></td>
                  <td>
                    <xsl:choose>
                      <xsl:when test="sitemap:changefreq = 'daily'">
                        <span class="badge badge-daily">Daily</span>
                      </xsl:when>
                      <xsl:when test="sitemap:changefreq = 'weekly'">
                        <span class="badge badge-weekly">Weekly</span>
                      </xsl:when>
                      <xsl:otherwise>
                        <span class="badge badge-monthly"><xsl:value-of select="sitemap:changefreq"/></span>
                      </xsl:otherwise>
                    </xsl:choose>
                  </td>
                  <td>
                    <xsl:choose>
                      <xsl:when test="sitemap:priority >= 0.8">
                        <span class="priority p-high"><xsl:value-of select="sitemap:priority"/></span>
                      </xsl:when>
                      <xsl:when test="sitemap:priority >= 0.5">
                        <span class="priority p-med"><xsl:value-of select="sitemap:priority"/></span>
                      </xsl:when>
                      <xsl:otherwise>
                        <span class="priority p-low"><xsl:value-of select="sitemap:priority"/></span>
                      </xsl:otherwise>
                    </xsl:choose>
                  </td>
                </tr>
              </xsl:for-each>
            </tbody>
          </table>
        </div>

        <footer>
          Generado por <a href="https://www.clilbritishmethod.com">CLIL British Method</a> · <a href="/robots.txt">robots.txt</a>
        </footer>
      </body>
    </html>
  </xsl:template>

</xsl:stylesheet>
