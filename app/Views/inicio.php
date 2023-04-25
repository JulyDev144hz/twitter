<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url("/public/styles/index.css")?>">
    <title>Inicio</title>
</head>

<body>
    <aside class="asideLeft">
        <a class="btnSignOut" href="<?= base_url('/logout')?>"><span>Salir</span></a>
    </aside>

    <main class="mainIndex">
        <h1>Twitter
            <?= $username?>
            <?= $typeUser?>
        </h1>

        <form action="/createTweet">
            <textarea name="content"></textarea>
            <button>Twittear</button>
        </form>
    </main>

    <aside class="asideRight">
        <div class="userInformation">
            <img src="" alt="">
            <span><?=$username?></span>
        </div>
    </aside>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        <?php if ($alert) { ?>
            let alert = ['<?= $alert[0] ?>', '<?= $alert[1] ?>', '<?= $alert[2] ?>']
            swal(alert[0],alert[1],alert[2])
        <?php } ?>

    </script>
</body>

</html>