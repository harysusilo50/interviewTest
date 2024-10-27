<!doctype html>
<html lang="en">

<head>
    <title><?= $title ?> | Interview Test</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <?php if(session()->logged_in){ ?>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="#">Test Interview</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?= uri_string() == 'home' ? 'active fw-bold' : '' ?>" aria-current="page"
                            href="<?= base_url('home') ?>">Home</a>
                    </li>
                    <?php if(session()->role != 'user') {?>
                    <li class="nav-item">
                        <a class="nav-link <?= uri_string() == 'products' ? 'active fw-bold' : '' ?>"
                            aria-current="page" href="<?= base_url('products') ?>">Product</a>
                    </li>
                    <?php } ?>

                    <li class="nav-item">
                        <form action="<?= base_url('auth/logout') ?>" method="post">
                            <button class="nav-link text-danger fw-bold" type="submit"
                                aria-current="page"">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php } ?>
    <?= $this->renderSection('content') ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>
