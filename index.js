import { payments, categories } from './dataJSON.js';

const dateInput = document.getElementById('date');
const [month, day, year] = new Date().toLocaleDateString().split('/');
dateInput.max = `${year}-${month}-${day}`;

document
  .getElementById('transactionForm')
  .addEventListener('submit', function (event) {
    event.preventDefault();

    const formData = new FormData(this);

    const categoryID = formData.get('category');
    const paymentID = formData.get('paymentMethod');
    const accountingID = categories.find(
      (category) => category.categoryID === categoryID
    ).accountingID;

    // Include accountingID, categoryID, and paymentID in FormData
    formData.append('accountingID', accountingID);
    formData.append('categoryID', categoryID);
    formData.append('paymentID', paymentID);

    // Dynamically set the form action based on the edit parameter
    const editParameter = getUrlParameter('edit');
    const formAction =
      editParameter === 'true'
        ? 'edit_transaction.php'
        : 'submit_transaction.php';

    fetch(formAction, {
      method: 'POST',
      body: formData,
    })
      .then((response) => response.text())
      .then((data) => {
        // Display the server response on the HTML page
        document.getElementById('formMessage').textContent = data;

        // Reset the form to its initial state
        document.getElementById('transactionForm').reset();

        // Reload the DataTable after submitting a new transaction or editing an existing one
        dataTable.ajax.reload();
      })
      .catch((error) => {
        console.error('Error:', error);
      });

    // Add logic to handle form submission (e.g., send data to the server)
    console.log('Transaction submitted!');
  });

document.addEventListener('DOMContentLoaded', function () {
  // Function to populate categories dynamically
  function populateCategories() {
    const categorySelect = document.getElementById('category');
    categories.forEach((category) => {
      const option = document.createElement('option');
      option.value = category.categoryID;
      option.text = category.category;
      categorySelect.appendChild(option);
    });
    // Enable the category select
    categorySelect.removeAttribute('disabled');
  }

  // Function to populate payment methods dynamically
  function populatePaymentMethods() {
    const paymentMethodSelect = document.getElementById('paymentMethod');
    payments.forEach((payment) => {
      const option = document.createElement('option');
      option.value = payment.paymentID;
      option.text = payment.paymentMethod;
      paymentMethodSelect.appendChild(option);
    });
    // Enable the payment method select
    paymentMethodSelect.removeAttribute('disabled');
  }

  // Call the functions to populate categories and payment methods
  populateCategories();
  populatePaymentMethods();
});

// Function to get URL parameters by name
function getUrlParameter(name) {
  const urlParams = new URLSearchParams(window.location.search);
  return urlParams.get(name);
}
