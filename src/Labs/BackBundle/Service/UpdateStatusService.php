<?php
/**
 * Created by PhpStorm.
 * User: raphael
 * Date: 08/07/16
 * Time: 16:38
 */

namespace Labs\BackBundle\Service;


use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\RequestStack;

class UpdateStatusService
{
    /**
     * @var EntityManager
     */
    private $entity;

    /**
     * @var RequestStack
     */
    private $request;

    /**
     * @param EntityManager $entityManager
     * @param RequestStack $requestStack
     */
    public function __construct(EntityManager $entityManager, RequestStack $requestStack)
    {
        $this->entity = $entityManager;
        $this->request = $requestStack;
    }

    /**
     * @param $media
     * @param $type
     * @param $dossier
     * @return array
     */
    public function UpdateActived($media ,$type, $dossier)
    {
        $response = [];
            if($this->updateFalse($type, $dossier)){
                $this->UpdateMediaTrue($media ,$type, $dossier);
                $response = [
                    "message" => " Enregistrement effectué avec success" ,
                    "status"  => "success"
                ];
            }else{
               $response = [
                   "message" => " Une erreur est survenue" ,
                   "status"  => "error"
               ];
            }
        return $response;
    }


    /**
     * @param $media
     * @param $dossier
     * @return array
     */
    public  function UpdateStatus($media, $dossier)
    {
        $response = [];
        if($this->updateStatusFalse($dossier)){
            $this->UpdateStatusMediaTrue($media , $dossier);
            $response = [
                "message" => " Enregistrement effectué avec success" ,
                "status"  => "success"
            ];
        }else{
            $response = [
                "message" => " Une erreur est survenue" ,
                "status"  => "error"
            ];
        }
        return $response;
    }

    /**
     * @param $media
     * @param $event
     * @return array
     * Met à jour le media de l'event passé en @param à activé
     */
    public function UpdateActivedEvent($media, $event)
    {
        //dump($this->UpdateActivedMediaEvent($event)); die;
        $response = [];
        if($this->UpdateActivedMediaEvent($event)){
            $medias = $this->entity->getRepository('LabsBackBundle:Media')->findOneMedia($media, $event);
            $medias->setActived(1);
            $this->entity->persist($medias);
            $this->entity->flush();
            $response = [
                "message" => " Enregistrement effectué avec success" ,
                "status"  => "success"
            ];
        }else{
            $response = [
                "message" => " Une erreur est survenue" ,
                "status"  => "error"
            ];
        }
        return $response;
    }


    /**
     * @param $type
     * @param $dossier
     * @return bool
     */
    private function updateFalse($type, $dossier)
    {
        $medias = $this->entity->getRepository('LabsBackBundle:Media')->UpdateAllFalse($type, $dossier);
        if(!empty($medias)){
            foreach ($medias as  $m){
                $m->setActived(0);
                $this->entity->persist($m);
            }
            $this->entity->flush();
            return true;
        }
    }

    /**
     * @param $media
     * @param $type
     * @param $dossier
     * @return bool
     */
    private function UpdateMediaTrue( $media ,$type, $dossier)
    {
        $medias = $this->entity->getRepository('LabsBackBundle:Media')->UpdateTrue($media ,$type, $dossier);
        $medias->setActived(1);
        $this->entity->persist($medias);
        $this->entity->flush();
        return true;
    }



    /**
     * @param $dossier
     * @return bool
     */
    private function updateStatusFalse($dossier)
    {
        $medias = $this->entity->getRepository('LabsBackBundle:Media')->UpdateStatusAllFalse($dossier);
        if(!empty($medias)){
            foreach ($medias as  $m){
                $m->setStatus(0);
                $this->entity->persist($m);
            }
            $this->entity->flush();
            return true;
        }
    }

    /**
     * @param $media
     * @param $dossier
     * @return bool
     */
    private function UpdateStatusMediaTrue( $media , $dossier)
    {
        $medias = $this->entity->getRepository('LabsBackBundle:Media')->UpdateStatusTrue($media, $dossier);
        $medias->setStatus(1);
        $this->entity->persist($medias);
        $this->entity->flush();
        return true;
    }


    /**
     * @param $event
     * @return bool
     * Met tout les media de l'event passe en paramètre à non activé
     */
    private function UpdateActivedMediaEvent($event)
    {
        $medias = $this->entity->getRepository('LabsBackBundle:Media')->findBy(array(
            'event' => $event
        ));
        if(!empty($medias)){
            foreach ($medias as  $m){
                $m->setActived(0);
                $this->entity->persist($m);
            }
            $this->entity->flush();
            return true;
        }
    }

}