# Application Web de Réservation (Projet Académique - L3 UBO)

Projet académique réalisé dans le cadre de la Licence Informatique à l'Université de Bretagne Occidentale (UBO). Il s'agit d'une application Full-Stack de gestion de réservations basée sur une architecture MVC.

## 🚀 Fonctionnalités principales
- **Architecture MVC :** Séparation claire de la logique métier, des données et de l'interface utilisateur.
- **Système d'authentification & Sécurité :** 
  - Gestion des rôles utilisateurs (**Admin** et **Membre**) avec contrôle d'accès sécurisé.
  - Sécurisation des mots de passe par hachage cryptographique **SHA-256 combiné à un système de salage (Salt)** pour contrer les attaques parレインボー tables (tables arc-en-ciel).
- **Interface Responsive :** Conception front-end moderne et adaptative en HTML5/CSS3 et Bootstrap.
- **Gestion des données :** Persistance assurée par une base de données relationnelle (MariaDB).

## 🛠️ Stack Technique & Sécurité
- **Front-end :** HTML5, CSS3, Bootstrap
- **Back-end :** PHP / Framework CodeIgniter4
- **Sécurité :** Algorithme de hachage SHA-256 + Salt, gestion des sessions sécurisées
- **Base de données & Outils :** MariaDB, MySQL Workbench, phpMyAdmin
- **Versioning :** Git / GitLab

## 📂 Structure du projet
- `app/` : Contrôleurs, modèles et vues (Architecture MVC sous CodeIgniter4)
- `public/` : Fichiers accessibles publiquement (CSS, JS, images)
- `database/` : Scripts SQL de création et d'initialisation de la base de données

## ⚙️ Installation et Lancement en local
1. Cloner le dépôt :
   ```bash
   git clone [https://github.com/saliou2003/projet-reservation-l3.git](https://github.com/saliou2003/projet-reservation-l3.git)
