<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class DonationController extends Controller
{

    public function index()
    {
        $donations = Donation::with('event')->get();

        $donationDetails = $donations->map(function($donation) {
            return [
                'id_user' => $donation->id_user,
                'nama_donatur' => $donation->nama_donatur,
                'nama_kegiatan' => $donation->event->nama_kegiatan,  // mengambil nama_kegiatan dari relasi event
                'jenis_kegiatan' => $donation->event->jenis_kegiatan, // mengambil jenis_kegiatan dari relasi event
                'status_verifikasi' => $donation->status_verifikasi,
            ];
        });

        return response()->json($donationDetails, 200);
    }
    public function verifyDonation(Request $request, $id_donasi)
    {
        $donation = Donation::find($id_donasi);

        if (!$donation) {
            return response()->json(['message' => 'Donation not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'status_verifikasi' => 'required|in:VALID,INVALID',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $donation->update([
            'status_verifikasi' => $request->status_verifikasi,
            'tanggal_verifikasi' => now(),
        ]);

        return response()->json(['message' => 'Donation verified successfully', 'donation' => $donation], 200);
    }
}
