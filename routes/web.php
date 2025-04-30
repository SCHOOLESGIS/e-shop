<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['guest'])->group(function () {
    Route::get("/", [HomeController::class, 'index'])->name('home.edit');
    Route::get("/about", [HomeController::class, 'about'])->name('home.about');
    Route::get("/produits", [App\Http\Controllers\ProduitController::class, 'index'])->name('produit.index');
    Route::get("/produits/{produit:name}", [App\Http\Controllers\ProduitController::class, 'show'])->name('produit.show');
    Route::get("/boutiques", [App\Http\Controllers\BoutiqueController::class, 'index'])->name('boutique.index');
    Route::get("/boutiques/{boutique:slug}", [App\Http\Controllers\BoutiqueController::class, 'show'])->name('boutique.show');
});

Route::middleware(['auth', 'seller'])->prefix("seller")->group(function () {
    Route::get("/boutiques", [\App\Http\Controllers\Auth\Seller\BoutiqueController::class, 'index'])->name('seller.boutique.index');
    Route::get("/boutiques/{boutique:slug}", [\App\Http\Controllers\Auth\Seller\BoutiqueController::class, 'show'])->name('seller.boutique.show');
    Route::get("/boutiques/create", [\App\Http\Controllers\Auth\Seller\BoutiqueController::class, 'create'])->name('seller.boutique.create');
    Route::get("/boutiques/{boutique:slug}/edit", [\App\Http\Controllers\Auth\Seller\BoutiqueController::class, 'edit'])->name('seller.boutique.edit');
    Route::post("/boutiques/create", [\App\Http\Controllers\Auth\Seller\BoutiqueController::class, 'store'])->name('seller.boutique.store');
    Route::put("/boutiques/{boutique:slug}/edit", [\App\Http\Controllers\Auth\Seller\BoutiqueController::class, 'update'])->name('seller.boutique.update');
    Route::delete("/boutiques/{boutique:slug}", [\App\Http\Controllers\Auth\Seller\BoutiqueController::class, 'destroy'])->name('seller.boutique.destroy');

    Route::get("/categories", [\App\Http\Controllers\Auth\Seller\CategorieController::class, 'index'])->name('seller.categorie.index');
    Route::get("/categories/{categorie:slug}", [\App\Http\Controllers\Auth\Seller\CategorieController::class, 'show'])->name('seller.categorie.show');
    Route::get("/categories/create", [\App\Http\Controllers\Auth\Seller\CategorieController::class, 'create'])->name('seller.categorie.create');
    Route::get("/categories/{categorie:slug}/edit", [\App\Http\Controllers\Auth\Seller\CategorieController::class, 'edit'])->name('seller.categorie.edit');
    Route::post("/categories/create", [\App\Http\Controllers\Auth\Seller\CategorieController::class, 'store'])->name('seller.categorie.store');
    Route::put("/categories/{categorie:slug}/edit", [\App\Http\Controllers\Auth\Seller\CategorieController::class, 'update'])->name('seller.categorie.update');
    Route::delete("/categories/{categorie:slug}", [\App\Http\Controllers\Auth\Seller\CategorieController::class, 'destroy'])->name('seller.categorie.destroy');

    Route::get("/produits", [\App\Http\Controllers\Auth\Seller\ProduitController::class, 'index'])->name('seller.produit.index');
    Route::get("/produits/{produit:slug}", [\App\Http\Controllers\Auth\Seller\ProduitController::class, 'show'])->name('seller.produit.show');
    Route::get("/produits/create", [\App\Http\Controllers\Auth\Seller\ProduitController::class, 'create'])->name('seller.produit.create');
    Route::get("/produits/{produit:slug}/edit", [\App\Http\Controllers\Auth\Seller\ProduitController::class, 'edit'])->name('seller.produit.edit');
    Route::post("/produits/create", [\App\Http\Controllers\Auth\Seller\ProduitController::class, 'store'])->name('seller.produit.store');
    Route::put("/produits/{produit:slug}/edit", [\App\Http\Controllers\Auth\Seller\ProduitController::class, 'update'])->name('seller.produit.update');
    Route::delete("/produits/{produit:slug}", [\App\Http\Controllers\Auth\Seller\ProduitController::class, 'destroy'])->name('seller.produit.destroy');
});

