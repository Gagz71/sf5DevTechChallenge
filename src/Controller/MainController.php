<?php

namespace App\Controller;

use App\Entity\Member;
use App\Form\AddMembersType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
	//Déclaration de l'entity Manager pour pouvoir le réutiliser plus simplement en bas
	private $entityManager;

	public function __construct(EntityManagerInterface $entityManager)
	{
		$this->entityManager = $entityManager;
	}
    /**
     * @Route("/", name="main")
     */
    public function index(Request $request): Response
    {
    	$member = new Member();
    	//Création du formulaire d'ajout des membres de l'équipage
    	$form = $this->createForm(AddMembersType::class, $member);
    	$form->handleRequest($request);

        return $this->render('main/index.html.twig', [
        	'form' => $form->createView()
        ]);
    }
}
