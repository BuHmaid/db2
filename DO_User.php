<?php
// I am Ansari
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Do_User
 *
 * @author 201101299
 */
include "mysqli_connect.php";

class DO_User extends Database {

    private $tableName = 'User';
    //attributes to reperesent table columns
    public $userId = 0;
    public $firstName;
    public $lastName;
    public $email;
    public $regDate;
    public $password;
    //variable to  store validateion errors
    public $errorMsg;

    public function DO_User() {

        $this->getConnection();
    }

    public function get($userId) {

        if ($this->getConnection()) {

            $q = "SELECT * FROM users WHERE UserId = $userId";
            $r = mysqli_query($this->dbc, $q);

            if ($r) {
                $row = mysqli_fetch_array($r);

                $this->userId = $row['UserId'];
                $this->firstName = $row['FName'];
                $this->lastName = $row['LName'];
                $this->email = $row['Email'];
                $this->regdate = $row['RegDate'];
                $this->password = $row['Password'];
                return true;
            } else {
                $this->displayError($q);
            }
        } else {
            echo '<p clas="error"> Could not connect to database</p>';
            return false;
        }
    }

    private function displayError($q) {
        echo '<p class="error"> ' . $q . '</p>';
        echo '<p class="error">A Database error occurred</p> ';
        echo '<p class="error"> ' . mysqli_error($this->dbc) . '</p>';
    }

    public function Save() {


        if ($this->getConnection()) {


            //$this->userId = mysqli_real_escape_string($this->dbc, $this->userId);
            $this->firstName = mysqli_real_escape_string($this->dbc, $this->firstName);
            $this->lastName = mysqli_real_escape_string($this->dbc, $this->lastName);
            $this->email = mysqli_real_escape_string($this->dbc, $this->email);
            $this->password = mysqli_real_escape_string($this->dbc, $this->password);

            if ($this->userId == null) {
                $q = "INSERT INTO users (FName,LName,Email,RegDate,Password)"
                        . " VALUES( '$this->firstName', '$this->lastName','$this->email' , NOW() ,'$this->password')";
               
            } else {
              
                $q = "update users set FName='$this->firstName' , "
                        . "LName='$this->lastName', Email='$this->email',"
                        . " Password='$this->password' where UserId = '$this->userId'";
            }


            $r = mysqli_query($this->dbc, $q);
             echo "debuggin1";

            if (!$r) {
                $this->displayError($q);
                 echo "debuggin2";
                return false;
            } 
            return true;
            
        } else {
            echo '<p clas="error"> Could not connect to database</p>';
            return false;
        }
    }

}
