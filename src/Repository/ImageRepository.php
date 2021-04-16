<?php

namespace App\Repository;

use App\Entity\Image;
use App\Entity\Slider;
use App\Entity\SliderImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Image|null find($id, $lockMode = null, $lockVersion = null)
 * @method Image|null findOneBy(array $criteria, array $orderBy = null)
 * @method Image[]    findAll()
 * @method Image[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Image::class);
    }

    public function hasData(): bool
    {
        return $this->count([]) > 0;
    }

    public function createInitData(): void
    {
        $slider1 = (new Slider())->setName('slider 1');
        $slider2 = (new Slider())->setName('slider 2');
        $image1 = (new Image())->setName('image 1');
        $image2 = (new Image())->setName('image 2');
        $image3 = (new Image())->setName('image 3');

        $sliderImage1_1 = new SliderImage($slider1, $image1);
        $sliderImage1_2 = new SliderImage($slider1, $image2);
        $sliderImage2_3 = new SliderImage($slider2, $image3);

        $this->_em->persist($slider1);
        $this->_em->persist($slider2);
        $this->_em->persist($image1);
        $this->_em->persist($image2);
        $this->_em->persist($image3);
        $this->_em->persist($sliderImage1_1);
        $this->_em->persist($sliderImage1_2);
        $this->_em->persist($sliderImage2_3);

        $this->_em->flush();
    }

    public function getNonAttachedImages(Slider $slider): array
    {
        $ids = ($this->createQueryBuilder('i'))
            ->select('i.id')
            ->innerJoin('i.sliderImages', 'si')
            ->where('si.slider = :id')
            ->setParameter('id', $slider->getId())
            ->getQuery()
            ->getArrayResult();

        return ($this->createQueryBuilder('i'))
            ->select('i')
            ->where('i.id NOT IN (:ids)')
            ->setParameter('ids', $ids)
            ->getQuery()
            ->getResult();
    }
}
