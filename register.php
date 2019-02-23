<?php include 'template/header.php'; ?>

<?php
    if($_SESSION['username']){
        header("Location: home.php");
        exit();
    }
?>

<?php
    $actinon  = $_GET['action'];

    if($actinon) {
        if($actinon === 'register') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $name     = $_POST['name'];
            $lastname = $_POST['lastname'];
            $email    = $_POST['email'];
            $gender   = $_POST['gender'];

            $hashPassword = hash('SHA256',$password);
            
            $sql = "INSERT INTO table_member (
                                        member_username,
                                        member_password,
                                        member_role,
                                        member_name,
                                        member_lastName,
                                        member_email,
                                        member_gender
                                    ) VALUES (
                                        '$username',
                                        '$hashPassword',
                                        '0',
                                        '$name',
                                        '$lastname',
                                        '$email',
                                        '$gender'
                                    )";
            $result = $conn->exec($sql);

            if($result) {
                echo "<script>alert('Register successfully!')</script>";
                echo "<script>window.location = 'login.php'</script>";
            } else {
                echo "<script>alert('Failed to register!')</script>";
                echo "<script>window.history.back()</script>";
            }
        }
    }
    
    
?>

<div class="container"> 
    <form action="register.php?action=register" method="post">

        <div class="nav justify-content-center">
        <h2>Register</h2>
        </div>

        <div>
            <label for="username">Username</label>
            <input type="text" placeholder="Username" name="username" id="username" class="form-control">
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" placeholder="Password" name="password" id="password" class="form-control">
        </div>

        <div>  
            <label for="name">FirstName</label>  
            <input type="text" placeholder="FirstName" name="name" id="name" class="form-control">
        </div>

        <div>
            <label for="lastname">LastName</label>
            <input type="text" placeholder="LastName" name="lastname" id="lastname" class="form-control">
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" placeholder="Email" name="email" id="email" class="form-control">
        </div>

        <div class="form-check">
            <input type="radio" name="gender" value="M" id="m" class="form-check-input">
            <label for="m" class="form-check-label">M</label>
        </div> 

        <div class="form-check">   
            <input type="radio" name="gender" value="F" id="f" class="form-check-input">
            <label for="f" class="form-check-label">F</label>
        </div>

        <div class="nav justify-content-center">
        <input type="submit" class="btn alert-primary" value="Register">
        </div>

    </form>
</div>

<?php include 'template/footer.php'; ?>