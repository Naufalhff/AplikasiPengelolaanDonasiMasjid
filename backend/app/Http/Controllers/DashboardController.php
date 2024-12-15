<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\Pengeluaran;
use App\Models\Kegiatan;
use App\Models\Pengguna;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function getStatistics()
    {
        $totalDonasi = Donasi::count();
        $jumlahTotalDonasi = Donasi::where('status_verifikasi', 'VALID')->sum('jumlah_donasi');

        $totalPengeluaran = Pengeluaran::count();
        $jumlahTotalPengeluaran = Pengeluaran::sum('total_pengeluaran');

        $bulanMapping = [
            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
            5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug',
            9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec'
        ];

        $donasiPerBulan = Donasi::select(
            DB::raw('EXTRACT(MONTH FROM tanggal_donasi) as bulan'),
            DB::raw('SUM(jumlah_donasi) as total_donasi')
        )
            ->where('status_verifikasi', 'VALID')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get()
            ->map(function ($item) use ($bulanMapping) {
                return [
                    'bulan' => $bulanMapping[$item->bulan],
                    'total_donasi' => $item->total_donasi
                ];
            });

        $pengeluaranPerBulan = Pengeluaran::select(
            DB::raw('EXTRACT(MONTH FROM tanggal_transaksi) as bulan'),
            DB::raw('SUM(total_pengeluaran) as total_pengeluaran')
        )
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get()
            ->map(function ($item) use ($bulanMapping) {
                return [
                    'bulan' => $bulanMapping[$item->bulan],
                    'total_pengeluaran' => $item->total_pengeluaran
                ];
            });

        return response()->json([
            'total_donasi' => $totalDonasi,
            'jumlah_total_donasi' => $jumlahTotalDonasi,
            'total_pengeluaran' => $totalPengeluaran,
            'jumlah_total_pengeluaran' => $jumlahTotalPengeluaran,
            'donasi_per_bulan' => $donasiPerBulan,
            'pengeluaran_per_bulan' => $pengeluaranPerBulan
        ]);
    }

    public function getLimitedDonasi()
    {
        $data = Donasi::join('kegiatan', 'donasi.id_kegiatan', '=', 'kegiatan.id_kegiatan')
            ->select(
                'donasi.id_donasi',
                'donasi.nama_donatur',
                'donasi.jumlah_donasi',
                'donasi.status_verifikasi',
                'donasi.tanggal_donasi',
                'kegiatan.nama_kegiatan'
            )
            ->orderBy('tanggal_donasi', 'desc')
            ->take(3)
            ->get();

        $formattedData = $data->map(function ($item) {
            $item->tanggal_donasi = date('Y-m-d', strtotime($item->tanggal_donasi));
            return $item;
        });

        return response()->json($formattedData, 200);
    }

    public function getTotalDonation()
    {
        $total = Kegiatan::sum('anggaran_terkumpul');
        return response()->json(['total_donations' => $total]);
    }

    public function countDonation()
    {
        $count = Donasi::count();
        return response()->json(['counts' => $count]);
    }

    public function countEvent()
    {
        $count = Kegiatan::count();
        return response()->json(['kegiatan' => $count]);
    }

    public function countDonatur()
    {
        $count = Pengguna::where('peran', 'Donatur')->count();
        return response()->json(['donatur' => $count]);
    }
}
