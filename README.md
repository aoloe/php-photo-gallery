# Simple PHP Photo Gallery

A very Simple PHP Photo Gallery:

- The gallery view is scanning folders with images (there is no database).
- Provide a full screen view (javascript based) and a download button for each image.
- Optionally, define different low resolution images for the gallery and high resolution ones for the full screen view and the download.
- Optional protection of individual galleries with secret words.  
  Warning: The images are not protected by the _password_, only their listing (it's not really a password either, just some sort of _access code_).
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
- Some styling is possible, by creating a CSS file and mentioning it in the configuration file.

## Installation

- Use a modern version of PHP.
- Put `index.php` and the `view/` folder somewhere served through http.
- Create folders with images in there.
- Use `config-demo.php` as a template for creating your `config.php`.  
  Fill the `config.php` file according to the content you are publishing.

## Todo

- [ ] Javascript based browsing of the images while the image is maximized.
