<?php

namespace App\Traits;

/**
 * This trate make dummy banners from normal
 * 
 * Trait DummyBanner
 * @package App\Traits
 */
trait DummyBanner {
    public function getDummyHtml($width = null, $height = null, $text = '') {
        return view('banner/dummy', [
            'width' => $width,
            'height' => $height,
            'text' => $text
        ]);
    }
}