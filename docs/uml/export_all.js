const fs = require('fs');
const path = require('path');
const puppeteer = require('C:/Users/USER/AppData/Roaming/npm/node_modules/@mermaid-js/mermaid-cli/node_modules/puppeteer');

const umlDir = __dirname;
const mermaidJsContent = fs.readFileSync(path.join(umlDir, 'mermaid.min.js'), 'utf8');

const diagrams = [
  { id: '01-use-case-diagram', file: '01-use-case-diagram.mmd', title: '1. Use Case Diagram (Multi-Role)' },
  { id: '02-activity-pemesanan-pembayaran', file: '02-activity-pemesanan-pembayaran.mmd', title: '2. Activity: Pemesanan & Pembayaran Tiket' },
  { id: '03-activity-verifikasi-admin', file: '03-activity-verifikasi-admin.mmd', title: '3. Activity: Verifikasi Pembayaran Admin' },
  { id: '04-activity-manajemen-berita', file: '04-activity-manajemen-berita.mmd', title: '4. Activity: Manajemen Berita' },
  { id: '05-activity-layanan-bantuan', file: '05-activity-layanan-bantuan.mmd', title: '5. Activity: Layanan Bantuan' },
  { id: '06-activity-validasi-tiket-pengelola', file: '06-activity-validasi-tiket-pengelola.mmd', title: '6. Activity: Validasi Tiket oleh Pengelola Desa' },
  { id: '07-activity-rekap-pencairan-admin', file: '07-activity-rekap-pencairan-admin.mmd', title: '7. Activity: Rekap & Konfirmasi Pencairan Dana oleh Admin' },
  { id: '08-sequence-pemesanan-tiket', file: '08-sequence-pemesanan-tiket.mmd', title: '8. Sequence: Pemesanan Tiket' },
  { id: '09-sequence-verifikasi-admin', file: '09-sequence-verifikasi-admin.mmd', title: '9. Sequence: Verifikasi Pembayaran' },
  { id: '10-sequence-ulasan-rating', file: '10-sequence-ulasan-rating.mmd', title: '10. Sequence: Ulasan & Rating' },
  { id: '11-sequence-validasi-tiket-pengelola', file: '11-sequence-validasi-tiket-pengelola.mmd', title: '11. Sequence: Validasi E-Ticket Pengelola Desa' },
  { id: '12-sequence-pencairan-dana-desa', file: '12-sequence-pencairan-dana-desa.mmd', title: '12. Sequence: Pengajuan & Pencairan Dana Desa' },
  { id: '13-class-diagram', file: '13-class-diagram.mmd', title: '13. Class Diagram' },
  { id: '14-entity-relationship-diagram-erd', file: '14-entity-relationship-diagram-erd.mmd', title: '14. Entity Relationship Diagram (ERD)' },
  { id: '15-logical-record-structure-lrs', file: '15-logical-record-structure-lrs.mmd', title: '15. Logical Record Structure (LRS)' },
  { id: '16-state-siklus-pembayaran', file: '16-state-siklus-pembayaran.mmd', title: '16. State: Siklus Pembayaran Tiket' },
  { id: '17-state-siklus-bantuan', file: '17-state-siklus-bantuan.mmd', title: '17. State: Siklus Bantuan' },
  { id: '18-state-siklus-tiket-masuk', file: '18-state-siklus-tiket-masuk.mmd', title: '18. State: Siklus Penggunaan Tiket (Check-In)' },
  { id: '19-state-siklus-pencairan-dana', file: '19-state-siklus-pencairan-dana.mmd', title: '19. State: Siklus Pencairan Dana Kas Desa' },
  { id: '20-dfd-level-0-konteks', file: '20-dfd-level-0-konteks.mmd', title: '20. DFD Level 0 (Diagram Konteks Multi-Role)' }
];

async function run() {
  const chromePath = fs.existsSync('C:/Program Files/Google/Chrome/Application/chrome.exe')
    ? 'C:/Program Files/Google/Chrome/Application/chrome.exe'
    : 'C:/Program Files (x86)/Microsoft/Edge/Application/msedge.exe';

  const tempProfile = path.join(umlDir, '.temp_profile_' + Date.now());
  if (!fs.existsSync(tempProfile)) fs.mkdirSync(tempProfile, { recursive: true });

  console.log('Launching headless browser with:', chromePath);
  const browser = await puppeteer.launch({
    executablePath: chromePath,
    userDataDir: tempProfile,
    headless: 'new',
    args: [
      '--no-sandbox',
      '--disable-setuid-sandbox',
      '--disable-gpu',
      '--disable-dev-shm-usage',
      '--remote-debugging-port=0'
    ]
  });

  const page = await browser.newPage();
  await page.setViewport({ width: 1920, height: 1080, deviceScaleFactor: 2 });

  await page.setContent(`<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <style>
    body { margin: 0; padding: 20px; background: #ffffff; font-family: sans-serif; }
    #container { display: inline-block; padding: 10px; }
  </style>
  <script>${mermaidJsContent}</script>
</head>
<body>
  <div id="container"></div>
  <script>
    mermaid.initialize({
      startOnLoad: false,
      theme: 'default',
      securityLevel: 'loose',
      flowchart: { useMaxWidth: false, htmlLabels: true },
      sequence: { useMaxWidth: false },
      er: { useMaxWidth: false }
    });
  </script>
</body>
</html>`);

  for (const diag of diagrams) {
    const mmdPath = path.join(umlDir, diag.file);
    if (!fs.existsSync(mmdPath)) {
      console.warn(`File not found: ${diag.file}`);
      continue;
    }
    const code = fs.readFileSync(mmdPath, 'utf8');
    console.log(`Processing: ${diag.title} (${diag.id})...`);

    try {
      const renderResult = await page.evaluate(async (chartCode, id) => {
        try {
          const { svg } = await window.mermaid.render('svg_' + id.replace(/[^a-zA-Z0-9]/g, '_'), chartCode);
          const container = document.getElementById('container');
          container.innerHTML = svg;
          return { success: true, svg };
        } catch (err) {
          return { success: false, error: err.message };
        }
      }, code, diag.id);

      if (!renderResult.success) {
        console.error(`  [ERROR rendering ${diag.id}]:`, renderResult.error);
        continue;
      }

      // Save SVG file
      const svgPath = path.join(umlDir, `${diag.id}.svg`);
      fs.writeFileSync(svgPath, renderResult.svg, 'utf8');
      console.log(`  -> Saved SVG: ${diag.id}.svg`);

      // Screenshot the rendered container for high-res PNG
      const containerHandle = await page.$('#container');
      if (containerHandle) {
        const pngPath = path.join(umlDir, `${diag.id}.png`);
        await containerHandle.screenshot({ path: pngPath, omitBackground: false });
        console.log(`  -> Saved PNG: ${diag.id}.png`);
      }
    } catch (e) {
      console.error(`  [EXCEPTION for ${diag.id}]:`, e.message);
    }
  }

  await browser.close();
  try {
    fs.rmSync(tempProfile, { recursive: true, force: true });
  } catch(e) {}
  console.log('ALL 20 DIAGRAMS PROCESSED SUCCESSFULLY!');
}

run().catch(err => {
  console.error('Fatal error:', err);
  process.exit(1);
});
