<?php
    include 'database.php';

    // proses insert data
    if( isset($_POST['add']) ) {
        $q_insert = "INSERT INTO task (tasklabel, taskstatus) value (
                        '".$_POST['task']."',
                        'open'
                    )"; 
        $run_q_insert = mysqli_query($conn, $q_insert);

        if( $run_q_insert ) {
            header('Refresh:0; url=index.php');
        }

    }

    // proses show data
    $q_select = "SELECT * FROM task ORDER BY taskid DESC";
    $run_q_select = mysqli_query($conn, $q_select);

    // proses delete
    if ( isset($_GET['delete']) ) {

        $get = $_GET['delete'];
        $q_delete = "DELETE FROM task WHERE taskid = $get";
        $run_q_delete = mysqli_query($conn, $q_delete);

        header('Refresh:0; url=index.php');

    }

    // proses update data (close atau open)
    if( isset($_GET['done']) ) {

        $status = 'close';

        if ( $_GET['status'] == 'open' ) {
            $status = 'close';
        } else {
            $status = 'open';
        }

        $q_update = "UPDATE task SET taskstatus = '$status' WHERE taskid = '".$_GET['done']."' ";
        $run_q_update = mysqli_query($conn, $q_update);

        header('Refresh:0; url=index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./style/style.css">

</head>

<body>
    <div class="container">

        <div class="header">

            <div class="title">

                <i class='bx bx-sun' ></i>

                <span>To Do List</span>

            </div>

            <div class="description">

                <?=date("l, d M Y") ?>

            </div>

        </div>

        <div class="content">

            <div class="card">

                <form action="" method="POST">

                    <input type="text" class="input-control" placeholder="Tambahkan Tugas" name="task">

                    <div class="text-right">

                        <button type="submit" name="add">add</button>

                    </div>

                </form>
                
            </div>

            <?php if ( mysqli_num_rows($run_q_select) > 0 ) {?>

                <?php while ($r = mysqli_fetch_array($run_q_select)) { ?>

                    <div class="card">

                        <div class="task-item <?= ($r['taskstatus'] == 'close') ? 'done' : '' ?>">

                            <div>
                                <input type="checkbox" onclick="window.location.href = '?done=<?= $r['taskid'] ?>&status=<?= $r['taskstatus'] ?>' " <?= ($r['taskstatus'] == 'close') ? 'checked' : '' ?> >
                                <span><?= $r['tasklabel'] ?></span>
                            </div>

                            <div>
                                <a href="edit.php?id=<?= $r['taskid'] ?>"><i class="bx bx-edit" title="Edit"></i></a>
                                <a href="index.php?delete=<?= $r['taskid']  ?>"><i class="bx bx-trash" onclick="return confirm('Are you sure ?')" title="Remove"></i></a>
                            </div>

                        </div>

                    </div>

            <?php }} else { ?>
                
                <div>
                    Task belum ada
                </div>

            <?php } ?>
        </div>
    </div>
</body>

</html>