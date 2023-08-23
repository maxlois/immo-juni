<?php

namespace App\Controller;

use App\Entity\Pays;
use App\Entity\Propriete;
use App\Entity\Quartier;
use App\Entity\TypePropriete;
use App\Entity\User;
use App\Entity\Ville;
use App\Form\FormPaysType;
use App\Form\ProprieteType;
use App\Form\QuartierType;
use App\Form\TypeProType;
use App\Form\UserType;
use App\Form\VilleType;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\PaysRepository;
use App\Repository\ProprieteRepository;
use App\Repository\QuartierRepository;
use App\Repository\TypeProprieteRepository;
use App\Repository\UserRepository;
use App\Repository\VilleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class SuperAdminController extends AbstractController
{

    #[Route('/super_admin', name: 'super_admin_home')]
    public function accueilSuperAdmin(): Response
    {
        return $this->render('/super_admin/accueil.html.twig');
    }


    // Gestion utilisateur

    #[Route('/super_admin/utilisateur', name: 'super_admin_utilisateur_list')]
    public function listUtilisateur(UserRepository $repository): Response
    {
        
        return $this->render('/super_admin/utilisateur-liste.html.twig', [           
            'user'  =>  $repository-> findAll()
        ]);

    }
    

    #[Route('/super_admin/utilisateur/new', name: 'super_admin_utilisateur_new')]
    #[Route('/super_admin/utilisateur/{id}/edit', name: 'super_admin_utilisateur_edit')]
    public function saveUtilisateur(User $user = null, Request $request,UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $em):Response
    {
        //creation d'utilisateur
        if(!$user) $user =  new User();

        //ceation de formulaire
        $userForm = $this->createForm(UserType::class, $user);

        //Traitement de la requete du formulaire
        $userForm ->handleRequest($request);

        //vérification du formulaire
        if( $userForm->isSubmitted() && $userForm->isValid()){
            //$pays = $paysForm->getData();
            //stoker dans la base de donnée
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $user = $userForm->getData()
                )
            );

            $em->persist($user);
            $em->flush();
            $this->addFlash('success', 'utilisateur ajouté');

            //redirection
            return $this->redirectToRoute('super_admin_utilisateur_list');
        }
        
        return $this->render('/super_admin/utilisateur-save.html.twig', [
            'userForm'=> $userForm->createview()
        ]);

    }



    #[Route('super_admin/utilisateur/{id}/delete', name: 'super_admin_utilisateur_delete')]
    public function deleteUser(User $user, EntityManagerInterface $em): Response
    {
       $em->remove($user);
       $em->flush();
     return $this->redirectToRoute('super_admin_utilisateur_list');
    }



    // Gestion Pays
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
    public function listVille(VilleRepository $repository): Response
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
        $villeForm = $this->createForm(VilleType::class, $ville);

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
            return $this->redirectToRoute('super_admin_ville_list');
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
    



    // gestion de la Quartier 

    
    #[Route('/super_admin/quartier', name: 'super_admin_quartier_list')]
    public function listQuartier(QuartierRepository $repository): Response
    {
        return $this->render('/super_admin/quartier-list.html.twig', [           
            'quartier' => $repository-> findAll()
        ]);

    }

    #[Route('/super_admin/quartier/new', name: 'super_admin_quartier_new')]
    #[Route('/super_admin/quartier/{id}/edit', name: 'super_admin_quartier_edit')]
    public function saveQuartier(Quartier $quartier = null, Request $request, EntityManagerInterface $em):Response
    {
        //creation de la Quartier
        if(!$quartier) $quartier =  new Quartier();

        //ceation de formulaire
        $quartierForm = $this->createForm(QuartierType::class, $quartier);

        //Traitement de la requete du formulaire
        $quartierForm ->handleRequest($request);

        //vérification du formulaire
        if( $quartierForm->isSubmitted() && $quartierForm->isValid()){
            //$pays = $paysForm->getData();
            //stoker dans la base de donnée
            $em->persist($quartier);
            $em->flush();
            $this->addFlash('success', 'quartier ajouté');

            //redirection
            return $this->redirectToRoute('super_admin_quartier_list');
        }
        
        return $this->render('/super_admin/quartier-save.html.twig', [
            'quartierForm'=> $quartierForm->createview()
        ]);

    }


    //Pour supprimer un quartier
    #[Route('super_admin/quartier/{id}/delete', name: 'super_admin_quartier_delete')]
    public function deleteQuartier(Quartier $quartier, EntityManagerInterface $em): Response
    {
        //pour supprimer le formulaire
       $em->remove($quartier);
       $em->flush();
     return $this->redirectToRoute('super_admin_quartier_list');
    }


    
    // gestion de type propriété 

    
    #[Route('/super_admin/type_propriete', name: 'super_admin_type_propriete_list')]
    public function listTypePro(TypeProprieteRepository $repository): Response
    {

        return $this->render('/super_admin/typePro-list.html.twig', [           
            'typePropriete' => $repository-> findAll()
        ]);

    }

    #[Route('/super_admin/type_propriete/new', name: 'super_admin_type_propriete_new')]
    #[Route('/super_admin/type_propriete/{id}/edit', name: 'super_admin_type_propriete_edit')]
    public function saveTypePro(TypePropriete $typePropriete = null, Request $request, EntityManagerInterface $em):Response
    {
        //creation de la Quartier
        if(!$typePropriete) $typePropriete =  new TypePropriete();

        //ceation de formulaire
        $typeProForm = $this->createForm(TypeProType::class, $typePropriete);

        //Traitement de la requete du formulaire
        $typeProForm ->handleRequest($request);

        //vérification du formulaire
        if( $typeProForm->isSubmitted() && $typeProForm->isValid()){
            //$pays = $paysForm->getData();
            //stoker dans la base de donnée
            $em->persist($typePropriete);
            $em->flush();
            $this->addFlash('success', 'type propriété ajouté');

            //redirection
            return $this->redirectToRoute('super_admin_type_propriete_list');
        }
        
        return $this->render('/super_admin/typePro-save.html.twig', [
            'typeProForm'=> $typeProForm->createview()
        ]);

    }


    //Pour supprimer un type propriété
    #[Route('super_admin/type_propriété/{id}/delete', name: 'super_admin_type_propriete_delete')]
    public function deleteTypePro(TypePropriete $typePropriete, EntityManagerInterface $em): Response
    {
        //pour supprimer le formulaire
       $em->remove($typePropriete);
       $em->flush();
     return $this->redirectToRoute('super_admin_type_propriete_list');
    }



     // Gestion propriete

     #[Route('/super_admin/propriete', name: 'super_admin_propriete_list')]
     public function listProprite(ProprieteRepository $repository): Response
     {
         return $this->render('/super_admin/propri-liste.html.twig', [           
             'propriete'  =>  $repository-> findAll()
         ]);
 
     }
 
     #[Route('/super_admin/propriete/new', name: 'super_admin_propriete_new')]
     #[Route('/super_admin/propriete/{id}/edit', name: 'super_admin_propriete_edit')]
     public function savePropriete(Propriete $propriete = null, Request $request, EntityManagerInterface $em):Response
     {
         //creation propriete
         if(!$propriete) $propriete =  new Propriete();
 
         //ceation de formulaire
         $proprieteForm = $this->createForm(ProprieteType::class, $propriete);
 
         //Traitement de la requete du formulaire
         $proprieteForm ->handleRequest($request);
 
         //vérification du formulaire
         if( $proprieteForm->isSubmitted() && $proprieteForm->isValid()){
             //$pays = $paysForm->getData();
             //stoker dans la base de donnée
             $em->persist($propriete);
             $em->flush();
             $this->addFlash('success', 'propriete ajouté');
 
             //redirection
             return $this->redirectToRoute('super_admin_propriete_list');
         }
         
         return $this->render('/super_admin/propri-save.html.twig', [
             'proprieteForm'=> $proprieteForm->createview()
         ]);
 
     }
 
 
 
     #[Route('super_admin/propriete/{id}/delete', name: 'super_admin_propriete_delete')]
     public function deleteproprete(Propriete $propriete, EntityManagerInterface $em): Response
     {
        $em->remove($propriete);
        $em->flush();
      return $this->redirectToRoute('super_admin_propri_list');
     }
 
}
