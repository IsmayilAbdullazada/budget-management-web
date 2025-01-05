<!DOCTYPE html>
<html lang="en">
<?php include 'head.php'; ?>
<body>
<!-- Include the navigation bar -->
<?php include 'navbar.php'; ?>
<main class="container mt-4">
    <!-- Transaction Entry Page -->
    <section id="transaction-entry">
        <h2 class="mb-3">Enter Transaction</h2>
        <!-- Transaction form goes here -->
        <form id="transactionForm" action="<?php echo isset($_GET['edit']) && $_GET['edit'] === 'true' ? 'edit_transaction.php' : 'submit_transaction.php'; ?>" method="post">
            <div class="form-group">
                <label for="amount">Amount:</label>
                <input
                    type="number"
                    class="form-control"
                    id="amount"
                    name="amount"
                    min="0"
                    step=".01"
                    required
                />
            </div>
            <div class="form-group">
                <label for="date">Date:</label>
                <input
                    type="date"
                    class="form-control"
                    id="date"
                    name="date"
                    required
                />
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <select
                    class="form-control"
                    id="category"
                    name="category"
                    required
                    disabled
                >
                    <option disabled selected value>-- Select a category --</option>
                    <!-- Populate categories dynamically from JSON -->
                </select>
            </div>
            <div class="form-group">
                <label for="paymentMethod">Payment Method:</label>
                <select
                    class="form-control"
                    id="paymentMethod"
                    name="paymentMethod"
                    required
                    disabled
                >
                    <option disabled selected value>
                        -- Select a payment method --
                    </option>
                    <!-- Populate payment methods dynamically from JSON -->
                </select>
            </div>
            <input type="hidden" id="transactionID" name="transactionID" value="<?php echo isset($_GET['transactionID']) ? $_GET['transactionID'] : ''; ?>">
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <span id="formMessage"></span>
    </section>
</main>
<?php include 'scripts.php'; ?>
<script type="module" src="index.js"></script>
</body>
</html>
