<?php

namespace App\Controller;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/")
 *
 * Class DefaultController
 * @package App\Controller
 */
class DefaultController extends AbstractController
{
    /**
     * @Route(path="/", methods={"GET"}, name="app_default_home")
     *
     * @return string
     */
    public function home()
    {
        return $this->render("default/home.html.twig");
    }

    /**
     * @Route(path="/mentions-legales", methods={"GET"}, name="app_default_mentionlegale")
     *
     * @return string
     */
    public function mentionlegale()
    {
        return $this->render("default/mentionslegales.html.twig");
    }

    /**
     * @Route(path="/cgv", methods={"GET"})
     *
     * @return string
     */
    public function cgv()
    {
        return $this->render("default/cgv.html.twig");
    }

    /**
     * @Route(path="/profile", methods={"GET"}, name="app_profile")
     *
     * @return string
     */
    public function profile()
    {
        return $this->render("default/profile.html.twig");
    }

    /**
     * @Route(path="/team", methods={"GET"})
     *
     * @return string
     */
    public function team()
    {
        return $this->render("default/team.html.twig");
    }

    /**
     * @Route(path="/contact", methods={"GET"})
     *
     * @return string
     */
    public function contact()
    {
        return $this->render("default/contact.html.twig");
    }

    /**
     * @Route(path="/carte", methods={"GET"})
     *
     * @return string
     */
    public function carte()
    {
        return $this->render("default/carte.html.twig");
    }

}