<?php

namespace App\Repository;

use App\Entity\Logement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Logement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Logement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Logement[]    findAll()
 * @method Logement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LogementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Logement::class);
    }

    // /**
    //  * @return Logement[] Returns an array of Logement objects
    //  */

    public function findLogement($value)
    {
        return $this->createQueryBuilder('l')
            ->innerJoin('l.chauffage','ch','WITH', 'ch.id = l.chauffage')
            ->innerJoin('l.eauChaude','eau','WITH', 'eau.id = l.eauChaude')
//            ->innerJoin('l.localisation','loc','WITH', 'loc.id = l.localisation')
            ->innerJoin('l.typeLogement','type','WITH', 'type.id = l.typeLogement')
//            ->innerJoin('l.vente', 'vte', 'WITH', 'vte.id = l.vente')
            ->andWhere('l.nombrePiece LIKE :val')
            ->orWhere('l.prix LIKE :val')
            ->orWhere('l.surfaceTotale LIKE :val')
            ->orWhere('l.description LIKE :val')
            ->orWhere('l.depot LIKE :val')
            ->orWhere('l.proximite LIKE :val')
            ->orWhere('ch.nomChauffage LIKE :val')
            ->orWhere('eau.nomEauChaude LIKE :val')
//            ->orWhere('loc.nomLocalisation LIKE :val')
            ->orWhere('type.nomTypeLogement LIKE :val')
//            ->orWhere('vte.nomVente LIKE :val')
            ->setParameter('val', "%".$value."%")
            ->getQuery()
            ->getResult()
        ;
    }



    public function findOneLogement($id): ?Logement
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.id = :val')
            ->setParameter('val', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function rechercheLogement($room, $surface, $price, $vente, $localisation, $type){

        $search = $this->createQueryBuilder('l');

        if ($room != null) {
            $search->andWhere("l.nombrePiece >= :nbPiece");
            $search->setParameter("nbPiece", $room);
        }

        if ($surface != null) {
            $search->andWhere("l.surfaceTotale >= :surface");
            $search->setParameter("surface", $surface);
        }

        if ($price != null) {
            $search->andWhere("l.prix <= :price");
            $search->setParameter("price", $price);
        }

        if ($vente != null) {
            $search->andWhere("l.nomVente = :vente");
            $search->setParameter("vente", $vente);
        }

        if ($localisation != null) {
            $search->andWhere("l.nomLocalisation = :loc");
            $search->setParameter("loc", $localisation);
        }

        if ($type != null) {
            $search->andWhere("l.typeLogement = :log");
            $search->setParameter("log", $type);
        }

        $search->orderBy("l.id", "DESC");
        return $search->getQuery()->getResult();



//        $qb = $this->createQueryBuilder('l');
//       $sql= "SELECT * FROM logement as log";
////       if ($formvalue == "Maison" || $formvalue == "Appartement"){
////           $sql .= " WHERE tl.nomTypeLogement LIKE % :typeLogement %";
////       }
//       $sql .= " or WHERE log.nombrePiece LIKE :nombrePiece or WHERE log.surfaceTotale LIKE :surfaceTotale or WHERE log.prix LIKE :prix";
////        $qb->setParameter('typeLogement', $formvalue);
//        $qb->setParameter('nombrePiece', "%".$room."%");
//        $qb->setParameter('surfaceTotale', "%".$surface."%");
//        $qb->setParameter('prix', "%".$price."%");
//
////        innerJoin('l.typeLogement','type','WITH', 'type.id = l.typeLogement')
////            ->where('a.nombrePiece LIKE :formvalue')
////            ->orWhere('l.prix LIKE :formvalue')
////            ->orWhere('l.surfaceTotale LIKE :formvalue')
////            ->setParameter('form', '%'. $formvalue .'%');
//     //   $qb->
//        return $qb->getQuery()->getResult();



//        dump($val);
//        $result = $this->createQueryBuilder('l');
//       if($val != null ){
//            $result->andWhere('l.vente=:vente')
//                ->setParameter('vente', $val->getVente()->getId());
//
//        }
//        elseif ($val != null ){
//            $result->andWhere('l.typeLogement=:typeLogement')
//                ->setParameter('typeLogement', $val->getTypeLogement()->getId());
//        }
//        elseif($val->getNombrePiece() != null ){
//            $result->andWhere('l.nombrePiece>=:nombrePiece')
//                ->setParameter('nombrePiece', $val->getNombrePiece());
//
//        }
//        elseif($val->getLocalisation() != null ){
//            $result->andWhere('l.localisation=:localisation')
//                ->setParameter('localisation', $val->getLocalisation()->getId());
//
//        }
//        elseif($val->getPrix() != null ){
//            $result->andWhere('l.prix<=:prix')
//                ->setParameter('prix', $val->getPrix());
//        }
//        elseif($val->getSurfaceTotale() != null ){
//            $result->andWhere('l.surfaceTotale<=:surfaceTotale')
//                ->setParameter('surfaceTotale', $val->getSurfaceTotale());
//        }
//        return $result->getQuery()->getResult();


    }

}
