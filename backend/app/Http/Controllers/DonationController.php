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
                'id_donasi' => $donation->id_donasi,
                'nama_donatur' => $donation->nama_donatur,
                'nama_kegiatan' => $donation->event->nama_kegiatan,
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

    public function viewDetailDonation($id_donasi)
    {
        $donation = Donation::with('event')->find($id_donasi);

        if (!$donation) {
            return response()->json(['message' => 'Donation not found'], 404);
        }

        return response()->json([
            'nama_donatur' => $donation->nama_donatur,
            'alamat_donatur' => $donation->alamat_donatur,
            'no_telepon_donatur' => $donation->no_telepon_donatur,
            'email_donatur' => $donation->email_donatur,
            'jumlah_donasi' => $donation->jumlah_donasi,
            'metode_pembayaran' => $donation->metode_pembayaran,
            'bukti_pembayaran' => $donation->bukti_pembayaran,
            'status_verifikasi' => $donation->status_verifikasi,
            'tanggal_donasi' => $donation->tanggal_donasi,
            'tanggal_verifikasi' => $donation->tanggal_verifikasi,
            'event' => [
                'nama_kegiatan' => $donation->event->nama_kegiatan,
            ],
        ], 200);
    }
}
