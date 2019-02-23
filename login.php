<?php include 'template/header.php'; ?>

<?php
    if($_SESSION['username']){
        header('Location: home.php');
        exit();
    }
?>
<?php
    $action = $_GET['action'];
    if($action){
        if($action === 'login'){
            $username = $_POST['username'];
            $password = $_POST['password'];

            $hashPassword = hash('SHA256', $password);

            $sql = "SELECT*FROM table_member
                        WHERE member_username = '$username'
                        AND member_password = '$hashPassword'";

            $query = $conn->query($sql);
            $result = $query->fetch();

            if($result){
                // print_r($result);
                
                $_SESSION['username'] = $result['member_username'];
                $_SESSION['user_id'] = $result['member_id'];
                echo "<script>alert('Sign in successfully')</script>";
                echo "<script>window.location = 'home.php'</script>";
            } else{
                echo "<script>alert('Invalid user name')</script>";
                echo "<script>window.history.back()</script>";
            }
            exit();
        }
    }
?>

<div class="container">
    <div style="width:350px; margin:0 auto;">
        <div class="nav justify-content-center">
            <h2>Login</h2>
        </div>

        <form action="login.php?action=login" method="post">

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" placeholder="Username" name="username" id="username" class="form-control">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" placeholder="Password" name="password" id="password" class="form-control">
            </div>

            <div class="nav justify-content-center">
                <input type="submit" class="btn alert-primary" value="Login">
            </div>
        </form>
    </div>    
</div>

<?php include 'template/footer.php'; ?>