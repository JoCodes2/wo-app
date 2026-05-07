<?php

namespace App\Repositories;

use App\Http\Requests\AuthRequest;
use App\Interfaces\AuthInterfaces;
use App\Models\User;
use App\Traits\HttpResponseTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthReposittories implements AuthInterfaces
{
    use HttpResponseTraits;
    protected $userModel;
    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }
    public function login(AuthRequest $request)
    {
        try {
            if (!Auth::attempt($request->only('email', 'password'))) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Email atau Password salah!'
                ], 401);
            } else {
                $user = $this->userModel::where('email', $request->email)->first();

                if ($user->role === 'wo' && $user->status_akun == 'pending') {
                    Auth::logout();
                    return response()->json([
                        'status' => 'forbidden',
                        'message' => 'Akun Anda belum aktif. Silakan menunggu aktivasi akun 1x24 jam.'
                    ], 403);
                }

                $user->tokens()->delete();
                $token = $user->createToken('token')->plainTextToken;

                return response()->json([
                    'status' => 'success',
                    'message' => 'Login success',
                    'data' => [
                        'id' => $user->id,
                        'nama_lengkap' => $user->nama_lengkap,
                        'email' => $user->email,
                        'role' => $user->role,
                    ],
                    'token' => $token
                ]);
            }
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 400, $th, class_basename($this), __FUNCTION__);
        }
    }
    public function logout(Request $request)
    {
        try {
            $request->user('web')->tokens()->delete();

            Auth::guard('web')->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return $this->success();
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 400, $th, class_basename($this), __FUNCTION__);
        }
    }
}
