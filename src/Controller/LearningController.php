<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class LearningController extends AbstractController
{
    private string $name;
    private Session $session;

    public function __construct()
    {
        $this->name = 'Unknown';
        $this->session = new Session;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    #[Route('/index', name: 'index')]
    public function index(): Response
    {
        return $this->render('learning/index.html.twig', [
            'controller_name' => 'LearningController',
        ]);
    }

    #[Route('/about-becode', name: 'about')]
    public function about(): Response
    {
        if ($this->session->get('name')) {
            $this->setName($this->session->get('name'));
        }elseif($this->getName() === 'Unknown'){
            return $this->forward('App\Controller\LearningController::showMyName');
        }
        return $this->render('learning/aboutme.html.twig', ['name' => $this->name]);
    }

    #[Route('/changename', name: 'changename')]
    public function changeMyName(): Response
    {
        $this->render('learning/changename.html.twig');
        if (isset($_POST['newname'])) {
            $this->session->set('name', (string)$_POST['newname']);
        }
        return $this->redirectToRoute('showname');
    }

    #[Route('/', name: 'showname')]
    public function showMyName(): Response
    {
        if ($this->session->get('name')) {
            $this->setName($this->session->get('name'));
        }
        return $this->render('learning/showname.html.twig', ['name' => $this->name]);
    }
}