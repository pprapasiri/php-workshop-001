<?php include 'template/header.php'; ?>

<?php
    $action = $_GET['action'];
    $boardId = $_GET['boardId'];
    $userId = $_SESSION['user_id'];
    if($action){
        if($action === 'comment'){
            $comment = $_POST['comment'];
            $sql = "INSERT INTO table_comment (
                                        comment_content,
                                        comment_board_id,
                                        comment_member_id
                                    ) VALUE (
                                        '$comment',
                                        '$boardId',
                                        '$userId'
                                    )";
            $result = $conn->exec($sql);
            if($result){
                echo "<script>alert('Comment success!')</script>";
                echo "<script>window.location = 'board.php?boardId=$boardId'</script>";
            }else{
                echo "<script>alert('Something went wrong!')</script>";
                echo "<script>window.history.back()</script>";
            }
            exit();
        }else if ($action === 'deleteComment'){
            $commentId = $_GET['commentId'];
            $boardId = $_GET['boardId'];

            $sql = "DELETE FROM table_comment WHERE comment_id = '$commentId'";
            $result = $conn->exec($sql);
                if($result) {
                    echo "<script>alert('Delete comment success!')</script>";
                    echo "<script>window.location = 'board.php?boardId=$boardId'</script>";
                } else {
                    echo "<script>alert('Something went wrong!')</script>";
                    echo "<script>window.history.back()</script>";
                }
            exit(); 
            
        }
                    
    }
?>

<?php
    $boardId = $_GET['boardId'];

    $sql    = "SELECT*FROM table_board WHERE board_id = '$boardId' ";
    $query  = $conn->query($sql);
    $result = $query->fetch(PDO::FETCH_ASSOC);

    $sqlComment = "SELECT*FROM table_comment WHERE comment_board_id = '$boardId' ";
    $queryComment = $conn->query($sqlComment);
    $resultsComment = $queryComment->fetchAll(PDO::FETCH_ASSOC);
    // print_r($resultsComment);
?>

<div class="container">
    <div class="nav justify-content-center">
        <h2>Board</h2>
    </div>
        <h2>ID : <?php echo $_GET['boardId'];?></h2>
        <h3><?php echo $result['board_topic'];?></h3>
        <p><?php echo $result['board_content'];?></p>
        <hr />
            <div class="wrap-comment">
                <?php foreach($resultsComment as $key => $comment): ?>
                        <div>Comment #<?php echo $key+1 ?></div>
                        <p><?php echo $comment['comment_content'] ?></p>
                    <?php if($_SESSION['user_id'] === $comment['comment_member_id']): ?>
                        <a href="#" onClick="deleteComment(<?php echo $comment['comment_id']; ?>, <?php echo $boardId ?>)">delete comment</a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <?php if($_SESSION['username']); ?>
        <hr>

        <div class = "wrap-comment">
            <form action="board.php?action=comment&boardId=<?php echo $result['board_id'];?>, <?php echo $boardId?>" method="post">
                <textarea class="form-control" name="comment" id="" cols="30" rows="5"></textarea>
        
                <div class="nav justify-content-center">
                    <input type="submit" class="btn alert-primary" value="Comment">
                </div>
            </form>
        </div>
        
</div>

<?php include 'template/footer.php'; ?>

<script>
    function deleteComment(commentId, boardId){
        const cf = confirm ('Are you sure to delete this comment?');
        if(cf == true){
            window.location = 'board.php?action=deleteComment&commentId=' + commentId + '&boardId=' + boardId;
        }
    }
</script>