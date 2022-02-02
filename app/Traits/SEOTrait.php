<?php

namespace app\Traits;

use App\Models\Seo;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\URL;

trait SEOTrait
{

    function SEOTrait($title = '', $img = '/logo.png', $currentURL = NULL, $property = 'Ecommerce')
    {
        $seo = Seo::find(1);
        if ($title === '') {
            $title = $seo->meta_title;
        }
        $author = $seo->meta_author;
        $addKeyword = explode(',', $seo->meta_tag);
        $description = $seo->meta_description;

        if ($currentURL === NULL) {
            $currentURL = URL::current();
        }
        SEOTools::opengraph()->addImage($img);
        SEOTools::twitter()->addImage($img);
        SEOTools::twitter()->setImage($img);
        SEOTools::addImages($img);
        SEOTools::setDescription($description);
        SEOTools::setTitle($title);
        SEOTools::setCanonical(URL::current());
        SEOMeta::addKeyword($addKeyword);
        SEOMeta::setCanonical($currentURL);
        SEOMeta::setTitle($title);
        SEOTools::opengraph()->setUrl($currentURL);
        SEOTools::opengraph()->setTitle($title);
        SEOTools::opengraph()->addProperty('type', $property);
        SEOTools::jsonLd()->setTitle($title);
        SEOTools::jsonLd()->setType($property);
        SEOTools::jsonLd()->setDescription($description);
        SEOTools::jsonLd()->addImage($img);
    }
}
