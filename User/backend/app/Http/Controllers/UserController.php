<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\OTPMail;

class UserController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return response()->json(['message' => 'Login berhasil', 'user' => $user], 200);
        } else {
            return response()->json(['message' => 'Email atau Password salah'], 401);
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        // Simpan data user sementara di cache tanpa password di-hash
        $userData = [
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'password' => $request->password, // Simpan dalam plaintext hanya untuk sementara
            'id_role' => 4
        ];

        Cache::put('user_register_' . $request->email, $userData, 60); // simpan selama 1 menit

        // Kirim OTP
        $this->sendOTP($request->email);

        return response()->json(['message' => 'OTP telah dikirim ke email Anda. Silakan verifikasi.'], 201);
    }

    public function sendOTP($email)
    {
        // Generate 6 digit OTP
        $otp = rand(100000, 999999);

        // Simpan OTP ke cache selama 1 menit
        Cache::put('otp_' . $email, $otp, 60);

        // Ambil data user dari cache untuk mendapatkan nama lengkap
        $userData = Cache::get('user_register_' . $email);
        $nama_lengkap = $userData['nama_lengkap'] ?? 'Pengguna'; // Default jika tidak ada nama lengkap

        // Kirim email dengan OTP dan nama_lengkap
        Mail::to($email)->send(new OTPMail($otp, $nama_lengkap));

        // Tidak perlu mengembalikan response JSON di sini, karena ini dipanggil dari fungsi lain
    }

    public function resendOTP(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Cek jika user sudah mendaftar dan ada di cache
        if (!Cache::has('user_register_' . $request->email)) {
            return response()->json(['message' => 'Email belum terdaftar atau OTP sudah kedaluwarsa.'], 404);
        }

        // Kirim ulang OTP
        $this->sendOTP($request->email);

        return response()->json(['message' => 'OTP telah dikirim ulang ke email Anda.'], 200);
    }

    public function verifyOTP(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6',
        ]);

        // Verifikasi OTP
        $cachedOTP = Cache::get('otp_' . $request->email);

        if (!$cachedOTP || $cachedOTP != $request->otp) {
            return response()->json(['message' => 'OTP tidak valid atau telah kedaluwarsa.'], 400);
        }

        // Dapatkan data user dari cache
        $userData = Cache::get('user_register_' . $request->email);

        if (!$userData) {
            return response()->json(['message' => 'Data user tidak ditemukan.'], 404);
        }

        // Simpan user ke database
        $user = new User();
        $user->nama_lengkap = $userData['nama_lengkap'];
        $user->email = $userData['email'];
        $user->password = $userData['password'];
        $user->id_role = $userData['id_role'];
        $user->save();

        // Hapus cache setelah berhasil
        Cache::forget('otp_' . $request->email);
        Cache::forget('user_register_' . $request->email);

        return response()->json(['message' => 'Verifikasi berhasil, user telah terdaftar.', 'user' => $user], 201);
    }
}
