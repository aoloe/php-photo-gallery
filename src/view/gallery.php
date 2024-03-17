<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>title</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <style>
    .image-gallery {
      display: flex;
      flex-wrap: wrap;
    }
    .image-gallery div {
      margin: 10px;
    }

    /*----*/

  div.fullscreen {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    z-index: 900;
    background-color: rgba(255, 255, 255, 1);
    opacity: 0;
    transition: opacity 400ms ease;
    pointer-events: none;
  }

  div.fullscreen:active {
    opacity: 1;
    pointer-events: auto;
  }

  div.fullscreen>image {
    position: relative;
    z-index: 800;
    transform: none;
    transition: transform 400ms ease;
    cursor: zoom-in;
  }

  div.fullscreen>image:active {
    z-index: 1000;
    cursor: zoom-out;
  }

    </style>
  </head>
  <body>
    <div class="container">
      <p><a href="?">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z"/>
            <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z"/>
        </svg>
      </a>
      <div class="image-gallery">
      <?php foreach ($photos as $photo): ?>
        <div>
          <img
            src="data/<?= $album ?>/<?= $low_res ?><?= $photo ?>"
            title="<?= $photo ?>"
            onclick="view_fullscreen(this)"
          />
          <div class="overlay">
            <a
              href="data/<?= $album ?>/<?= $high_res ?><?= $photo ?>"
              download="<?= $photo ?>"
              title="Download <?= $photo ?>"
            >
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
              </svg>
            </a>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </body>
  <script>
    /*
    let view_fullscreen = (ev) => {
        console.log('click', ev);
        let gallery = document.getElementsByClassName('image-gallery')[0];
        let view = document.getElementsByClassName('image-view')[0];

        let image = document.createElement('img');
        image.src = ev.src;
        image.style.width = "100%"
        image.onclick = view_gallery;
        view.appendChild(image);

        // gallery.style.display = 'none';
        // view.style.display = 'inline'
        view.style.display = 'grid'
    }
    let view_gallery = (ev) => {
        let gallery = document.getElementsByClassName('image-gallery')[0];
        let view = document.getElementsByClassName('image-view')[0];

        while (view.firstChild) {
          view.removeChild(view.lastChild);
        }

        // gallery.style.display = 'flex';
        view.style.display = 'none';
    }
    */
    let view_fullscreen = (ev) => {
      console.log('click');
			let fullscreen = document.createElement('div');
      fullscreen.classList.add('fullscreen');
      fullscreen.onclick = view_gallery;
			let fullscreen_image = document.createElement('img');
      // console.log(ev);
      fullscreen_image.src = ev.src; // TODO: use the bigger size?
      fullscreen.appendChild(fullscreen_image);
			document.body.appendChild(fullscreen);
      console.log('cluck');
    };

    let view_gallery = (ev) => {
      console.log('clack')
      for (let fullscreen of document.getElementsByClassName('fullscreen')) {
        fullscreen.remove();
      }
    };

  </script>
</html>
