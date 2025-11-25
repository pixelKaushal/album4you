<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>albums4you - Login</title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="login.css">
    <?php
    session_start();
    require_once 'db.php';
    if($_SESSION['loggedin'] ?? false){
        header("Location: index.html");
        exit();

    }
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $emailOrNumber = $_POST['emailOrNumber'];
        $password = $_POST['password'];
        $stmt = $conn->prepare("SELECT username, email, password FROM users WHERE email = ? OR phone_number = ?");
        $stmt->bind_param("ss", $emailOrNumber, $emailOrNumber);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($username, $email, $hashed_password);
            $stmt->fetch();
            if (is_null($hashed_password)) {
         echo "Error: No password found for this user.";
             exit();
        }
            if (password_verify($password, $hashed_password)) { 
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $_SESSION['loggedin'] = true;
                header("Location: index.html");
                exit();
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "No user found with that email or phone number.";
        }
        $stmt->close();
    }
    ?>
</head>
<style> 
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Poppins, sans-serif;
}

body {
    background: #eef3ff;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 20px;
}

#login {
    background: white;
    width: 100%;
    max-width: 400px;
    padding: 35px 30px;
    border-radius: 16px;
    box-shadow: 0 6px 25px rgba(0, 0, 0, 0.1);
    animation: fadeIn 0.3s ease;
}

#login h2 {
    text-align: center;
    margin-bottom: 25px;
    font-size: 26px;
    font-weight: 600;
}

.input-group {
    margin-bottom: 18px;
}

.input-group label {
    font-size: 14px;
    margin-bottom: 5px;
    display: block;
}

.input-box {
    display: flex;
    align-items: center;
    background: #f3f6ff;
    padding: 10px 12px;
    border-radius: 10px;
    gap: 10px;
}

.input-box i {
    color: #555;
    font-size: 15px;
}

.input-box input {
    border: none;
    outline: none;
    background: none;
    width: 100%;
    font-size: 14px;
}

.btn {
    width: 100%;
    padding: 12px;
    border: none;
    background: #4a74ff;
    color: white;
    border-radius: 10px;
    font-size: 15px;
    font-weight: 500;
    cursor: pointer;
    transition: 0.2s;
}

.btn:hover {
    background: #2c55f5;
}

.register-link {
    text-align: center;
    margin-top: 15px;
    font-size: 14px;
}

.register-link a {
    color: #2c55f5;
    text-decoration: none;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(15px); }
    to   { opacity: 1; transform: translateY(0); }
}

</style>

<body>

    <form id="login" method="post" action="login.php">

        <h2><i class="fa-solid fa-right-to-bracket"></i> Login</h2>

        <div class="input-group">
            <label>Email/Number</label>
            <div class="input-box">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="emailOrNumber" required>
            </div>
        </div>

        <div class="input-group">
            <label>Password</label>
            <div class="input-box">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="password" required>
            </div>
        </div>

        <button type="submit" class="btn">Login</button>

        <p class="register-link">Don't have an account? 
            <a href="register.php">Register here</a>
        </p>

    </form>

</body>
</html>
