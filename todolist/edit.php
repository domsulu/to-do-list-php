<?php
    include 'database.php';

    // proses show data
    $q_select = "SELECT * FROM task WHERE taskid = '".$_GET['id']."' ";
    $run_q_select = mysqli_query($conn, $q_select);
    $d = mysqli_fetch_object($run_q_select);

    // proses edit data
    if( isset($_POST['edit']) ) {
        $q_update = "UPDATE task SET tasklabel = '".$_POST['task']."' WHERE taskid = '".$_GET['id']."' ";
        $run_q_update = mysqli_query($conn, $q_update);

        header('Refresh: 0; index.php');
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
    <link rel="stylesheet" href="./style/style2.css">

</head>

<body>
    <div class="container">

        <div class="header">

            <div class="title">

                <a href="index.php"><i class='bx bx-chevron-left' ></i></a>

                <span>Back</span>

            </div>

            <div class="description">

                <?=date("l, d M Y") ?>

            </div>

        </div>

        <div class="content">

            <div class="card">

                <form action="" method="POST">

                    <input type="text" class="input-control" placeholder="Edit" name="task" value="<?= $d->tasklabel ?>">

                    <div class="text-right">

                        <button type="submit" name="edit">Edit</button>

                    </div>

                </form>
                
            </div>

            
        </div>
    </div>
</body>

</html>