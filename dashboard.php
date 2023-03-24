<?php
$page_title = "Dashboard";
include('includes/header.php');
require('dbcon.php');

//GET data from database for exibition
$query = "SELECT * FROM users";
$query_exec = mysqli_query($conn, $query);

if (mysqli_num_rows($query_exec) > 0) {

?>

    <div class="container">
        <h3>Dashboard</h3>

        <div class="content">
            <?php
            foreach ($query_exec as $user) {
            ?>
                <div class="card">
                    <div class="card-header">
                        <span>NAME:<?= $user['username']; ?></span>
                    </div>
                    <div class="card-body">
                        <span>ID:<?= $user['id']; ?></span>
                        <span>EMAIL:<?= $user['email']; ?></span>
                    </div>
                    <div class="card-footer">
                        <a href="view.php" class="btn view">view</a>
                        <a href="edit.php" class="btn view">edit</a>
                        <a href="delete.php" class="btn view">delete</a>
                    </div>
                </div>
        <?php

            } 
        } else {
            echo "<h5>NO DATA FOUND.</h5>";
        }
        ?>

        </div>
    </div>

<!-- inserir nsa páginas CRUD index, regiter, view, edit -->

    <?php include('includes/footer.php'); ?>