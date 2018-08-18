<?php
    if(isset($_POST['submit'])){

        include_once 'dbh.inc.php';

        //this PHP method turns user "code" into just text(Mitigates some risk of SQL injection)
        //first param is db connection var "$conn"
        //2nd param is the Global Array $_POST etc.
        $first = mysqli_real_escape_string($conn, $_POST['first']);
        $last = mysqli_real_escape_string($conn, $_POST['last']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $uid = mysqli_real_escape_string($conn, $_POST['uid']);
        $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

        //Create Error Handlers(Form Validation, all fields must be filled in)
        if(empty($first)|| empty($last) || empty($email) || empty($uid) || empty($pwd))
        {
            header("Location: ../signup.php?signup=empty");
            exit();
        }else{
            //Check if input characters are valid
            if(!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)){

                header("Location: ../signup.php?signup=invalid");
                exit();
            }else{
                //Check if email is valid
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    header("Location: ../signup.php?signup=email");
                    exit();
                }else{
                    $sql = "SELECT * FROM users WHERE user_uid= '$uid'";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);

                    if($resultCheck > 0){
                        header("Location: ../signup.php?signup=usernamealreadyinuse");
                        exit();
                    }else{

                        //HASH PWD
                        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
                        //Insert user into DB
                        $sql = "INSERT INTO users(user_first, user_last, user_email, user_uid,
                        user_pwd) VALUES ('$first', '$last', '$email', '$uid', '$hashedPwd');";
                        mysqli_query($conn, $sql);
                        header("Location: signup.php?signup=Success");
                        exit();

                    }   
                }
            }
        }

    }else{
        header("Location: ../signup.php");
        //Close off and stop script
        exit();
    }

?>