<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>albums4you - Profile</title>
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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

    main {
        background: #fff;
        width: 100%;
        max-width: 500px;
        border-radius: 16px;
        box-shadow: 0 6px 25px rgba(0,0,0,0.1);
        padding: 30px;
        animation: fadeIn 0.3s ease;
    }

    h1 {
        text-align: center;
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 20px;
        color: #4a74ff;
    }

    .info-group {
        display: flex;
        flex-direction: column;
        margin-bottom: 15px;
    }

    .info-group label {
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 5px;
        color: #555;
    }

    .info-group span {
        font-size: 16px;
        background: #f3f6ff;
        padding: 10px 12px;
        border-radius: 10px;
        color: #333;
    }

    .logout-btn {
        display: block;
        width: 100%;
        text-align: center;
        padding: 12px;
        background: #4a74ff;
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        margin-top: 20px;
        transition: 0.2s;
        text-decoration: none;
    }

    .logout-btn:hover {
        background: #2c55f5;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(15px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 480px) {
        main {
            padding: 20px;
        }

        h1 {
            font-size: 24px;
        }
    }
</style>
</head>
<body>
<main>
    <h1 id="profileName">Profile</h1>

    <div class="info-group">
        <label>Email</label>
        <span id="email">Loading...</span>
    </div>

    <div class="info-group">
        <label>Address</label>
        <span id="address">Loading...</span>
    </div>

    <div class="info-group">
        <label>Phone Number</label>
        <span id="phone_number">Loading...</span>
    </div>

    <div class="info-group">
        <label>Social Link</label>
        <span id="social_link">Loading...</span>
    </div>

    <div class="info-group">
        <label>Preferred Contact Method</label>
        <span id="contact_method">Loading...</span>
    </div>

    <div class="info-group">
        <label>Best Time to Contact</label>
        <span id="contact_time">Loading...</span>
    </div>

    <div class="info-group">
        <label>Notes</label>
        <span id="notes">Loading...</span>
    </div>

    <a href="logout.php" class="logout-btn"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
    <a href="edit.php" class="logout-btn"><i class="fa-solid fa-user-pen"></i> Edit Profile</a>
</main>

<script>
    fetch('sendData.php')
    .then(response => response.json())
    .then(data => {
        if(!data.loggedin) {
            window.location.href = "login.php"; // redirect if not logged in
            return;
        }

        document.title = `albums4you - ${data.username}`;
        document.getElementById("profileName").textContent = data.username;
        document.getElementById("email").textContent = data.email ?? "Not set";
        document.getElementById("address").textContent = data.address ?? "Not set";
        document.getElementById("phone_number").textContent = data.phone_number ?? "Not set";
        document.getElementById("social_link").textContent = data.social_link ?? "Not set";
        document.getElementById("contact_method").textContent = data.contact_method ?? "Not set";
        document.getElementById("contact_time").textContent = data.contact_time ?? "Not set";
        document.getElementById("notes").textContent = data.notes ?? "None";
    })
    .catch(error => console.error('Error fetching profile:', error));
</script>
</body>
</html>
