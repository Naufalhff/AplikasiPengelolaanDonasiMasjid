<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Mail\OTPMail;
use App\Mail\DonationReceipt;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $pengguna = Auth::user();
            return response()->json(['message' => 'Login berhasil', 'user' => $pengguna], 200);
        } else {
            return response()->json(['message' => 'Email atau Password salah'], 401);
        }
    }

    public function sendOTP($email)
    {
        $otp = rand(100000, 999999);
        Cache::put('otp_' . $email, $otp, 60);

        $user = Pengguna::where('email', $email)->first();
        $nama_lengkap = $user->nama_lengkap ?? 'Pengguna';

        Mail::to($email)->send(new OTPMail($otp, $nama_lengkap));
    }

    public function resendOTP(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = Pengguna::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'message' => 'Email tidak ditemukan atau belum terdaftar.',
                'status' => 'error'
            ], 404);
        }

        $this->sendOTP($request->email);

        return response()->json([
            'message' => 'OTP telah dikirim ulang ke email Anda.',
            'status' => 'success'
        ], 200);
    }

    public function verifyOTP(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6',
        ]);

        $cachedOTP = Cache::get('otp_' . $request->email);

        if (!$cachedOTP || $cachedOTP != $request->otp) {
            return response()->json(['message' => 'OTP tidak valid atau telah kedaluwarsa.'], 400);
        }

        Cache::forget('otp_' . $request->email);

        return response()->json(['message' => 'OTP berhasil diverifikasi.'], 200);
    }

    public function registerCache(Request $request, $selected_role)
    {
        try {
            $request->validate([
                'nama_lengkap' => 'required|string|max:100',
                'email' => 'required|email|unique:pengguna,email',
                'password' => 'required|string|min:8',
            ]);

            $userData = [
                'nama_lengkap' => $request->nama_lengkap,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'peran' => $selected_role,
            ];

            Cache::put('register_user_' . $request->email, $userData, now()->addMinutes(10));

            $this->sendOTP($request->email);

            return response()->json(['message' => 'OTP telah dikirim ke email Anda. Silakan verifikasi.'], 201);
        } catch (ValidationException $e) {
            $errors = $e->validator->errors();
            if ($errors->has('email')) {
                return response()->json(['message' => 'Email sudah digunakan.'], 422);
            }

            return response()->json(['message' => 'Data tidak valid.'], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat pendaftaran.'], 500);
        }
    }

    public function saveCache(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
            ]);

            $cachedData = Cache::get('register_user_' . $request->email);

            if (!$cachedData) {
                return response()->json(['message' => 'Data pendaftaran tidak ditemukan atau telah kedaluwarsa.'], 404);
            }

            $user = Pengguna::create($cachedData);

            Cache::forget('register_user_' . $request->email);

            return response()->json(['message' => 'Pendaftaran berhasil.', 'user' => $user], 201);
        } catch (ValidationException $e) {
            return response()->json(['message' => 'Data tidak valid.'], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data.'], 500);
        }
    }

    public function sendDonationReceipt($id_donasi)
    {
        $donation = Donasi::with('event')->findOrFail($id_donasi);

        $id_donasi = $donation->id_donasi;
        $tanggal_donasi = $donation->tanggal_donasi;
        $nama_kegiatan = $donation->event->nama_kegiatan;
        $jumlah_donasi = $donation->jumlah_donasi;
        $nama_donatur = $donation->nama_donatur;

        Mail::to($donation->email_donatur)->send(new DonationReceipt($id_donasi, $tanggal_donasi, $nama_kegiatan, $jumlah_donasi, $nama_donatur));

        return response()->json(['message' => 'Kuitansi donasi berhasil dikirim']);
    }

    public function sendReset(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = Pengguna::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'message' => 'Email tidak dapat ditemukan.',
                'status' => 'error'
            ], 404);
        }

        $this->sendOTP($request->email);

        return response()->json([
            'message' => 'OTP reset password telah dikirim ke email Anda.',
            'status' => 'success'
        ], 200);
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password_baru' => [
                'required',
                'string',
                function($attribute, $value, $fail) {
                    if (strlen($value) < 8) {
                        $fail('Password harus memiliki minimal 8 karakter.');
                    }
                }
            ],
            'konfirmasi_password' => 'required|same:password_baru'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();

            $passwordErrors = [];
            if ($errors->has('password_baru')) {
                $passwordErrors = [
                    'panjang_password' => strlen($request->password_baru),
                    'pesan_error' => $errors->first('password_baru')
                ];
            }

            return response()->json([
                'message' => 'Validasi gagal',
                'status' => 'error',
                'errors' => [
                    'password' => $passwordErrors
                ]
            ], 422);
        }

        $user = Pengguna::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'message' => 'User tidak ditemukan.',
                'status' => 'error'
            ], 404);
        }

        if (Hash::check($request->password_baru, $user->password)) {
            return response()->json([
                'message' => 'Password baru tidak boleh sama dengan password lama.',
                'status' => 'error'
            ], 400);
        }

        $user->password = Hash::make($request->password_baru);
        $user->tanggal_dirubah = now();
        $user->save();

        return response()->json([
            'message' => 'Password berhasil diubah.',
            'status' => 'success',
            'detail' => [
                'panjang_password' => strlen($request->password_baru)
            ]
        ], 200);
    }
}
