<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?= base_url('/public/styles/login.css') ?>" />
    <title>Login</title>
</head>

<body class="bodylogin">
    <div class="container">
        <div class="option">
            <h3>Tienes una cuenta?</h3>
            <p>Presiona aqui para ingresar con tu cuenta!</p>
            <button id="buttonLogin">Iniciar Sesion</button>
        </div>
        <div class="option">
            <h3>No tienes una cuenta?</h3>
            <p>Presiona aqui para crear una cuenta!</p>
            <button id="buttonSingup">Registrarse</button>
        </div>



        <form class="form" action="<?= base_url() ?>/login" method="POST">
            <h1 id="title">LOG IN</h1>
            <input required id="user" type="text" name="username" autocomplete="off" placeholder="User" />
            <input required id="password" type="password" name="password" autocomplete="off" placeholder="Password" />
            <div class="buttons">
                <span id="changeForm">No tienes una cuenta?</span>
                <button id="buttonForm">LOG IN</button>
            </div>
        </form>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        <?php if ($alert) { ?>
            let alert = ['<?= $alert[0] ?>', '<?= $alert[1] ?>', '<?= $alert[2] ?>']
            swal(alert[0], alert[1], alert[2])
        <?php } ?>

        let baseurl = '<?= base_url('/') ?>'
        let loginState = true

        $("#changeForm").on("click",(e)=> {
            e.preventDefault();
            loginState = !loginState 
            if(loginState) {
                $('.form').attr('action', baseurl + '/login')
                $('#title').html('LOG IN')
                $('#buttonForm').html('LOG IN')
                e.currentTarget.innerHTML  = "No tienes una cuenta?"
            }else {
                $('.form').attr('action', baseurl + '/signup')
                $('#title').html('SIGN UP')
                $('#buttonForm').html('SIGN UP')
                e.currentTarget.innerHTML = "Ya tienes una cuenta?"
            }
        })

        $('#buttonSingup').on('click', () => {
            $('.form').addClass('formSingup')

            $('.form').attr('action', baseurl + '/signup')
            $('#title').html('SIGN UP')
            $('#buttonForm').html('SIGN UP')
        })
        $('#buttonLogin').on('click', () => {
            $('.form').removeClass('formSingup')
            $('.form').attr('action', baseurl + '/login')
            $('#title').html('LOG IN')
            $('#buttonForm').html('LOG IN')
        })
    </script>
</body>

</html>