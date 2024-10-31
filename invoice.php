<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Retrieve user data from session
$userId = $_SESSION['user_id'];
$fullName = $_SESSION['full_name'];
$plan = $_SESSION['plan'];
$price = ($plan === '30MBPS') ? 800 : 1000; // Define the price based on the user's plan

// Invoice details
$invoiceDate = date('Y-m-d');
$invoiceNumber = uniqid('INV-');
$dueDate = date('Y-m-d', strtotime('+1 days'));
$clientAddress = "123 Main St, Sample City, Sample Province";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - <?php echo htmlspecialchars($invoiceNumber); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f2f2f2; font-family: Arial, sans-serif; }
        .invoice-container { background: white; padding: 20px; max-width: 800px; margin: auto; border: 1px solid #ccc; }
        .header, .footer { text-align: center; margin-bottom: 20px; }
        .header img { max-width: 120px; }
        .header h4 { margin: 10px 0; font-weight: bold; color: #333; }
        .contact-info { font-size: 0.9em; color: #555; }
        .section-title { font-weight: bold; font-size: 1.1em; color: #555; border-bottom: 2px solid #007bff; padding-bottom: 5px; margin-bottom: 15px; }
        .info-table, .summary-table, .acknowledgement { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .info-table td, .summary-table td, .summary-table th, .acknowledgement td { padding: 10px; border: 1px solid #ddd; }
        .summary-table th { background-color: #f9f9f9; }
        .totals-row { font-weight: bold; }
        .acknowledgement { font-size: 0.9em; color: #333; }
        .footer p { font-size: 0.9em; color: #888; }
        .btn-print { margin-top: 20px; text-align: center; }
    </style>
</head>
<body>
    <div class="invoice-container">
        <!-- Header with Logo and Contact Information -->
        <div class="header">
            <img src="assets/img/logo.jpg" alt="Company Logo">
            <h4>Teranet Wired Internet Services</h4>
            <div class="contact-info">
                <p>Office Address: Barangay Pasong, Putik Proper, Quezon City, 1118</p>
                <p>Phone: +63 9568981983 | Email: customercare@teranetwis.com | Facebook: <a href="https://facebook.com/twis2021">facebook.com/twis2021</a></p>
            </div>
        </div>

        <!-- Sales Invoice Title -->
        <div class="section-title">Sales Invoice</div>

        <!-- Account Information -->
        <table class="info-table">
            <tr>
                <td><strong>Account Number:</strong> <?php echo htmlspecialchars($userId); ?></td>
                <td><strong>Payment From:</strong> <?php echo htmlspecialchars($fullName); ?></td>
            </tr>
            <tr>
                <td><strong>Connection Type:</strong> FIBER OPTIC</td>
                <td><strong>Status:</strong> UNPAID</td>
            </tr>
            <tr>
                <td><strong>Due Date:</strong> <?php echo $dueDate; ?></td>
                <td><strong>Statement Date:</strong> <?php echo $invoiceDate; ?></td>
            </tr>
            <tr>
                <td colspan="2"><strong>Payment Reference:</strong> <?php echo htmlspecialchars($invoiceNumber); ?></td>
            </tr>
        </table>

        <!-- Summary of Charges -->
        <div class="section-title">Summary</div>
        <table class="summary-table">
            <thead>
                <tr>
                    <th>Internet Plan</th>
                    <th>Particulars</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $plan; ?></td>
                    <td>Subscription from <?php echo $invoiceDate; ?> to <?php echo $dueDate; ?></td>
                    <td>₱ <?php echo number_format($price, 2); ?></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2" class="text-end">VAT (12%)</td>
                    <td>₱ <?php echo number_format($price * 0.12, 2); ?></td>
                </tr>
                <tr class="totals-row">
                    <td colspan="2" class="text-end">Total Amount to Pay</td>
                    <td>₱ <?php echo number_format($price * 1.12, 2); ?></td>
                </tr>
            </tfoot>
        </table>

        <!-- Acknowledgment Section -->
        <div class="section-title">Acknowledgement</div>
        <table class="acknowledgement">
            <tr>
                <td>This is to acknowledge the receipt of Php ___________________ from ___________________ as payment for Internet Plan - <?php echo $plan; ?>.</td>
            </tr>
            <tr>
                <td>Next due date: ___________________</td>
            </tr>
            <tr>
                <td>Received By: ___________________ &nbsp;&nbsp;&nbsp;&nbsp; Date: ___________________ &nbsp;&nbsp;&nbsp;&nbsp; Acknowledged By: Client's Name and Signature</td>
            </tr>
        </table>

        <!-- Print and Back to Dashboard Buttons -->
        <div class="btn-print text-center">
            <button class="btn btn-primary" onclick="window.print()">Print Invoice</button>
            <a href="index.php" class="btn btn-secondary">Back to Dashboard</a>
        </div>

        <!-- Footer -->
        <div class="footer text-center">
            <p>If there are any Questions and Inquiries, feel free to Contact Us</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
