<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>
    <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <header>
            <nav>
                <div class="main-wrapper">
                    <ul>
                        <li><a href="index.php">Home Page</a></li>
                    </ul>
                    <div class="nav-login">
                        <?php
                            if(isset($_SESSION['u_id'])){
                                echo ('<form action="logout.inc.php" method="POST">
                                     <button type="submit" name="submit">Log Out</button>
                                      </form>');
                            }else{
                                echo('<form action="login.inc.php" method="POST">
                                    <input type="text" name="uid" placeholder="Username/e-mail">
                                    <input type="password" name="pwd" placeholder="Password">
                                    <button type="submit" name="submit">Login</button>
                                    </form>
                                    <a href="signup.php" id="signup">Sign Up</a>');

                            }
                        ?>
                    </div>
                </div>
            </nav>
        </header>