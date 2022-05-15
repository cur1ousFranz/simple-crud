<?php 
include("includes.php"); // CDN LINK OF BOOTSTRAP 5

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <!-- REGISTER FORM -->
    <div class="container w-50 border  mt-5">
        <h1 class="text-center mt-2">Register</h1>
        <div class="container mt-4">
            <form action="" method="post">
                <input type="text" class="form-control rounded-pill" placeholder="Firstname" name="firstname" required>
                <input type="text" class="form-control rounded-pill mt-3" placeholder="Lastname" name="lastname" required>
                <input type="text" class="form-control rounded-pill mt-3" placeholder="Username" name="username" required>
                <input type="password" class="form-control mt-3 rounded-pill" placeholder="Password" name="pass" required>
                <input type="password" class="form-control mt-3 rounded-pill" placeholder="Confirm password" name="confirmpass" required>
                <button class="btn btn-primary form-control mt-3 mb-4 rounded-pill">Register</button>
            </form>
        </div>
        <div class="container text-center">
        <p><a href="login.php">Login instead?</a></p>
        </div>
    </div>

    <?php 
       
       $stmt = $pdo->prepare("INSERT INTO users (firstname, lastname, username, pass)
       VALUES (:firstname, :lastname, :username, :pass)");

       $stmt->bindParam(':firstname', $firstname);
       $stmt->bindParam(':lastname', $lastname);
       $stmt->bindParam(':username', $username);
       $stmt->bindParam(':pass', $pass);

       $query = "SELECT username FROM users";
       $d = $pdo->query($query);

        // VERIFY FOR EMPTY FIELD
       if(!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['username']) && !empty($_POST['pass'])){

        // VERIFY IF THE PASWORD MATCHED TO CONFIMATION PASSWORD
        if($_POST['pass'] == $_POST['confirmpass']){
            // MAKE CONDITION IF THERE ARE ROWS FETCHED
            if($d->rowCount() > 0){

                $isExist = false;

                // LOOPING FROM FETCHED USERNAMES IF EXIST
                    foreach($d as $data){
                        if($data['username'] == $_POST['username']){
                            echo "Username already exist!";
                            $isExist = true;
                            break;
                        }
                    }
                    // EXECUTE THE INSERTION IF THE USERNAME IS VALID
                    if($isExist == false){
                        $firstname = $_POST['firstname'];
                        $lastname = $_POST['lastname'];
                        $username = $_POST['username'];
                        $pass = $_POST['pass'];
                
                        $stmt->execute();
                        echo "Registered Successful"; 
                    }
            // EXECUTE THE INSERTION IF THERE NO USERNAMES YET IN DATABASE
            }else {
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $username = $_POST['username'];
                $pass = $_POST['pass'];
        
                $stmt->execute();  
            }
        }else{
            echo "Password does not match!";
        }
        
      }

    ?>

</body>
</html>