<?php
require_once 'db_conn.php';

// Get data from the POST request
$amount = $_POST['amount'];
$date = $_POST['date'];
$categoryID = $_POST['categoryID'];
$paymentID = $_POST['paymentID'];
$accountingID = $_POST['accountingID'];

try {
    // Prepare the SQL statement
    $sql = "INSERT INTO transactions (amount, date, paymentID, categoryID, accountingID) VALUES (:amount, :date, :paymentID, :categoryID, :accountingID)";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':amount', $amount);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':categoryID', $categoryID);
    $stmt->bindParam(':paymentID', $paymentID);
    $stmt->bindParam(':accountingID', $accountingID);

    // Execute the statement
    $stmt->execute();

    // Send success response
    echo "Transaction added successfully";
} catch (PDOException $e) {
    // Send error response
    echo "Error: " . $e->getMessage();
}

// Close the connection
$conn = null;
?>