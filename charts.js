// Sample data (you can replace it with your actual data)
const summaryData = {
  labels: ['January', 'February', 'March', 'April', 'May'],
  datasets: [
    {
      label: 'Expenses',
      backgroundColor: 'rgba(255, 99, 132, 0.2)',
      borderColor: 'rgba(255, 99, 132, 1)',
      borderWidth: 1,
      data: [50, 30, 70, 40, 90],
    },
  ],
};

// Get the canvas element
// const ctx = document.getElementById('summaryChart').getContext('2d');

// Create a bar chart
const summaryChart = new Chart(ctx, {
  type: 'bar',
  data: summaryData,
  options: {
    scales: {
      y: {
        beginAtZero: true,
      },
    },
  },
});
