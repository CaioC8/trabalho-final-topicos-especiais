<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255|unique:categorias,nome',
        ]);

        Categoria::create($request->only('nome'));

        return redirect()->route('categorias.index')
            ->with('sucesso', 'Categoria criada com sucesso!');
    }

    public function edit(string $id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, string $id)
    {
        $categoria = Categoria::findOrFail($id);

        $request->validate([
            'nome' => 'required|string|max:255|unique:categorias,nome,' . $categoria->id,
        ]);

        $categoria->update($request->only('nome'));

        return redirect()->route('categorias.index')
            ->with('sucesso', 'Categoria atualizada com sucesso!');
    }

    public function destroy(string $id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();

        return redirect()->route('categorias.index')
            ->with('sucesso', 'Categoria excluída!');
    }
}
