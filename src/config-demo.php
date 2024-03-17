<?php
return [
    'path' => 'data/', // default value
    'title' => 'My Photos', // optional
    'css' => 'gallery.css', // optional
    'albums' => [
        'demo' => [
            'title' => 'Demo photos', // mandatory
            'secret' => 'not so secret', // optional
            'low-res' => '640/', // default value
            'high-res' => '1920/', // default value
        ],
    ],
];
