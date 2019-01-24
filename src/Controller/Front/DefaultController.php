<?php

namespace App\Controller\Front;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


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
        return $this->render("Front/default/home.html.twig",[
            'bg' => "bg_carte",
        ]);
    }

    /**
     * @Route(path="/mentions-legales", methods={"GET"}, name="app_default_mentionlegale")
     *
     * @return string
     */
    public function mentionlegale()
    {
        return $this->render("Front/default/mentionslegales.html.twig",[
            'bg' => "bg_carte",
        ]);
    }

    /**
     * @Route(path="/cgv", methods={"GET"})
     *
     * @return string
     */
    public function cgv()
    {
        return $this->render("Front/default/cgv.html.twig",[
        'bg' => "bg_carte",
    ]);
    }

    /**
     * @Route(path="/profil", methods={"GET"}, name="app_profil")
     *
     * @return string
     */
    public function profil( AuthorizationCheckerInterface $authChecker)
    {
        if (false === $authChecker->isGranted('ROLE_USER')) {
            throw new AccessDeniedException('Unable to access this page!');
        }
        return $this->render("Front/default/profil.html.twig",[
            'bg' => "bg_carte",
        ]);
    }

    /**
     * @Route(path="/team", methods={"GET"})
     *
     * @return string
     */
    public function team()
    {
        return $this->render("Front/default/team.html.twig",[
            'bg' => "bg_carte",
        ]);
    }

    /**
     * @Route(path="/contact", methods={"GET"})
     *
     * @return string
     */
    public function contact()
    {
        return $this->render("Front/default/contact.html.twig",[
            'bg' => "bg_carte",
        ]);
    }

    /**
     * @Route(path="/carte", methods={"GET"})
     *
     * @return string
     */
    public function carte()
    {
        return $this->render("Front/default/carte.html.twig",[
            'bg' => "bg_carte",
        ]);
    }

    /**
     * @Route(path="/products", methods={"GET"})
     *
     * @return string
     */
    public function products()
    {
        return $this->render("Front/default/products.html.twig",[
            'bg' => "bg_carte",
        ]);
    }

    /**
     * @Route(path="/galerie", methods={"GET"})
     *
     * @return string
     */
    public function galerie()
    {
        $auth = new Instagram\Auth([
            'client_id'     => '537a54b77e374c5e8edc8990282a2dcc',
            'client_secret' => 'cd7968032894480f8c1107bd219d61a3',
            'redirect_uri'  => 'http://127.0.0.1:8000/galerie'
        ]);

        if(!isset($_SESSION['instagram_token'])){
            if(!isset($_GET['code'])){
                $auth->authorize();
            } else {
                $access_token = $auth->getAccessToken($_GET['code']);
                $_SESSION['instagram_token'] = $access_token;
            }
        }

        try{
            $instagram = new Instagram\Instagram();
            $instagram->setAccessToken($_SESSION['instagram_token']);
            $medias = $instagram->getCurrentUser()->getMedia(['count' => 3]);
        } catch(Exception $e) {
            die($e->getMessage());
        }
        foreach($medias as $media){
            if ($media->type == 'image') {
                echo "<img src='{$media->images->standard_resolution->url}' width='100'>";
            }
        }
        return $this->render("Front/default/galerie.html.twig",[
            'bg' => "bg_carte",
        ]);
    }

}