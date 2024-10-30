<?php
// Database configuration
$conn = new mysqli("localhost", "root", "", "UserAccounts");

if (isset($_GET['code'])) {
    $verification_code = $_GET['code'];

    // Verify the code
    $stmt = $conn->prepare("SELECT * FROM Users WHERE verification_code = ?");
    $stmt->bind_param("s", $verification_code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Update the user record to set is_verified to 1
        $stmt = $conn->prepare("UPDATE Users SET is_verified = 1 WHERE verification_code = ?");
        $stmt->bind_param("s", $verification_code);
        if ($stmt->execute()) {
            echo "Email successfully verified! You can now <a href='login.php'>login</a>.";
        } else {
            echo "Error verifying email.";
        }
    } else {
        echo "Invalid verification code.";
    }

    // Close connections
    $stmt->close();
    $conn->close();
} else {
    echo "No verification code provided.";
}
?>
