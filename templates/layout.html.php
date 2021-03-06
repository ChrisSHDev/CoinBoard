<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="/coins.css">
  <script src="https://kit.fontawesome.com/b423b412fd.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
  </script>
  <script type="text/javascript" src="/coins.js"></script>
  <title><?= $title ?></title>
</head>

<body>

  <div class="container-xl">
    <div class="row">
      <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-4 pt-1">

          </div>
          <div class="col-4 text-center">
            <a class="blog-header-logo text-dark" href="/"><img src="/assets/logonew.png"></a>
          </div>
          <div class="col-4 d-flex justify-content-end align-items-center">

          </div>
        </div>
      </header>


      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-xl">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01"
            aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse justify-content-center" id="navbarColor01">
            <ul class="navbar-nav align-items-center me-auto mb-2 mb-lg-0 col-lg-12 ">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/">Home</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" role="button"
                  data-bs-toggle="dropdown" aria-expanded="false">
                  Forum
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <li><a class="dropdown-item" href="/article/list">All Articles</a></li>
                  <li><a class="dropdown-item" href="/article/list?categoryId=1">Bitcoin</a></li>
                  <li><a class="dropdown-item" href="/article/list?categoryId=2">Altcoin</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Charts</a>
              </li>

              <li class="nav-item login-btn ms-auto">
                <?php if ($loggedIn) : ?>
                <a class="btn btn-sm light-color" href="/logout">Log Out</a>
                <?php else : ?>
                <a class="btn btn-sm bg-darker" href="/login">Log In</a>
                <?php endif; ?>
              </li>
            </ul>
          </div>
        </div>
      </nav>

    </div>
  </div>
  <main class="container-xl">

    <?= $output ?>

  </main>

  <footer class="container-xl d-flex justify-content-center">
    <div class="row">
      &copy; Coindb 2021
    </div>
  </footer>
</body>

</html>