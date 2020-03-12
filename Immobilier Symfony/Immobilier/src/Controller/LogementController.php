<?php

namespace App\Controller;

use App\Entity\Logement;

use App\Entity\Media;
use App\Entity\Recherche;
use App\Form\LogementType;
use App\Form\MediaType;
use App\Repository\LogementRepository;
use App\Repository\MediaRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/logement")
 */
class LogementController extends AbstractController
{
    /**
     * @Route("/", name="logement_index", methods={"GET", "POST"})
     */
    public function index(Request $request, LogementRepository $logementRepository): Response
    {

        $search = new Recherche();

        $form = $this->createForm(\App\Form\RechercheType::class, $search);
        $form->handleRequest($request);

        $piece = $search->getNombrePiece();
        $surface = $search->getSurfaceTotale();
        $prix = $search->getPrix();
        $vente = $search->getNomVente();
        $localisation = $search->getLocalisation();
        $type = $search->getTypeLogement();

        $result = $logementRepository->rechercheLogement($piece, $surface, $prix, $vente, $localisation, $type);



        return $this->render('logement/index.html.twig', [
                'form' => $form->createView(),
                'logement' => $result,
            ]);
//
//        $resultat="";

//
//        if ($form->isSubmitted() && $form->isValid()){
//
////            $type= $search->getTypeLogement()->getNomTypeLogement();
//            $piece=$search->getNombrePiece();
//            $surf=$search->getSurfaceTotale();
//            $prix=$search->getPrix();
//
////            $tabSearch = [];
////            array_push($tabSearch,$nbrPce,$surface,$prix);
////
////            foreach ($tabSearch as $elt) {
////                dump($elt);
////                $resultat = $logementRepository->rechercheLogement($elt);
////            }
//            $resultat = $logementRepository->rechercheLogement($piece, $surf, $prix);
//


//            $sql = "";
//            $sql = "SELECT * FROM logement
//INNER JOIN typeLogement ON logement.id = typeLogement.id";
//
//            if ($type != null){
//                $resultat =  $sql."andWhere('l.typeLogement=:typeLogement')";
//            }
//            if ($nbrPce != null){
//                $resultat = $sql."andWhere('l.nombrePiece>=:nombrePiece')";
//            }
//            if ($surface != null){
//                $resultat =  $sql."andWhere('l.surfaceTotale<=:surfaceTotale')";
//            }
//            if ($prix != null){
//                $resultat = $sql."andWhere('l.prix<=:prix')";
//            }
//
//            $em = $this->getDoctrine()->getManager();
//            $rsm = new ResultSetMappingBuilder($this->getDoctrine()->getManager());
//
//            $stmt = $this->getDoctrine()->getManager()->createNativeQuery($sql, $rsm);
//$stmt->setParameter();


        //$repo = $this->getDoctrine()->getRepository();

//            dump($search);
//            $type= $search->getTypeLogement()->getNomTypeLogement();
////            $vente=$search->getNomVente();
//            $nbrPce=$search->getNombrePiece();
////           $localisation=$search->getLocalisation();
//            $surface=$search->getSurfaceTotale();
//            $prix=$search->getPrix();
////dump($type);
//            $tabSearch = [];
//                array_push($tabSearch, $type,$nbrPce,$surface,$prix);
////            dump(count($tabSearch));
//           dump($tabSearch);
//foreach ($tabSearch as $elt){
//    $resultat = $logementRepository->findLogement($elt);
//}
//
//
//dump($resultat);
//            return $this->render('logement/index.html.twig', [
//                'form' => $form->createView(),
//                'logement' => $resultat,
//            ]);
//        }
//
//
//        return $this->render('logement/index.html.twig', [
//            'form' => $form->createView(),
//            'logement' => $logementRepository->findAll(),
//
//        ]);
    }


    /**
     * @Route("/new", name="logement_new", methods={"GET","POST"})
     */
    public function new(Request $request,  LogementRepository $logementRepository): Response
    {
        $logement = new Logement();
        $form = $this->createForm(LogementType::class, $logement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($logement);
            $entityManager->flush();

            return $this->redirectToRoute('media_new');
        }

        return $this->render('logement/new.html.twig', [
            'logement' => $logement,
            'form' => $form->createView(),

        ]);
    }

    /**
     * @Route("/{id}", name="logement_show", methods={"GET"})
     */
    public function show(Logement $logement, LogementRepository $logementRepository, $id): Response
    {
        $showLogement = $logementRepository->findOneLogement($id);

        //dump($showLogement);

        return $this->render('logement/show.html.twig', [
            'logement' => $showLogement,

        ]);
    }

    /**
     * @Route("/{id}/edit", name="logement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Logement $logement): Response
    {
        $form = $this->createForm(LogementType::class, $logement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('logement_index');
        }

        return $this->render('logement/edit.html.twig', [
            'logement' => $logement,
            'form' => $form->createView(),

        ]);
    }

    /**
     * @Route("/{id}", name="logement_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Logement $logement,LogementRepository $logementRepository, MediaRepository $mediaRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$logement->getId(), $request->request->get('_token'))) {
            $this->deleteAll($logementRepository, $mediaRepository, $logement);
        }

        return $this->redirectToRoute('logement_index');
    }

    private function deleteAll($logementRepository, $mediaRepository, $id){
        $delMedia = $mediaRepository->findBy(["logement"=>$id]);
        foreach ($delMedia as $media){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($media);
            $entityManager->flush();
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($id);
        $entityManager->flush();
    }
}
