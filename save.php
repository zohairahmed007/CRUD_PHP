<?php
$con = mysqli_connect("localhost", "root", "", "web_app");

if (isset($_POST["btn_save"])) {
    if ($con == false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    } else {
        $name = $_POST['name'];
        $class = $_POST['class'];

        $qry_insert = "insert into std_info (std_name,std_class) values ('$name','$class')";

        $qry_run = mysqli_query($con, $qry_insert);
        if ($qry_run) {
            echo "Save Records";
            //header("Location: index.html");
        } else {
            echo "Error Occured ";
        }
    }
} else if (isset($_POST["btn_show"])) {

    if ($con == true) {

        $qry_show = "select * from std_info";

        $qry_run = mysqli_query($con, $qry_show);
        if (mysqli_num_rows($qry_run)) {
            $rows = mysqli_fetch_array($qry_run);
            //print_r($rows);
            while ($row = mysqli_fetch_array($qry_run)) {
                echo $row['std_id'];
                echo $row['std_name'];
                echo $row['std_class'];
            }
        } else {
            echo "Error Occured ";
        }

    }

} else if (isset($_POST["btn_delete"])) {


    if ($con == true) {

        $qry_delete = "delete from std_info where std_id=" . $_POST['del_id'];

        $qry_run = mysqli_query($con, $qry_delete);
        if ($qry_run) {

            header("Location: index.php");
        } else {
            echo "Error Occured ";
        }
    }
} else if (isset($_POST["btn_update"])) {


    if ($con == true) {

        $name = $_POST['name'];
        $class = $_POST['class'];
        $edit_id = $_POST['edit_id'];

        $qry_update = "update std_info set std_name='$name' , std_class='$class' where std_id = $edit_id";

        $qry_run = mysqli_query($con, $qry_update);
        if ($qry_run) {

            header("Location: index.php");
        } else {
            echo "Error Occured ";
        }

    }
}

?>