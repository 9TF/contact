<?php
//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!user Admin Panel or index page.
require_once '../includes/secure.inc.php';
$user_name = $_SESSION['user_name'];
$name = $_SESSION['name'];
$email= $_session['email'];
$group = $_GET['group'];
$query = "SELECT * FROM `contacts` WHERE `user_name` = '$user_name' AND `group` = '$group' ORDER BY name ASC";
require_once '../includes/db.inc.php';    
$result = mysql_query($query);
 
if(isset($_POST['add'])){
$name = $_POST['name'];
$group = $_GET['group'];
$number = $_POST['number'];
$email = $_POST['email'];
$query = "INSERT INTO `cb`.`contacts` (`user_name`, `name`, `number`, `email`, `address`, `group`, `event_name`, `event_date`, `image`) VALUES ('$user_name', '$name', '$number', '$email', NULL, '$group', NULL, NULL, NULL)";
require_once '../includes/db.inc.php';
@mysql_query($query);

}
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Contact Book</title>
        <link href="../style/style.css" rel="stylesheet" type="text/css"/>
        <link href="../style/w3.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    </head>
    <body >
                
        <div class="w3-top ">
               <?php require_once '../includes/header.inc.php'; ?>       
        </div>
<!-- Page Container -->
        <div class="w3-container w3-content" style="max-width:1400px;margin-top:80px;">    
          <!-- The Grid -->
          <div class="w3-row-padding" >
             <!-- Left Column -->
             <div class="w3-col m3 l2">
              <!-- Profile -->
              <div class="w3-card-2  w3-white " >
                <div class="w3-container" style="overflow: auto;">
                 <h4 class="w3-center">My Profile</h4>
                  <div class="chip">
                        
                        <img src="../pictures/userimage/<?php echo $_SESSION['user_name'];?>.jpg" alt="Person" width="96" height="96" onclick="document.getElementById('id03').style.display='block'">
                    <?php echo $_SESSION['name'];?>
                    </div><hr>
                 <ul class="w3-ul">
                 <a href="index.php"><li class="w3-leftbar">All Contact</li></a>
                 <li class="w3-accordion" onclick="myFunction('Demo1')">
                     Groups
                      <div id="Demo1" class="w3-accordion-content">
                        <ul class="w3-ul">
                            <?php 
                            $query = "select * from groups where user_name='$user_name'";
                            require_once '../includes/db.inc.php';    
                            $groups = mysql_query($query);
                            if(mysql_num_rows($groups)>0){
                            while($group = mysql_fetch_assoc($groups)){ ?>
                            <a href="show_groups.php?group=<?php echo $group['group_name']; ?>"><li class="fa fa-group <?php if($group['group_name']==="$group"){ echo 'w3-leftbar'; } ?>"> <?php echo $group['group_name']; ?></li></a>
                            <?php }} ?>
                            <li class="fa fa-group" onclick="document.getElementById('id02').style.display='block'" > New Group</li>
                        </ul>  
                      </div>
                 </li>
                 <li>Events</li>
                 </ul>
                </div>
              </div>        
            </div>
             <script>      <!-- script 4 Accordion -->
                        function myFunction(id) {
                            var x = document.getElementById(id);
                            if (x.className.indexOf("w3-show") == -1) {
                                x.className += " w3-show";
                            } else { 
                                x.className = x.className.replace(" w3-show", "");
                            }
                        }
             </script>

                                    <div id="id02" class="w3-modal w3-center"  >
                           <div class="w3-modal-content w3-animate-zoom w3-card-8 w3-round-small " style="max-width: 400px;margin: auto;">
                              <span onclick="document.getElementById('id02').style.display='none'" 
                                  class="w3-closebtn">&times;</span>
                              <form action="add_groups.php" method="POST">
                                    
                                  <input class="w3-input" required type="text" name="group_name" placeholder="Enter Group Name" /></td>
                                    
                                          <footer class="w3-container w3-blue">                                  
                                        <input type="submit" value="Add" name="groups" class="w3-btn-block w3-blue"/>  
                                 
                                          </footer>   
                              </form>
                                </div>
                                
                           </div>
             
             
                          
             
          <!-- Middle Column -->
                            <div class="w3-col m7 l8" >
                                <div  class="w3-container " style="min-height:250px;overflow: auto;" >
                                    <h2><?php echo $_GET['group'] ; ?></h2>
                                    <ul class="w3-ul w3-card-2 w3-white " style="overflow: auto;"> 
                                        <?php while($row = mysql_fetch_assoc($result)){      ?>
                                        <li>
                                            <div class="w3-row-padding">
                                                <div class="w3-quarter chip w3-left-align"><img src="../pictures/img_avatar3.png" alt="Person" width="96" height="96">
                                                                        <?php echo $row['name']; ?></div>
                                                <div class="w3-quarter w3-left-align"><?php echo $row['number']; ?></div>
                                                <div class="w3-quarter w3-left-align"><?php echo $row['email']; ?></div>
                                                <div class="w3-quarter w3-right-align">
                                                  <a href="viewcontact.php?number=<?php echo $row['number']; ?>" ><i class="w3-large fa fa-clone" style="color:red" title="View Contact" ></i></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                  <a href="edit.php?number=<?php echo $row['number']; ?>" ><i class="fa fa-edit w3-large " style="color:red" title="EDIT" ></i></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                  <a onclick="return confirm('ARE you Sure Want To Delete' )" href="delete.php?number=<?php echo $row['number']; ?>" ><i class="w3-large  fa fa-trash " style="color:red" title="DELETE" ></i></a>
                                                </div>                                            
                                            </div>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                        </div>
            
                         <!--  right  Column -->
                        <div class="w3-col m2" >
                           
                         <div class="w3-container w3-center" style="float:right;">
                             <img class="w3-card w3-circle" src="../pictures/pictures.jpg" onclick="document.getElementById('id01').style.display='block'" style="width:auto;" title="Add Contact To This Group"/>
 
                         </div>
                       <div id="id01" class="w3-modal w3-center"  >
                           <div class="w3-modal-content w3-animate-zoom w3-card-4 w3-round-small " style="max-width: 400px;margin: auto;">
                              
                               <form action="show_groups.php" method="POST">
                                        
                                        <table border="0" >
                                            <tbody>
                                                <tr>
                                                    <td>Name</td>
                                                    <td><input class="w3-input" required type="text" name="name" /></td>
                                                </tr>
                                                <tr>
                                                    <td>Number</td>
                                                    <td><input class="w3-input" required type="text" name="number" /></td>
                                                </tr>
                                                <tr>
                                                    <td>Email</td>
                                                    <td><input class="w3-input" type="text" name="email" /></td>
                                                </tr>
                                               
                                            </tbody>
                                        </table><br>
                                          <footer class="w3-container w3-blue">                                  
                                        <input type="submit" value="Add" name="add" class="w3-btn-block w3-blue"/>  
                                 </footer>   
                              </form>
                                </div>
                                
                           </div>
                             <script>       <!-- script 4 Add Contact modal box -->
                                // Get the modal
                                var modal = document.getElementById('id01');

                                // When the user clicks anywhere outside of the modal, close it
                                window.onclick = function(event) {
                                    if (event.target == modal) {
                                        modal.style.display = "none";
                                    }
                                }
                             </script>

                        </div>   
     
          </div>
        </div>

        <div id="id03" class="w3-modal w3-center"  >
        <div class="w3-modal-content w3-animate-zoom w3-card-4 w3-round-small " style="max-width: 400px;margin: auto;">

            <form action="index.php" method="POST" enctype="multipart/form-data">
            <table border="1">
                <tbody>
                    <tr>
                        <td>image</td>
                        <td><input type="file" name="image" accept="image/*" /></td>
                    </tr>
                    <tr>
                        
                        <td><input type="submit" value="sumit" name="upload" /></td>
                    </tr>
                </tbody>
            </table>

        </form>
        </div>

        </div>
        <script>       <!-- script 4 Add image modal box -->
        // Get the modal
        var modal = document.getElementById('id03');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
        if (event.target == modal) {
        modal.style.display = "none";
        }
        }
        </script>
  </body>
</html>
