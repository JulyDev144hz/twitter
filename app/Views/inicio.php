<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
</head>
<body>
    <a href="<?= base_url('/logout')?>">Salir</a>
    <h1>Twitter <?= $username?> <?= $typeUser?></h1>

    <form action="/createTweet">
        <textarea name="content"></textarea>
        <button>Twittear</button>
    </form>

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