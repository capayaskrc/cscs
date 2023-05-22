<?php require_once('config.php'); ?>

<?php
// Assuming you have a database connection established

// Check the user type
if ($_settings->userdata('type') == 3) {
    // Query for user type 3 (specific user)
    $query = "SELECT date_created AS date, SUM(amount) AS amount FROM sale_list WHERE user_id = '{$_settings->userdata('id')}' AND date_created >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) GROUP BY date_created";
} else {
    // Query for other user types
    $query = "SELECT date_created AS date, SUM(amount) AS amount FROM sale_list WHERE date_created >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) GROUP BY date_created";
}

$result = $conn->query($query);

// Array to store the daily income data
$incomeData = array();

// Fetching the data from the result set
while ($row = $result->fetch_assoc()) {
    $incomeData[] = $row;
}

// Closing the database connection
$conn->close();

// Sending the response as JSON
header('Content-Type: application/json');
echo json_encode($incomeData);
?>
