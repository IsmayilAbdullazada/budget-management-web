<?php
require_once 'db_conn.php';

try {
    // Use prepared statements to prevent SQL injection
    $query = "UPDATE transactions SET amount = :amount, date = :date, categoryID = :categoryID, paymentID = :paymentID WHERE transactionID = :transactionID";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':amount', $_POST['amount']);
    $stmt->bindParam(':date', $_POST['date']);
    $stmt->bindParam(':categoryID', $_POST['categoryID']);
    $stmt->bindParam(':paymentID', $_POST['paymentID']);
    $stmt->bindParam(':transactionID', $_POST['transactionID']);
    $stmt->execute();

    // // Redirect back to view-transactions.php after the update
    // header('Location: view-transactions.php');
    // exit();
    echo "Updated Successfully";
} catch(Exception $e) {
    // Handle the case where the request is not POST, or implement additional logic as needed
    $e->getMessage();
    echo 'Invalid request';
}
