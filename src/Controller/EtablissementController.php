<?php

namespace App\Controller;
use App\Entity\Commentaires;
use App\Entity\Etablissement;
use App\Form\EtablissementType;
use App\Form\CommentairesType;
use App\Repository\EtablissementRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EtablissementController extends AbstractController
{

    /**
     * @Route("/", name="app_home",methods="GET")
     */
    public function index(EtablissementRepository $etablissementRepository): Response
    {

        $etab=$this->getDoctrine()->getRepository(Etablissement::class)->findAll();

        return $this->render('etablissement/index.html.twig', [
            'etab' => $etab,
        ]);

    }
    /**
     * @Route("/détail_établissement/{id<[0-9]+>}", name="app_etablissement_details",methods={"GET||POST"})
     */
    public function detail_etablissemen(Etablissement $etablissement,Request $request,EntityManagerInterface $em){
        $commentaire= new Commentaires();
        $formulaire= $this->createForm(CommentairesType::class,$commentaire)
        ;
        $formulaire->handleRequest($request); // elle récupére que les donnée de type Post
        if ($formulaire->isSubmitted() && $formulaire->isValid()){
            $commentaire->setEtablissement($etablissement);
            $etablissement->addRelationEtablissement($commentaire);
            $em->persist($commentaire);
            $em->persist($etablissement);
            $em->flush();
            $this->addFlash('success','Un nouvel commentaire a été crée avec succès');
            return $this->redirectToRoute('app_etablissement_details',array(
                "id"=>$etablissement->getId()
            ));
        }
        return $this->render('etablissement/cartographieCommune.html.twig', [
            'etablissement' => $etablissement,
            'formulaire'=>$formulaire->createView()
        ]);
    }
     /**
     * @Route("/creation", name="app_etablissement_creation",methods={"GET||POST"})
     */

    public function create_etablissement(Request $request,EntityManagerInterface $em):Response{

        $etablissement= new Etablissement();
        $formulaire= $this->createForm(EtablissementType::class,$etablissement)
        ;
        $formulaire->handleRequest($request); // elle récupére que les donnée de type Post
        if ($formulaire->isSubmitted() && $formulaire->isValid()){
            $em->persist($etablissement);
            $em->flush();
            $this->addFlash('success','Un nouvel etablissement a été crée avec succès');
            return $this->redirectToRoute('app_home');
        }

        return $this->render("etablissement/creation_etablissement.html.twig",[
            'formulaire'=>$formulaire->createView()
        ]);
    }

    /**
     * @return Response
     * @Route ("/modification/{id<[0-9]+>}",name="app_etablissement_modification",methods={"GET||POST||PUL"})
     */
    public function modifier(Etablissement $etablissement,Request $request,EntityManagerInterface  $em):Response{
        $formulaire= $this->createForm(EtablissementType::class,$etablissement,[
            'method'=>'POST'
        ]);
        $formulaire->handleRequest($request); // elle récupére que les donnée de type Post
        if ($formulaire->isSubmitted() && $formulaire->isValid()){
            $em->flush();
            $this->addFlash('updated','Cet etablissement a été modifiée avec succès');
            return $this->redirectToRoute('app_home');
        }
        return $this->render("etablissement/modifier_detail.html.twig",[
            'etablissement'=>$etablissement,
            'formulaire'=>$formulaire->createView()
        ]);
    }

     /**
     * @return Response
     * @Route ("/supprimer/{id<[0-9]+>}",name="app_etablissement_supprimer",methods={"DELETE||POST"})
     */
    public function supprimer(Request $request,Etablissement $etablissement,EntityManagerInterface  $em):Response{
        if($this->isCsrfTokenValid('etablissement_deletion_'. $etablissement->getId(),$request->request->get('csrf_token'))){
            $em->remove($etablissement);
            $em->flush();
            $this->addFlash('suppression','Etablissement supprimer');
        }

        return $this->redirectToRoute('app_home');
    }
   
    
    

   
}
