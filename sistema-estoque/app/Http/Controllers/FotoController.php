<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class FotoController extends Controller
{
    public function index()
    {
        $fotos = Auth::user()->fotos;
        return view('fotos.index', compact('fotos'));
    }

    public function create()
    {
        return view('fotos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'arquivo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('arquivo')) {
            $caminhoArquivo = $request->file('arquivo')->store('fotos', 'public');

            Foto::create([
                'titulo' => $request->titulo,
                'nome_arquivo' => $caminhoArquivo,
                'usuario_id' => Auth::id(),
            ]);

            return redirect()->route('fotos.index')
                ->with('sucesso', 'Foto adicionada com sucesso!');
        }

        return back()->with('erro', 'Erro ao fazer upload.');
    }

    public function edit(string $id)
    {
        $foto = Foto::findOrFail($id);

        if ($foto->usuario_id !== Auth::id()) {
            abort(403, 'Ação não autorizada. Essa foto não é sua.');
        }

        return view('fotos.edit', compact('foto'));
    }

    public function update(Request $request, string $id)
    {
        $foto = Foto::findOrFail($id);

        if ($foto->usuario_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'titulo' => 'required|string|max:255',
            'arquivo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $foto->titulo = $request->titulo;

        if ($request->hasFile('arquivo')) {
            Storage::disk('public')->delete($foto->nome_arquivo);
            $novoCaminho = $request->file('arquivo')->store('fotos', 'public');
            $foto->nome_arquivo = $novoCaminho;
        }

        $foto->save();

        return redirect()->route('fotos.index')
            ->with('sucesso', 'Foto atualizada!');
    }

    public function destroy(string $id)
    {
        $foto = Foto::findOrFail($id);

        if ($foto->usuario_id !== Auth::id()) {
            abort(403);
        }

        Storage::disk('public')->delete($foto->nome_arquivo);
        $foto->delete();

        return redirect()->route('fotos.index')
            ->with('sucesso', 'Foto excluída!');
    }
}
