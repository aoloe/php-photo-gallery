<!DOCTYPE html>
<html lang="en">
  <!-- list images in $photos. provide a download link to the high res version.
       on click show the high refs image to the size fitting the browser window -->
  <head>
    <meta charset="utf-8">
    <title><?= $title ?></title>
    <style>
      .image-gallery {
        display: flex;
        flex-wrap: wrap;
      }
      .image-gallery div {
        margin: 10px;
      }

      .image-gallery div img {
        cursor: zoom-in;
      }

      svg.icon {
        width: 16px;
        height: 16px;
      }

      div.fullscreen {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        z-index: 900;
        background-color: rgba(255, 255, 255, 1);
        opacity: 0;
        cursor: zoom-out;
      }

      div.fullscreen.resized {
        opacity: 1;
      }

      div.fullscreen image {
        position: relative;
        z-index: 800;
        transform: none;
        opacity: 0;
      }

      div.fullscreen>image.resized {
        opacity: 1;
      }
    </style>
    <?php if (array_key_exists('css', $config)): ?>
    <link rel="stylesheet" href="<?= $config['css'] ?>">
    <?php endif; ?>
  </head>
  <body>
    <!-- svg icon template for the download link -->
		<svg
      xmlns="http://www.w3.org/2000/svg"
      xmlns:xlink="http://www.w3.org/1999/xlink"
      width="16" height="16" fill="currentColor"
    >
      <symbol viewBox="0 0 16 16" id="bi-download">
        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
      </symbol>
		</svg>

    <div class="container">
      <h1>
        <a href="?">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z"/>
              <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z"/>
          </svg></a>
        <?= $title ?>
      </h1>
      <div class="image-gallery">
      <?php foreach ($photos as $photo): ?>
        <div>
          <img
            src="<?= $album_path ?><?= $low_res_folder ?><?= $photo ?>"
            title="<?= $photo ?>"
            onclick="view_fullscreen(this)"
          />
          <div class="overlay">
            <a
              href="<?= $album_path ?><?= $high_res_folder ?><?= $photo ?>"
              download="<?= $photo ?>"
              title="Download <?= $photo ?>"
            >
              <svg class="icon" fill="currentColor">
                  <use xlink:href="#bi-download" />
              </svg>
            </a>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
    <script>
      // inspired by https://github.com/alecrios/image-zoom-js
      let view_fullscreen = (targetElement) => {
        // let currentImage = targetElement;
        let high_res_path = "<?= $album_path ?><?= $high_res_folder ?>";
        let fullscreen = document.createElement('div');
        fullscreen.classList.add('fullscreen');
        fullscreen.onclick = view_gallery;

        let fullscreen_image = get_fullscreen_image(high_res_path + targetElement.src.split('/').pop());
        fullscreen.appendChild(fullscreen_image);

        document.body.appendChild(fullscreen);
        document.onkeydown = (event) => {
          if (event.key === "Escape") {
            document.onkeydown = null;
            view_gallery()
          } else if (event.key === "ArrowRight") {
            // TODO: implement the arrow right and arrow left
            // nextGalleryImage = targetElement.parentElement.nextElementSibling.firstElementChild;
            // let i = 0;
            // while (currentImage.parentElement.lastElementChild &&  i < 10) {
            //   i += 1;
            //   console.log(i)
            //   currentImage.parentElement.removeChild(currentImage.parentElement.lastElementChild);
            // }
            // let nextFullScreenImage = get_fullscreen_image(high_res_path + nextGalleryImage.src.split('/').pop())
            // currentImage.parentElement.appendChild(nextFullScreenImage);
            // console.log(nextFullScreenImage.src);
          } else if (event.key === "ArrowLeft") {
          }
        };
      };

      let get_fullscreen_image = (src) => {
        let fullscreen_image = document.createElement('img');
        fullscreen_image.src = src;

        fullscreen_image.onload = () => {
          boundingRect = fullscreen_image.getBoundingClientRect();
          var scale = Math.min(window.innerWidth / boundingRect.width, window.innerHeight / boundingRect.height);
          var translateX = ((window.innerWidth - boundingRect.width) / 2) - boundingRect.left;
          var translateY = ((window.innerHeight - boundingRect.height) / 2) - boundingRect.top;
          fullscreen_image.style.transform = `translate3d(${translateX}px, ${translateY}px, 0) scale(${scale})`;
          // TODO: is there any way to avoid the flickering by wating for transform to finish?
          fullscreen_image.classList.add('resized');
          fullscreen_image.parentElement.classList.add('resized');
        }
        return fullscreen_image;
      }

      let view_gallery = (_) => {
        for (let fullscreen of document.getElementsByClassName('fullscreen')) {
          fullscreen.remove();
        }
      };
    </script>
  </body>
</html>
