<?php
include 'header.html';
?>


<?php
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);

//print_r($_POST);
?>

<h1>User Registration</h1>
<form action="register.php" method="post">
    <fieldset>
        <p><b>Enter First Name</b>
            <input type="text" name="FName" size="20" value="" />
        <p><b>Enter Last Name</b>
            <input type="text" name="LName" size="20" value="" />
        <p><b>Enter Email</b>
            <input type="email" name="Email" size="50" value="" />
        <p><b>Enter Password</b>
            <input type="password" name="Password" size="10" value="" />
        <div align="center">
            <input type ="submit" class ="DB4Button" value ="Register" />
        </div>  
        <input type="hidden" name="submitted" value="1" />
    </fieldset>
</form>    

<?php
if (isset($_POST['submitted'])) {
    $firstName = '';
    $lastName = '';
    $email = '';
    $password = '';

    $errors = array();

    if (empty($_POST['FName']))
        $errors[] = 'You must enter first name';
    else
        $firstName = trim($_POST['FName']);

    if (empty($_POST['LName']))
        $errors[] = 'You must enter last name';
    else
        $lastName = trim($_POST['LName']);

    if (empty($_POST['Email']))
        $errors[] = 'You must enter email';
    else
        $email = trim($_POST['Email']);

    if (empty($_POST['Password']))
        $errors[] = 'You must enter password';
    else
        $password = trim($_POST['Password']);

    if (empty($errors)) {
        /*         * *** TO DO *** */

        /*         * * Add code to create and populate a new user data object.
         *   Call the validation method of the object - if it is valid save it to the database and display a confirmation 
         *   message
         */

        include 'DO_User.php';

        $user = new DO_User();


        $user->firstName = $_POST['FName'];
        $user->lastName = $_POST['LName'];
        $user->password = $_POST['Email'];
        $user->email = $_POST['Password'];

        if ($user->Save())
            echo "<h1> Thankyou </h1><p>$user->firstName $user->lastName you are now registered</p>";
        else {
            echo '<p class="error"> Oh dear. There was an error</p>';
            echo '<p class = "error">' . mysqli_error($user->dbc) . '</p>';
        }



        /*         * ******** END TO DO*********** */
    }//if no errors
    else {
        echo '<p class="error"> Error </p>';

        foreach ($errors as $msg)
            echo " - $msg<br /> ";
    }
}// if submitted   
include 'footer.html';
?>