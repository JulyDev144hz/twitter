<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url("/public/styles/index.css") ?>?<?php echo date('l jS \of F Y h:i:s A'); ?>">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <title>Inicio</title>
</head>

<body>
    <aside class="asideLeft">
        <a class="btnSignOut" href="<?= base_url('/logout') ?>"><span>Cerrar Sesion</span></a>
        <a class="btnAsideOption" href="<?= base_url('/') ?>"><span>Inicio</span></a>
        <a class="btnAsideOption" href="<?= base_url('/editProfile') ?>"><span>Edit Profile</span></a>
    </aside>

    <main class="mainIndex">
        <h1>Twitter \ EditProfile</h1>
        <form class="formEditUser" action="<?= base_url('/editUser') ?>" method='POST' enctype="multipart/form-data">
            <div class="imgEditProfile">
                <?php if ($image) { ?>
                    <img id="imgForm" class="imgForm" src="<?= base_url() . '/uploads/' . $image ?>" alt="">
                <?php } else { ?>
                    <img id="imgForm" class="imgForm" src="<?= base_url('/public/img/userpicture.png') ?>" alt="">
                <?php } ?>
                <input type="file" name="image" id="imgIn">
            </div>
            <div class="EdtiProfileInputs">
                <input hidden name="oldUsername" type="text" value="<?= $username ?>">
                <input name="username" autocomplete="off" type="text" placeholder="Username" value="<?= $username ?>">
                <input name="oldPassword" type="password" placeholder="Old Password">
                <input name="password" type="password" placeholder="NewPassword">
                <input name="confirmPassword" type="password" placeholder="Confirm New Password">
            </div>
            <button>Confirm</button>

        </form>
    </main>

    <aside class="asideRight">
        <div class="userInformation">
            <?php if ($image) { ?>
                <img class="userPicture" src="<?= base_url() . '/uploads/' . $image ?>" alt="">
            <?php } else { ?>
                <img class="userPicture" src="<?= base_url('/public/img/userpicture.png') ?>" alt="">
            <?php } ?>

            <span class="userUsername"><a href="<?= base_url("/profile/").$id?>"><?= $username ?></a></span>
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

        const imgForm = document.getElementById('imgForm')
        const imgIn = document.getElementById('imgIn')
        imgIn.onchange = evt => {
            const [file] = imgIn.files
            if (file) {
                imgForm.src = URL.createObjectURL(file)
            }
        }
    </script>
</body>

</html>