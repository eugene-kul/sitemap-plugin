<?php

use Eugene3993\Sitemap\Classes\Sitemap;

Route::get('sitemap.xml', function() {
    $sitemap = new Sitemap;
    return \Response::make($sitemap->generate())->header('Content-Type', 'application/xml');
});