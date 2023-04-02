<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cache Location
    |--------------------------------------------------------------------------
    |
    | Filesystem path to use for caching, the default should be acceptable in
    | most cases.
    |
    */
    'cache.location' => storage_path() . '/framework/cache',

    /*
    |--------------------------------------------------------------------------
    | Cache Life
    |--------------------------------------------------------------------------
    |
    | Life of cache, in seconds
    |
    */
    'cache.life' => 3600,

    /*
    |--------------------------------------------------------------------------
    | Cache Disabled
    |--------------------------------------------------------------------------
    |
    |
    |
    */
    'cache.disabled' => true,
    /*
  |--------------------------------------------------------------------------
  | Disable Check for SSL certificates (enable for self signed certificates)
  |--------------------------------------------------------------------------
  |
  |
  |
  */
    'ssl_check.disabled' => false,
    /*
    |--------------------------------------------------------------------------
    | Strip Html Tags Disabled
    |--------------------------------------------------------------------------
    |
    |
    |
    */
    'strip_html_tags.disabled' => false,

    /*
    |--------------------------------------------------------------------------
    | Striped Html Tags
    |--------------------------------------------------------------------------
    |
    |
    |
    */
    // 'base', 'blink', 'body', 'doctype', 'embed', 'font', 'form', 'frame', 'frameset', 'html', 'iframe', 'input', 'marquee', 'meta', 'noscript', 'object', 'param', 'script', 'style'
    'strip_html_tags.tags' => ['base', 'blink', 'body', 'doctype', 'embed', 'font', 'form', 'frame', 'frameset', 'html', 'iframe', 'input', 'marquee', 'meta', 'noscript', 'object', 'param', 'script', 'style'],

    /*
    |--------------------------------------------------------------------------
    | Strip Attributes Disabled
    |--------------------------------------------------------------------------
    |
    |
    |
    */
    'strip_attribute.disabled' => false,

    /*
    |--------------------------------------------------------------------------
    | Striped Attributes Tags
    |--------------------------------------------------------------------------
    |
    |
    |
    */
    // 'bgsound', 'class', 'expr', 'id', 'style', 'onclick', 'onerror', 'onfinish', 'onmouseover', 'onmouseout', 'onfocus', 'onblur', 'lowsrc', 'dynsrc'
    'strip_attributes.tags' => ['bgsound', 'class', 'expr', 'id', 'style', 'onclick', 'onerror', 'onfinish', 'onmouseover', 'onmouseout', 'onfocus', 'onblur', 'lowsrc', 'dynsrc'],

    /*
    |--------------------------------------------------------------------------
    | CURL Options
    |--------------------------------------------------------------------------
    |
    | Array of CURL options (see curl_setopt())
    | Set to null to disable
    |
    */
    'curl.options' => null,
    'curl.timeout' => 20,
    'sources' => [
//        'montevideo' => [
//            'url' => 'https://www.montevideo.com.uy/anxml.aspx?58',
//            'country' => 'Uruguay',
//            'image' => ['element' => '.foto-ppal img', 'attr' => 'src'],
//            'timezone' => 'America/Montevideo'
//        ],
//        'lr21' => [
//            'url' => 'http://www.lr21.com.uy/feed',
//            'country' => 'Uruguay',
//            'image' => ['element' => 'figure img', 'attr' => 'src'],
//            'timezone' => 'America/Montevideo'
//        ],
//        'ladiaria'=> [
//            'url' => 'https://ladiaria.com.uy/feeds/articulos',
//            'country' => 'Uruguay',
//            'image' => ['element' => '.materialboxed source', 'attr' => 'srcset', 'base_url' => 'https://ladiaria.com.uy'],
//            'timezone' => 'America/Montevideo'
//        ],
//        'uypress'=> [
//            'url' => 'http://www.uypress.net/anxml.aspx?13',
//            'country' => 'Uruguay',
//            'image' => ['element' => '.contenedor_foto img', 'attr' => 'src'],
//            'timezone' => 'America/Montevideo'
//        ],
//        'brecha'=> [
//            'url' => 'http://brecha.com.uy/feed/',
//            'country' => 'Uruguay',
//            'image' => ['element' => '.post-thumbnail img', 'attr' => 'src'],
//            'timezone' => 'America/Montevideo'
//        ],
//        'larepublica'=> [
//            'url' => 'https://www.republica.com.uy/feed/',
//            'country' => 'Uruguay',
//            'image' => ['element' => '.aspectRatio-picture img', 'attr' => 'src'],
//            'timezone' => 'America/Montevideo'
//        ],
    ],       
    'default' => [
        'country' => 'Uruguay',
        'limit' => 2
    ],
]; 