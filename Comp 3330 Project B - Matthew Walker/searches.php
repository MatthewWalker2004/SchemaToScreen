<html>
<head>
    <title>Pet Searching</title>

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

       /* Styling for headers */
        h2, h3 {
            text-align: center;
            margin-bottom: 10px;
        }

       /* Form container styling */
        form {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%; 
            display: flex;
            flex-direction: column;
            align-items: center; 
        }

          /* Form label styling */
        label {
            font-weight: bold;
            margin-top: 10px;
        }

        /* Input fields styling */     
        input[type="number"],
        input[type="text"] {
            width: 100%; 
            padding: 8px;
            margin: 5px 0 15px; 
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        /* Button container styling */      
        .button-container {
            text-align: center; 
            margin-top: 10px;
        }

        /* Submit and reset button styling */       
        input[type="submit"],
        input[type="reset"] {
            padding: 10px 15px;
            border: none;
            background-color: #007bff;
            color: white;
            border-radius: 4px;
            cursor: pointer;
            margin: 5px;
        }

        /* Button hover effects */

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #0056b3;
        }

</style>    
  
</head>

<body>

<h2> Pet Search </h2>

<!-- Instructions for entering staff data -->

<h3> Please enter either the owner's ID OR Pet name in the boxes provided below </h3>

<h3>Use these Links to traverse through our pages</h3>

<!-- Navigation links to other pages -->

 <a href="dataupdate.php">Data Update</a>
 <a href="DataEntry.php">Data Entry</a>

  <!-- Data Entry Form -->

<form action="searches.php" method="post">

<label for="ownerid"> Owner ID: </label>
<br> <input type= "number" id="ownerid" name="ownerid" value="" maxlength="" ></br>

<label for="name"> Pet Name: </label>
<br> <input type= "text" id="name" name="name" value="" maxlength="" ></br>

<input type="submit" value="submit" name="submit">

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



$iderror = "";
$nameerror = "";
$botherror ="";
$error = false;

//form submission

if($_SERVER["REQUEST_METHOD"] === "POST")
{

    // Cleaning input data
    $ownerid = clean($_POST['ownerid']);
    $petname = clean($_POST['name']);
     
    
   

//Validations
    if (!preg_match("/^[0-9]*$/", $ownerid)) {
        $iderror = "Only numbers are allowed for the visitID";
        $error = true;
    }

    if (!preg_match("/^[a-zA-Z ]*$/",$petname)) {

        $nameerror = "Only Letters are allowed";
        $error = true;
    }


    if(empty($ownerid) and empty($petname))
    {
       $botherror = "Either owner id or pet name must be entered";
       $error = true;
    }

//error messages

 if($error)
{

        if($iderror != "")
     {
 
   echo"<b>Error:</b>";
   echo "<br>" . $iderror;

     }

     if($nameerror != "")
     {
    echo"<b>Error:</b>";
    echo "<br>" . $nameerror;
 
     }

     if($botherror != "")
     {
    echo"<b>Error:</b>";
    echo "<br>" . $botherror;
 
     }


    }


                 //queries
    if (empty($ownerid)) {

       $Query = "SELECT name, species, breed,dateofbirth  FROM pet where name = '$petname'"; 
        $result = mysqli_query ($connection, $Query); 
        

        if (mysqli_num_rows($result) > 0) {

        echo "<table border='1'>
        <tr>
        <th>Name</th>
        <th>Species</th>
        <th>Breed</th>
        <th>date of birth</th>
        </tr>";                                                                  
        

        while($row = mysqli_fetch_array($result)) {
       printf(
        "<tr>
            <td>%s</td>
            <td>%s</td>
            <td>%s</td>
            <td>%s</td>
        </tr>",
        $row['name'],
        $row['species'],
        $row['breed'],
        $row['dateofbirth']
    );
}
        echo "</table>";
}

else {
    echo "<h4>Wrong pet name entered.</h4>";
}
        mysqli_free_result ($result); 
        mysqli_close($connection);


    }

    else{

        $Query = "SELECT owner.firstname,owner.lastname, pet.name, pet.species, pet.breed,pet.dateofbirth  FROM pet JOIN owner on owner.ownerid = pet.ownerid where owner.ownerid = $ownerid"; 
        $result = mysqli_query ($connection, $Query); 

       
    
        

        if (mysqli_num_rows($result) > 0) {
    echo "<table border='1'>
    <tr>
    <th>Owner first name</th>
    <th>Owner last name</th>
    <th>Pet name</th>
    <th>species</th>
    <th>breed</th>
    <th>date of birth</th>
    </tr>";                                                                
    
   
   


    while($row = mysqli_fetch_array($result)) {


        
         printf(
    "<tr>
        <td>%s</td>
        <td>%s</td>
        <td>%s</td>
        <td>%s</td>
        <td>%s</td>
        <td>%s</td>
    </tr>",
    $row['firstname'],
    $row['lastname'],
    $row['name'],
    $row['species'],
    $row['breed'],
    $row['dateofbirth']
);
    }
    echo "</table>";
}
else {
    echo "<h4>Wrong ID entered or no matching records found.</h4>";
}
    mysqli_free_result ($result); 
    mysqli_close($connection);

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

