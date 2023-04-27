<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url("/public/styles/index.css") ?>">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <title>Inicio</title>
</head>

<body>
    <aside class="asideLeft">
        <a class="btnSignOut" href="<?= base_url('/logout') ?>"><span>Salir</span></a>
    </aside>

    <main class="mainIndex">
        <h1>Twitter</h1>

        <form class="CreateTweetForm" method="POST" action="<?= base_url('/createTweet') ?>">
            <textarea placeholder="En que estas pensando?" name="content"></textarea>
            <button>Twittear</button>
        </form>

        <?php foreach ($tweets as $tweet) { ?>
            <div class="tweet">
                <?php if ($tweet['image']) { ?>
                    <img class="TweetUserPicture" src="<?= base_url() . '/uploads/' . $tweet['image'] ?>" alt="">
                <?php }else{ ?>
                    <img class="TweetUserPicture" src="<?= base_url('/public/img/userpicture.png') ?>" alt="">
                <?php } ?>
                <span class="TweetUsername"><?= $tweet['username'] ?></span>
                <p class="TweetContent"><?= $tweet['content'] ?></p>
                <div class="TweetStats">
                    Likes 2 <?= $tweet['id_tweet'] ?>
                </div>

                <?php if ($typeUser == "admin") { ?>
                    <a href="<?= base_url() . '/deleteTweet' . '/' . $tweet['id_tweet'] ?>" class="deleteButton">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <path fill="#f00" d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />
                        </svg>
                    </a>
                <?php } ?>
            </div>
        <?php } ?>
    </main>

    <aside class="asideRight">
        <div class="userInformation">
            <img src="" alt="">
            <span><?= $username ?></span>
        </div>
    </aside>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        <?php if ($alert) { ?>
            let alert = ['<?= $alert[0] ?>', '<?= $alert[1] ?>', '<?= $alert[2] ?>']
            swal(alert[0], alert[1], alert[2])
        <?php } ?>
        <?php if ($toast) { ?>
            Toastify({
                text: '<?= $toast ?>',
                duration: 3000,
                newWindow: true,
                close: true,
                gravity: "bottom",
                position: "right",
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                    background: "linear-gradient(to right, #00b09b, #96c93d)",
                }
            }).showToast();
        <?php } ?>
    </script>
</body>

</html>