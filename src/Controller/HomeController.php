<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Entity\Actor;
use App\Entity\Genre;
use App\Entity\Studio;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private $repoMovie;

    public function __construct(MovieRepository $repoMovie) {
        $this->repoMovie = $repoMovie;
    }

    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render("home/index.html.twig");
    }

    /**
     * @Route("/movies", name="movies")
     */
    public function movies(): Response
    {
        $movies = $this->repoMovie->findAll();
 
        return $this->render("home/movies.html.twig", [
            'movies' => $movies,
        ]);
    }

    /**
     * @Route("/about", name="about")
     */
    public function about(): Response
    {
        return $this->render("home/about.html.twig");
    }

    /**
     * @Route("/detailMovie/{id}", name="detail_movie")
     */
    public function detailMovie(Movie $movie): Response
    {
        return $this->render("home/detailMovie.html.twig", [
            'movie' => $movie
        ]);
    }

    /**
     * @Route("/showByActor/{id}", name="showByActor")
     */
    public function showByActor(Actor $actor): Response
    {
        return $this->render("home/showByActor.html.twig", [
            'movies' => $actor->getMovies(),
            'actor' => $actor
        ]);
    }

    /**
     * @Route("/showByGenre/{id}", name="showByGenre")
     */
    public function showByGenre(Genre $genre): Response
    {
        return $this->render("home/showByGenre.html.twig", [
            'movies' => $genre->getMovies(),
            'genre' => $genre
        ]);
    }

    /**
     * @Route("/showByStudio/{id}", name="showByStudio")
     */
    public function showByStudio(Studio $studio): Response
    {
        return $this->render("home/showByStudio.html.twig", [
            'movies' => $studio->getMovies(),
            'studio' => $studio
        ]);
    }
}
