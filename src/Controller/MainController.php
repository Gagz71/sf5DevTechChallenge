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
    	$newMember = new Member();
    	//Création du formulaire d'ajout des membres de l'équipage
    	$form = $this->createForm(AddMembersType::class, $newMember);
    	$form->handleRequest($request);
    	
    	//Si le formulaire est soumis et valide
    	if($form->isSubmitted() && $form->isValid()){
    		
    		//Récupération du nom saisi
    		$newMember = $form->getData();
    		$search_name = $this->entityManager->getRepository(Member::class)->findOneByName($newMember->getName());
    		//Si le nom n'existe pas déjà en BDD
	        if(!$search_name){
		        //Hydratation du nouveau membre
		        $newMember->setRegisterDate(new  \DateTime());
		        //enregistrement en BDD
		        $this->entityManager->persist($newMember);
		        $this->entityManager->flush();
		
		        //Création d'une notification de succès
		        $this->addFlash('success', 'Le nouveau membre de votre équipage a bien été enregistré !');
	        } else{
	        	$this->addFlash('error', 'Ce membre a déjà été ajouté. ');
	        }
    		
    		
        }
    	
    	$members = $this->entityManager->getRepository(Member::class)->findAll();

        return $this->render('main/index.html.twig', [
        	'form' => $form->createView(),
	        'members' => $members
        ]);
    }
}
