<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    
    session_start();
    require_once 'db.php';

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $email = $_POST['email'];
        $address = $_POST['address'];
        $phNum = $_POST['phNum'];
        $socialLink = !empty($_POST['socialLink']) ? $_POST['socialLink'] : null;
        $contactMethod = $_POST['contactMethod'];
        $contactTime = $_POST['contactTime'];
        $notes = $_POST['notes'];

       
        $stmt = $conn->prepare("INSERT INTO users (username, password, email, address, phone_number , social_link, contact_method, contact_time, notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $username, $password, $email, $address, $phNum, $socialLink, $contactMethod, $contactTime, $notes);
        $stmt->execute();
        if ($stmt->error) {
            die("Error: " . $stmt->error);
        }
        else {
            echo "Registration successful!";
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['loggedin'] = true;
            $_SESSION['address'] = $address;
            $_SESSION['phone_number'] = $phNum;
            $_SESSION['social_link'] = $socialLink;
            $_SESSION['contact_method'] = $contactMethod;
            $_SESSION['contact_time'] = $contactTime;
            $_SESSION['notes'] = $notes;
            
              $stmt->close();
        header("Location: index.html");
        exit();
        }
      
    }

    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>albums4you - Register</title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="register.css">
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

#register {
    background: white;
    width: 100%;
    max-width: 420px;
    padding: 35px 30px;
    border-radius: 16px;
    box-shadow: 0 6px 25px rgba(0, 0, 0, 0.1);
    animation: fadeIn 0.3s ease;
}

#register h2 {
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

select, textarea {
    width: 100%;
    padding: 10px;
    background: #f3f6ff;
    border: none;
    outline: none;
    border-radius: 10px;
    font-size: 14px;
}

textarea {
    resize: none;
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

.login-link {
    text-align: center;
    margin-top: 15px;
    font-size: 14px;
}

.login-link a {
    color: #2c55f5;
    text-decoration: none;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(15px); }
    to   { opacity: 1; transform: translateY(0); }
}
</style>
<body>

    <form id="register" method="post" action="register.php">

        <h2><i class="fa-solid fa-user-plus"></i> Create Account</h2>

        <div class="input-group">
            <label>Username</label>
            <div class="input-box">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="username" required>
            </div>
        </div>

        <div class="input-group">
            <label>Password</label>
            <div class="input-box">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="password" required placeholder="remember your pw :)">
            </div>
        </div>

        <div class="input-group">
            <label>Email</label>
            <div class="input-box">
                <i class="fa-solid fa-envelope"></i>
                <input type="email" name="email" required>
            </div>
        </div>

        <div class="input-group">
            <label>Address</label>
            <div class="input-box">
                <i class="fa-solid fa-location-dot"></i>
                <input type="text" name="address" required>
            </div>
        </div>

        <div class="input-group">
            <label>Phone</label>
            <div class="input-box">
                <i class="fa-solid fa-phone"></i>
                <input type="tel" name="phNum" required>
            </div>
        </div>

        <div class="input-group">
            <label>Social Link (optional)</label>
            <div class="input-box">
                <i class="fa-solid fa-link"></i>
                <input type="url" name="socialLink" placeholder="https://instagram.com/yourprofile">
            </div>
        </div>

        <div class="input-group">
            <label>Preferred Contact Method</label>
            <select name="contactMethod" required>
                <option value="">Choose one</option>
                <option value="phone">Phone</option>
                <option value="whatsapp">WhatsApp</option>
                <option value="instagram">Instagram DM</option>
                <option value="facebook">Facebook Messenger</option>
            </select>
        </div>

        <div class="input-group">
            <label>Best Time to Contact</label>
            <select name="contactTime">
                <option value="any">Anytime</option>
                <option value="morning">Morning</option>
                <option value="afternoon">Afternoon</option>
                <option value="evening">Evening</option>
            </select>
        </div>

        <div class="input-group">
            <label>Additional Notes</label>
            <textarea name="notes" rows="3" placeholder="Anything you'd like us to know?"></textarea>
        </div>

        <button type="submit" class="btn">Register</button>

        <p class="login-link">Already have an account? <a href="login.php">Login</a></p>

    </form>

</body>
</html>
