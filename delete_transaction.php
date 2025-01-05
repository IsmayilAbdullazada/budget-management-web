<?php
require_once 'db_conn.php';

try {
    // Use prepared statements to prevent SQL injection
    $query = "DELETE FROM transactions WHERE transactionID = :transactionID";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':transactionID', $_POST['transactionID']);
    $stmt->execute();

    // Send a success message
    echo "Deleted Successfully";
} catch(Exception $e) {
    // Handle the case where the request is not POST or implement additional logic as needed
    $e->getMessage();
    echo 'Invalid request';
}
