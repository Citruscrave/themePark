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

$siteBuilder->getOpeningHtmlTags('Maintenance');

$siteBuilder->getGreyOverLay();

$siteBuilder->getMenu();
?>

<div class = "content">
        <a href="createMaintenance.php" class="add_ticket_button">
        <button class="add_maintenance">Create</button>
        <a href="maintenanceManage.php" class="add_ticket_button">
        <button class="mod_maintenance">Manage</button>
        </a>
        <center>
        <h1>
        Ride Maintenance
        </h1>
        </center> 
 </div>
<div class = "maintenanceMenu">
         <?php
           
            require_once('../db_connection.php');

            $query = "SELECT idMaintenance, user_created, date_created, ticket_description, ride
            FROM UmaLand.Maintenance WHERE user_closed IS NULL ";

            $response = @mysqli_query($dbc, $query);
            
            if($response)
            {
                echo '<table align = left"
                cellspacing="10" cellpadding = "8" class="report"
                <tr><td align = "left"><b> Active Tickets:</b></td></tr>
                <tr><td align = "left"><b>Ticket #</b></td>
                <td align="left"><b>Date_Created</b></td>
                <td align="left"><b>User_Created</b></td>
                <td align="left"><b>Ride ID</b></td>
                <td align="left"><b>Ticket_Description</b></td>';
                
                while($row = mysqli_fetch_array($response))
                {
                    echo '<tr><td align="left">'.
                    $row['idMaintenance'] . '</td><td align="left">' . 
                    $row['date_created'] . '</td><td align="left">' .
                    $row['user_created'] . '</td><td align="left">' . 
                    $row['ride'] . '</td><td align="left">' .
                    $row['ticket_description'] . '</td><td align="left">';              
                }
            }

            $query = "SELECT idMaintenance, user_created, date_created, user_closed,date_closed,
            ticket_description,closed_description, ride FROM UmaLand.Maintenance WHERE user_closed IS NOT NULL ";

            $response = @mysqli_query($dbc, $query);
            
            if($response)
            {
                echo
                '<tr><td align = "left"><b> Closed Tickets:</b></td></tr>
                <tr><td align = "left"><b>Ticket #</b></td>
                <td align="left"><b>Date_Created</b></td>
                <td align="left"><b>User_Created</b></td>
                <td align="left"><b>Ride ID</b></td>
                <td align="left"><b>Ticket_Description</b></td>
                <td align="left"><b>Date_Closed</b></td>
                <td align="left"><b>User_Closed</b></td>
                <td align="left"><b>Resolution</b></td>';
                
                while($row = mysqli_fetch_array($response))
                {
                    echo '<tr><td align="left">'.
                    $row['idMaintenance'] . '</td><td align="left">' . 
                    $row['date_created'] . '</td><td align="left">' .
                    $row['user_created'] . '</td><td align="left">' .
                    $row['ride'] . '</td><td align="left">' .
                    $row['ticket_description'] . '</td><td align="left">'.
                    $row['user_closed'] . '</td><td align="left">'.
                    $row['date_closed'] . '</td><td align="left">'.                          
                    $row['closed_description'] . '</td><td align="left">';              
                }
                  echo '</table>';  
             }
              mysqli_close($dbc);     
            ?>
    </div>

<?php
$siteBuilder->getClosinghtmlTags();
?>