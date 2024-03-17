<!DOCTYPE html>
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
  <body class="index">
    <div class="container">
      <?php if (empty($albums)): ?>
      <p>No albums to show</p>
      <?php else: ?>
      <ul class="dash">
      <?php foreach ($albums as $key => $label): ?>
      <li><a href="?album=<?= $key ?>"><?= $label ?></a></li>
      <?php endforeach; ?>
      </ul>
      <?php endif ?>
    </div>
  </body>
</html>
