<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Usuario;

class PerfilController extends Controller
{
    public function index()
    {
        $usuario = Auth::user();
        return view('perfil.index', compact('usuario'));
    }

    public function update(Request $request)
    {
        $usuario = Auth::user();

        $request->validate([
            'nome'  => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:usuarios,email,' . $usuario->id,
            'senha' => 'nullable|string|min:6|confirmed',
        ]);

        $usuario->nome = $request->nome;
        $usuario->email = $request->email;

        if ($request->filled('senha')) {
            $usuario->senha = $request->senha;
        }

        /** @var \App\Models\Usuario $usuario */
        $usuario->save();

        return back()->with('sucesso', 'Perfil atualizado com sucesso!');
    }

    public function destroy(Request $request)
    {
        /** @var \App\Models\Usuario $usuario */
        $usuario = Auth::user();

        foreach ($usuario->fotos as $foto) {
            Storage::disk('public')->delete($foto->nome_arquivo);
        }

        $usuario->delete();

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->withErrors(['email' => 'Sua conta foi excluída com sucesso.']);
    }
}
