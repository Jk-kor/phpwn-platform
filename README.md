# 🏴‍☠️ CTF Marketplace Platform

> Plateforme d'achat et de vente de challenges CTF (type HackTheBox) développée avec Laravel 12, TailwindCSS et Vite.

## 🚀 Fonctionnalités principales

- **Marketplace de challenges CTF** :
  - Parcourez, achetez et téléchargez des challenges (Web, Pwn, Crypto, etc.)
  - Système de panier et paiement (fictif)
  - Historique des achats et challenges résolus
  - Téléchargement sécurisé (accès réservé aux acheteurs)
  - Soumission de flag avec vérification automatique (hashé côté serveur)
- **Vente de challenges** :
  - Déposez vos propres challenges à vendre
  - Gestion des fichiers, catégories, difficulté, prix, etc.
- **Gestion utilisateur** :
  - Authentification, inscription, gestion du profil
  - Rôles : utilisateur, admin, creator
  - Ban/déban, promotion admin (interface admin)
- **Administration** :
  - Tableau de bord admin : gestion des utilisateurs et challenges
  - Activation/désactivation, suppression, modération
- **Sécurité** :
  - Accès restreint selon achat/rôle
  - Protection contre double scoring, IDOR, throttling sur la soumission de flag
- **Expérience utilisateur** :
  - Interface responsive et moderne (TailwindCSS, Blade, Alpine.js)
  - Notifications de succès/erreur

## 🛠️ Stack & technologies

- **Backend** : Laravel 12 (PHP 8.2+)
- **Frontend** : Blade, TailwindCSS, Alpine.js
- **Build** : Vite
- **Base de données** : SQLite (par défaut), support MySQL/PostgreSQL
- **Tests** : PHPUnit, Laravel Breeze (auth scaffolding)

## ⚡ Installation & démarrage rapide

```bash
# 1. Cloner le repo
$ git clone <repo-url>
$ cd phpwn-platform

# 2. Installer les dépendances PHP & JS
$ composer install
$ npm install

# 3. Copier l'exemple d'environnement et générer la clé
$ cp .env.example .env
$ php artisan key:generate

# 4. Lancer les migrations et seeders (optionnel)
$ php artisan migrate --seed

# 5. Lancer le serveur de dev
$ php artisan serve
# et en parallèle (pour le front)
$ npm run dev
```

## 🔑 Commandes utiles

- `php artisan migrate:fresh --seed` : Réinitialise la base et recharge les données de démo
- `php artisan test` : Lance la suite de tests
- `npm run dev` : Lance le build front en mode dev (Vite)
- `npm run build` : Build de production

## 📁 Structure principale

- `app/Http/Controllers/` : Contrôleurs (Challenge, Cart, Admin, Auth...)
- `app/Models/` : Modèles Eloquent (User, Challenge, Invoice...)
- `resources/views/` : Vues Blade (dashboard, admin, challenges, achats...)
- `routes/web.php` : Routes principales
- `database/migrations/` : Migrations SQL
- `public/` : Fichiers publics (index.php, assets)

## 👤 Rôles & droits

- **Utilisateur** : Parcours, achète, résout des challenges
- **Vendeur** : Dépose ses propres challenges
- **Admin/Creator** : Modère, gère les utilisateurs/challenges

## 🔒 Sécurité

- Accès aux fichiers et soumission de flag réservés aux acheteurs
- Flags stockés hashés (SHA256)
- Throttling sur la soumission de flag
- Protection contre IDOR, double scoring, accès admin sécurisé

## 🧪 Tests

- Tests unitaires et fonctionnels avec PHPUnit
- Dossiers : `tests/Unit/` et `tests/Feature/`

## 📦 Dépendances principales

- Laravel 12, PHP 8.2+
- TailwindCSS, Vite, Alpine.js
- PHPUnit, Faker, Laravel Breeze

## 📄 Licence

Projet open-source sous licence MIT.
