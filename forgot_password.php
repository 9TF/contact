<?php
    $status = 0;
    $template = 1;
    if(isset($_POST['submit'])){
        $user_name = $_POST['user_name'];
        $query = "select * from users where user_name='$user_name'";
        require_once 'includes/db.inc.php';
      
        $result = mysql_query($query);
        if(mysql_num_rows($result)==1){
           $row = mysql_fetch_assoc($result);
           $question = $row['question'];
           $template = 2;
        }
        else{
            $template = 1;
            $status = 1;
        }
    }
    if(isset($_POST['reset'])){
        $user_name = $_POST['user_name'];
        $question = $_POST['question'];
        $answer = $_POST['answer'];
        $answer = sha1($answer);
        $query = "select * from users where user_name = '$user_name' and answer = '$answer'";
        require_once 'includes/db.inc.php';
        $result = @mysql_query($query);
        if(mysql_num_rows($result)==1){
           $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
           $str = str_shuffle($str);
           $password = substr($str, 0, 8);
           $data = sha1($password);
           $query = "update users set password='$data' where user_name='$user_name'";
           mysql_query($query);
           $template = 3;
        }
        else{
            $template = 2;
            $status = 2;
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>Forget Password</title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <link href="style/style.css" rel="stylesheet" type="text/css"/>
        <link href="style/w3.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
       <div class="w3-top">
            <ul class="w3-navbar w3-red w3-large w3-center">
                <li style="width:100%"><a  href="index.php">CONTACT BOOK</a></li>
            </ul>
        </div>
        
        
        
        <br><br>
                <div class="w3-card-12 w3-center w3-white"  style="width:auto; max-width:350px; margin: auto;">
                    <?php if($template==1){ ?>
            <h2>Forgot Password</h2>
            <form action="forgot_password.php" method="POST">
                <table border="0">
                    <tbody>
                        <tr>
                            <td>User Name : </td>
                            <td><input type="text" name="user_name" value="" /></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: center;">
                                <input type="submit" name="submit" value="Submit" />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
            <?php if($status==1) { ?>
                <h2 class="error">UserName is Incorrect</h2>
            <?php } ?>
            <?php } ?>
                
            <?php if($template==2){ ?>
            <h2>Forgot Password</h2>
            <form action="forgot_password.php" method="POST">
                <table border="0">
                    <tbody>
                        <tr>
                            <td>User Name : </td>
                            <td><input type="text" readonly name="user_name" value="<?php echo $user_name;?>" /></td>
                        </tr>
                        <tr>
                            <td>Question : </td>
                            <td><input type="text" readonly name="question" value="<?php echo $question;?>" /></td>
                        </tr>
                        <tr>
                            <td>Answer : </td>
                            <td><input type="text" name="answer" value="" /></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: center;">
                                <input  type="submit" name="reset" value="Submit" />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
            <?php if($status==2) { ?>
                <h2 class="error">The given answer is Incorrect</h2>
            <?php } ?>
            <?php } ?> 
            <?php if($template==3){ ?>
            <h3>Your password has been changed.</h3>
            <h3>An email has been sent to your mail id.</h3>
            <h3>Your Password is <?php echo $password;?></h3>
            Click <a href="index.php">here</a> to login.
            <?php } ?>
                </div>    
    
                              
        
    </body>
</html>
