<!doctype html>
<html lang="en">
<head>
    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-GMHS6MTZEM"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-GMHS6MTZEM');
</script>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="shortcut icon" href="assets/icons/logo.png">
    <title>DWIT</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <!-- fontawesome icons -->
    <script src="https://kit.fontawesome.com/0fa86ee952.js"></script>

    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,600,700" rel="stylesheet">


    <title></title>
    <!-- responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- custome css link -->
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css">


    <!-- <script src="assets/ckeditor/ckeditor.js"></script> -->
    <script src="./assets/ckeditor4/ckeditor/ckeditor.js"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <script src="assets/js/jquery-3.3.1.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="./assets/js/validate.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>

    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>


</head>

<body>
<div class="container-fluid mainContent">

    <nav class="navbar navbar-expand-md navbar-light bg-light navbar-dark bg-dark sticky-top">
        <a class="navbar-brand" href="#"><img src="./assets/icons/logo.png" width="30px" height="30px"
                                              style="margin-right: 4%;">Deerwalk Institute of Technlogy</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            </ul>


            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle setWidth" type="button" id="dropdownMenu2"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo $_SESSION['email']; ?>
                </button>

                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                    <a href="?fold=form&page=change-password">
                        <button class="dropdown-item" type="button">Change Password</button>
                    </a>
                    <a href="?fold=actpages&page=logout">
                        <button class="dropdown-item" type="button">Logout</button>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="row bodyContent">
    		
