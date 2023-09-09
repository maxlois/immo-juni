<?php

namespace App\Controller;

use App\Entity\Location;
use App\Entity\Loyer;
use App\Entity\Pays;
use App\Entity\Propriete;
use App\Entity\Quartier;
use App\Entity\TypePropriete;
use App\Entity\User;
use App\Entity\Ville;
use App\Form\FormPaysType;
use App\Form\LocationType;
use App\Form\LoyerType;
use App\Form\ProprieteType;
use App\Form\QuartierType;
use App\Form\TypeProType;
use App\Form\UserType;
use App\Form\VilleType;
use App\Repository\LocationRepository;
use App\Repository\LoyerRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\PaysRepository;
use App\Repository\ProprieteRepository;
use App\Repository\QuartierRepository;
use App\Repository\TypeProprieteRepository;
use App\Repository\UserRepository;
use App\Repository\VilleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

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
        // $attrRequired = false ;
        if(!$user) $user =  new User();
            // $attrRequired = true;
        

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
                    $user->getPassword()
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

     #[Route('super_admin/info-immeuble/{id}', name:'info-immeuble')]
     public function infoIm(Propriete $propriete , string $id , EntityManagerInterface $entityManager ):Response
     {
       return $this->render('/super_admin/info-immeuble.html.twig', compact('propriete'));
     }
 
     #[Route('/super_admin/propriete/new', name: 'super_admin_propriete_new')]
     #[Route('/super_admin/propriete/{id}/edit', name: 'super_admin_propriete_edit')]
     public function savePropriete(Propriete $propriete = null, Request $request, SluggerInterface $slugger, EntityManagerInterface $em):Response
     {
        $attrRequired = false ;
         //creation propriete
         if(!$propriete){
            $propriete =  new Propriete();
            $attrRequired = true ;
         }
 
         //ceation de formulaire
         $proprieteForm = $this->createForm(ProprieteType::class, $propriete, ['attrRequired' => $attrRequired]);
 
         //Traitement de la requete du formulaire
         $proprieteForm ->handleRequest($request);
 
         //vérification du formulaire
         if( $proprieteForm->isSubmitted() && $proprieteForm->isValid()){

            $imageFile = $proprieteForm->get('image')->getData();
            $image2File = $proprieteForm->get('image2')->getData();
            $image3File = $proprieteForm->get('image3')->getData();
            $image4File = $proprieteForm->get('image4')->getData();
            $image5File = $proprieteForm->get('image5')->getData();

            if ($imageFile) $propriete->setimageFile($this->uploadFile($imageFile, $slugger));
            if ($image2File) $propriete->setimage2File($this->uploadFile($image2File, $slugger));
            if ($image3File) $propriete->setimage3File($this->uploadFile($image3File, $slugger));
            if ($image4File) $propriete->setimage4File($this->uploadFile($image4File, $slugger));
            if ($image5File) $propriete->setimage5File($this->uploadFile($image5File, $slugger));
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
      return $this->redirectToRoute('super_admin_propriete_list');
     }
 
     public function uploadFile($file, SluggerInterface $slugger)
     {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $file->move(
                        $this->getParameter('upload_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

        return '/upload/' . $newFilename ;
     }



        // gestion de loyer 

    
       #[Route('/super_admin/loyer', name: 'super_admin_loyer_list')]
       public function listLoyer(LoyerRepository $repository): Response
       {

            return $this->render('/super_admin/loyer-list.html.twig', [           
               'loyer' => $repository-> findAll()
            ]);

       }

        #[Route('/super_admin/loyer/new', name: 'super_admin_loyer_new')]
        #[Route('/super_admin/loyer/{id}/edit', name: 'super_admin_loyer_edit')]
        public function saveLoyer(Loyer $loyer = null, Request $request, EntityManagerInterface $em):Response
        {
             //creation de la Quartier
            if(!$loyer) $loyer =  new Loyer();

            //ceation de formulaire
           $loyerForm = $this->createForm(LoyerType::class, $loyer);

            //Traitement de la requete du formulaire
           $loyerForm ->handleRequest($request);

           //vérification du formulaire
           if( $loyerForm->isSubmitted() && $loyerForm->isValid()){
               //$pays = $paysForm->getData();
               //stoker dans la base de donnée
               $em->persist($loyer);
               $em->flush();
               $this->addFlash('success', 'loyer ajouté');

               //redirection
               return $this->redirectToRoute('super_admin_loyer_list');
           }
        
            return $this->render('/super_admin/loyer-save.html.twig', [
                'loyerForm'=> $loyerForm->createview()
            ]);

       }


         //Pour supprimer un loyer
       #[Route('super_admin/loyer/{id}/delete', name: 'super_admin_loyer_delete')]
       public function deleteLoyer(Loyer $loyer, EntityManagerInterface $em): Response
       {
           //pour supprimer le formulaire
          $em->remove($loyer);
          $em->flush();
         return $this->redirectToRoute('super_admin_loyer_list');
       }



       
       #[Route('/super_admin/location', name: 'super_admin_location_liste',methods: ['GET', 'POST'])]
       public function listLocation(LocationRepository $repository): Response
       {

            return $this->render('/super_admin/location-liste.html.twig', [           
               'location' => $repository-> findAll()
            ]);

       }

       #[Route('/super_admin/location/new', name: 'super_admin_location_new')]
       //#[Route('/super_admin/location/{id}/edit', name: 'super_admin_location_edit')]
       public function saveLocation(Location $location = null, Request $request, SluggerInterface $slugger, EntityManagerInterface $em):Response
       {
           //creation de la Quartier
           $attrRequired = false ;
           //creation propriete
           if(!$location){
              $location =  new Location();
              $attrRequired = true ;
           }

           //ceation de formulaire
           $locationForm = $this->createForm(LocationType::class, $location, ['attrRequired' => $attrRequired]);

           //Traitement de la requete du formulaire
           $locationForm ->handleRequest($request);

           //vérification du formulaire
           if( $locationForm->isSubmitted() && $locationForm->isValid()){
                $etatLieuFile = $locationForm->get('etatLieu')->getData();

                if ($etatLieuFile) $location->setetatLieu($this->uploadFile($etatLieuFile, $slugger));

               //stoker dans la base de donnée
               $em->persist($location);
               $em->flush();
               $this->addFlash('success', 'location ajouté');

               // Mettre à jour le statut de la propriété
               $propriete = $location->getPropriete() ;

               $propriete->setStatut(true);
               $em->persist($propriete);
               $em->flush();

               // Enregistrer les premiers loyers
               $moisEnCours = intval($location->getMois()) ;
               $anneeEncours = intval($location->getAnnee()) ;
               $modePaiem = $locationForm->get('modePaiem')->getData();

               for($i = 0; $i < intval($location->getMoisAvance()); $i++){
                    $loyer = new Loyer ;
                    $prixLoyer = $location->getPropriete()->getPrixPro() ;
                    
                    if($i > 0){
                        $moisEnCours++ ;

                        if($moisEnCours > 12){
                            $moisEnCours = 1;
                            $anneeEncours++ ;
                        }
                    }

                    $loyer->setPrixLoyer($prixLoyer)
                          ->setDateLoyer($location->getDateDLocation())
                          ->setTypePaie(2)
                          ->setStatutLoy(true)
                          ->setMontLoy($prixLoyer)
                          ->setAppliPenal(false)
                          ->setMois($moisEnCours)
                          ->setAnnee($anneeEncours)
                          ->setModePaie($modePaiem)
                          ->setRefPaie(uniqid())
                          ->setMontPaie($prixLoyer)
                          ->setLocation($location) ;

                    $em->persist($loyer);
                    $em->flush();
                }

               //redirection
               return $this->redirectToRoute('super_admin_location_liste');
           }
        
           return $this->render('/super_admin/location-save.html.twig', [
               'locationForm'=> $locationForm->createview()
           ]);

       }


    

       #[Route('super_admin/location/{id}/delete', name: 'super_admin_location_delete', methods: ['POST'])]
       public function delete(Request $request, Location $location, EntityManagerInterface $entityManager): Response
       {
           if ($this->isCsrfTokenValid('delete'.$location->getId(), $request->request->get('_token'))) {
               $entityManager->remove($location);
               $entityManager->flush();
           }

           return $this->redirectToRoute('super_admin_location_liste', [], Response::HTTP_SEE_OTHER);
       }

       public function etalieuFile($file, SluggerInterface $slugger)
     {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $file->move(
                        $this->getParameter('upload_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

        return '/upload/' . $newFilename ;
     }


}