Route::middleware(['auth', 'buyer'])->prefix("buyer")->group(function () {
    Route::get("/boutiques", [\App\Http\Controllers\Auth\Buyer\BoutiqueController::class, 'index'])->name('buyer.boutique.index');
    Route::get("/boutiques/{boutique:slug}", [\App\Http\Controllers\Auth\Buyer\BoutiqueController::class, 'show'])->name('buyer.boutique.show');

    Route::get("/produits", [\App\Http\Controllers\Auth\Buyer\ProduitController::class, 'index'])->name('buyer.produit.index');
    Route::get("/produits/{produit:slug}", [\App\Http\Controllers\Auth\Buyer\ProduitController::class, 'show'])->name('buyer.produit.show');

    Route::get("/commandes", [\App\Http\Controllers\Auth\Buyer\CommandeController::class, 'index'])->name('buyer.commande.index');
    Route::get("/commandes/{commande}", [\App\Http\Controllers\Auth\Buyer\CommandeController::class, 'show'])->name('buyer.commande.show');
    Route::get("/commandes/create", [\App\Http\Controllers\Auth\Buyer\CommandeController::class, 'create'])->name('buyer.commande.create');
    Route::get("/commandes/{commande}/edit", [\App\Http\Controllers\Auth\Buyer\CommandeController::class, 'edit'])->name('buyer.commande.edit');
    Route::post("/commandes/create", [\App\Http\Controllers\Auth\Buyer\CommandeController::class, 'store'])->name('buyer.commande.store');
    Route::put("/commandes/{commande}/edit", [\App\Http\Controllers\Auth\Buyer\CommandeController::class, 'update'])->name('buyer.commande.update');
    Route::delete("/commandes/{commande}", [\App\Http\Controllers\Auth\Buyer\CommandeController::class, 'destroy'])->name('buyer.commande.destroy');

    Route::get("/commande-items", [\App\Http\Controllers\Auth\Buyer\CommandeItemController::class, 'index'])->name('buyer.commandeItem.index');
    Route::get("/commande-items/{commandeItem}", [\App\Http\Controllers\Auth\Buyer\CommandeItemController::class, 'show'])->name('buyer.commandeItem.show');
    Route::get("/commande-items/create", [\App\Http\Controllers\Auth\Buyer\CommandeItemController::class, 'create'])->name('buyer.commandeItem.create');
    Route::get("/commande-items/{commandeItem}/edit", [\App\Http\Controllers\Auth\Buyer\CommandeItemController::class, 'edit'])->name('buyer.commandeItem.edit');
    Route::post("/commande-items/create", [\App\Http\Controllers\Auth\Buyer\CommandeItemController::class, 'store'])->name('buyer.commandeItem.store');
    Route::put("/commande-items/{commandeItem}/edit", [\App\Http\Controllers\Auth\Buyer\CommandeItemController::class, 'update'])->name('buyer.commandeItem.update');
    Route::delete("/commande-items/{commandeItem}", [\App\Http\Controllers\Auth\Buyer\CommandeItemController::class, 'destroy'])->name('buyer.commandeItem.destroy');

    Route::get("/paniers", [\App\Http\Controllers\Auth\Buyer\PanierController::class, 'index'])->name('buyer.panier.index');
    Route::get("/paniers/{panier}", [\App\Http\Controllers\Auth\Buyer\PanierController::class, 'show'])->name('buyer.panier.show');
    Route::get("/paniers/create", [\App\Http\Controllers\Auth\Buyer\PanierController::class, 'create'])->name('buyer.panier.create');
    Route::get("/paniers/{panier}/edit", [\App\Http\Controllers\Auth\Buyer\PanierController::class, 'edit'])->name('buyer.panier.edit');
    Route::post("/paniers/create", [\App\Http\Controllers\Auth\Buyer\PanierController::class, 'store'])->name('buyer.panier.store');
    Route::put("/paniers/{panier}/edit", [\App\Http\Controllers\Auth\Buyer\PanierController::class, 'update'])->name('buyer.panier.update');
    Route::delete("/paniers/{panier}", [\App\Http\Controllers\Auth\Buyer\PanierController::class, 'destroy'])->name('buyer.panier.destroy');

    Route::get("/panier-items", [\App\Http\Controllers\Auth\Buyer\PanierItemController::class, 'index'])->name('buyer.panierItem.index');
    Route::get("/panier-items/{panierItem}", [\App\Http\Controllers\Auth\Buyer\PanierItemController::class, 'show'])->name('buyer.panierItem.show');
    Route::get("/panier-items/create", [\App\Http\Controllers\Auth\Buyer\PanierItemController::class, 'create'])->name('buyer.panierItem.create');
    Route::get("/panier-items/{panierItem}/edit", [\App\Http\Controllers\Auth\Buyer\PanierItemController::class, 'edit'])->name('buyer.panierItem.edit');
    Route::post("/panier-items/create", [\App\Http\Controllers\Auth\Buyer\PanierItemController::class, 'store'])->name('buyer.panierItem.store');
    Route::put("/panier-items/{panierItem}/edit", [\App\Http\Controllers\Auth\Buyer\PanierItemController::class, 'update'])->name('buyer.panierItem.update');
    Route::delete("/panier-items/{panierItem}", [\App\Http\Controllers\Auth\Buyer\PanierItemController::class, 'destroy'])->name('buyer.panierItem.destroy');
});

