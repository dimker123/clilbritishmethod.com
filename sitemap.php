<?php
/**
 * Sitemap dinámico — CLIL British Method
 * Sirve XML limpio a bots/crawlers y HTML visual a navegadores.
 */

$urls = [
    [
        'loc'        => 'https://www.clilbritishmethod.com/',
        'lastmod'    => '2026-03-20',
        'changefreq' => 'monthly',
        'priority'   => '1.0',
    ],
];

// ── Detectar si es un crawler ──────────────────────────────────────────────
$ua = strtolower($_SERVER['HTTP_USER_AGENT'] ?? '');
$isCrawler = preg_match('/googlebot|bingbot|slurp|duckduckbot|baiduspider|yandexbot|sogou|exabot|facebot|ia_archiver|semrushbot|ahrefsbot|dotbot|serpstatbot|mj12bot|petalbot/i', $ua);

// ── MODO XML (para crawlers / herramientas SEO) ────────────────────────────
if ($isCrawler || isset($_GET['xml'])) {
    header('Content-Type: application/xml; charset=UTF-8');
    echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;
    foreach ($urls as $url) {
        echo '  <url>' . PHP_EOL;
        echo '    <loc>'        . htmlspecialchars($url['loc'])        . '</loc>'        . PHP_EOL;
        echo '    <lastmod>'    . htmlspecialchars($url['lastmod'])    . '</lastmod>'    . PHP_EOL;
        echo '    <changefreq>' . htmlspecialchars($url['changefreq']) . '</changefreq>' . PHP_EOL;
        echo '    <priority>'   . htmlspecialchars($url['priority'])   . '</priority>'   . PHP_EOL;
        echo '  </url>' . PHP_EOL;
    }
    echo '</urlset>' . PHP_EOL;
    exit;
}

// ── MODO HTML (para navegadores) ───────────────────────────────────────────
$count    = count($urls);
$lastDate = $urls[0]['lastmod'] ?? date('Y-m-d');

$freqBadge = [
    'always'  => ['class' => 'badge-red',    'label' => 'Always'],
    'hourly'  => ['class' => 'badge-orange', 'label' => 'Hourly'],
    'daily'   => ['class' => 'badge-yellow', 'label' => 'Daily'],
    'weekly'  => ['class' => 'badge-green',  'label' => 'Weekly'],
    'monthly' => ['class' => 'badge-blue',   'label' => 'Monthly'],
    'yearly'  => ['class' => 'badge-gray',   'label' => 'Yearly'],
    'never'   => ['class' => 'badge-gray',   'label' => 'Never'],
];

