<<<<<<< HEAD
# 🚩 PHPWN Platform — Plateforme de Bug Bounty / CTF

Projet final PHP — Plateforme e-commerce orientée cybersécurité, permettant aux utilisateurs d'acheter, vendre et résoudre des challenges CTF.

Développé avec **Laravel 11**, **MySQL** et **Tailwind CSS**.

---

## 📋 Fonctionnalités implémentées

### Obligatoires
- ✅ Inscription (`/register`) — username, email, password, bio, skill_level
- ✅ Connexion (`/login`) — par username + password, avec rate limiting
- ✅ Page d'accueil (`/`) — liste des challenges par ordre chronologique inverse
- ✅ Détail d'un challenge (`/challenges/{id}`) — description, soumission de flag, téléchargement
- ✅ Création de challenge (`/sell`) — avec upload de fichier sécurisé
- ✅ Modification / Suppression de challenge (`/challenges/{id}/edit`)
- ✅ Panier (`/cart`) — ajout, suppression, calcul du total
- ✅ Validation de commande (`/checkout`) — vérification de solde, adresse de facturation, transaction DB
- ✅ Factures (`/invoices`) — historique des achats avec adresse de facturation
- ✅ Mon compte (`/account`) — profil privé : challenges créés, achetés, factures, score, recharge de solde
- ✅ Profil public (`/account?id=X`) — pseudo, niveau, challenges créés, flags résolus
- ✅ Espace administrateur (`/admin`) — gestion des utilisateurs (ban, rôle, reset solde) et challenges (activer/désactiver)
- ✅ Soumission de flag — hachage SHA-256, protection anti-double submission, throttle (10 req/min)
- ✅ Téléchargement sécurisé — réservé aux acheteurs

### Sécurité
- ✅ Mots de passe hachés (bcrypt via Laravel)
- ✅ Protection CSRF sur tous les formulaires
- ✅ Requêtes préparées (Eloquent ORM — protection SQLi)
- ✅ Gestion des rôles côté backend (user / admin / creator)
- ✅ Régénération de session à la connexion
- ✅ Race condition évitée sur le paiement (DB lock `lockForUpdate()`)
- ✅ IDOR protégé sur les téléchargements et soumissions

---

## ⚙️ Prérequis

- PHP >= 8.2
- MySQL / MariaDB
- Composer
- Node.js + npm
- XAMPP (Windows) ou équivalent

---

## 🚀 Installation

### 1. Cloner le repository

```bash
git clone https://github.com/Jk-kor/phpwn-platform.git
cd phpwn-platform
```

### 2. Installer les dépendances

```bash
composer install
npm install && npm run build
```

### 3. Configuration de l'environnement

```bash
cp .env.example .env
php artisan key:generate
```

Modifier `.env` :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=php_exam_db
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Créer la base de données

Dans PhpMyAdmin, créer une base `php_exam_db`, puis :

```bash
php artisan migrate
```

Ou importer directement le fichier SQL fourni :

```
php_exam_db.sql
```

### 5. Lancer le serveur

```bash
php artisan serve
```

Accéder à : [http://localhost:8000](http://localhost:8000)

---

## 🧪 Comptes de test

| Rôle | Username | Email | Mot de passe |
|------|----------|-------|--------------|
| Admin | `admin` | `admin@phpwn.fr` | `password` |
| Utilisateur | `hacker` | `hacker@phpwn.fr` | `password` |

> Ces comptes doivent être créés manuellement via `/register` puis le rôle `admin` assigné directement en base ou via le panel admin.

---

## 🗄️ Structure de la base de données

| Table | Description |
|-------|-------------|
| `users` | Utilisateurs (username, email, password, balance, role, bio, skill_level) |
| `challenges` | Challenges CTF (title, category, difficulty, price, flag_hash, author_id) |
| `cart` | Panier utilisateur |
| `invoices` | Factures (avec adresse de facturation) |
| `invoice_items` | Détail des achats par facture |
| `submissions` | Soumissions de flag |

---

## 🛠️ Framework utilisé

**Laravel 11** — choisi pour :
- Sa structure MVC claire et maintenable
- Son ORM Eloquent (requêtes préparées automatiques → protection SQLi)
- Son système de middleware pour la gestion des rôles et sessions
- Sa protection CSRF intégrée
- Sa gestion native des fichiers uploadés

=======
# 🏴‍☠️ CTF Marketplace Platform

> Plateforme d'achat et de vente de challenges CTF (type HackTheBox) développée avec Laravel 12, TailwindCSS et Vite.
>>>>>>> d584f4d08d3e0a3461633d521ec0a6ca2221b4fb

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
