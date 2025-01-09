<html>
<head>
    <title>Data Entry for the Staff table</title>

    <style>

 /* Styling for the page body */
 body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: silver;
        }

/* Styling for the header */
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
/* Form container styling */
        form {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%; 
        }

/* Table styling for the form layout */       
        table {
            margin: 0 auto;
            width: 100%;
        }

/* Input fields styling */     
        input[type="text"] {
            width: 100%; 
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

  /* Button container styling */      
        .button-container {
            text-align: center; 
        }

/* Submit and reset button styling */       
        input[type="submit"],
        input[type="reset"] {
            margin: 10px;
            padding: 8px 12px;
            border: none;
            background-color: #007bff;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }
/* Button hover effects */
        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #0056b3;
        }
    </style>

    </style>


</head>

<body>

<h2> Staff Data Entry Form </h2>

<!-- Instructions for entering staff data -->

<h3> Please enter the Staff's First name, Last name, and their role in the boxes provided below </h3>

<h3>Use these Links to traverse through our pages</h3>

<!-- Navigation links to other pages -->

 <a href="dataupdate.php">Data Update</a>
 <a href="searches.php">Data Search</a>
 

 
 <!-- Data Entry Form -->

<form action="DataEntry.php" method="post">

<label for="fname"> First name: </label>
<br> <input type= "text" id="fname" name="fname" value="" maxlength="" ></br>

<label for="lname"> Last name: </label>
<br> <input type= "text" id="lname" name="lname" value="" maxlength="" ></br>

<label for="role"> Staff Role: </label>
<br> <input type= "text" id="role" name="role" value="" maxlength="" ></br>


<td colspan="2" class="button-container">
<input type="submit" value="submit" name="submit">
<input type="reset" value="reset" name="reset">

</form>


<?php
// Database connection 
$db = [
    'DB_USER' => 'root',
    'DB_PASSWORD' => '',
    'DB_HOST' => 'localhost',
    'DB_NAME' => '40001xxxx'
];


$connection = new mysqli(

$db['DB_HOST'],
$db['DB_USER'],
$db['DB_PASSWORD'],
$db['DB_NAME'],
);


if($connection->connect_error){

die('Connection Failed: ' . $connection->connect_error);
}
else {
    echo " Database connected successfully!";
}
mysqli_select_db($connection,$db['DB_NAME']);

$fnameerr = "";
$lnameerr = "";
$staffroleerr = "";
$error = false;

//form submission
if($_SERVER["REQUEST_METHOD"] === "POST")
{

    // Cleaning input data

    $firstname = clean($_POST['fname']);
    $lastname = clean($_POST['lname']);
    $staffrole = clean($_POST['role']);
    

    //Validations
    if(empty($firstname))
    {
     $fnameerr = "Enter Data";
     $error = true;
    }
    elseif (!preg_match("/^[a-zA-Z ]*$/",$firstname))
    {
        $fnameerr = "Only letters are allowed for the first name ";
        $error = true;
    }
    


    if(empty($lastname))
    {
     $lastnameerr = "Enter last Data";
     $error = true;
    }
    elseif (!preg_match("/^[a-zA-Z ]*$/",$lastname))
    {
        $lnameerr = "Only letters are allowed for the last name ";
        $error = true;
    }
    


    
    if(empty($staffrole))
    {
     $staffroleerr = "Enter staff Data";
     $error = true;
    }
    elseif (!preg_match("/^[a-zA-Z ]*$/", $staffrole))
    {
        $staffroleerr = "Only letters are allowed for the staff role ";
        $error = true;
    }

   //error messages
 if($error)
 {
    if($fnameerr != "")
    {
     
       echo"<b>Error:\n</b>";
       echo "<br>" . $fnameerr;
    
    }
    

    if($lnameerr != "")
    {
     
       echo"<b>Error:\n</b>";
       echo "<br>" . $lnameerr;
    
    }

    if( $staffroleerr != "")
    {
     
       echo"<b>Error:</b>";
       echo "<br>" .  $staffroleerr;
    
    }
 }

 //queries

 else {

    $insertquery = "INSERT INTO staff (firstname,lastname,role) VALUES 
    ('$firstname','$lastname','$staffrole')";

    $queryresult = mysqli_query($connection,$insertquery);
     
    if($queryresult)
    {
        echo '<h4>New record added</h4>';
    }
    

 }
    

}
// Function to clean and sanitize input data

function clean($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>



</body>



</html>