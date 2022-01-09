<?php
include_once 'includes/user.php';
include_once 'includes/user_session.php';


$userSession = new UserSession();
$user = new User();

if(isset($_SESSION['user'])){
    //echo "hay sesion";
    $user->setUser($userSession->getCurrentUser());
    include_once 'vistas/home.php';

}else if(isset($_POST['correo']) && isset($_POST['password'])){
    
    $userForm = $_POST['correo'];
    $passForm = $_POST['password'];

    $user = new User();
    if($user->userExists($userForm, $passForm)){
        //$userSession->setCurrentUser($userForm);
        $user->setUser($userForm);
        $userSession->setCurrentUser($user->getNombre());


        include_once 'vistas/home.php';
    }else{
        //echo "No existe el usuario";
        $errorLogin = "Nombre de usuario y/o password incorrecto";
        include_once 'vistas/login.php';
    }
}else{
    //echo "login";
    include_once 'vistas/login.php';
}

?>