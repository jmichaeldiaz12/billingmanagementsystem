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
$plan = $_SESSION['plan'];

// Define the price based on the user's plan
$price = 0;
if ($plan === '30MBPS') {
    $price = 800;
} elseif ($plan === '70MBPS') {
    $price = 1000;
}
// Add more conditions for other plans if needed

// Generate the invoice content
$invoiceDate = date('Y-m-d');
$invoiceNumber = uniqid('INV-'); // Generate a unique invoice number
$dueDate = date('Y-m-d', strtotime($invoiceDate . ' + 30 days')); // Set due date 30 days from invoice date

// Client's address (replace with actual data if available)
$clientAddress = "123 Main St, Sample City, Sample Province";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - <?php echo htmlspecialchars($invoiceNumber); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa;
        }
        .invoice {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            max-width: 100px;
        }
        .invoice-details {
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .total {
            font-size: 1.5rem;
            font-weight: bold;
            color: #28a745;
        }
        .btn {
            margin-top: 20px;
        }
        .office-info {
            margin-top: 20px;
            padding: 10px;
            border-top: 1px solid #dee2e6;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="invoice">
            <div class="header">
                <img src="https://via.placeholder.com/100" alt="Logo">
                <h2>Invoice</h2>
            </div>
            <div class="invoice-details">
                <h5>Invoice Number: <?php echo htmlspecialchars($invoiceNumber); ?></h5>
                <p>Date: <?php echo $invoiceDate; ?></p>
                <h5>Billing Details</h5>
                <p>Name: <?php echo htmlspecialchars($fullName); ?></p>
                <p>Address: <?php echo htmlspecialchars($clientAddress); ?></p>
                <p>Account Number: <?php echo htmlspecialchars($userId); ?></p>
                <p>Plan: <?php echo htmlspecialchars($plan); ?></p>
                <p class="total">Total Amount: ₱ <?php echo number_format($price, 2); ?></p>
                <p>Due Date: <?php echo $dueDate; ?></p>
            </div>

            <div class="office-info">
                <h5>Office Information</h5>
                <p><strong>Address:</strong> 456 Office St, Business City, Province</p>
                <p><strong>Phone:</strong> (123) 456-7890</p>
                <p><strong>Email:</strong> office@example.com</p>
                <p><strong>Facebook:</strong> <a href="https://facebook.com" target="_blank">facebook.com/YourOffice</a></p>
            </div>

            <div class="payment-options mt-4">
                <h5>Payment Options</h5>
                <ul>
                    <li>Bank Transfer</li>
                    <li>Cash Payment</li>
                    <li>Online Payment via Credit/Debit Card</li>
                </ul>
            </div>

            <div class="text-center">
                <button class="btn btn-primary" onclick="window.print()">Print Invoice</button>
                <a href="index.php" class="btn btn-secondary">Back to Dashboard</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
