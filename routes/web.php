<?php

use App\Http\Controllers\{HomeController, ProfileController};
use Illuminate\Support\Facades\Route;

// Public guest routes
Route::middleware(['role.redirect'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::get('/about', [HomeController::class, 'about'])->name('home.about');
    Route::get('/contact', [HomeController::class, 'contact'])->name('home.contact');
    Route::get('/modalite/{boutique}', [App\Http\Controllers\HomeController::class, 'modalite'])->name('home.modalite');
    Route::get('/blog', [HomeController::class, 'blog'])->name('home.blog');
    Route::get('/produits', [App\Http\Controllers\ProduitController::class, 'index'])->name('produit.index');
    Route::get('/produits/{produit:name}', [App\Http\Controllers\ProduitController::class, 'show'])->name('produit.show');
    Route::get('/boutiques', [App\Http\Controllers\BoutiqueController::class, 'index'])->name('boutique.index');
    Route::get('/boutiques/{boutique:slug}', [App\Http\Controllers\BoutiqueController::class, 'show'])->name('boutique.show');
});

// Authenticated user profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Seller routes
Route::middleware(['auth', 'seller'])->prefix('seller')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Auth\Seller\DashboardController::class, 'index'])->name('seller.dashboard.index');
    Route::resource('boutiques', App\Http\Controllers\Auth\Seller\BoutiqueController::class)->parameters(['boutiques' => 'boutique:slug'])->names('seller.boutique');
    Route::resource('categories', App\Http\Controllers\Auth\Seller\CategorieController::class)->parameters(['categories' => 'categorie'])->names('seller.categorie');
    Route::resource('produits', App\Http\Controllers\Auth\Seller\ProduitController::class)->parameters(['produits' => 'produit'])->names('seller.produit');
    Route::resource('commandes', App\Http\Controllers\Auth\Seller\CommandeController::class)->parameters(['commandes' => 'commande'])->names('seller.commande')->except(['destroy', 'store']);
});

// Buyer routes
Route::middleware(['auth', 'buyer'])->prefix('buyer')->group(function () {
    Route::get('/panier', [HomeController::class, 'panier'])->name('home.panier');
    Route::get('/dashboard', [App\Http\Controllers\Auth\Buyer\DashboardController::class, 'index'])->name('buyer.dashboard.index');
    Route::resource('boutiques', App\Http\Controllers\Auth\Buyer\BoutiqueController::class)->parameters(['boutiques' => 'boutique:slug'])->names('buyer.boutique');
    Route::resource('produits', App\Http\Controllers\Auth\Buyer\ProduitController::class)->parameters(['produits' => 'produit'])->names('buyer.produit');
    Route::resource('commandes', App\Http\Controllers\Auth\Buyer\CommandeController::class)->names('buyer.commande');
    Route::resource('commande-items', App\Http\Controllers\Auth\Buyer\CommandeItemController::class)->names('buyer.commandeItem');
    Route::resource('paniers', App\Http\Controllers\Auth\Buyer\PanierController::class)->names('buyer.panier');
    Route::resource('panier-items', App\Http\Controllers\Auth\Buyer\PanierItemController::class)->names('buyer.panierItem');
    Route::resource('favoris', App\Http\Controllers\Auth\Buyer\FavorisController::class)->names('buyer.favoris');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin/dashboard')->group(function () {
    Route::get('/', [App\Http\Controllers\Auth\Admin\DashboardController::class, 'stats'])->name('admin.dashboard.stats');
    Route::resource('boutiques', App\Http\Controllers\Auth\Admin\BoutiqueController::class)->parameters(['boutiques' => 'boutique:slug'])->names('admin.boutique');
    Route::resource('categories', App\Http\Controllers\Auth\Admin\CategorieController::class)->parameters(['categories' => 'categorie'])->names('admin.categorie');
    Route::resource('produits', App\Http\Controllers\Auth\Admin\ProduitController::class)->parameters(['produits' => 'produit'])->names('admin.produit');
    Route::resource('commandes', App\Http\Controllers\Auth\Admin\CommandeController::class)->names('admin.commande');
    Route::resource('commande-items', App\Http\Controllers\Auth\Admin\CommandeItemController::class)->names('admin.commandeItem');
    Route::resource('paniers', App\Http\Controllers\Auth\Admin\PanierController::class)->names('admin.panier');
    Route::resource('panier-items', App\Http\Controllers\Auth\Admin\PanierItemController::class)->names('admin.panierItem');
    Route::resource('/users', App\Http\Controllers\Auth\Admin\UserController::class)->names('admin.user');

});

require __DIR__.'/auth.php';
