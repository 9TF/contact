<?php
$status = 0;
$template = 1;
$user_name = '';
$password = '';
$confirm_password = '';
$name = '';
$email = '';
$number = '';
$question = '';
$image = '';
$answer = '';
$verified = '';
$verification_code='';
$error = array();
if (isset($_POST['signup'])) {
   
    $user_name = $_REQUEST['user_name'];
    $password = trim($_REQUEST['password']);
    $confirm_password = $_REQUEST['confirm_password'];
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $number = $_REQUEST['number'];
    $question = $_REQUEST['question'];
    $answer = $_REQUEST['answer'];
 /* step 1 all field are completely filled */
    if (empty($user_name)) {
        $error['user_name'] = 'enter user name';
    }
    if (!empty($user_name)) {

        $query = "select * from users where user_name='$user_name'";
        require_once '../includes/db.inc.php';
        $result = @mysql_query($query);
        if (mysql_num_rows($result) === 1) {
            $error['user_name'] = 'user name already exist ';
        }
    }
    if (empty($password)) {
        $error['password'] = 'enter password';
    }
    if (empty($confirm_password)) {
        $error['confirm_password'] = 'enter confirm password';
    }
    if (empty($name)) {
        $error['name'] = 'enter name';
    }
    if (empty($email)) {
        $error['email'] = 'enter email';
    }
    if (empty($number)) {
        $error['number'] = 'enter number';
    }
    if (empty($question)) {
        $error['question'] = 'enter question';
    }
    if (empty($answer)) {
        $error['answer'] = 'enter answer';
    }
    /* step 2 validation */if (count($error) == 0) {
        if (!preg_match('/^[A-Za-z][A-Za-z0-9]*$/', $user_name)) {
            $error['user_name'] = 'User Name is not Valid';
        }
        if (strlen($password) < 6) {
            $error['password'] = 'Password must be at least 6 characters';
        }
        if ($password != $confirm_password) {
            $error['confirm_password'] = 'Passwords do not match';
        }
        if (!preg_match('/^[A-Za-z0-9]+@[A-Za-z0-9]+\.[A-Za-z]+$/', $email)) {
            $error['email'] = 'Email is not Valid';
        }
    }
    if (count($error) == 0) {

        $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $str = str_shuffle($str);
        $verification_code = substr($str, 0, 20);
        $password = sha1($password);
        $answer = sha1($answer);
        $query = "INSERT INTO `cb`.`users` (`user_name`, `password`, `name`, `image`, `email`, `number`, `question`, `answer`, `verified`, `verification_code`) VALUES ('$user_name', '$password', '$name', '', '$email', '$number', '$question', '$answer', 'N', '$verification_code')";

       require_once '../includes/db.inc.php';
       echo  $user_name;
       echo $password;
       echo $name;
       echo $number;
       echo $email;
       
       echo $answer;
       echo $verification_code;
               
       //@mysql_query($query) or die('quries not run');
       if (mysql_query($query)) {
            $template = 2;
             
       }
    }
}
?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Contact Book</title>
        <link href="../style/w3.css" rel="stylesheet" type="text/css"/>
        <link href="../style/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body >
        <div class="w3-top">
            
            <ul class="w3-navbar w3-red w3-large w3-center">
                <li style="width:100%"><a  href="../index.php">CONTACT BOOK</a></li>
            </ul>
        </div>
        <br><br><br>
        <div class="w3-card-12 w3-center w3-white"  style="margin:auto; max-width: 500px ;width:auto;">
            <button class="w3-btn-block w3-red" style="">Register</button>
<?php if ($template == 1) { ?>
            <form action="signup.php" method="POST">

                    <div class="w3-section w3-center" >
                        <table>
                             <tbody>
                                <tr>
                                    <td>User Name</td>
                                    <td>
                                        <input class="w3-input  w3-animate-input" type="text" name="user_name" " value="<?php if(isset($error['user_name'])){ echo $error['user_name'];} else {echo $user_name; }?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>Password</td>
                                    <td>
                                        <input class="w3-input w3-animate-input" type="password" name="password" placeholder="<?php echo $error['password']; ?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Confirm Password</td>
                                    <td>
                                        <input class="w3-input w3-animate-input" type="password" name="confirm_password" placeholder="<?php echo $error['password']; ?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Name</td>
                                    <td>
                                        <input class="w3-input w3-animate-input" type="text" name="name" value="<?php echo $name; ?>"  placeholder="<?php echo $error['name']; ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>
                                        <input class="w3-input w3-animate-input"  type="text" name="email" placeholder="<?php echo $error['email']; ?>" value="<?php echo $email; ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>Number</td>
                                    <td>
                                        <input class="w3-input   w3-animate-input" type="text" name="number" value="<?php echo $number; ?>" placeholder="<?php echo $error['number']; ?>" />
                                    </td>
                                </tr>

                                <tr>
                                    <td>Security Question</td>
                                    <td>
                                        <input class="w3-input   w3-animate-input" type="text" name="question" value="<?php echo $question; ?>" placeholder="<?php echo $error['question']; ?> " />
                                    </td>
                                </tr>
                                <tr>
                                    <td>Answer</td>
                                    <td>
                                        <input class="w3-input   w3-animate-input" type="text" name="answer" value="" placeholder="<?php echo $error['answer']; ?>" />
                                    </td>
                                </tr>
                            </tbody>
                        </table> 
                    </div>
                    <input type="submit" name="signup" class="w3-btn-block w3-red" value="Submit"/>                 
                </form>
            <?php } ?>
<?php if ($template == 2) { ?>
                <h3>Congratulation Registered successfully. <br>
                    GO TO YOUR EMAIL <?php echo $email; ?> AND <br>
                    PLEASE CLICK THE VERIFICATION LINK GIVEN IN YOUR EMAIL ID.</h3>
            

<?php } ?> 
        </div>           


    </body>
</html>
