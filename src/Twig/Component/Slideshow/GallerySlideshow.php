<?php

namespace App\Twig\Component\Slideshow;

use App\Entity\Gallery;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('gallery-slideshow', template: '.components/slideshows/gallery-slideshow.html.twig')]
class GallerySlideshow
{
    public Gallery $gallery;
}
