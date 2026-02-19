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


## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
