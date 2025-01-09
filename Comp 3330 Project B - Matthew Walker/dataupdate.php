<html>
<head>
    <title>Updating Data for the Visit Table</title>

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



<h2> Visit Update Form </h2>

<!-- Instructions for entering staff data -->


<h3> Please enter the Visit ID OR the Pet name AND the medication that you want to modify </h3>

<h3>Use these Links to traverse through our pages</h3>

<!-- Navigation links to other pages -->

 <a href="searches.php">Data Search</a>
 <a href="DataEntry.php">Data Entry</a>

 <!-- Data Entry Form -->

<form action="dataupdate.php" method="post">

<label for="visitid"> Visit ID: </label>
<br> <input type= "number" id="visitid" name="visitid" value="" maxlength="" ></br>

<label for="medicationupdate"> Updated Medication: </label>
<br> <input type= "text" id="medicationupdate" name="medicationupdate" value="" maxlength="" ></br>

<label for="petname"> Pet Name: </label>
<br> <input type= "text" id="petname" name="petname" value="" maxlength="" ></br>


<div class="button-container">
<input type="submit" value="submit" name="submit">
<input type="reset" value="reset" name="reset">
</div>

</form>


<?php 
// Database connection 

$db= [
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
$mederror = "";
$peterror = "";
$error = false;
$botherror = "";


//form submission

if($_SERVER["REQUEST_METHOD"] === "POST"){

        // Cleaning input data

    $visitid = clean($_POST['visitid']);
    $medications = clean($_POST['medicationupdate']);
    $petname = clean($_POST['petname']);

    //Validations

    if (!preg_match("/^[0-9]*$/", $visitid)) {
            $iderror = "Only numbers are allowed for the visitID";
            $error = true;

    }

    if (!preg_match("/^[a-zA-Z ]*$/", $petname)) {
               $peterror = "Only Letters are allowed";
               $error = true;
   
       }


        if (empty($medications)) {
            $mederror = "Please enter the medication to be updated";
            $error = true;

             } elseif (!preg_match("/^[a-zA-Z ]*$/",$medications)) {

              $mederror = "Only Letters are allowed";
              $error = true;

    }

        if (empty($visitid) and empty($petname) )
        {
            $botherror = "Either Visit ID or Pet name must be entered";
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

            if($mederror != "")
            {
                echo"<b>Error:</b>";
                echo "<br>" . $mederror;
            
            }

            if($peterror != "")
            {
                echo"<b>Error:</b>";
                echo "<br>" . $peterror;
            
            }

            if($botherror != "")
            {
                echo"<b>Error:</b>";
                echo "<br>" . $botherror;
            
            }

    }

else{


                 //queries

            if (empty($petname)) {
                $insertquery = "UPDATE visit set medications = '$medications' WHERE visitid = $visitid";
                $queryresult = mysqli_query($connection,$insertquery);



                        if (mysqli_affected_rows($connection) > 0) {
                     
                            echo '<h4>Medication has been modified</h4>';

                        } else {
                            echo '<h4>No records found for the provided Visit ID.</h4>';
                    }
                }
            else
            {
                $insertquery = "UPDATE visit JOIN pet on visit.petid = pet.petid
                set visit.medications = '$medications'
                where pet.name = '$petname'
                ";
            $queryresult = mysqli_query($connection,$insertquery);

                    if (mysqli_affected_rows($connection) > 0) {
                    
                        echo '<h4>Medication has been modified.</h4>';
                    } else {
                        echo '<h4>No records found for the provided Pet Name.</h4>';
                    }

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



