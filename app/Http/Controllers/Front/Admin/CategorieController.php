<?php

namespace App\Http\Controllers\Front\Admin;

use App\Http\Controllers\Controller;
use App\Models\Front\Admin\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * CategorieController — Version sécurisée
 * 
 * Corrections cybersécurité appliquées :
 * 1. Validation stricte du type et de la taille des fichiers uploadés
 * 2. Nommage sécurisé des fichiers avec UUID
 * 3. Logging des actions sensibles (admin)
 */
class CategorieController extends Controller
{
    public function index()
    {
        $categories = Categorie::all();
        return view('Front.categorie.index', compact('categories'));
    }

    public function create()
    {
        return view('Front.categorie.create');
    }

    /**
     * ✅ Validation stricte de l'image
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'     => 'required|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            // ✅ Image obligatoire, format contrôlé, taille max 2MB
            'image'     => 'required|file|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $image      = $request->file('image');
        $image_name = \Illuminate\Support\Str::uuid() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images_categorie'), $image_name);

        $categorie            = new Categorie;
        $categorie->title     = $request->title;
        $categorie->sub_title = $request->sub_title;
        $categorie->image     = $image_name;
        $categorie->save();

        Log::info('Catégorie créée', ['admin_id' => Auth::id(), 'categorie_id' => $categorie->id]);

        return redirect()->back()->with('success', 'Catégorie ajoutée avec succès.');
    }

    /**
     * ✅ Image optionnelle à la modification, validée si fournie
     */
    public function edit(string $id)
    {
        $categorie = Categorie::findOrFail($id);
        return view('Front.categorie.edit', compact('categorie'));
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'title'     => 'required|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'image'     => 'nullable|file|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $categorie            = Categorie::findOrFail($id);
        $categorie->title     = $request->title;
        $categorie->sub_title = $request->sub_title;

        if ($request->hasFile('image')) {
            $image            = $request->file('image');
            $image_name       = \Illuminate\Support\Str::uuid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images_categorie'), $image_name);
            $categorie->image = $image_name;
        }

        $categorie->save();

        Log::info('Catégorie modifiée', ['admin_id' => Auth::id(), 'categorie_id' => $id]);

        return redirect()->route('categorie')->with('success', 'Catégorie modifiée avec succès.');
    }

    public function destroy(string $id)
    {
        $categorie = Categorie::findOrFail($id);
        $categorie->delete();

        Log::info('Catégorie supprimée', ['admin_id' => Auth::id(), 'categorie_id' => $id]);

        return redirect()->back()->with('success', 'Catégorie supprimée avec succès.');
    }
}
