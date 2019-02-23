<?php include 'template/header.php'; ?>

<?php
    if(!$_SESSION['username']){
        header("Location: login.php");
        exit();
    }
?>

<?php
    $action = $_GET['action'];
    $boardId = $_GET['boardId'];

    if ($action) {
        if ($action === 'edit') {
            $topic = $_POST['topic'];
            $content = $_POST['content'];
            $sql = "UPDATE table_board 
                    SET board_topic='$topic' , board_content='$content'
                    WHERE board_id='$boardId'";

            $result = $conn->exec($sql);

            if($result){
                echo "<script>alert('Solved Successfully!')</script>";
                echo "<script>window.location = 'myBoard.php'</script>";

            }else{
                echo "<script>alert('Something went wrong!')</script>";
                echo "<script>window.history.back()</script>";
            }
            exit();
        }
    }
?>

<?php
    $boardId = $_GET['boardId'];
    
    $sql = "SELECT * FROM table_board WHERE board_id = '$boardId'";
    $query = $conn->query($sql);
    $result = $query->fetch(PDO::FETCH_ASSOC);
?>

<div class="container">
    <div class="nav justify-content-center">
        <h2>Edit board</h2>
    </div>

    <form action="editBoard.php?action=edit&boardId=<?php echo $boardId ?>" method="post">
        <div class="form-group">
            <label for="topic">Topic</label>
            <input type="text" name="topic" id="topic" value="<?php echo $result['board_topic'] ?>" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control" name="content" id="content" cols="30" rows="10">
                <?php echo $result['board_content']; ?>
            </textarea>
        </div>

        <div class="nav justify-content-center">
            <input type="submit" class="btn alert-primary" value="Edit">
        </div>
    </form>
</div>

<?php include 'template/footer.php'; ?>
