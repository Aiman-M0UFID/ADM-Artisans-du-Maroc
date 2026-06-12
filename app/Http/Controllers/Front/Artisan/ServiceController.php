<?php

namespace App\Http\Controllers\Front\Artisan;

use App\Http\Controllers\Controller;
use App\Models\Front\Admin\Categorie;
use App\Models\Front\Artisan\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * ServiceController — Version sécurisée
 * 
 * Corrections cybersécurité appliquées :
 * 1. Validation stricte du type et de la taille des fichiers uploadés (mimes + max)
 * 2. Nommage sécurisé des fichiers (Str::uuid au lieu de time())
 * 3. Vérification que l'artisan ne peut modifier/supprimer QUE ses propres services
 * 4. Logging des actions sensibles
 */
class ServiceController extends Controller
{
    /**
     * Liste des services de l'artisan connecté uniquement.
     */
    public function index()
    {
        $services = Service::where('user_id', auth()->user()->id)->get();
        return view('Front.service.index', compact('services'));
    }

    /**
     * Formulaire de création.
     */
    public function create()
    {
        $categories = Categorie::all();
        return view('Front.service.create', compact('categories'));
    }

    /**
     * Enregistrement d'un nouveau service.
     * 
     * ✅ Validation stricte : image obligatoire, format jpeg/png/jpg/webp, max 2MB
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nom'          => 'required|string|max:255',
            'title'        => 'nullable|string|max:255',
            'experience'   => 'required|integer|min:0|max:60',
            'categorie_id' => 'required|exists:categories,id',
            'details'      => 'nullable|string|max:2000',
            // ✅ Validation sécurisée de l'image
            'image'        => 'required|file|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // ✅ Nom de fichier sécurisé avec UUID (évite les collisions et injections)
        $image      = $request->file('image');
        $image_name = \Illuminate\Support\Str::uuid() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images_service'), $image_name);

        $service               = new Service;
        $service->nom          = $request->nom;
        $service->title        = $request->title;
        $service->image        = $image_name;
        $service->experience   = $request->experience;
        $service->user_id      = Auth::user()->id;
        $service->categorie_id = $request->categorie_id;
        $service->details      = $request->details;
        $service->save();

        // ✅ Log de l'action
        Log::info('Service créé', ['user_id' => Auth::id(), 'service_id' => $service->id]);

        return redirect()->back()->with('success', 'Service ajouté avec succès.');
    }

    /**
     * Formulaire de modification.
     * 
     * ✅ Vérification que le service appartient à l'artisan connecté
     */
    public function edit(string $id)
    {
        $categories = Categorie::all();
        $service    = Service::where('id', $id)
                             ->where('user_id', Auth::id()) // ✅ sécurité
                             ->firstOrFail();

        return view('Front.service.edit', compact('service', 'categories'));
    }

    /**
     * Mise à jour d'un service.
     * 
     * ✅ Vérification que l'artisan est bien le propriétaire
     * ✅ Validation de l'image si fournie
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'nom'          => 'required|string|max:255',
            'title'        => 'nullable|string|max:255',
            'experience'   => 'required|integer|min:0|max:60',
            'categorie_id' => 'required|exists:categories,id',
            'details'      => 'nullable|string|max:2000',
            // ✅ Image optionnelle à la modification, mais validée si fournie
            'image'        => 'nullable|file|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // ✅ L'artisan ne peut modifier que SES services
        $service = Service::where('id', $id)
                          ->where('user_id', Auth::id())
                          ->firstOrFail();

        $service->nom          = $request->nom;
        $service->title        = $request->title;
        $service->experience   = $request->experience;
        $service->categorie_id = $request->categorie_id;
        $service->details      = $request->details;

        if ($request->hasFile('image')) {
            $image            = $request->file('image');
            $image_name       = \Illuminate\Support\Str::uuid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images_service'), $image_name);
            $service->image   = $image_name;
        }

        $service->save();

        Log::info('Service modifié', ['user_id' => Auth::id(), 'service_id' => $service->id]);

        return redirect()->route('sevice')->with('success', 'Service modifié avec succès.');
    }

    /**
     * Suppression d'un service.
     * 
     * ✅ Vérification que l'artisan est bien le propriétaire
     */
    public function destroy(string $id)
    {
        // ✅ L'artisan ne peut supprimer que SES services
        $service = Service::where('id', $id)
                          ->where('user_id', Auth::id())
                          ->firstOrFail();

        $service->delete();

        Log::info('Service supprimé', ['user_id' => Auth::id(), 'service_id' => $id]);

        return redirect()->back()->with('success', 'Service supprimé avec succès.');
    }
}
