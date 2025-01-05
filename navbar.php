<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="home.php">    
      <img
      src="home-icon.png"
      width="30"
      height="30"
      class="d-inline-block align-top"
      alt=""
    />
  </a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a
          class="nav-link active"
          href="transaction-entry.php"
          >Enter Transaction</a
        >
      </li>
      <li class="nav-item">
        <a
          class="nav-link"
          href="view-transactions.php"
          >View Transactions</a
        >
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="view-summaries.php" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Summary
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="summary.php?category">By Category</a>
          <a class="dropdown-item" href="summary.php?period">By Period</a>
          <a class="dropdown-item" href="summary.php?type">By Type</a>
          <!-- Add more summary choices as needed -->
        </div>
      </li>
    </ul>
  </div>
  </div>
</nav>