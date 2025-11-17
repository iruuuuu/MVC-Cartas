<?php 

// Si alguien se está registrando, miramos si ha escrito la contraseña dos veces igual.
if (isset($_POST['contrasena2']) && isset($_POST['contrasena']) && isset($_POST['nombre_usuario'])) {
    if ($_POST['contrasena'] == $_POST['contrasena2']) {
        // Si las contraseñas son iguales, creamos el nuevo jugador.
        $user = new User(null, $_POST['nombre_usuario'], null);
        UsuariosRepository::registrar($user, $_POST['contrasena']);
        // Y lo mandamos a la pantalla de inicio para que entre.
        header('Location: /cartas/index.php');
        die();
    }
}

// Si alguien está intentando entrar, comprobamos su nombre y contraseña.
if (isset($_POST['nombre_usuario']) && isset($_POST['contrasena'])) {
    $user = UsuariosRepository::iniciarSesion($_POST['nombre_usuario'], $_POST['contrasena']);
    
    // Si el nombre y la contraseña son correctos...
    if ($user) {
        // Apuntamos que ha entrado ahora mismo.
        UsuariosRepository::actualizarUltimoAcceso($user->getId());

        // Lo guardamos en la sesión para no olvidarnos de quién es.
        $_SESSION['user'] = $user;
        header('Location: /cartas/index.php');
        die();
    }
}

// Si alguien quiere registrarse, le enseñamos el formulario de registro.
if (isset($_GET['register'])) {
    require_once __DIR__ . '/../views/registerView.phtml';
    die();
}

// Si el jugador quiere salir, cerramos su sesión.
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: /cartas/index.php');
    die();
}

// Si el jugador quiere cambiar su foto, le enseñamos la pantalla para hacerlo.
if (isset($_GET['edit'])) {
    require_once __DIR__ . '/../views/editUserView.phtml';
    die();
}

// Si el jugador ha subido una foto nueva...
if (isset($_POST['setAvatar'])) {
    // Comprobamos que la foto se ha subido bien.
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        require_once __DIR__ . '/../helpers/fileHelper.php';

        $origen = $_FILES['avatar']['tmp_name'];
        $newAvatarName = $_FILES['avatar']['name'];
        $destino = __DIR__ . '/../public/img/' . $newAvatarName;

        // Usamos una ayudita para guardar la foto en su sitio.
        if (FileHelper::fileHandler($origen, $destino)) {
            UsuariosRepository::actualizarAvatar($newAvatarName, $_SESSION['user']);
            $_SESSION['user']->setAvatar($newAvatarName);
        }
    }
    // Después, volvemos a la pantalla de editar perfil.
    header('Location: /cartas/index.php?c=usuarios&edit=1');
    die();
}