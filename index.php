<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Retrieve user data from session
$userId = $_SESSION['user_id'];
$fullName = $_SESSION['full_name'];

// Sample PHP variables for demonstration
$userName = $fullName; // Use the fullName variable from session
$plan = $_SESSION['plan']; // Get the user's plan from session
$price = $_SESSION['price']; // Get the user's price from session
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Client Management Systems</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">J.M.D</a>
        <!-- Navbar User Name-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <h5 class="user-name" style="color: white;"><?php echo htmlspecialchars($fullName); ?></h5>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li><hr class="dropdown-divider" /></li>
                    <li><a class="dropdown-item" href="#!">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Home
                        </a>
                        <a class="nav-link" href="serviceinformation.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-bars"></i></div>
                            Service Information
                        </a>
                        <a class="nav-link" href="charts.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-usd "></i></div>
                             Billing History
                        </a>
                        <a class="nav-link" href="charts.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-ticket"></i></div>
                            Help Ticket
                        </a>
                        <div class="sb-sidenav-menu-heading">Arrangement</div>
                        <a class="nav-link" href="charts.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                            Account
                        </a>
                        <a class="nav-link" href="tables.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-key"></i></div>
                            Change Password
                        </a>
                        <a class="nav-link" href="tables.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-info"></i></div>
                            About
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <div class="row">

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-light text-dark mb-4 border">
                                <div class="card-body">
                                    <h5 class="mb-3 text-center">Your Package</h5>
                                    <p class="mb-1 text-center h4 font-weight-bold"><?php echo htmlspecialchars($plan); ?></p>
                                    <p class="mb-0 text-center">Service Item</p>
                                </div>
                                <div class="card-footer text-center">
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#accountDetailsModal">
                                        View Details
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-light text-dark mb-4 border">
                                <div class="card-body">
                                    <h5 class="mb-3 text-center">Monthly Bill For October 2024</h5>
                                    <p class="mb-1 text-center h4 font-weight-bold">₱ <?php echo number_format($price, 2); ?></p>
                                    <p class="mb-0 text-center text-muted">Pay the bill before October 2024</p>
                                </div>
                                <div class="card-footer text-center">
                                    <a class="btn btn-warning text-white" href="#">Pay Now</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="accountDetailsModal" tabindex="-1" aria-labelledby="accountDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="accountDetailsModalLabel">Account Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>Account Number:</h6>
                    <p id="accountNumber"><?php echo htmlspecialchars($userId); ?></p>
                    
                    <h6>Status of Payment:</h6>
                    <p id="paymentStatus">Paid</p> <!-- This can be dynamically set if needed -->
                    
                    <h6>Total Price:</h6>
                    <p id="totalPrice">₱ <?php echo number_format($price, 2); ?></p>
                    
                    <h6>Billing Details:</h6>
                    <p>Your plan: <?php echo htmlspecialchars($plan); ?></p>
                    <p>Billing Period: Monthly</p> <!-- Modify as needed -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="pay()">Pay</button>
                    <button type="button" class="btn btn-success" onclick="confirmPayment()">Payment Confirmation</button>
                    <button type="button" class="btn btn-secondary" onclick="generateInvoice()">Invoice</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>

    <script>
    function pay() {
        alert('Pay button clicked!'); // Replace with your payment logic
    }

    function confirmPayment() {
        alert('Payment confirmed!'); // Replace with your confirmation logic
    }

    function generateInvoice() {
        window.location.href = 'invoice.php'; // Redirect to invoice.php
    }
</script>
</body>
</html>
