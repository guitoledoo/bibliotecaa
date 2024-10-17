<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use Illuminate\Http\Request;

class LivrosController extends Controller
{
    
    public function index()
    {
        $livros = Livro::paginate(10);
        return view('livros.index', compact('livros'));
    }

    
    public function create()
    {
        return view('livros.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'ISBN' => 'required|string|unique:livros',
            'editora' => 'required|string|max:255',
            'ano_publicacao' => 'required|integer',
        ]);
        
    Livro::create($request->all());
    return redirect()->route('livros.index')->with('success', 'Livro criado com sucesso.');
    }

    
    public function show(Livro $livros)
    {
        return view('livros.show', compact('livros'));

    }

    
    public function edit(Livro $livros)
    {
        return view('livros.edit', compact('livros'));
    }

   
    public function update(Request $request, Livro $livros)
    {
        $request->validate([
            'titulo' => 'required',
            'autor' => 'required',
            'isbn' => 'required',
            'editora' => 'required',
            'ano_publicacao' => 'required',
            
        ]);

        $livros->update($request->all());
        return redirect()->route('livros.index')->with('success', 'Livro atualizado com sucesso.');
    }

   
    public function destroy(Livro $livros)
    {
        $livros->delete();
        return redirect()->route('livros.index')->with('success', 'Livro deletado com sucesso.');
    }
}
