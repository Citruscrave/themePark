<?php
session_start();

if(isset($_SESSION['id'])){
    $username = $_SESSION['username']; 
    $id = $_SESSION['id'];
    $roleId = $_SESSION['roleId'];
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
} else{
    header("Location: index.php");
}

require("themeparkSiteBuilder.php");
$siteBuilder = new themeParkSiteBuilder();

$siteBuilder->getOpenHtmlTags();

$siteBuilder->getGreyOverLay();

$siteBuilder->getMenu();


echo "<center class=\"info\">
            <h1>Welcome " . $first_name . ' ' . $last_name . "</h1>
                <p>Click one of the functional buttons to the left to get started</p>
        </center>";


$siteBuilder->getClosinghtmlTags();
?>

