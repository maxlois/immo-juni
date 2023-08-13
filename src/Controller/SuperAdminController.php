<?php

namespace App\Controller;

use App\Entity\Pays;
use App\Entity\Ville;
use App\Form\FormPaysType;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\PaysRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SuperAdminController extends AbstractController
{

    #[Route('/super_admin', name: 'super_admin_home')]
    public function accueilSuperAdmin(): Response
    {
        return $this->render('/super_admin/accueil.html.twig');
    }

    #[Route('/super_admin/pays', name: 'super_admin_pays_list')]
    public function listPays(PaysRepository $repository): Response
    {
        return $this->render('/super_admin/pays-list.html.twig', [           
            'pays'  =>  $repository-> findAll()
        ]);

    }

    #[Route('/super_admin/pays/new', name: 'super_admin_pays_new')]
    #[Route('/super_admin/pays/{id}/edit', name: 'super_admin_pays_edit')]
    public function savePays(Pays $pays = null, Request $request, EntityManagerInterface $em):Response
    {
        //creation de pays
        if(!$pays) $pays =  new Pays();

        //ceation de formulaire
        $paysForm = $this->createForm(FormPaysType::class, $pays);

        //Traitement de la requete du formulaire
        $paysForm ->handleRequest($request);

        //vérification du formulaire
        if( $paysForm->isSubmitted() && $paysForm->isValid()){
            //$pays = $paysForm->getData();
            //stoker dans la base de donnée
            $em->persist($pays);
            $em->flush();
            $this->addFlash('success', 'Pays ajouté');

            //redirection
            return $this->redirectToRoute('super_admin_pays_list');
        }
        
        return $this->render('/super_admin/pays-save.html.twig', [
            'paysForm'=> $paysForm->createview()
        ]);

    }



    #[Route('super_admin/pays/{id}/delete', name: 'super_admin_pays_delete')]
    public function deletePays(Pays $pays, EntityManagerInterface $em): Response
    {
       $em->remove($pays);
       $em->flush();
     return $this->redirectToRoute('super_admin_pays_list');
    }


    // gestion de la ville 

    
    #[Route('/super_admin/ville', name: 'super_admin_ville_list')]
    public function listVille(PaysRepository $repository): Response
    {
        return $this->render('/super_admin/ville-liste.html.twig', [           
            'ville'  =>  $repository-> findAll()
        ]);

    }

    #[Route('/super_admin/ville/new', name: 'super_admin_ville_new')]
    #[Route('/super_admin/ville/{id}/edit', name: 'super_admin_ville_edit')]
    public function saveVille(Ville $ville = null, Request $request, EntityManagerInterface $em):Response
    {
        //creation de la ville
        if(!$ville) $ville =  new Ville();

        //ceation de formulaire
        $villeForm = $this->createForm(villeType::class, $ville);

        //Traitement de la requete du formulaire
        $villeForm ->handleRequest($request);

        //vérification du formulaire
        if( $villeForm->isSubmitted() && $villeForm->isValid()){
            //$pays = $paysForm->getData();
            //stoker dans la base de donnée
            $em->persist($ville);
            $em->flush();
            $this->addFlash('success', 'ville ajouté');

            //redirection
            return $this->redirectToRoute('super_admin_ville_new');
        }
        
        return $this->render('/super_admin/ville-save.html.twig', [
            'villeForm'=> $villeForm->createview()
        ]);

    }


    //Pour supprimer une ville
    #[Route('super_admin/ville/{id}/delete', name: 'super_admin_ville_delete')]
    public function deleteVille(Ville $ville, EntityManagerInterface $em): Response
    {
        //pour supprimer le formulaire
       $em->remove($ville);
       $em->flush();
     return $this->redirectToRoute('super_admin_ville_list');
    }
    

}
