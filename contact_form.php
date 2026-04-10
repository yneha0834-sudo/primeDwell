<?php
// Database Connection
$conn = mysqli_connect("localhost", "root", "", "primedwell");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Form Submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_type']) && $_POST['form_type'] == 'general') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $sql = "INSERT INTO tenant_requests 
            (tenant_name, tenant_email, tenant_phone, message, request_type, created_at)
            VALUES ('$name', '$email', '$phone', '$message', 'general', NOW())";

    if(mysqli_query($conn, $sql)){
        $success = "Thank you! Your message has been sent.";
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact Us</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f2f2f2; margin:0; padding:0; }
        .container { max-width: 700px; margin: 50px auto; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.2); }
        h1 { text-align: center; color: #007bff; }
        form input, form textarea { width: 100%; padding: 10px; margin: 10px 0; border-radius: 5px; border: 1px solid #ccc; }
        form button { background: #007bff; color: #fff; border: none; padding: 12px 20px; border-radius: 5px; cursor: pointer; font-size: 16px; }
        form button:hover { background: #0056b3; }
        .success { color: green; text-align: center; font-weight: bold; }
        .error { color: red; text-align: center; font-weight: bold; }
    </style>
</head>
<body>

<div class="container">
    <h1>Contact Us</h1>

    <?php
        if(isset($success)) echo "<p class='success'>$success</p>";
        if(isset($error)) echo "<p class='error'>$error</p>";
    ?>

    <form action="" method="POST">
        <!-- Hidden input to identify form type -->
        <input type="hidden" name="form_type" value="general">

        <input type="text" name="name" placeholder="Your Name" required>
        <input type="email" name="email" placeholder="Your Email" required>
        <input type="text" name="phone" placeholder="Phone Number" required>
        <textarea name="message" placeholder="Your Message" rows="5" required></textarea>

        <button type="submit">Send Message</button>
    </form>
</div>

</body>
</html>