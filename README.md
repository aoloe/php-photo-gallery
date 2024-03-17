# Simple PHP Photo Gallery

A Simple PHP Photo Gallery with:

- Listing a gallery by scanning a folder with jpg images.
- Provide a full screen view and a download button for each image.
- Posisbility to define low resolution images for the gallery and high resolution ones for the full screen view and the download.
- Optional protection of individual galleries with specific secret words.
- Each album must be defined in the `config.php` file:

  ```php
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
  ```
