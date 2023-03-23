<?php 
$page_title = "Login Page";
include('includes/header.php');
 ?>

<div class="container">
    <h2>Log-in into your account</h2>
    <form action="submit">
        <label for="email">E-mail:</label>
        <input type="text" placeholder="Your email" name="email">
        <label for="pw">Password:</label>
        <input type="password" placeholder="Your Password" name="pw">
        <button>Log-in</button>
    </form>
    <a href="/login-php/index.php">back</a>
</div>

<?php include('includes/footer.php'); ?>