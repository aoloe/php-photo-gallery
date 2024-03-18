<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?= $config['title'] ?></title>
    <style>
    ul.dash {
      list-style: none;
      margin-left: 0;
      padding-left: 1em;
    }
    ul.dash > li:before {
    display: inline-block;
    content: "-";
    width: 1em;
           margin-left: -1em;
    }
    </style>
    <?php if (array_key_exists('css', $config)): ?>
    <link rel="stylesheet" href="<?= $config['css'] ?>">
    <?php endif; ?>
  </head>
  <body class="secret">
    <div class="container">
      <h1>
        <a href="?">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z"/>
              <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z"/>
          </svg></a>
        <?= $title ?>
      </h1>
      <form method="POST" >
        <p>
            <input name="secret">
            <input type="submit" value="Ok">
        </p>
      <form>
    </div>
  </body>
</html>
