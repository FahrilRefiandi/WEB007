<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasipaham | Bikin EZ aja!</title>
    <link rel="icon" type="icon" href="../../assets/images/Kasipaham ico.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Nunito">
    <link rel="stylesheet" href="../../assets/style.css">
    <style>
        body {
            margin: 0;
        }

        .image-container {
            background: var(--grayish, #EDF2FB);
            margin-top: 59px;
        }

        .image-container img {
            display: block;
            width: 100%;
            justify-content: center;
            align-items: center;
            flex-shrink: 0;
        }

        .promo-container {
            display: flex;
            width: 100%;
            height: 500px;
            justify-content: center;
            align-items: center;
            flex-shrink: 0;
            background: var(--grayish, #EDF2FB);
        }

        .promo-container img {
            height: 240px;
            flex-shrink: 0;
        }

        .content-container {
            display: flex;
            width: 100%;
            height: relative;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            flex-shrink: 0;
            padding: 64px 64px;
            background: var(--light, #F8F7FF);
        }

        .content-container h1 {
            font-size: 32px;
            color: #0096C7;
        }

        .fill-container {
            display: flex;
            margin-top: 46px;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: top;
        }

        .content {
            width: calc(33.33% - 56px);
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .title-content {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .title-content lord-icon {
            height: 72px;
            width: 72px;
            margin-right: 6px;
        }

        .title-content h2 {
            color: #023E8A;
            margin-bottom: 0;
        }

        .content p {
            margin-left: 76px;
            margin-top: -16px;
            color: #737373;
        }
    </style>
</head>

<body>
<?php include 'layouts/header.php'; ?>
    <div class="image-container">
        <img src="../../assets/images/Title-Header.png" alt="Header">
    </div>
    <div class="promo-container">
        <img src="../../assets/images/card tryout.png" alt="Tryout">
    </div>
    <div class="content-container">
        <h1>Kenapa harus #KasipahamAja?</h1>
        <div class="fill-container">
            <div class="content">
                <div class="title-content">
                    <lord-icon src="https://cdn.lordicon.com/dxoycpzg.json" trigger="loop" delay="2000" colors="primary:#f24c00,secondary:#646e78,tertiary:#4bb3fd,quaternary:#ebe6ef,quinary:#f9c9c0">
                    </lord-icon>
                    <h2>Materi Asique <br></h2>
                </div>
                <p>Ya dong, dengan Kasipaham, materi yang dikasih pasti selalu asqiue</p>
            </div>
            <div class="content">
                <div class="title-content">
                    <lord-icon src="https://cdn.lordicon.com/ajkxzzfb.json" trigger="loop" delay="2000" colors="primary:#ffc738,secondary:#4bb3fd" state="hover-looking-around">
                    </lord-icon>
                    <h2>Mentor Ketjeh <br></h2>
                </div>
                <p>Dengan mentor yang ketjeh badai, belajar kalian lebih menyenangkan
                    dan seru. Kesusahan dengan materi? Mentor Kasipaham bakal kasih paham kalian
                    dengan sepenuh hati dong.
                </p>
            </div>
            <div class="content">
                <div class="title-content">
                    <lord-icon src="https://cdn.lordicon.com/oqhlhtfq.json" trigger="loop" delay="2000" colors="primary:#4bb3fd,secondary:#ebe6ef" state="hover-2">
                    </lord-icon>
                    <h2>Support 24/7 <br></h2>
                </div>
                <p>Dengan support 24/7, kalian bisa mengakses Kasipaham kapan aja dan dimana aja loh.
                    So, jaman now belajar bisa lebih EZ PZ ya.
                </p>
            </div>
        </div>
    </div>
    <?php include 'layouts/footer.php'; ?>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>