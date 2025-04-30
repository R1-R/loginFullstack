<?php
    session_start();
    require_once 'config.php';
    // Register
if (isset($_POST['Register'])){
    $name = $_POST['name'];
    $Email = $_POST['email'];
    $password = password_hash($_POST['password'] ,PASSWORD_DEFAULT);
    $role = $_POST['role'];
    

    $checkEmail = $conn->query("Select Email From users Where Email = '$Email'");
    if ($checkEmail->num_rows>0) {
        $_SESSION['register_error'] = 'Email is already registered!';
        $_SESSION['active_form'] = 'register';
    }else{
        $conn->query("Insert into users(Name,Email,Password,role) values ('$name','$Email','$password','$role')");
    }
    header("Location: index.php");
    exit();
}
// login
if (isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];


    $result = $conn->query("select * from users where Email ='$email' and Password ='$password'");
    if($result->num_rows>0){
        $user =$result->fetch_assoc();
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