Route::middleware(['auth', 'admin'])->prefix("admin")->group(function () {
    Route::get("/boutiques", [\App\Http\Controllers\Auth\Admin\BoutiqueController::class, 'index'])->name('admin.boutique.index');
    Route::get("/boutiques/{boutique:slug}", [\App\Http\Controllers\Auth\Admin\BoutiqueController::class, 'show'])->name('admin.boutique.show');
    Route::get("/boutiques/create", [\App\Http\Controllers\Auth\Admin\BoutiqueController::class, 'create'])->name('admin.boutique.create');
    Route::get("/boutiques/{boutique:slug}/edit", [\App\Http\Controllers\Auth\Admin\BoutiqueController::class, 'edit'])->name('admin.boutique.edit');
    Route::post("/boutiques/create", [\App\Http\Controllers\Auth\Admin\BoutiqueController::class, 'store'])->name('admin.boutique.store');
    Route::put("/boutiques/{boutique:slug}/edit", [\App\Http\Controllers\Auth\Admin\BoutiqueController::class, 'update'])->name('admin.boutique.update');
    Route::delete("/boutiques/{boutique:slug}", [\App\Http\Controllers\Auth\Admin\BoutiqueController::class, 'destroy'])->name('admin.boutique.destroy');

    Route::get("/produits", [\App\Http\Controllers\Auth\Admin\ProduitController::class, 'index'])->name('admin.produit.index');
    Route::get("/produits/{produit:slug}", [\App\Http\Controllers\Auth\Admin\ProduitController::class, 'show'])->name('admin.produit.show');
    Route::get("/produits/create", [\App\Http\Controllers\Auth\Admin\ProduitController::class, 'create'])->name('admin.produit.create');
    Route::get("/produits/{produit:slug}/edit", [\App\Http\Controllers\Auth\Admin\ProduitController::class, 'edit'])->name('admin.produit.edit');
    Route::post("/produits/create", [\App\Http\Controllers\Auth\Admin\ProduitController::class, 'store'])->name('admin.produit.store');
    Route::put("/produits/{produit:slug}/edit", [\App\Http\Controllers\Auth\Admin\ProduitController::class, 'update'])->name('admin.produit.update');
    Route::delete("/produits/{produit:slug}", [\App\Http\Controllers\Auth\Admin\ProduitController::class, 'destroy'])->name('admin.produit.destroy');

    Route::get("/commandes", [\App\Http\Controllers\Auth\Admin\CommandeController::class, 'index'])->name('admin.commande.index');
    Route::get("/commandes/{commande}", [\App\Http\Controllers\Auth\Admin\CommandeController::class, 'show'])->name('admin.commande.show');
    Route::get("/commandes/create", [\App\Http\Controllers\Auth\Admin\CommandeController::class, 'create'])->name('admin.commande.create');
    Route::get("/commandes/{commande}/edit", [\App\Http\Controllers\Auth\Admin\CommandeController::class, 'edit'])->name('admin.commande.edit');
    Route::post("/commandes/create", [\App\Http\Controllers\Auth\Admin\CommandeController::class, 'store'])->name('admin.commande.store');
    Route::put("/commandes/{commande}/edit", [\App\Http\Controllers\Auth\Admin\CommandeController::class, 'update'])->name('admin.commande.update');
    Route::delete("/commandes/{commande}", [\App\Http\Controllers\Auth\Admin\CommandeController::class, 'destroy'])->name('admin.commande.destroy');

    Route::get("/commande-items", [\App\Http\Controllers\Auth\Admin\CommandeItemController::class, 'index'])->name('admin.commandeItem.index');
    Route::get("/commande-items/{commandeItem}", [\App\Http\Controllers\Auth\Admin\CommandeItemController::class, 'show'])->name('admin.commandeItem.show');
    Route::get("/commande-items/create", [\App\Http\Controllers\Auth\Admin\CommandeItemController::class, 'create'])->name('admin.commandeItem.create');
    Route::get("/commande-items/{commandeItem}/edit", [\App\Http\Controllers\Auth\Admin\CommandeItemController::class, 'edit'])->name('admin.commandeItem.edit');
    Route::post("/commande-items/create", [\App\Http\Controllers\Auth\Admin\CommandeItemController::class, 'store'])->name('admin.commandeItem.store');
    Route::put("/commande-items/{commandeItem}/edit", [\App\Http\Controllers\Auth\Admin\CommandeItemController::class, 'update'])->name('admin.commandeItem.update');
    Route::delete("/commande-items/{commandeItem}", [\App\Http\Controllers\Auth\Admin\CommandeItemController::class, 'destroy'])->name('admin.commandeItem.destroy');

    Route::get("/paniers", [\App\Http\Controllers\Auth\Admin\PanierController::class, 'index'])->name('admin.panier.index');
    Route::get("/paniers/{panier}", [\App\Http\Controllers\Auth\Admin\PanierController::class, 'show'])->name('admin.panier.show');
    Route::get("/paniers/create", [\App\Http\Controllers\Auth\Admin\PanierController::class, 'create'])->name('admin.panier.create');
    Route::get("/paniers/{panier}/edit", [\App\Http\Controllers\Auth\Admin\PanierController::class, 'edit'])->name('admin.panier.edit');
    Route::post("/paniers/create", [\App\Http\Controllers\Auth\Admin\PanierController::class, 'store'])->name('admin.panier.store');
    Route::put("/paniers/{panier}/edit", [\App\Http\Controllers\Auth\Admin\PanierController::class, 'update'])->name('admin.panier.update');
    Route::delete("/paniers/{panier}", [\App\Http\Controllers\Auth\Admin\PanierController::class, 'destroy'])->name('admin.panier.destroy');

    Route::get("/panier-items", [\App\Http\Controllers\Auth\Admin\PanierItemController::class, 'index'])->name('admin.panierItem.index');
    Route::get("/panier-items/{panierItem}", [\App\Http\Controllers\Auth\Admin\PanierItemController::class, 'show'])->name('admin.panierItem.show');
    Route::get("/panier-items/create", [\App\Http\Controllers\Auth\Admin\PanierItemController::class, 'create'])->name('admin.panierItem.create');
    Route::get("/panier-items/{panierItem}/edit", [\App\Http\Controllers\Auth\Admin\PanierItemController::class, 'edit'])->name('admin.panierItem.edit');
    Route::post("/panier-items/create", [\App\Http\Controllers\Auth\Admin\PanierItemController::class, 'store'])->name('admin.panierItem.store');
    Route::put("/panier-items/{panierItem}/edit", [\App\Http\Controllers\Auth\Admin\PanierItemController::class, 'update'])->name('admin.panierItem.update');
    Route::delete("/panier-items/{panierItem}", [\App\Http\Controllers\Auth\Admin\PanierItemController::class, 'destroy'])->name('admin.panierItem.destroy');
});

require __DIR__.'/auth.php';
