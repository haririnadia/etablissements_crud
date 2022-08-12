<?php

namespace App\Controller;
use App\Entity\Commentaires;
use App\Form\CommentairesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentaireController extends AbstractController
{
     
     /**
     * @return Response
     * @Route ("/commentaire_{id<[0-9]+>}/modification",name="app_commentaire_modification",methods={"GET||POST||PUL"})
     */
    public function modifier_commentaire(Commentaires $commentaire,Request $request,EntityManagerInterface  $em):Response{
      
        $formulaire= $this->createForm(CommentairesType::class,$commentaire,[
            'method'=>'POST'
        ]);
        $formulaire->handleRequest($request); // elle récupére que les donnée de type Post
        if ($formulaire->isSubmitted() && $formulaire->isValid()){
            $em->flush();
            $this->addFlash('updated','Ce commentaire a été modifiée avec succès');
            return $this->redirectToRoute('app_etablissement_details',array(
                "id"=>$commentaire->getEtablissement()->getId()
            ));
        }
        return $this->render("commentaire/modifier_detail_commentaire.html.twig",[
            'commentaire'=>$commentaire,
            'formulaire'=>$formulaire->createView()
        ]);
    }

     /**
     * @return Response
     * @Route ("/commentaire_{id<[0-9]+>}/supprimer",name="app_commentaire_supprimer",methods={"DELETE||POST"})
     */
    public function supprimer_commentaire(Request $request,Commentaires $commentaire,EntityManagerInterface  $em):Response{
        if($this->isCsrfTokenValid('commentaire_deletion_'. $commentaire->getId(),$request->request->get('csrf_token'))){
            $em->remove($commentaire);
            $em->flush();
            $this->addFlash('suppression','Commentaire supprimer');
        }

        return $this->redirectToRoute('app_etablissement_details',array(
            "id"=>$commentaire->getEtablissement()->getId()
        ));
    }
    
}
