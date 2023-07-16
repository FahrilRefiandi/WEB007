<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasipaham</title>
    <link rel="icon" type="icon" href="../../assets/images/Kasipaham ico.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Nunito">
    <link rel="stylesheet" href="../../assets/style.css">
    <style>
        body{
            background: #EDF2FB;
        }
        .container{
            height: calc(100vh - 59px);
            margin-top: 128px;
        }
    </style>
</head>
<body>
    <?php include 'layouts/header.php'; ?>
    <div class="container" bis_skin_checked="1">
    <div class="p-5 text-center bg-body-tertiary rounded-3" bis_skin_checked="1">
    <svg class="bi mt-4 mb-3" style="color: var(--bs-indigo);" width="100" height="100"><use xlink:href="#bootstrap"></use></svg>
    <h1 class="text-body-emphasis">Jumbotron with icon</h1>
    <p class="col-lg-8 mx-auto fs-5 text-muted">
      This is a custom jumbotron featuring an SVG image at the top, some longer text that wraps early thanks to a responsive <code>.col-*</code> class, and a customized call to action.
    </p>
    <div class="d-inline-flex gap-2 mb-5" bis_skin_checked="1">
      <button class="d-inline-flex align-items-center btn btn-primary btn-lg px-4 rounded-pill" type="button">
        Ambil
      </button>
      <button class="btn btn-outline-secondary btn-lg px-4 rounded-pill" type="button">
        Cek Deskripsi
      </button>
    </div>
  </div>
</div>
    <?php include 'layouts/footer.php'; ?>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>    
</body>
</html>