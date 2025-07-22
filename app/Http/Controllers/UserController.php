<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        return view('app.dashboard.index');
    }

    public function auth()
    {
        return view('app.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                Auth::login($user);

                if (Auth::check()) {
                    $request->session()->put('user', $user);
                    $request->session()->put('logged_in', true);

                    $postSlug = $request->post_slug;
                    if ($postSlug) {
                        return redirect()->route('posts.show', ['slug' => $postSlug])->with('success', 'Berhasil Login');
                    } else {
                        if ($request->has('remember_me')) {
                            $token = $user->createToken('authToken')->plainTextToken;
                            $cookie = cookie('authToken', $token, 3600); // 3600 minutes = 60 hours
                            return redirect()->route('dashboard')->withCookie($cookie)->with('success', 'Berhasil Login');
                        } else {
                            return redirect()->route('dashboard')->with('success', 'Berhasil Login');
                        }
                    }
                } else {
                    return back()->with('error', 'Terjadi kesalahan saat login. Silakan coba lagi.');
                }
            } else {
                return back()->with('error', 'Password tidak sesuai');
            }
        } else {
            return back()->with('error', 'Email belum terdaftar');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout(); // keluar dari sistem auth

        $request->session()->invalidate(); // batalin session lama
        $request->session()->regenerateToken(); // regenerasi CSRF token

        return redirect()->route('login')->with('success', 'Berhasil Logout');
    }


    // Menampilkan daftar user
    public function manage()
    {
        $users = User::with('role')->paginate(10); // Menampilkan user beserta role
        return view('app.user.index', compact('users'));
    }

    // Form tambah user
    public function create()
    {
        $roles = Role::all();
        return view('app.user.tambah', compact('roles'));
    }

    // Simpan user baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role_id' => 'required|exists:roles,id',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

            $avatarPath = null;
            if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'avatar' => $avatarPath,
        ]);

        return redirect()->route('users.manage')->with('success', 'User berhasil ditambahkan.');
    }

    // Form edit user
    public function edit(User $user)
    {
        return view('app.user.edit', compact('user'));
    }

    // Update data user
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role_id' => 'required|integer',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

         $avatarPath = $user->avatar;

            if ($request->hasFile('avatar')) {
                // Opsional: hapus avatar lama
                if ($user->avatar && \Storage::disk('public')->exists($user->avatar)) {
                    \Storage::disk('public')->delete($user->avatar);
                }

                $avatarPath = $request->file('avatar')->store('avatars', 'public');
            }

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'avatar' => $avatarPath
        ]);

        return redirect()->route('users.manage')->with('success', 'User berhasil diperbarui.');
    }

    // Hapus user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.manage')->with('success', 'User berhasil dihapus.');
    }
}
