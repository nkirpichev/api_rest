<?php

namespace App\Controller;

use App\Entity\Ouvrage;
use App\Repository\OuvrageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class OuvrageController extends AbstractController
{
    #[Route('/ouvrage', name: 'app_ouvrage')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/OuvrageController.php',
        ]);
    }

    #[Route('api/ouvrages', name: 'app_api_ouvrages', methods:['GET'])]
    public function apiOuvrages(OuvrageRepository $ouvrageRepository, SerializerInterface $serializer) : JsonResponse
    {
        $ouvrages = $ouvrageRepository->findAll();
        $ouvragesJson = $serializer->serialize($ouvrages , 'json', ['groups' => ['ouvrage', 'categorie', 'auteur']]);
        
        return new JsonResponse($ouvragesJson, Response::HTTP_OK,[],true);
    }

    #[Route('api/ouvrages/{id}', name: 'app_api_ouvrage', methods:['GET'])]
    public function apiOuvragesById(OuvrageRepository $ouvrageRepository, SerializerInterface $serializer, $id) : JsonResponse|Response
    {
        $ouvrage = $ouvrageRepository->find($id);
        if(isset($ouvrage)){
            $ouvragesJson = $serializer->serialize($ouvrage , 'json', ['groups' => ['ouvrage', 'categorie', 'auteur']]);
        
            return new JsonResponse($ouvragesJson, Response::HTTP_OK,[],true);
        }
       
        return new Response('', Response::HTTP_NOT_FOUND);
    }

    #[Route('api/ouvrages/param/{id}', name: 'app_api_ouvrage_param', methods:['GET'])]
    public function apiOuvragesByIdParam(Ouvrage $ouvrage, SerializerInterface $serializer, $id) : JsonResponse|Response
    {
        
        if(isset($ouvrage)){
            $ouvragesJson = $serializer->serialize($ouvrage , 'json', ['groups' => ['ouvrage', 'categorie', 'auteur']]);
        
            return new JsonResponse($ouvragesJson, Response::HTTP_OK,[],true);
        }
       
        return new Response('', Response::HTTP_NOT_FOUND);
    }

    #[Route('api/ouvrages/{id}', name: 'app_api_ouvrage_delete', methods:['DELETE'])]
    public function apiOuvrageDelete(Ouvrage $ouvrage, EntityManagerInterface $em) : Response
    {
        $em->remove($ouvrage);
        $em->flush();
        return new Response('', Response::HTTP_NO_CONTENT);
    }

    #[Route('api/ouvrages/', name: 'app_api_ouvrage_create', methods:['POST'])]
    public function apiOuvrageCreate(Request $request, EntityManagerInterface $em, SerializerInterface $serializer) : Response
    {

        $ouvrage = $serializer->deserialize($request->getContent(), Ouvrage::class,'json', ['groups' => ['ouvrage']]);
        $em->persist( $ouvrage);
        $em->flush();
        return new Response('', Response::HTTP_CREATED);
    }

}
