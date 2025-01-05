<?php
require_once 'db_conn.php';

// Fetch data from the transactions table
$query = "SELECT p.paymentID, c.categoryID, t.transactionID, t.amount, t.date, c.category, p.paymentMethod
          FROM transactions t
          JOIN categories c ON t.categoryID = c.categoryID
          JOIN payments p ON t.paymentID = p.paymentID";
$result = $conn->query($query);

// Fetch the data into an associative array
$data = $result->fetchAll(PDO::FETCH_ASSOC);

// Close the database connection
$conn = null;
?>
<!-- Embed the data as a JSON string in a hidden element -->
<div id="transactionsData" style="display: none;"><?php echo json_encode($data); ?></div>