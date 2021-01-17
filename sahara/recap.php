<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css">

        <title>Trip Recap</title>
    </head>
<body>

    <?php


            if(!empty($_POST['name'])) //if something is written, we print the name, else nothing
            {
               echo '<p> Your name is '.htmlspecialchars($_POST['name']); //we print

            }
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) //if the email is validate, a good email, 
            {
                if(!empty($_POST['email'])) //if something is written, we prin the email, else nothing
                {
                   echo '<p> Your email is '.htmlspecialchars($_POST['email']);
                }

            }
            else
            {
                echo '<br/><br/><br/> <u>UNKNOW EMAIL</u>';
            }
            if(!empty($_POST['adults'])) //post = store details from forum
            {
               echo '<p> You are '.htmlspecialchars($_POST['adults']). 'persons';
            }
            if(!empty($_POST['date-from']) && ($_POST['date-to'])) //get = store details from guests
            {
               echo '<p> Your want to travel from '.htmlspecialchars($_POST['date-from']). 'to' .htmlspecialchars($_POST['date-to']);

            }

            if(!empty($_POST['country'])) //post = store details from forum
            {
               echo '<p> Your country is '.htmlspecialchars($_POST['country']);
            }
            
            
            if(!empty($_POST['messagespecial-requirements'])) //post = store details from forum
            {
               echo '<p> Your message is : '.htmlspecialchars($_POST['special-requirements']);
            }


            $email = $_POST["email"];
            $name = $_POST["name"];
            $country = $_POST["country"];
            $nbPersons = $_POST["adults"];
            $date = $_POST["date-from"];

//--------------------------------HERE YOU HAVE TO CHANGE WITH YOUR VALUES -----------------------------//
            // Insert new user into database
            
               $sql = "INSERT INTO book ('name', email, country, nbPersons, 'date') VALUES (?, ?, ?, ?, ?);";
            
               $stmt = mysqli_stmt_init($conn);//Initializes a statement and returns an object for use with mysqli_stmt_prepare 
               if (!mysqli_stmt_prepare($stmt, $sql)) {  // Prepare an SQL statement for execution
                  header("location: ../signup.php?error=stmtfailed");
                  exit();
               }
            
               mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $country, $nbPersons, $date);//Binds variables to a prepared statement as parameters
               mysqli_stmt_execute($stmt);//Executes a prepared Query
               mysqli_stmt_close($stmt);//Closes a prepared statement
               mysqli_close($conn);//Closes the function
               header("location: ../signup.php?error=none");
               exit();
            
               if (isset($_GET["error"])) { //We two tests to be sure that the informations are valid and everything is check grom the url
                  if ($_GET["error"] == "stmtfailed") {  //An error occured
                  echo "<p>Something went wrong!</p>";
                  }
                  
                  else if ($_GET["error"] == "none") { //else everithyng is good so your trip is booked
                  echo "<p>Your trip is booked !!</p>";
                  }
               }
           ?>
      ?>
           
</body>
</html>
