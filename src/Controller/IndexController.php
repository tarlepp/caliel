<?php

namespace App\Controller;

use App\Repository\ImageRepository;
use App\Repository\SliderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/{sliderId}', defaults: ['sliderId' => null], name: 'index', methods: ['GET'])]
    public function index(SliderRepository $sliderRepository, ImageRepository $imageRepository, ?int $sliderId = null): Response
    {
        if ($imageRepository->hasData() === false) {
            $imageRepository->createInitData();
        }

        $sliders = $sliderRepository->findAll();
        $slider = $sliderId !== null ? $sliderRepository->find($sliderId) : null;
        $otherImages = $sliderId !== null ? $imageRepository->getNonAttachedImages($slider) : [];

        return $this->render('index/index.html.twig', [
            'sliders' => $sliders,
            'slider' => $slider,
            'otherImages' => $otherImages,
        ]);
    }

}
