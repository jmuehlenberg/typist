<?php
declare(strict_types=1);
require_once __DIR__ . '/helpers.php';

// === Konfiguration ===
const TEMPLATE_FILE = __DIR__ . '/executeprf.html'; // Prüfungs-Template

function get_str(string $key, int $maxLen = 200): string {
  $v = $_GET[$key] ?? '';
  $v = is_string($v) ? $v : '';
  $v = trim($v);
  if (mb_strlen($v, 'UTF-8') > $maxLen) {
    $v = mb_substr($v, 0, $maxLen, 'UTF-8');
  }
  return $v;
}
function get_int(string $key, int $min = 0, int $max = 10000): int {
  $v = $_GET[$key] ?? '';
  $i = filter_var($v, FILTER_VALIDATE_INT);
  if ($i === false) $i = $min;
  if ($i < $min) $i = $min;
  if ($i > $max) $i = $max;
  return $i;
}

// Parameter lesen
$src  = get_str('src');             // z.B. prfs/prf3.js (wir erlauben nur Datei aus /prfs)
$mins = get_int('mins', 1, 600);    // 1..600 Minuten

// Quelle validieren (nur prfs/*.js, keine Pfad-Traversal)
$base = __DIR__ . '/prfs/';
$baseReal = realpath($base);
if ($baseReal === false) {
  http_response_code(500);
  exit('Konfiguration: Ordner "prfs" fehlt.');
}
$srcFile = basename($src);
if (strtolower(pathinfo($srcFile, PATHINFO_EXTENSION)) !== 'js') {
  http_response_code(400);
  exit('Ungültige Quelldatei.');
}
$abs = realpath($baseReal . DIRECTORY_SEPARATOR . $srcFile);
if ($abs === false || strpos($abs, $baseReal) !== 0) {
  http_response_code(404);
  exit('Datei nicht gefunden.');
}
$relForHtml = 'prfs/' . $srcFile;

// Template laden
if (!is_file(TEMPLATE_FILE)) {
  http_response_code(500);
  exit('Template executeprf.html nicht gefunden.');
}
$html = file_get_contents(TEMPLATE_FILE);

// Platzhalter ersetzen
$html = strtr($html, [
  '<@filename@>'  => $relForHtml,
  '<@totalmins@>' => (string)$mins,
]);

// Echtzeit-Timer: Start erst bei erster Eingabe (Key/Paste/Touch)
$totalSec = max(1, $mins * 60);
$timerJs = <<<JS
<script>
(function(){
  var total = {$totalSec};
  var start = null;      // wird beim ersten Input gesetzt
  var running = false;   // Uhr läuft erst nach erstem Input
  var rafId = null;

  function fmt(s){ var m = Math.floor(s/60), ss = s%60; return m + ':' + (ss<10?'0'+ss:ss); }

  // Anzeige initial auf 0:00 / total setzen
  function render(elapsed){
    var t = document.getElementById('Time');
    if (!t) return;
    var shown = Math.min(elapsed, total);
    t.textContent = 'Zeit: ' + fmt(shown) + ' / ' + fmt(total);
  }
  render(0);

  function tick(){
    if (!running || start === null) return;
    var elapsed = Math.floor((Date.now() - start) / 1000);
    if (elapsed < 0) elapsed = 0;
    render(elapsed);
    if (elapsed < total) {
      rafId = setTimeout(tick, 1000);
    } else {
      running = false;
      // OPTIONAL: Hier könntest du bei Zeitablauf automatisch beenden/sperren:
      // if (typeof FinishExam === 'function') FinishExam();
    }
  }

  // Einmaliger Starter bei erstem Eingabe-Event
  function startOnFirstInput(){
    if (running) return;
    running = true;
    start = Date.now();
    tick();
    // Listener wieder entfernen (einmaliger Start)
    window.removeEventListener('keydown', startOnFirstInput, true);
    window.removeEventListener('input', startOnFirstInput, true);
    window.removeEventListener('paste', startOnFirstInput, true);
    window.removeEventListener('pointerdown', startOnFirstInput, true);
  }

  // Warten auf ersten tatsächlichen Input
  window.addEventListener('keydown', startOnFirstInput, true);
  window.addEventListener('input', startOnFirstInput, true);
  window.addEventListener('paste', startOnFirstInput, true);
  window.addEventListener('pointerdown', startOnFirstInput, true);

  // Falls die Seite verlassen wird: Timer aufräumen
  window.addEventListener('beforeunload', function(){
    if (rafId) { try { clearTimeout(rafId); } catch(e){} }
  });
})();
</script>
JS;

echo $html . "\n" . $timerJs;