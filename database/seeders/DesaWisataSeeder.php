<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DesaWisataSeeder extends Seeder
{
    public function run(): void
    {
        $jsPath = public_path('js/destinasi.js');
        if (!file_exists($jsPath)) {
            $this->command->error("File destinasi.js tidak ditemukan.");
            return;
        }

        $jsContent = file_get_contents($jsPath);
        if (preg_match('/const desaWisataData = (\[[\s\S]*?\]);/', $jsContent, $matches)) {
            // Parse JSON-like array
            $jsonString = preg_replace('/(\w+):/i', '"$1":', $matches[1]);
            // Remove trailing commas before closing braces/brackets
            $jsonString = preg_replace('/,\s*([\]}])/m', '$1', $jsonString);
            $desaList = json_decode($jsonString, true);
        }

        // Fallback jika regex parsing JSON gagal karena format JS murni
        if (empty($desaList)) {
            // Gunakan node.js untuk extract json bersih
            $output = shell_exec('node -e "const fs = require(\'fs\'); const content = fs.readFileSync(\'public/js/destinasi.js\', \'utf8\'); const m = content.match(/const desaWisataData = (\[[\\s\\S]*?\]);/); if (m) console.log(JSON.stringify(eval(m[1])));"');
            $desaList = json_decode($output, true);
        }

        if (empty($desaList)) {
            $this->command->error("Gagal mengekstrak data 57 desa wisata.");
            return;
        }

        $this->command->info("Memproses " . count($desaList) . " desa wisata...");

        // Bank options untuk variasi default rekening kas desa
        $bankList = ['Bank BJB', 'Bank BRI', 'Bank Mandiri', 'Bank BCA'];

        foreach ($desaList as $index => $item) {
            $namaDesa = trim($item['desa']);
            $slug = Str::slug($namaDesa);
            $destinasiUnggulan = !empty($item['destinasi']) ? implode(', ', $item['destinasi']) : $namaDesa;
            $kategori = $item['kategori'] ?? 'Alam';
            $statusDesa = $item['status'] ?? 'Rintisan';
            $sk = $item['sk'] ?? '446/Kpts.232-Huk/2020';
            $gambar = $item['gambar'] ?? 'pictures/destinasi/default.jpg';
            $deskripsi = $item['deskripsi'] ?? 'Potensi wisata desa yang menawarkan keindahan panorama, kearifan lokal, dan fasilitas ramah wisatawan di Kabupaten Ciamis.';

            // Cari harga tiket dari destination_prices jika ada
            $priceRecord = DB::table('destination_prices')
                ->where('destination_name', 'LIKE', '%' . $namaDesa . '%')
                ->orWhere('destination_name', 'LIKE', '%' . ($item['destinasi'][0] ?? $namaDesa) . '%')
                ->first();
            $hargaTiket = $priceRecord ? $priceRecord->ticket_price : 5000;

            $bankRandom = $bankList[$index % count($bankList)];
            $rekRandom = '100' . str_pad($index + 1, 4, '0', STR_PAD_LEFT) . '889';

            // Insert or Update Desa Wisata
            $desaId = DB::table('desa_wisata')->updateOrInsert(
                ['slug' => $slug],
                [
                    'nama_desa' => $namaDesa,
                    'kecamatan' => $item['kecamatan'] ?? 'Ciamis',
                    'sk_bupati' => $sk,
                    'status_desa' => $statusDesa,
                    'kategori' => $kategori,
                    'destinasi_unggulan' => $destinasiUnggulan,
                    'deskripsi' => $deskripsi,
                    'gambar' => $gambar,
                    'jam_buka' => '08:00 - 17:00 WIB',
                    'hari_operasional' => 'Setiap Hari',
                    'harga_tiket' => $hargaTiket,
                    'nama_bank' => $bankRandom,
                    'nomor_rekening' => $rekRandom,
                    'atas_nama_rekening' => 'BUMDes ' . $namaDesa . ' Mandiri',
                    'saldo_tersedia' => 0,
                    'saldo_dicairkan' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            // Dapatkan id desa
            $desa = DB::table('desa_wisata')->where('slug', $slug)->first();

            // Username & Email Pengelola Desa
            $username = 'desa_' . str_replace('-', '_', $slug);
            $email = $slug . '@desawisataciamis.id';

            // Insert or Update Akun Pengelola Desa
            DB::table('pengelola_desa')->updateOrInsert(
                ['username' => $username],
                [
                    'desa_id' => $desa->id,
                    'name' => 'Pengelola Desa Wisata ' . $namaDesa,
                    'email' => $email,
                    'password' => Hash::make('password123'),
                    'no_hp' => '08' . rand(1111111111, 9999999999),
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        // Sinkronisasi orders ke desa_id & hitung saldo
        $orders = DB::table('orders')->get();
        foreach ($orders as $order) {
            // Cocokkan destination_name dengan desa_wisata
            $matchedDesa = DB::table('desa_wisata')
                ->where('destinasi_unggulan', 'LIKE', '%' . $order->destination_name . '%')
                ->orWhere('nama_desa', 'LIKE', '%' . $order->destination_name . '%')
                ->first();

            if ($matchedDesa) {
                DB::table('orders')->where('id', $order->id)->update([
                    'desa_id' => $matchedDesa->id,
                    'ticket_status' => $order->ticket_status ?? 'active',
                ]);

                // Jika pesanan lunas, tambahkan ke saldo_tersedia desa
                if ($order->payment_status === 'lunas') {
                    DB::table('desa_wisata')->where('id', $matchedDesa->id)->increment('saldo_tersedia', $order->total_price);
                }
            }
        }

        $this->command->info("57 Desa Wisata & 57 Akun Pengelola Desa berhasil di-generate!");
    }
}
