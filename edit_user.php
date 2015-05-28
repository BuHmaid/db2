<?php

$page_title = 'Delete User';

include 'header.html';

echo '<h1>Edit User</h1>';
      
include "mysqli_connect.php";

$id=0;

if( isset($_GET['id']) )
{
    $id=$_GET['id'];  
}
elseif(isset($_POST['id']))
{
    $id=$_POST['id'];    
}
else
{
     echo '<p class="error"> Error has occured</p>';   
     
     include 'footer.html';
     
     exit();
}

  
if(isset($_POST['submitted']))
{
//declare variables and initialise
    $firstName = '';
    $lastName= '';
    $email = '';
    $password = '';
    
    $errors = array();
           
     if ( empty( $_POST['FName']) )
        $errors[] = 'You must enter first name';
     else
        $firstName = trim($_POST['FName']);
     
     if ( empty($_POST['LName']) )
        $errors[] = 'You must enter last name';
     else
        $lastName = trim($_POST['LName']);
        
     if ( empty($_POST['Email']) )
        $errors[] = 'You must enter email';
     else
        $email = trim($_POST['Email']);
  
     if ( empty($_POST['Password']) )
        $errors[] = 'You must enter password';
     else
        $password = trim($_POST['Password']);
     
    if(!empty($errors))
    {
        echo '<p class="error"> The following errors occurred: <br />';
        foreach($errors as $err)
        {
           echo "$err <br />";
         }
        echo '</p>';
    }
    else //update the user
    {
/****** TO DO ******/   
        
        //include 
   
/***  add code to edit the user using the User data object and display a confirmation message  ***/
    }
/*******************/
 } // end if submitted conditional
//always show form
 
 $db = new Database();
 $dbc = $db->getConnection();

   $q = "SELECT FName, LName, Email, Password from users where UserId = $id"; 
  
    $r = mysqli_query($dbc, $q);
    
    $row = mysqli_fetch_array($r);
  
    echo '<form action="edit_user.php" method="post">
        <br />
        <h3>Edit User: '.$row[0] . ' ' .$row[1]. '</h3>
        <p><br />
           <p>First Name    <input type="text" name="FName" value="'.$row[0] .'" /></p>
           <p>Last Name     <input type="text" name="LName" value="'.$row[1] .'"/></p>
           <p>Email Address <input type="text" name="Email" value="'.$row[2] .'"/></p>
           <p>Password <input type="password" name="Password" value="'.$row[3] .'"/></p>
        </p>
        <p><input type="submit" class ="DB4Button" name="submit" value="update" /></p>
        
         <input type ="hidden" name="submitted" value="TRUE">
         <input type ="hidden" name="id" value="' . $id . '"/>
         </form>';   

include 'footer.html';
?>
