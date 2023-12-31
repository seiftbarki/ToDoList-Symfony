<?php
namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController{
    #[Route("/",name:"homepage")]
    public function index(EntityManagerInterface $manager){

        $categorieRepo=$manager->getRepository(Categorie::class);
    $categories=$categorieRepo->findAll();
    
        return $this->render("pages/home.html.twig",[
            "categories"=> $categories
        ]);
    }
    #[Route("/show/{slug}/{id<\d+>}",name:"show_categorie")]
    public function show($slug,$id,CategorieRepository $categorieRepo,Request $request,EntityManagerInterface $manager){
       $categorie=$categorieRepo->find($id);
       if($categorie==null){
        throw $this->createNotFoundException("categorie introuvable");

       }
       $task = new Task();
       $form = $this->createForm(TaskType::class,$task);
       $form -> handleRequest($request);
       if($form->isSubmitted() and $form->isValid()){
        $task->setCategorie($categorie);
        $manager->persist($task);
        $manager->flush();
        $this->addFlash("messages","tache-ajoutée");
        return $this->redirectToRoute("homepage");
        
       }
       return $this->render("pages/show.html.twig",[
            "categorie"=> $categorie,
            "tasks"=>$categorie->getTasks(),
            "form"=>$form->createView()
            

       ]);
    }
    #[Route("/create",name:"create_categorie")]
    #[IsGranted('ROLE_ADMIN')]
    public function create(Request $request,EntityManagerInterface $manager){
        $categorie=new Categorie();
       $form= $this->createForm(CategorieType::class,$categorie);
        $form->handleRequest($request);
        if($form->isSubmitted() and $form->isValid()){
            $manager->persist($categorie);
            $manager->flush();
            $this->addFlash("messages","categorie-ajouté");
            return $this->redirectToRoute("homepage");
        }

        return $this->render("pages/create.html.twig",[
           "categorie_form"=>$form->createView() 
        ]);
    }
}