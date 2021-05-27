<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\User;
use App\Entity\Actor;
use App\Entity\Genre;
use App\Entity\Movie;
use App\Entity\Studio;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {

        $users = [];
        $userAdmin = new User();
        $userAdmin->setEmail('admin@admin.fr');
        $passwordAdmin = $this->encoder->encodePassword($userAdmin, 'adminadmin');
        $userAdmin->setPassword($passwordAdmin);
        $userAdmin->setRoles(["ROLE_ADMIN"]);
        $manager->persist($userAdmin);
        $users[] = $userAdmin;

        $userLambda = new User();
        $userLambda->setEmail('user@user.fr');
        $passwordLambda = $this->encoder->encodePassword($userLambda, 'useruser');
        $userLambda->setPassword($passwordLambda);
        // $userLambda->setPassword('useruser');
        $manager->persist($userLambda);
        $users[] = $userLambda;

        $faker = Faker\Factory::create();
        $faker->addProvider(new \Xylis\FakerCinema\Provider\Movie($faker));
        $faker->addProvider(new \Xylis\FakerCinema\Provider\Person($faker));

        $genres = [];
        for($i=0; $i < 7; $i++) {
            $genre = new Genre();
            $genre->setName($faker->movieGenre);
            $manager->persist($genre);
            $genres[] = $genre;
        }

        $studios = [];
        for($i=0; $i < 7; $i++) {
            $studio = new Studio();
            $studio->setName($faker->studio);
            $manager->persist($studio);
            $studios[] = $studio;
        }

        $actors = [];
        for($i=0; $i < 20; $i++) {
            $actor = new Actor();
            $fullName = $faker->actor;
            $actor->setLastName(stristr($fullName, ' '));
            $actor->setFirstName(stristr($fullName, ' ', true));
            $actor->setImage('acteur.jpg');
            $manager->persist($actor);
            $actors[] = $actor;
        }

        $movies = [];
        for($i=0; $i < 30; $i++) {
            $movie = new Movie();
            $movie->setName($faker->movie);
            $movie->setOriginalName($faker->text(50));
            $movie->setReleaseDate($faker->numberBetween(1920,2021));
            $movie->addGenre($genres[$faker->numberBetween(0,6)]);
            $movie->addActor($actors[$faker->numberBetween(0,19)]);
            $movie->setImage('affiche_film.jpg');
            $movie->setSynopsis($faker->overview);
            $movie->addStudio($studios[$faker->numberBetween(0,6)]);
            $movie->setSeen($faker->boolean);
            $movie->setWatchList($faker->boolean);
            $manager->persist($movie);
            $movies[] = $movie;
        }

        $manager->flush();
    }
}
