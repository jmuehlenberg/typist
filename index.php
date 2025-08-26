<?php
declare(strict_types=1);
session_start();
require __DIR__ . '/db.php';
require_once __DIR__ . '/helpers.php';

function h(?string $s): string {
  return htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/**
 * Sichere Ermittlung des "window"-Parameters (ohne PHP‑8-Warnings)
 */
$winRaw = $_POST['window'] ?? $_GET['window'] ?? '';
$winRaw = is_string($winRaw) ? trim($winRaw) : '';
if ($winRaw === '') {
  $winRaw = 'home.html';
}

/**
 * Routing-Regeln:
 * - PHP-Skripte: nur eine feste Whitelist erlauben (im Root)
 * - HTML-Seiten: im Root NUR 'home.html' und 'hilfe.html' erlauben,
 *                ansonsten nur Dateien unter '/lektionen/'.
 */
$allowedPhp = [
  'load.php',
  'loadsecond.php',
  'loadprf.php',
  'showlek.php',
  'dialogs.php',
  'regsvr.php',
  'print.php',
  'login_info.php'
];

$includeFile   = __DIR__ . '/home.html';
$rootReal      = realpath(__DIR__);
$lekReal       = realpath(__DIR__ . '/lektionen');
$allowedRootHtml = ['home.html', 'hilfe.html'];

if (preg_match('/\.php$/i', $winRaw)) {
  $base = basename($winRaw);
  if (in_array($base, $allowedPhp, true)) {
    $includeFile = __DIR__ . '/' . $base;
  }
} elseif (preg_match('/\.html?$/i', $winRaw)) {
  $lower = strtolower($winRaw);
  if (in_array($lower, $allowedRootHtml, true)) {
    // explizit erlaubte HTMLs aus dem Root
    $includeFile = __DIR__ . '/' . basename($winRaw);
  } else {
    // nur HTMLs innerhalb /lektionen/
    $candidate = __DIR__ . '/' . $winRaw;
    $real = realpath($candidate);
    if ($real !== false && $lekReal !== false && strpos($real, $lekReal) === 0) {
      $includeFile = $real;
    }
  }
}

// Falls die Zieldatei wider Erwarten nicht existiert, auf home zurückfallen
if (!is_file($includeFile)) {
  $includeFile = __DIR__ . '/home.html';
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="utf-8">
  <title>Tastaturschreibkurs Online</title>
  <meta name="Author" content="Jens Mühlenberg">
  <meta name="Publisher" content="muehlenberg.ch">
  <meta name="Copyright" content="© 2016 - <?php echo date('Y'); ?> muehlenberg.ch">
  <meta name="Revisit" content="After 2 days">
  <meta name="Keywords" content="Schreiben, 10, Finger, System, üben, lernen">
  <meta name="page-topic" content="Bildung">
  <meta name="audience" content="Alle">
  <meta name="Robots" content="INDEX,FOLLOW">
  <meta name="Language" content="Deutsch">
  <!-- Dein ursprüngliches Styling -->
  <link rel="stylesheet" href="mystyle.css">
  <style>
    /* Minimaler Rahmen fürs 2-Spalten-Layout, mystyle.css kann überschreiben */
    body {margin:0; font-family: Arial, sans-serif;}
    .layout {display:flex; min-height:100vh;}
    .left {width:280px; background:#f5f5f5; border-right:1px solid #ddd; padding:16px; box-sizing:border-box;}
    .right {flex:1; padding:16px; box-sizing:border-box;}
    @media (max-width: 900px) { .left {width:220px;} }
  </style>
</head>
<body>
  <div class="layout">
    <aside class="left">
      <?php
        $nav = __DIR__ . '/navi.html';
        if (is_file($nav)) {
          include $nav;
        } else {
          echo '<h3>Lektionen &amp; Prüfungen</h3><p><em>Die Datei <code>navi.html</code> wurde nicht gefunden.</em></p>';
        }
      ?>
    </aside>
    <main class="right">
      <?php include $includeFile; ?>
    </main>
  </div>
</body>
</html>