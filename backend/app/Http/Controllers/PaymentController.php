<?php

namespace App\Http\Controllers;

use App\Models\RekeningPembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function getDataById($id)
    {
        $qrisAccounts = RekeningPembayaran::where('id_kegiatan', $id)
            ->where('jenis_rekening', 'QRIS')
            ->get();

        $bsiAccounts = RekeningPembayaran::where('id_kegiatan', $id)
            ->where('jenis_rekening', 'BSI')
            ->get();

        return response()->json([
            'qris' => $qrisAccounts,
            'bsi' => $bsiAccounts,
        ]);
    }
}
