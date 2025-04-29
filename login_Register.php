<?php
    session_start();
    require_once 'config.php';
if (isset($_POST['Register'])){
    $name = $_POST['name'];
    $Email = $_POST['email'];
    $password = password_hash($_POST['password'] ,PASSWORD_DEFAULT);
    $role = $_POST['role'];
    

    $checkEmail = $conn->query("select Email From users Where Email = '$Email'");
    if ($checkEmail->num_rows>0) {
        $_SESSION['register_error'] = 'Email is already registered!';
        $_SESSION['active_forn'] = 'register';
    }else{
        $conn->query("Insert into users(Name,Email,Password,role) values ('$name','$Email','$password','$role')");
    }
    header("Location: index.php");
    exit();
}

if (isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];


    $Result = $conn->query("select * from users where Email ='$email'");
    if($Result->num_rows>0){
        $user =$Result->fetch_assoc();
        if(password_verify($password, $user['password'])){
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];

     if($user['role'] === 'Admin') {
                header("Location: Admin_page.php");
            }else{
                header("Location: User_Page.php");
            }
            exit();
        }
    }

     $_SESSION['login_error']= 'incorrect email or password';
     $_SESSION['active_form']= 'login';
     header("Location: index.php");
     exit();

}
?>