header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex, nofollow">
  <title>Sitemap XML — CLIL British Method</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: 'Inter', -apple-system, sans-serif; background: #f1f5f9; color: #1e293b; }

    /* ── Header ── */
    .site-header {
      background: #0f2b5b;
      padding: 24px 40px;
      display: flex;
      align-items: center;
      gap: 18px;
      border-bottom: 3px solid #e63946;
    }
    .header-icon {
      width: 44px; height: 44px;
      background: #e63946;
      border-radius: 10px;
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0;
    }
    .header-icon svg { width: 24px; height: 24px; fill: #fff; }
    .header-text h1 { font-size: 1.25rem; font-weight: 700; color: #fff; letter-spacing: -0.3px; }
    .header-text p  { font-size: 0.8rem; color: #94a3b8; margin-top: 2px; }

    /* ── Main ── */
    main { max-width: 980px; margin: 36px auto; padding: 0 20px; }

    /* ── Stats bar ── */
    .stats {
      display: flex;
      gap: 24px;
      background: #fff;
      border: 1px solid #e2e8f0;
      border-radius: 12px;
      padding: 20px 28px;
      margin-bottom: 24px;
      flex-wrap: wrap;
    }
    .stat { display: flex; flex-direction: column; gap: 4px; }
    .stat-label { font-size: 0.68rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: #94a3b8; }
    .stat-value { font-size: 1.3rem; font-weight: 700; color: #0f2b5b; }

    /* ── Table ── */
    .table-wrap {
      background: #fff;
      border: 1px solid #e2e8f0;
      border-radius: 12px;
      overflow: hidden;
    }
    table { width: 100%; border-collapse: collapse; }
    thead { background: #0f2b5b; }
    thead th {
      padding: 13px 20px;
      text-align: left;
      font-size: 0.72rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 1px;
      color: #cbd5e1;
    }
    tbody tr { border-bottom: 1px solid #f1f5f9; transition: background 0.12s; }
    tbody tr:last-child { border-bottom: none; }
    tbody tr:hover { background: #f8fafc; }
    tbody td { padding: 16px 20px; font-size: 0.88rem; vertical-align: middle; }

    a.url-link { color: #e63946; text-decoration: none; font-weight: 500; word-break: break-all; }
    a.url-link:hover { text-decoration: underline; }

    /* ── Badges ── */
    .badge {
      display: inline-block;
      padding: 3px 11px;
      border-radius: 20px;
      font-size: 0.72rem;
      font-weight: 600;
    }
    .badge-blue   { background: #dbeafe; color: #1d4ed8; }
    .badge-green  { background: #dcfce7; color: #15803d; }
    .badge-yellow { background: #fef9c3; color: #92400e; }
    .badge-orange { background: #ffedd5; color: #c2410c; }
    .badge-red    { background: #fee2e2; color: #b91c1c; }
    .badge-gray   { background: #f1f5f9; color: #64748b; }

    /* ── Priority ── */
    .prio { font-weight: 700; font-size: 0.9rem; }
    .prio-high { color: #16a34a; }
    .prio-mid  { color: #d97706; }
    .prio-low  { color: #94a3b8; }

    /* ── Footer ── */
    footer {
      text-align: center;
      padding: 28px;
      font-size: 0.78rem;
      color: #94a3b8;
    }
    footer a { color: #e63946; text-decoration: none; }
    footer a:hover { text-decoration: underline; }
  </style>
</head>
<body>

  <header class="site-header">
    <div class="header-icon">
      <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14H9V8h2v8zm4 0h-2V8h2v8z"/>
      </svg>
    </div>
    <div class="header-text">
      <h1>Sitemap XML — CLIL British Method</h1>
      <p>clilbritishmethod.com &middot; <?= $count ?> URL<?= $count !== 1 ? 's' : '' ?> indexada<?= $count !== 1 ? 's' : '' ?></p>
    </div>
  </header>

  <main>
    <div class="stats">
      <div class="stat">
        <span class="stat-label">URLs indexadas</span>
        <span class="stat-value"><?= $count ?></span>
      </div>
      <div class="stat">
        <span class="stat-label">Última actualización</span>
        <span class="stat-value"><?= htmlspecialchars($lastDate) ?></span>
      </div>
      <div class="stat">
        <span class="stat-label">Estándar</span>
        <span class="stat-value">Sitemap 0.9</span>
      </div>
      <div class="stat">
        <span class="stat-label">Formato XML</span>
        <span class="stat-value"><a href="?xml" style="color:#e63946;text-decoration:none;font-size:0.9rem;">Ver XML ↗</a></span>
      </div>
    </div>

    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>URL</th>
            <th>Última modificación</th>
            <th>Frecuencia</th>
            <th>Prioridad</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($urls as $i => $url):
            $freq  = $url['changefreq'] ?? 'monthly';
            $badge = $freqBadge[$freq] ?? $freqBadge['monthly'];
            $prio  = (float)($url['priority'] ?? 0.5);
            $prioClass = $prio >= 0.8 ? 'prio-high' : ($prio >= 0.5 ? 'prio-mid' : 'prio-low');
          ?>
          <tr>
            <td><?= $i + 1 ?></td>
            <td><a href="<?= htmlspecialchars($url['loc']) ?>" class="url-link" target="_blank" rel="noopener"><?= htmlspecialchars($url['loc']) ?></a></td>
            <td><?= htmlspecialchars($url['lastmod'] ?? '—') ?></td>
            <td><span class="badge <?= $badge['class'] ?>"><?= $badge['label'] ?></span></td>
            <td><span class="prio <?= $prioClass ?>"><?= $url['priority'] ?></span></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </main>

  <footer>
    Generado por <a href="https://www.clilbritishmethod.com">CLIL British Method</a>
    &middot; <a href="/robots.txt">robots.txt</a>
    &middot; <a href="?xml">Ver XML puro</a>
  </footer>

</body>
</html>
