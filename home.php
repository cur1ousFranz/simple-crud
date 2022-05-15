<?php 
    session_start();
    include('nav.php');

    if(isset($_SESSION['User'])){

    }else{
        header("Location: login.php");
    }

    function getUserData($username){
        $array = array();
        $query = "SELECT * FROM users WHERE username='$username'";
        $d = $GLOBALS['pdo']->query($query);

        foreach($d as $data){
            $array['id'] = $data['id'];
            $array['firstname'] = $data['firstname'];
            $array['lastname'] = $data['lastname'];
            $array['username'] = $data['username'];
            $array['pass'] = $data['pass'];

        }
        return $array;
    }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>
<body>

    <div class="container border mt-5">

        <?php 

            $userSession = $_SESSION['User'];
            $userData = getUserData($userSession);
        
        ?>
         <input class="form-control mt-3" type="text" placeholder=" <?php echo $userData['id']; ?>" readonly>
         <input class="form-control mt-3" type="text" placeholder="FIRSTNAME: <?php echo $userData['firstname']; ?>" readonly>
         <input class="form-control mt-3" type="text" placeholder="LASTNAME: <?php echo $userData['lastname']; ?>" readonly>
         <input class="form-control mt-3" type="text" placeholder="USERNAME: <?php echo $userData['username']; ?>" readonly>
         <input class="form-control mt-3 mb-3" type="text" placeholder="PASSWORD: <?php echo $userData['pass']; ?>" readonly>
    </div>

</body>
</html>

