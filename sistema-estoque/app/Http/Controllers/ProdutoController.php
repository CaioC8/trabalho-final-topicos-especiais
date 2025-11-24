<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Auth::user()->produtos()->with('categorias')->get();
        return view('produtos.index', compact('produtos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('produtos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:20480',
            'categorias' => 'nullable|array',
            'categorias.*' => 'exists:categorias,id'
        ]);

        if ($request->hasFile('foto')) {
            $caminhoFoto = $request->file('foto')->store('produtos', 'public');

            $produto = Produto::create([
                'nome' => $request->nome,
                'preco' => $request->preco,
                'foto' => $caminhoFoto,
                'usuario_id' => Auth::id(),
            ]);

            if ($request->filled('categorias')) {
                $produto->categorias()->attach($request->categorias);
            }

            return redirect()->route('produtos.index')
                ->with('sucesso', 'Produto criado com sucesso!');
        }

        return back()->with('erro', 'Erro ao fazer upload da imagem.');
    }

    public function edit(string $id)
    {
        $produto = Produto::findOrFail($id);

        if ($produto->usuario_id !== Auth::id()) {
            abort(403, 'Você não tem permissão para editar este produto.');
        }

        $categorias = Categoria::all();
        return view('produtos.edit', compact('produto', 'categorias'));
    }

    public function update(Request $request, string $id)
    {
        $produto = Produto::findOrFail($id);

        if ($produto->usuario_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:20480',
            'categorias' => 'nullable|array',
            'categorias.*' => 'exists:categorias,id'
        ]);

        $produto->nome = $request->nome;
        $produto->preco = $request->preco;

        if ($request->hasFile('foto')) {
            Storage::disk('public')->delete($produto->foto);

            $produto->foto = $request->file('foto')->store('produtos', 'public');
        }

        $produto->save();

        if ($request->has('categorias')) {
            $produto->categorias()->sync($request->categorias);
        } else {
            $produto->categorias()->detach();
        }

        return redirect()->route('produtos.index')->with('sucesso', 'Produto atualizado!');
    }

    public function destroy(string $id)
    {
        $produto = Produto::findOrFail($id);

        if ($produto->usuario_id !== Auth::id()) {
            abort(403);
        }

        Storage::disk('public')->delete($produto->foto);

        $produto->delete();

        return redirect()->route('produtos.index')->with('sucesso', 'Produto excluído!');
    }
}
