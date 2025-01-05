<!DOCTYPE html>
<html lang="en">
<?php include 'head.php'; ?>
<body>
  <?php include 'navbar.php'; ?>
  <main class="container mt-4">
    <!-- View Transactions Page -->
    <section id="view-transactions" class="desktop-only">
      <h2 class="mb-3">View Transactions</h2>
      <table id="transactionsTable" class="display">
        <!-- DataTable content will be loaded here -->
      </table>
    </section>
  </main>

  <!-- Include jQuery and DataTables JS -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

  <!-- Initialize DataTable on the client side -->
  <script>
    var dataTable;
    $(document).ready(function () {
      // Retrieve embedded data
      var transactionsData = JSON.parse($('#transactionsData').text());

      // Initialize DataTable with embedded data
      dataTable = $('#transactionsTable').DataTable({
        data: transactionsData,
        columns: [
          {title:'Transaction No', data: 'transactionID' },
          {title:'Amount', data: 'amount' },
          { 
            title: 'Date',
            data: 'date',
            render: function (data) {
              // Format the date to dd/mm/yyyy
              var date = new Date(data);
              var day = date.getDate().toString().padStart(2, '0');
              var month = (date.getMonth() + 1).toString().padStart(2, '0');
              var year = date.getFullYear();
              return day + '/' + month + '/' + year;
            }
          },
          { title: 'Category', data: 'category' },
        { title: 'Payment Method', data: 'paymentMethod' },
        {
          data: null,
          render: function (data) {
              return '<button class="btn btn-warning btn-edit" data-id="' + data.transactionID + '">Edit</button>';
            }
        },
        {
          data: null,
          render: function (data) {
              return '<button class="btn btn-danger btn-delete" data-id="' + data.transactionID + '">Delete</button>';
            }
        }
          // Add more columns as needed based on your table structure
        ]
      });

      $('#transactionsTable tbody').on('click', 'button.btn-edit', function () {
        var transactionID = $(this).data('id');
        // Redirect to transaction entry page with the row values to edit
        window.location.href = 'transaction-entry.php?edit=true&transactionID=' + transactionID;
      });

     $('#transactionsTable tbody').on('click', 'button.btn-edit', function () {
        var transactionID = $(this).data('id');
        // Redirect to transaction entry page with the row values to edit
        window.location.href = 'transaction-entry.php?edit=true&transactionID=' + transactionID;
      });

      $('#transactionsTable tbody').on('click', 'button.btn-delete', function () {
        var transactionID = $(this).data('id');
        
        // Show a confirmation dialog
        var confirmDelete = confirm('Are you sure you want to delete this transaction?');
        if (confirmDelete) {
          // Send a request to delete_transaction.php
          fetch('delete_transaction.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'transactionID=' + transactionID,
          })
            .then((response) => response.text())
            .then((data) => {
               window.location.reload();
            })
            .catch((error) => {
              console.error('Error:', error);
            });
        }
      });
    });
  </script>
  <?php include 'get_transactions.php'; ?>
  <?php include 'scripts.php'; ?>
</body>
</html>
