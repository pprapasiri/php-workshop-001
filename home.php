<?php include 'template/header.php'; ?>
<?php
    $sql   = "SELECT*FROM table_board
            INNER JOIN table_member
            ON table_board.board_member_id = table_member.member_id";
    $query = $conn->query($sql);
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    // print_r($results);

?>

<div class="container">
    <div class="nav justify-content-center">
        <h2>Home page</h2>
    </div>
    
    <h3>
        Hello<?php echo $_SESSION['username'];?>
    </h3>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Topic</th>
                <th scope="col">Date</th>
                <th scope="col">Auther</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($results as $key => $value):?>
                <tr>
                    <th scope="row"><?php echo $key+1 ?></th>
                    <td>
                        <a href="board.php?boardId=<?php echo $value['board_id'];?>">
                            <?php echo $value['board_topic'];?>
                        </a>
                    </td>
                    <td>
                        <?php 
                            date_default_timezone_set("Asia/Bangkok");
                            $date = new DateTime ($value['board_date']);
                            echo $date->format('Y-m-d, D');
                        ?>
                    </td>
                    <td><?php echo $value['member_name']; ?></td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>

</div>

<?php include 'template/footer.php'; ?>