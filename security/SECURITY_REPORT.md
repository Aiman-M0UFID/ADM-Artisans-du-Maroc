# 🔐 Rapport de Sécurité — ADM Artisans du Maroc

> Analyse et corrections des vulnérabilités de l'application Laravel ADM.
> Réalisé dans le cadre du projet académique — Licence Informatique.

---

## 📋 Résumé des vulnérabilités trouvées et corrigées

| # | Vulnérabilité | Fichier concerné | Sévérité | Statut |
|---|---|---|---|---|
| 1 | Aucun contrôle de rôle sur `/admin` | `routes/web.php` | 🔴 Critique | ✅ Corrigé |
| 2 | Aucun contrôle de rôle sur `/artisan` | `routes/web.php` | 🔴 Critique | ✅ Corrigé |
| 3 | Upload de fichier sans validation du type | `ServiceController.php` | 🔴 Critique | ✅ Corrigé |
| 4 | Upload de fichier sans validation du type | `CategorieController.php` | 🔴 Critique | ✅ Corrigé |
| 5 | Un artisan peut modifier/supprimer les services d'un autre | `ServiceController.php` | 🔴 Critique | ✅ Corrigé |
| 6 | Inscription possible avec `type_user=admin` | `RegisteredUserController.php` | 🟠 Haute | ✅ Corrigé |
| 7 | Code mort dans l'inscription (logique incorrecte) | `RegisteredUserController.php` | 🟡 Moyenne | ✅ Corrigé |
| 8 | Nommage des fichiers uploadés prévisible (`time()`) | `ServiceController.php` | 🟡 Moyenne | ✅ Corrigé |
| 9 | Pas de logging des actions sensibles | Tous les controllers | 🟡 Moyenne | ✅ Corrigé |

---

## 🔴 Vulnérabilités Critiques

### 1 & 2 — Absence de contrôle de rôle (IDOR / Broken Access Control)

**Problème :** N'importe quel utilisateur connecté (client, artisan) pouvait accéder à `/admin` et gérer les catégories, ou accéder à `/artisan` et créer des services.

```php
// ❌ AVANT — vérifie seulement que l'utilisateur est connecté
Route::group(['middleware' => 'auth', 'prefix' => 'admin'], ...)
```

**Correction :** Création de deux middlewares dédiés `AdminMiddleware` et `ArtisanMiddleware` qui vérifient le champ `type_user` en base.

```php
// ✅ APRÈS — vérifie le rôle exact
Route::group(['middleware' => ['auth', 'role.admin'], 'prefix' => 'admin'], ...)
Route::group(['middleware' => ['auth', 'role.artisan'], 'prefix' => 'artisan'], ...)
```

**Fichiers créés :**
- `app/Http/Middleware/AdminMiddleware.php`
- `app/Http/Middleware/ArtisanMiddleware.php`
- `app/Http/Kernel.php` → enregistrement des aliases `role.admin` et `role.artisan`

---

### 3 & 4 — Upload de fichier non sécurisé (Unrestricted File Upload)

**Problème :** Aucune validation du type de fichier uploadé. Un attaquant pouvait uploader un fichier `.php` malveillant et l'exécuter depuis le navigateur.

```php
// ❌ AVANT — aucune validation
if ($request->hasFile('image')) {
    $image->move(public_path('images_service'), $image_name);
}
```

**Correction :** Validation stricte avec les règles Laravel.

```php
// ✅ APRÈS
'image' => 'required|file|mimes:jpeg,png,jpg,webp|max:2048'
```

---

### 5 — IDOR sur les services (Insecure Direct Object Reference)

**Problème :** Un artisan pouvait modifier ou supprimer les services d'un autre artisan en changeant l'`id` dans l'URL.

```
GET /artisan/service-edit/15  → accès au service d'un autre artisan ❌
```

**Correction :** Ajout d'une vérification `user_id` dans chaque requête.

```php
// ✅ APRÈS
$service = Service::where('id', $id)
                  ->where('user_id', Auth::id())
                  ->firstOrFail();
```

---

## 🟠 Vulnérabilités Hautes

### 6 — Escalade de privilèges à l'inscription

**Problème :** Le champ `type_user` était accepté sans restriction. Un attaquant pouvait envoyer `type_user=admin` via une requête HTTP forgée et obtenir les droits admin.

```php
// ❌ AVANT
'type_user' => ['required', 'string', 'max:255'],
```

**Correction :** Validation avec `in:` pour n'autoriser que les valeurs attendues.

```php
// ✅ APRÈS — impossible de s'inscrire comme admin
'type_user' => ['required', 'string', 'in:client,artisan'],
```

---

## 🟡 Vulnérabilités Moyennes

### 7 — Code mort (logique incorrecte)

Le `RegisteredUserController` contenait un second bloc `if` après un `return`, donc jamais exécuté. Supprimé et logique clarifiée.

### 8 — Nommage prévisible des fichiers uploadés

`time()` génère des noms prévisibles (timestamp UNIX). Remplacé par `Str::uuid()` pour des noms aléatoires impossibles à deviner.

### 9 — Absence de logging

Aucune trace des actions sensibles (création/modification/suppression). Ajout de `Log::info()` sur toutes les actions admin et artisan.

---

## ✅ Ce qui était déjà bien sécurisé

- **Protection CSRF** : active par défaut via `VerifyCsrfToken` middleware
- **Hashage des mots de passe** : `Hash::make()` → bcrypt
- **Validation des inputs** : présente dans les controllers
- **Sessions sécurisées** : `session()->regenerate()` après login
- **Laravel Sanctum** : sessions API sécurisées
- **`.env` dans `.gitignore`** : les credentials ne sont pas exposés sur GitHub

---

## 📁 Fichiers à remplacer dans le projet

```
app/
├── Http/
│   ├── Kernel.php                              ← remplacer
│   ├── Middleware/
│   │   ├── AdminMiddleware.php                 ← nouveau fichier
│   │   └── ArtisanMiddleware.php               ← nouveau fichier
│   └── Controllers/
│       ├── Auth/
│       │   └── RegisteredUserController.php    ← remplacer
│       └── Front/
│           ├── Admin/CategorieController.php   ← remplacer
│           └── Artisan/ServiceController.php   ← remplacer
routes/
└── web.php                                     ← remplacer
```

---

*Rapport rédigé dans le cadre du projet ADM — Licence Informatique*
