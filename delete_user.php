<?php
$page_title = 'Delete User';

include 'header.html';

echo '<h1>Delete User</h1>';
      
include "mysqli_connect.php";

$id=0;

//the first time the page is displayed it is because it is from a hyper link so we use $_GET to 
//retrieve the parameter from the link
//Any time the page is shown after that it is because it has been submitted using the form
//so we then use $_POST to get the form data
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
}

if(isset($_POST['submitted']))
{
 //test the value of the radio button       
    if(isset($_POST['sure']) && ($_POST['sure'] == 'Yes') ) //delete the record   
    {
/****** TO DO ******/
/***add code to delete the user using the User data object and display a confirmation message ****/      
        
        
/*******************/
    }//no confirmation
     else
       echo '<p> User deletion not confirmed</p>'; 
}
else //show form
{
    $db = new Database();
    $dbc = $db->getConnection();

    $q = "SELECT CONCAT(FName, ' ', LName) from users where UserId = $id"; 
    
  
    $r = mysqli_query($dbc, $q);
    
    $row = mysqli_fetch_array($r);
    
    echo '<form action="delete_user.php" method="post">
        <br />
        <h3>Name: '.$row[0] . '</h3>
        <p>Delete this user? <br/><br/>
          <input type="radio" name="sure" value="Yes" /> Yes
          <input type="radio" name="sure" value="No" checked="checked" /> No
        </p>
        <p><input type="submit" class ="DB4Button" name="submit" value="Delete" /></p>
        
         <input type ="hidden" name="submitted" value="TRUE">
         <input type ="hidden" name="id" value="' . $id . '"/>
         </form>';   

}

include 'footer.html';
?>
