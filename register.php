<?php 
session_start();
$page_title = "Registration Page";
include('includes/header.php'); 
?>

<div class="container">
    <div class="alert">
        <?php if(isset($_SESSION['status'])){ 
            echo "[".$_SESSION['status']."]"; 
            unset($_SESSION['status']);
        }
            ?>
    </div>
    <h2 class="title">Register your account</h2>
    <form action="script.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" placeholder="Your username" name="username">
        <label for="email">E-mail:</label>
        <input type="text" placeholder="Your email" name="email">
        <label for="pw">Password:</label>
        <input type="password" placeholder="Your Password" name="pw">
        <label for="confpw">Confirm Password:</label>
        <input type="password" placeholder="Confirm your Password" name="confpw">
        <button type="submit" id="register_btn" name="register_btn">Register</button>
    </form>
    <a href="/login-php/index.php">back</a>
</div>

<?php include('includes/footer.php'); ?>