<?php

namespace Database\Seeders;

use App\Models\Boutique;
use App\Models\Categorie;
use App\Models\Commande;
use App\Models\CommandeItem;
use App\Models\Panier;
use App\Models\PanierItem;
use App\Models\Produit;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin'),
            'role' => 'admin'
        ]);

        // Liste d'utilisateurs avec les boutiques réparties
        $usersSellers = [
            ['name' => 'Hugo Bernard', 'email' => 'hugo.bernard@example.com', 'role' => 'seller', 'boutiques' => [
                ['name' => "Hugo's Boutique 1", 'slug' => 'hugo-boutique-1', 'description' => 'Bienvenue dans notre boutique en ligne, où nous vous proposons les meilleurs produits de qualité.'],
                ['name' => "Hugo's Boutique 2", 'slug' => 'hugo-boutique-2', 'description' => 'Découvrez nos produits exclusifs, soigneusement sélectionnés pour répondre à vos besoins.'],
                ['name' => "Hugo's Boutique 3", 'slug' => 'hugo-boutique-3', 'description' => 'Votre satisfaction est notre priorité, explorez nos produits et trouvez ce que vous cherchez.'],
                ['name' => "Hugo's Boutique 4", 'slug' => 'hugo-boutique-4', 'description' => 'Une large gamme de produits vous attend. Profitez de la qualité à des prix compétitifs.'],
                ['name' => "Hugo's Boutique 5", 'slug' => 'hugo-boutique-5', 'description' => 'Nous offrons une variété de produits à des prix abordables, pour tous vos besoins.'],
            ]],
            ['name' => 'Bernard Lemoine', 'email' => 'bernard.lemoine@example.com', 'role' => 'seller', 'boutiques' => [
                ['name' => "Bernard's Boutique 1", 'slug' => 'bernard-boutique-1', 'description' => 'Nos produits sont de haute qualité et viennent d\'artisans locaux.'],
                ['name' => "Bernard's Boutique 2", 'slug' => 'bernard-boutique-2', 'description' => 'Découvrez nos produits faits main, réalisés avec soin et passion.'],
                ['name' => "Bernard's Boutique 3", 'slug' => 'bernard-boutique-3', 'description' => 'Des produits exclusifs pour satisfaire tous vos besoins.'],
                ['name' => "Bernard's Boutique 4", 'slug' => 'bernard-boutique-4', 'description' => 'Une boutique pleine de nouveautés. Ne manquez pas nos meilleures offres.'],
                ['name' => "Bernard's Boutique 5", 'slug' => 'bernard-boutique-5', 'description' => 'Offrez-vous les meilleurs produits à des prix compétitifs.'],
            ]],
            ['name' => 'David Lefevre', 'email' => 'david.lefevre@example.com', 'role' => 'seller', 'boutiques' => [
                ['name' => "David's Boutique 1", 'slug' => 'david-boutique-1', 'description' => 'La qualité avant tout, nos produits sont conçus pour durer.'],
                ['name' => "David's Boutique 2", 'slug' => 'david-boutique-2', 'description' => 'Découvrez notre gamme de produits exclusifs et tendance.'],
                ['name' => "David's Boutique 3", 'slug' => 'david-boutique-3', 'description' => 'Notre boutique vous propose des articles pour tous les goûts et tous les budgets.'],
                ['name' => "David's Boutique 4", 'slug' => 'david-boutique-4', 'description' => 'Explorez une large gamme de produits de qualité supérieure.'],
                ['name' => "David's Boutique 5", 'slug' => 'david-boutique-5', 'description' => 'Des produits uniques et originaux pour égayer votre quotidien.'],
            ]],
            ['name' => 'Gabrielle Petit', 'email' => 'gabrielle.petit@example.com', 'role' => 'seller', 'boutiques' => [
                ['name' => "Gabrielle's Boutique 1", 'slug' => 'gabrielle-boutique-1', 'description' => 'Bienvenue dans notre boutique en ligne, une sélection rigoureuse de produits de qualité.'],
                ['name' => "Gabrielle's Boutique 2", 'slug' => 'gabrielle-boutique-2', 'description' => 'Venez découvrir des produits faits main, qui sauront vous séduire.'],
                ['name' => "Gabrielle's Boutique 3", 'slug' => 'gabrielle-boutique-3', 'description' => 'Une sélection exclusive de produits à ne pas manquer.'],
                ['name' => "Gabrielle's Boutique 4", 'slug' => 'gabrielle-boutique-4', 'description' => 'Nos produits sont pensés pour vous apporter le confort et le style que vous recherchez.'],
                ['name' => "Gabrielle's Boutique 5", 'slug' => 'gabrielle-boutique-5', 'description' => 'Explorez une collection unique et découvrez des produits inspirants.'],
            ]],
        ];

        // Création des boutiques pour chaque utilisateur
        foreach ($usersSellers as $userData) {
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => Hash::make('password'), // Password par défaut pour tous les utilisateurs
                'role' => $userData['role'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Création des boutiques pour ce vendeur
            foreach ($userData['boutiques'] as $boutiqueData) {
                Boutique::create([
                    'user_id' => $user->id,
                    'name' => $boutiqueData['name'],
                    'slug' => $boutiqueData['slug'],
                    'logo' => null,
                    'description' => $boutiqueData['description'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $usersBuyer = [
            ['name' => 'Alice Dupont', 'email' => 'alice.dupont@example.com', 'password' => 'password', 'role' => 'buyer'],
            ['name' => 'Caroline Martin', 'email' => 'caroline.martin@example.com', 'password' => 'password', 'role' => 'buyer'],
            ['name' => 'Emma Rousseau', 'email' => 'emma.rousseau@example.com', 'password' => 'password', 'role' => 'buyer'],
            ['name' => 'François Moreau', 'email' => 'francois.moreau@example.com', 'password' => 'password', 'role' => 'buyer'],
            ['name' => 'Julien Lambert', 'email' => 'julien.lambert@example.com', 'password' => 'password', 'role' => 'buyer'],
        ];

        foreach ($usersBuyer as $userData) {
            User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => Hash::make($userData['password']), // Password par défaut pour tous les utilisateurs
                'role' => $userData['role'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        //CATEGORIES
        $categories = [
            ['boutique_id' => 1, 'name' => 'Électronique'],
            ['boutique_id' => 1, 'name' => 'Accessoires mobiles'],
            ['boutique_id' => 2, 'name' => 'Mode femme'],
            ['boutique_id' => 2, 'name' => 'Chaussures'],
            ['boutique_id' => 2, 'name' => 'Bijoux'],
            ['boutique_id' => 3, 'name' => 'Maison & déco'],
            ['boutique_id' => 3, 'name' => 'Luminaires'],
            ['boutique_id' => 3, 'name' => 'Mobilier'],
            ['boutique_id' => 4, 'name' => 'Jeux vidéo'],
            ['boutique_id' => 4, 'name' => 'Informatique'],
            ['boutique_id' => 4, 'name' => 'Accessoires gaming'],
            ['boutique_id' => 4, 'name' => 'PC & composants'],
        ];

        foreach ($categories as $categoryData) {
            Categorie::create([
                'boutique_id' => $categoryData['boutique_id'],
                'name' => $categoryData['name'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        //PRODUITS
        $produits = [
            ['boutique_id' => 1, 'categorie_id' => 1, 'name' => 'Smartphone Galaxy Z', 'description' => 'Un smartphone pliable dernière génération avec écran AMOLED.', 'image' => 'produits/galaxy_z.jpg', 'price' => 1299.99, 'stock' => 15],
            ['boutique_id' => 1, 'categorie_id' => 1, 'name' => 'Casque Bluetooth Sony', 'description' => 'Son immersif, réduction de bruit active, autonomie 30h.', 'image' => 'produits/sony_bt.jpg', 'price' => 199.99, 'stock' => 22],
            ['boutique_id' => 1, 'categorie_id' => 2, 'name' => 'Coque iPhone 14 Pro', 'description' => 'Coque fine et résistante en silicone noir.', 'image' => 'produits/coque_iphone14.jpg', 'price' => 19.99, 'stock' => 80],
            ['boutique_id' => 1, 'categorie_id' => 2, 'name' => 'Chargeur sans fil 15W', 'description' => 'Recharge rapide compatible Qi.', 'image' => 'produits/chargeur_qi.jpg', 'price' => 29.99, 'stock' => 40],

            ['boutique_id' => 2, 'categorie_id' => 3, 'name' => 'Robe Bohème Fleurie', 'description' => 'Tissu fluide, imprimé floral, parfait pour l\'été.', 'image' => 'produits/robe_bohème.jpg', 'price' => 49.99, 'stock' => 32],
            ['boutique_id' => 2, 'categorie_id' => 3, 'name' => 'Blazer Oversize Beige', 'description' => 'Chic et confortable pour un look professionnel.', 'image' => 'produits/blazer_beige.jpg', 'price' => 69.90, 'stock' => 18],
            ['boutique_id' => 2, 'categorie_id' => 4, 'name' => 'Escarpins Noirs Cuir', 'description' => 'Talons 7cm, confort optimal, cuir véritable.', 'image' => 'produits/escarpins.jpg', 'price' => 89.99, 'stock' => 20],
            ['boutique_id' => 2, 'categorie_id' => 4, 'name' => 'Baskets Blanches Femme', 'description' => 'Semelle ergonomique, tendance urbaine.', 'image' => 'produits/baskets_femme.jpg', 'price' => 59.99, 'stock' => 25],
            ['boutique_id' => 2, 'categorie_id' => 5, 'name' => 'Collier en Argent 925', 'description' => 'Bijou élégant avec pendentif minimaliste.', 'image' => 'produits/collier_argent.jpg', 'price' => 39.50, 'stock' => 35],
            ['boutique_id' => 2, 'categorie_id' => 5, 'name' => 'Bracelet Cuir Femme', 'description' => 'Design artisanal, fermeture aimantée.', 'image' => 'produits/bracelet_cuir.jpg', 'price' => 27.90, 'stock' => 42],

            ['boutique_id' => 3, 'categorie_id' => 6, 'name' => 'Tapis Berbère 160x230', 'description' => 'Motif ethnique noir & blanc, fabriqué à la main.', 'image' => 'produits/tapis_berbere.jpg', 'price' => 129.00, 'stock' => 10],
            ['boutique_id' => 3, 'categorie_id' => 6, 'name' => 'Coussin Déco Lin Beige', 'description' => 'Finition brodée, intérieur moelleux.', 'image' => 'produits/coussin_lin.jpg', 'price' => 18.00, 'stock' => 60],
            ['boutique_id' => 3, 'categorie_id' => 7, 'name' => 'Lampe en Bambou Suspendue', 'description' => 'Style scandinave, lumière douce.', 'image' => 'produits/lampe_bambou.jpg', 'price' => 74.99, 'stock' => 12],
            ['boutique_id' => 3, 'categorie_id' => 7, 'name' => 'Guirlande LED Guinguette', 'description' => '10m étanche, ambiance festive.', 'image' => 'produits/guirlande_led.jpg', 'price' => 24.50, 'stock' => 50],
            ['boutique_id' => 3, 'categorie_id' => 8, 'name' => 'Chaise Velours Bleu', 'description' => 'Style rétro, assise rembourrée.', 'image' => 'produits/chaise_bleue.jpg', 'price' => 109.99, 'stock' => 8],
            ['boutique_id' => 3, 'categorie_id' => 8, 'name' => 'Étagère Murale Chêne', 'description' => 'Design minimaliste, 3 niveaux.', 'image' => 'produits/etagere_chene.jpg', 'price' => 39.90, 'stock' => 22],

            ['boutique_id' => 4, 'categorie_id' => 9, 'name' => 'Manette Xbox Série X', 'description' => 'Bluetooth, grip amélioré.', 'image' => 'produits/manette_xbox.jpg', 'price' => 59.99, 'stock' => 17],
            ['boutique_id' => 4, 'categorie_id' => 9, 'name' => 'Nintendo Switch OLED', 'description' => 'Écran OLED 7", autonomie étendue.', 'image' => 'produits/switch_oled.jpg', 'price' => 349.99, 'stock' => 10],
            ['boutique_id' => 4, 'categorie_id' => 10, 'name' => 'Clavier Mécanique RGB', 'description' => 'Switchs rouges, rétroéclairage personnalisable.', 'image' => 'produits/clavier_rgb.jpg', 'price' => 89.00, 'stock' => 14],
            ['boutique_id' => 4, 'categorie_id' => 10, 'name' => 'Écran 27" 144Hz IPS', 'description' => 'Résolution 2K, temps de réponse 1ms.', 'image' => 'produits/ecran_27.jpg', 'price' => 239.99, 'stock' => 9],
            ['boutique_id' => 4, 'categorie_id' => 11, 'name' => 'Tapis de souris XXL', 'description' => 'Base antidérapante, surface micro-texturée.', 'image' => 'produits/tapis_xxl.jpg', 'price' => 16.90, 'stock' => 65],
            ['boutique_id' => 4, 'categorie_id' => 11, 'name' => 'Casque Gaming RGB', 'description' => 'Micro HD, surround virtuel.', 'image' => 'produits/casque_gaming.jpg', 'price' => 79.90, 'stock' => 19],
            ['boutique_id' => 4, 'categorie_id' => 12, 'name' => 'Carte Graphique RTX 4070', 'description' => '12GB GDDR6X, Ray Tracing, DLSS.', 'image' => 'produits/rtx_4070.jpg', 'price' => 649.99, 'stock' => 6],
            ['boutique_id' => 4, 'categorie_id' => 12, 'name' => 'Boîtier PC ATX RGB', 'description' => 'Panneaux en verre trempé, 3 ventilateurs inclus.', 'image' => 'produits/boitier_pc.jpg', 'price' => 89.00, 'stock' => 13],
        ];

        foreach ($produits as $produitData) {
            Produit::create([
                'boutique_id'   => $produitData['boutique_id'],
                'categorie_id'  => $produitData['categorie_id'],
                'name'          => $produitData['name'],
                'description'   => $produitData['description'],
                'image'         => null,
                'price'         => $produitData['price'],
                'stock'         => $produitData['stock'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        //COMMANDES
        $commandes = [
            ['user_id' => 1, 'boutique_id' => 1, 'total' => 125.50, 'status' => 'paid'],
            ['user_id' => 2, 'boutique_id' => 2, 'total' => 45.00, 'status' => 'shipped'],
            ['user_id' => 3, 'boutique_id' => 3, 'total' => 89.99, 'status' => 'cancelled'],
            ['user_id' => 4, 'boutique_id' => 4, 'total' => 210.75, 'status' => 'paid'],
            ['user_id' => 5, 'boutique_id' => 1, 'total' => 39.90, 'status' => 'pending'],
            ['user_id' => 1, 'boutique_id' => 2, 'total' => 78.60, 'status' => 'paid'],
            ['user_id' => 2, 'boutique_id' => 3, 'total' => 55.40, 'status' => 'pending'],
            ['user_id' => 3, 'boutique_id' => 4, 'total' => 134.99, 'status' => 'shipped'],
            ['user_id' => 4, 'boutique_id' => 1, 'total' => 62.00, 'status' => 'cancelled'],
            ['user_id' => 5, 'boutique_id' => 2, 'total' => 199.90, 'status' => 'paid'],
            ['user_id' => 1, 'boutique_id' => 3, 'total' => 48.50, 'status' => 'pending'],
            ['user_id' => 2, 'boutique_id' => 4, 'total' => 77.30, 'status' => 'shipped'],
            ['user_id' => 3, 'boutique_id' => 1, 'total' => 103.75, 'status' => 'paid'],
            ['user_id' => 4, 'boutique_id' => 2, 'total' => 60.00, 'status' => 'cancelled'],
            ['user_id' => 5, 'boutique_id' => 3, 'total' => 29.99, 'status' => 'pending'],
            ['user_id' => 1, 'boutique_id' => 4, 'total' => 180.25, 'status' => 'paid'],
            ['user_id' => 2, 'boutique_id' => 1, 'total' => 56.10, 'status' => 'pending'],
            ['user_id' => 3, 'boutique_id' => 2, 'total' => 84.00, 'status' => 'shipped'],
            ['user_id' => 4, 'boutique_id' => 3, 'total' => 210.00, 'status' => 'paid'],
            ['user_id' => 5, 'boutique_id' => 4, 'total' => 92.75, 'status' => 'cancelled'],
            ['user_id' => 1, 'boutique_id' => 1, 'total' => 39.99, 'status' => 'paid'],
            ['user_id' => 2, 'boutique_id' => 2, 'total' => 149.50, 'status' => 'shipped'],
            ['user_id' => 3, 'boutique_id' => 3, 'total' => 120.10, 'status' => 'pending'],
            ['user_id' => 4, 'boutique_id' => 4, 'total' => 68.25, 'status' => 'paid'],
            ['user_id' => 5, 'boutique_id' => 1, 'total' => 74.60, 'status' => 'shipped'],
            ['user_id' => 1, 'boutique_id' => 2, 'total' => 99.90, 'status' => 'paid'],
            ['user_id' => 2, 'boutique_id' => 3, 'total' => 130.00, 'status' => 'cancelled'],
            ['user_id' => 3, 'boutique_id' => 4, 'total' => 52.45, 'status' => 'pending'],
            ['user_id' => 4, 'boutique_id' => 1, 'total' => 43.80, 'status' => 'shipped'],
            ['user_id' => 5, 'boutique_id' => 2, 'total' => 88.00, 'status' => 'paid'],
        ];

        $startDate = Carbon::now()->startOfWeek(Carbon::MONDAY);

        foreach ($commandes as $index => $commandeData) {
            $date = $startDate->copy()->addDays($index % 7);

            Commande::create([
                'user_id'     => $commandeData['user_id'],
                'boutique_id' => $commandeData['boutique_id'],
                'total'       => $commandeData['total'],
                'status'      => $commandeData['status'],
                'created_at'  => $date,
                'updated_at'  => $date,
            ]);
        }

        //PANIER
        $paniers = [
            ['user_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 5, 'created_at' => now(), 'updated_at' => now()],
        ];

        foreach ($paniers as $panierData) {
            Panier::create([
                'user_id'    => $panierData['user_id'],
                'created_at' => $panierData['created_at'],
                'updated_at' => $panierData['updated_at'],
            ]);
        }

        //PANIERS ITEMS
        $panierItems = [
            ['panier_id' => 1, 'produit_id' => 1, 'quantity' => 2],
            ['panier_id' => 1, 'produit_id' => 2, 'quantity' => 1],
            ['panier_id' => 2, 'produit_id' => 3, 'quantity' => 3],
            ['panier_id' => 2, 'produit_id' => 4, 'quantity' => 1],
            ['panier_id' => 3, 'produit_id' => 5, 'quantity' => 1],
            ['panier_id' => 3, 'produit_id' => 6, 'quantity' => 2],
            ['panier_id' => 4, 'produit_id' => 7, 'quantity' => 1],
            ['panier_id' => 4, 'produit_id' => 8, 'quantity' => 2],
            ['panier_id' => 5, 'produit_id' => 9, 'quantity' => 1],
            ['panier_id' => 5, 'produit_id' => 10, 'quantity' => 3],
            ['panier_id' => 1, 'produit_id' => 11, 'quantity' => 2],
            ['panier_id' => 1, 'produit_id' => 12, 'quantity' => 1],
            ['panier_id' => 2, 'produit_id' => 13, 'quantity' => 4],
            ['panier_id' => 2, 'produit_id' => 14, 'quantity' => 1],
            ['panier_id' => 3, 'produit_id' => 15, 'quantity' => 2],
            ['panier_id' => 3, 'produit_id' => 16, 'quantity' => 3],
            ['panier_id' => 4, 'produit_id' => 17, 'quantity' => 1],
            ['panier_id' => 4, 'produit_id' => 18, 'quantity' => 2],
            ['panier_id' => 5, 'produit_id' => 19, 'quantity' => 3],
            ['panier_id' => 5, 'produit_id' => 20, 'quantity' => 1],
        ];

        foreach ($panierItems as $item) {
            PanierItem::create([
                'panier_id'  => $item['panier_id'],
                'produit_id' => $item['produit_id'],
                'quantity'   => $item['quantity'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        //COMMANDES ITEMS
        $commandeItems = [
            ['commande_id' => 1, 'produit_id' => 1, 'quantity' => 2, 'unit_price' => 199.99],
            ['commande_id' => 1, 'produit_id' => 2, 'quantity' => 1, 'unit_price' => 15.99],
            ['commande_id' => 2, 'produit_id' => 3, 'quantity' => 3, 'unit_price' => 49.99],
            ['commande_id' => 2, 'produit_id' => 4, 'quantity' => 1, 'unit_price' => 99.99],
            ['commande_id' => 3, 'produit_id' => 5, 'quantity' => 1, 'unit_price' => 350.00],
            ['commande_id' => 3, 'produit_id' => 6, 'quantity' => 2, 'unit_price' => 120.50],
            ['commande_id' => 4, 'produit_id' => 7, 'quantity' => 1, 'unit_price' => 25.75],
            ['commande_id' => 4, 'produit_id' => 8, 'quantity' => 2, 'unit_price' => 75.00],
            ['commande_id' => 5, 'produit_id' => 9, 'quantity' => 1, 'unit_price' => 200.00],
            ['commande_id' => 5, 'produit_id' => 10, 'quantity' => 3, 'unit_price' => 80.00],
            ['commande_id' => 6, 'produit_id' => 11, 'quantity' => 2, 'unit_price' => 40.00],
            ['commande_id' => 6, 'produit_id' => 12, 'quantity' => 1, 'unit_price' => 12.99],
            ['commande_id' => 7, 'produit_id' => 13, 'quantity' => 4, 'unit_price' => 15.00],
            ['commande_id' => 7, 'produit_id' => 14, 'quantity' => 1, 'unit_price' => 199.99],
            ['commande_id' => 8, 'produit_id' => 15, 'quantity' => 2, 'unit_price' => 79.99],
            ['commande_id' => 8, 'produit_id' => 16, 'quantity' => 3, 'unit_price' => 50.00],
            ['commande_id' => 9, 'produit_id' => 17, 'quantity' => 1, 'unit_price' => 25.00],
            ['commande_id' => 9, 'produit_id' => 18, 'quantity' => 2, 'unit_price' => 30.00],
            ['commande_id' => 10, 'produit_id' => 19, 'quantity' => 3, 'unit_price' => 40.00],
            ['commande_id' => 10, 'produit_id' => 20, 'quantity' => 1, 'unit_price' => 150.00],
        ];

        foreach ($commandeItems as $item) {
            CommandeItem::create([
                'commande_id' => $item['commande_id'],
                'produit_id'  => $item['produit_id'],
                'quantity'    => $item['quantity'],
                'unit_price'  => $item['unit_price'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
