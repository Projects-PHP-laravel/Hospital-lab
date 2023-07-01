<?php
    session_start();
    include "master/sections/connect.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Heart Center</title>
        <link rel="stylesheet" href="master/css/log.css">
    </head>
    <body>
        <div class="all">
            <header>Heart Center</header>
                <div class="f">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <input type="text" name="username" placeholder="username" autocomplete="off">
                    <input type="password" name="pass" placeholder="password">
                    <input type="submit" value="Login">
                </form>
                <?php
                    if( $_SERVER['REQUEST_METHOD'] == 'POST'){
                        $user = $_POST['username'];
                        $pass = $_POST['pass'];
                       
                        if( empty($user) || empty($pass) ){
                            echo "<div class=\"error\">Please Write username and password to signin. </div>";
                        }
                        else{
                            $user_info = $conn -> query("SELECT * FROM users WHERE user_username = '$user'
                            AND user_password = '$pass'") -> fetchAll(PDO::FETCH_ASSOC);
                            if( count($user_info) > 0){
                                $user_type = $user_info[0]['user_usertype'];
                               if( $user_type == 1 ){
                                    $_SESSION['user'] = $user_info[0]['user_username'];
                                    $_SESSION['userid'] = $user_info[0]['user_userid'];
                                    $_SESSION['usertype'] = "admin";
                                    header("location:pages/admin.php");
                               }
                               else{
                                    $_SESSION['user'] = $user_info[0]['user_username'];
                                    $_SESSION['userid'] = $user_info[0]['user_userid'];
                                    $_SESSION['usertype'] = "user";
                                    header("location:pages/user.php");
                               }
                            }
                            else{
                                echo "<div class=\"error\">Invalid Username Or Password. </div>";
                            }
                        }
                    }
                ?>
            </div>
            <footer>Created By YAT</footer>
        </div>
    </body>
</html>