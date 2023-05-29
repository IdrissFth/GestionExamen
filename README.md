# GestionExamen
Projet Symfony développé pour la gestion des examens des établissements, divisés par modules et semestre, et leur personnel.
Avec une Base de donner MySQL.

Voici les commandes que j'ai utilisé et aussi les commandes de faire un project avec une Dashboard cote Client et Cote Admin:


//installation d'une nouvelle application symfony 
symfony new GestionExamen --full --version=6.0
Ou 
composer create-project symfony/website-skeleton GestionExamen 

modifier le fichier .env
Activer la Base de donner que vous aller utiliser dans notre cas c'est MySQL.
******
Vous pouvez changer "symfony" avec "php bin/console"
******
//creation de la base de données selon les paramètres du fichier .env
symfony console doctrine:database:create


install certificat
symfony server:ca:install

start server
symfony server:start -d

navigate to server
start https://127.0.0.1:8000


stop server
symfony server:stop

creation de toutes les entités et des relation

symfony console make:entity


creation des tables sur la base de données
symfony console make:migration
symfony console doctrine:migrations:migrate



create securité
symfony console make:user >>> User yes email yes
symfony console make:entity >>>  User username string 50 no 

install authenticator
symfony console make:auth  >>>   1 AppAuthenticator SecurityController yes

symfony console make:registration >>> yes no yes

composer require symfonycasts/reset-password-bundle 

symfony console make:reset-password  >>> \n email@fac.ma  "gestion exams"

remplacer le text dans le fichier \\src\\Security\\AppAuthenticator.php
		//return new RedirectResponse($this->urlGenerator->generate('some_route'))
		return new RedirectResponse($this->urlGenerator->generate('dashboard'))


remplacer le text dans le fichier 
	\config\packages\\security.yaml
     # - { path: ^/admin, roles: ROLE_ADMIN }
       - { path: ^/admin, roles: ROLE_USER }

symfony console make:migration
symfony console doctrine:migrations:migrate

   
installer les fixtures
composer require zenstruck/foundry --dev

faire la même chose pour toutes les entité et pour User aussi
symfony console make:factory 0


composer require orm-fixtures --dev


ajouter use dans le fichier appFixtures.php pour toutes les entités et User aussi
               
\src\DataFixtures\AppFixtures.php -->  use App\Factory\EtudiantFactory; 

ajouter pour chaque entité une ligne de remplissage dans le procedure load
        FiliereFactory::createMany(10);
        
Modifier les fixtures dans les fichiers factory de chaque entité remplacer text par le type correspondant
exemple:
      return [
            // TODO add your default values here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories)
            'nom' => self::faker()->lastname(),
            'prenom' => self::faker()->firstname(),  
            'filiere' => FiliereFactory::randomOrCreate(),       
            'cin' => self::faker()->realText(10),
        ];



Modifier le contenu de la procedure getDefaults de UserFactory avec le code suivant

  return [
                    'email' => 'admin@fac.ma',
                    'roles' => ['ROLE_ADMIN'],
                    'password' => '$2y$13$w7usfxJhm1MP8qjT8TDNzOq.UuYWFuZszfwqX/agMwG8JeqWgacZ.',
                    'username' => 'Admin',
                ];

charger les fixtures
symfony console doctrine:fixtures:load

installation de la dash board

composer require admin
symfony console make:admin:dashboard \n \n

ajouter les classes suivantes aux fichier DashboardController
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\Etudiant;
use App\Entity\Filiere;
use App\Entity\User;

ajouter les lien à configureMenuItems du DashboardController

        yield MenuItem::linkToCrud('User', 'fas fa-list', User::class);
        yield MenuItem::linkToCrud('Filiere', 'fas fa-list', Filiere::class);
        yield MenuItem::linkToCrud('Etudiant', 'fas fa-list', Etudiant::class);

ajouter ces deux procedures au DashboardController

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return parent::configureUserMenu($user)
            ->setName($user->getUserIdentifier())
            ->setGravatarEmail($user->getEmail())
         //   ->setAvatarUrl('https://www.clipartmax.com/png/full/405-4050774_avatar-icon-flat-icon-shop-download-free-icons-for-avatar-icon-flat.png')
            ->displayUserAvatar(true);
    }



    public function configureAssets(): Assets
    {
        return Assets::new()->addCssFile('build/css/admin.css');
    }

ajouter le controller admin a toutes les entités
symfony console make:admin:crud

composer require symfony/webpack-encore-bundle
yarn install
yarn add jquery
yarn add sass-loader  sass --dev
yarn add postcss-loader  autoprefixer --dev
npm install --save-dev @fortawesome/fontawesome-free
yarn add file-loader@^6.0.0 --dev
yarn add bootstrap

ajouter ces lignes a app.js
import $ from 'jquery';

import '@fortawesome/fontawesome-free/js/fontawesome';
import '@fortawesome/fontawesome-free/js/solid';
import '@fortawesome/fontawesome-free/js/regular';
import '@fortawesome/fontawesome-free/js/brands';

changer le contenu de app.scss par

@import 'custom';
@import '~bootstrap/scss/bootstrap';




symfony console cache:clear
