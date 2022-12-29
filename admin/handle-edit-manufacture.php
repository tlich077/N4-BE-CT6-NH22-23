
<?php
session_start();
require "config.php";
require "models/db.php";
require "models/manufacture.php";
$manufactures = new Manufacture();
$getAllManus = $manufactures->getAllManus();
$manu_name = $_POST['manu_name'];
if (isset($_SESSION["getID"])) {
    $manu_id = $_SESSION["getID"];
    $edit = $manufactures->editManu($manu_name, $manu_id);
}
header('location:manufacture.php');


