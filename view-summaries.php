<!DOCTYPE html>
<html lang="en">
<?php include 'head.php'; ?>
<body>

<!-- Include the navigation bar -->
<?php include 'navbar.php'; ?>
<main class="container mt-4">

<!-- View Summaries Page -->
<section id="view-summaries">
  <h2 class="mb-3">View Summaries</h2>
  <!-- View summaries content goes here -->
  <canvas id="summaryChart" width="400" height="200"></canvas>
  <canvas id="categoryChart" width="400" height="200"></canvas>
  <canvas id="paymentMethodChart" width="400" height="200"></canvas>
</section>

</main>
<?php include 'scripts.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="charts.js"></script>

<?php
require_once 'db_conn.php';

try {
  // Fetch data from the database for a summary of expenses by date
  $queryByDate = "
    SELECT
      date,
      SUM(amount) AS total_expense
    FROM
      transactions
    WHERE
      categoryID = 2
    GROUP BY
      date
    ORDER BY
      date;
  ";

  $stmtByDate = $conn->prepare($queryByDate);
  $stmtByDate->execute();
  $resultByDate = $stmtByDate->fetchAll(PDO::FETCH_ASSOC);

  // Convert the result into JSON format for Chart.js
  $json_data_by_date = json_encode($resultByDate);

  // Fetch data from the database for a summary of expenses by category
  $queryByCategory = "
    SELECT
      categories.category,
      SUM(transactions.amount) AS total_expense
    FROM
      transactions
    JOIN
      categories ON transactions.categoryID = categories.categoryID
    WHERE
      transactions.categoryID IS NOT NULL
    GROUP BY
      categories.category
    ORDER BY
      total_expense DESC;
  ";

  $stmtByCategory = $conn->prepare($queryByCategory);
  $stmtByCategory->execute();
  $resultByCategory = $stmtByCategory->fetchAll(PDO::FETCH_ASSOC);

  // Convert the result into JSON format for Chart.js
  $json_data_by_category = json_encode($resultByCategory);

  // Fetch data from the database for a summary of expenses by payment method
  $queryByPaymentMethod = "
    SELECT
      payments.paymentMethod,
      SUM(transactions.amount) AS total_expense
    FROM
      transactions
    JOIN
      payments ON transactions.paymentID = payments.paymentID
    WHERE
      transactions.paymentID IS NOT NULL
    GROUP BY
      payments.paymentMethod
    ORDER BY
      total_expense DESC;
  ";

  $stmtByPaymentMethod = $conn->prepare($queryByPaymentMethod);
  $stmtByPaymentMethod->execute();
  $resultByPaymentMethod = $stmtByPaymentMethod->fetchAll(PDO::FETCH_ASSOC);

  // Convert the result into JSON format for Chart.js
  $json_data_by_payment_method = json_encode($resultByPaymentMethod);
} catch (Exception $e) {
  echo 'Error: ' . $e->getMessage();
}
?>

<script>
  // Parse the JSON data received from PHP for expenses by date
  var chartDataByDate = <?php echo $json_data_by_date; ?>;

  // Extract labels and data for Chart.js
  var labelsByDate = chartDataByDate.map(entry => entry.date);
  var dataByDate = chartDataByDate.map(entry => entry.total_expense);

  // Get the canvas element for expenses by date
  var ctxByDate = document.getElementById('summaryChart').getContext('2d');

  // Create a bar chart for expenses by date
  var myChartByDate = new Chart(ctxByDate, {
    type: 'bar',
    data: {
      labels: labelsByDate,
      datasets: [{
        label: 'Total Expense by Date',
        data: dataByDate,
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        x: { stacked: true },
        y: { stacked: true }
      }
    }
  });

  // Parse the JSON data received from PHP for expenses by category
  var chartDataByCategory = <?php echo $json_data_by_category; ?>;

  // Extract labels and data for Chart.js
  var labelsByCategory = chartDataByCategory.map(entry => entry.category);
  var dataByCategory = chartDataByCategory.map(entry => entry.total_expense);

  // Get the canvas element for expenses by category
  var ctxByCategory = document.getElementById('categoryChart').getContext('2d');

  // Create a pie chart for expenses by category
  var myChartByCategory = new Chart(ctxByCategory, {
    type: 'pie',
    data: {
      labels: labelsByCategory,
      datasets: [{
        data: dataByCategory,
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)'
        ],
        borderColor: [
          'rgba(255, 99, 132, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      plugins: {
        legend: {
          position: 'right',
        },
        tooltip: {
          callbacks: {
            label: function(context) {
              var label = context.label || '';
              var value = context.formattedValue;
              var percentage = context.dataset.data[context.dataIndex] / context.dataset.data.reduce((a, b) => a + b, 0) * 100;
              return label + ': ' + value + ' (' + percentage.toFixed(2) + '%)';
            }
          }
        }
      }
    }
  });

  // Parse the JSON data received from PHP for expenses by payment method
  var chartDataByPaymentMethod = <?php echo $json_data_by_payment_method; ?>;

  // Extract labels and data for Chart.js
  var labelsByPaymentMethod = chartDataByPaymentMethod.map(entry => entry.paymentMethod);
  var dataByPaymentMethod = chartDataByPaymentMethod.map(entry => entry.total_expense);

  // Get the canvas element for expenses by payment method
  var ctxByPaymentMethod = document.getElementById('paymentMethodChart').getContext('2d');

  // Create a bar chart for expenses by payment method
  var myChartByPaymentMethod = new Chart(ctxByPaymentMethod, {
    type: 'bar',
    data: {
      labels: labelsByPaymentMethod,
      datasets: [{
        label: 'Total Expense by Payment Method',
        data: dataByPaymentMethod,
        backgroundColor: 'rgba(255, 99, 132, 0.2)',
        borderColor: 'rgba(255, 99, 132, 1)',
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        x: { stacked: true },
        y: { stacked: true }
      }
    }
  });
</script>

</body>
</html>
