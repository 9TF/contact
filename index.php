<?php 
$template = 1;
$status = 0;

if(isset($_POST['login']))
{
    $user_name = $_REQUEST['user_name'];
    $password = sha1($_REQUEST['password']);
    $query = "select * from users where user_name='$user_name' and password='$password'";
    require_once 'includes/db.inc.php';
    $result = @mysql_query($query);
    if(mysql_num_rows($result)==1){
        $row = mysql_fetch_assoc($result);
             if($row['verified']== Y)
                {
                 session_start();
                 $name = $row['name'];
                 $_SESSION['name'] = $name;
                 $_SESSION['user_name'] = $user_name;
                 header('location:user/index.php');
                }else{
                    $template = 2;
                }
     }else{
           $status = 1;}
} 

     
?>
<!DOCTYPE html>
<html>
    <head>
    
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Contact Book</title>
        <link href="style/w3.css" rel="stylesheet" type="text/css"/>
        <link href="style/style.css" rel="stylesheet" type="text/css"/>
        <link href="style/cdnjs.cloudflare.com_ajax_libs_font-awesome_4.6.3_css_font-awesome.min.css" rel="stylesheet" type="text/css"/>
    </head>
    <body >
        <div class="w3-top">
            <ul class="w3-navbar w3-red w3-large w3-center">
                <li style="width:100%">CONTACT BOOK<i class="fa fa-book"></i></li>
            </ul>
        </div>
        
       
        
        <br><br>
                <div class="w3-card-12 w3-center w3-white"  style="width:auto; max-width:350px; margin: auto;">
                    <?php if($template==1){ ?>
                    <div class="w3-container w3-center">
                         
                     <img class="w3-circle " src="pictures/img_avatar3.png" alt="Avatar" style="width:80%">
                     <form action="index.php" method="POST" >
                     <div class="w3-section">
                     <table class="w3-table">
                         <tr ><td><input type="text"  name="user_name" required placeholder="<?php if($status==1){ echo 'wrong';} ?> Username" class="w3-input w3-animate-input"  /></td></tr>
                     <tr><td><input type="password" name="password" required placeholder="<?php if($status==1){ echo 'wrong';} ?> Password" class="w3-input  w3-animate-input"  /></td></tr>
                     </table>
                     </div>
                     <div class="w3-section " style="overflow: auto">
                         <input type="submit" name="login" class="w3-btn w3-red" value="Login" /> 
                     <a href="forgot_password.php"><input type="button" name="forget_password" class="w3-btn w3-red" value="Forget Password" /></a>    
                     <a href="./user/signup.php"><input type="button" name="signup" class="w3-btn w3-red" value="signup" /></a>
                     </div></form>
                    </div>
                    <?php echo "$password"; }?>
                    <?php if($template==2){ ?>
                    <div class="w3-container w3-center"
                         <h3 class="w3-center">contacts</h3><br>
                     <img class="w3-circle" src="pictures/img_avatar3.png" alt="Avatar" style="width:80%">
                     <h1>NOT!! VERIFIED,!!GO TO YOUR EMAIL AND COMPLETE VERIFICATION </h1>
                    </div>
                    <?php }?> 
                   
                </div>    
    </body>
</html>
