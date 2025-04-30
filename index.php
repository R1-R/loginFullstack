<?php
session_start();

$errors = [
    'login'=> $_SESSION['login_error'] ??'',
    'register' => $_SESSION['register_error'] ??''
];
$activeForm = $_SESSION['active_form'] ?? 'login';
session_unset();

function showError($error){
    return !empty($error) ? "<P class = 'error-message'>$error</p>" : '';
}

function isActiveForm($formName, $activeForm){
    return $formName === $activeForm ? 'active' : '';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    <!-- login -->
        <div class="form-box <?= isActiveForm('login',$activeForm); ?>" id="login-form">
            <form action="login_Register.php"  method="post">
                <h2>login</h2>
                <?=showError($errors['login']);?>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="login">login</button>
                <p>Don't have an account? <a href="#" onclick="showform('Register-form')">Register</a></p>
            </form>
        </div>
         <!-- register -->
      <div class="form-box <?= isActiveForm('regsister',$activeForm); ?>" id="Register-form">
            <form action="login_Register.php" method="post">
                <h2>Register</h2>
                <?=showError($errors['register']);?>
                <input type="text" name="name" placeholder="Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <select name="role" required>
                    <option value="">--select role--</option>
                    <option value="User">User</option>
                    <option value="Admin">Admin</option>
                </select>
                <button type="submit" name="Register">Register</button>
                <p>Already have an account? <a href="#" onclick="showform('login-form')">login</a></p>
            </form>
        </div>    

    </div>
    
    <script src="script.js"></script>
</body>
</html>