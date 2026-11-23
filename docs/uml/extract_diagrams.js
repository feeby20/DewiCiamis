const fs = require('fs');
const path = require('path');

const mdPath = path.join(__dirname, 'diagram.md');
const content = fs.readFileSync(mdPath, 'utf8');
const lines = content.split('\n');

let currentTitle = '';
let inBlock = false;
let blockLines = [];
let diagrams = [];

for (let i = 0; i < lines.length; i++) {
  const line = lines[i];
  if (line.startsWith('## ') || line.startsWith('### ')) {
    currentTitle = line.replace(/^#+\s*/, '').trim();
  }
  if (line.trim().startsWith('```mermaid')) {
    inBlock = true;
    blockLines = [];
    continue;
  }
  if (inBlock && line.trim().startsWith('```')) {
    inBlock = false;
    diagrams.push({ title: currentTitle, code: blockLines.join('\n') });
    continue;
  }
  if (inBlock) {
    blockLines.push(line);
  }
}

console.log('Found ' + diagrams.length + ' diagrams:');
diagrams.forEach((d, idx) => console.log((idx + 1) + '. ' + d.title + ' (' + d.code.length + ' chars)'));

const fileNames = [
  '01-use-case-diagram',
  '02-activity-pemesanan-pembayaran',
  '03-activity-verifikasi-admin',
  '04-activity-manajemen-berita',
  '05-activity-layanan-bantuan',
  '06-activity-validasi-tiket-pengelola',
  '07-activity-rekap-pencairan-admin',
  '08-sequence-pemesanan-tiket',
  '09-sequence-verifikasi-admin',
  '10-sequence-ulasan-rating',
  '11-sequence-validasi-tiket-pengelola',
  '12-sequence-pencairan-dana-desa',
  '13-class-diagram',
  '14-entity-relationship-diagram-erd',
  '15-logical-record-structure-lrs',
  '16-state-siklus-pembayaran',
  '17-state-siklus-bantuan',
  '18-state-siklus-tiket-masuk',
  '19-state-siklus-pencairan-dana',
  '20-dfd-level-0-konteks'
];

diagrams.forEach((d, idx) => {
  const baseName = fileNames[idx] || ('diagram-' + (idx + 1));
  const mmdPath = path.join(__dirname, baseName + '.mmd');
  fs.writeFileSync(mmdPath, d.code.trim(), 'utf8');
  console.log('Written: ' + baseName + '.mmd');
});
