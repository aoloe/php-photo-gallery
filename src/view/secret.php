<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>title</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
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
  </head>
  <body>
    <div class="container">
      <form method="POST" >
        <p><input name="secret"></p>
      <form>
    </div>
  </body>
</html>
