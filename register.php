<!DOCTYPE html>
<html lang="en">
  
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Register - SB Admin</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  </head>
  
  <body class="bg-primary">
    <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
          // Database configuration
          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname = "twis";

          // Create a connection
          $conn = new mysqli($servername, $username, $password, $dbname);

          // Check the connection
          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }

          // Capture form data
          $fullName = $_POST['fullName'];
          $email = $_POST['email'];
          $contactNumber = $_POST['contactNumber'];
          $address = $_POST['address'];
          $plan = $_POST['plan'];
          $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password

          // Insert data into the Users table
          $sql = "INSERT INTO Users (FullName, Email, ContactNumber, Address, Plan, Password) VALUES (?, ?, ?, ?, ?, ?)";

          // Prepare and bind
          $stmt = $conn->prepare($sql);
          $stmt->bind_param("ssssss", $fullName, $email, $contactNumber, $address, $plan, $password);

          // Execute the query
          if ($stmt->execute()) {
              echo "<div class='alert alert-success text-center'>Account created successfully!</div>";
          } else {
              echo "<div class='alert alert-danger text-center'>Error: " . $conn->error . "</div>";
          }

          // Close the statement and connection
          $stmt->close();
          $conn->close();
      }
    ?>

    <div id="layoutAuthentication">
      <div id="layoutAuthentication_content">
        <main>
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-lg-7">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                  <div class="card-header">
                    <h3 class="text-center font-weight-light my-4">Create Account</h3>
                  </div>
                  <div class="card-body">
                    <form method="POST" action="">
                      <div class="row mb-3">
                        <div class="col-md-12">
                          <div class="form-floating mb-3 mb-md-0">
                            <input class="form-control" id="inputFullName" name="fullName" type="text" placeholder="Enter your full name" required />
                            <label for="inputFullName">Full name</label>
                          </div>
                        </div>
                      </div>
                      <div class="form-floating mb-3">
                        <input class="form-control" id="inputEmail" name="email" type="email" placeholder="name@example.com" required />
                        <label for="inputEmail">Email address</label>
                      </div>
                      <div class="form-floating mb-3">
                        <input class="form-control" id="inputNumber" name="contactNumber" type="number" placeholder="+6939772559061" required />
                        <label for="inputNumber">Contact Number</label>
                      </div>
                      <div class="form-floating mb-3">
                        <input class="form-control" id="inputAddress" name="address" type="text" placeholder="Maligaya Park" required />
                        <label for="inputAddress">Address</label>
                      </div>
                      <div class="form-floating mb-3">
                        <select class="form-select" id="inputPlan" name="plan" required>
                          <option selected disabled>Select Plan</option>
                          <option value="30MBPS">30 MBPS</option>
                          <option value="70MBPS">70 MBPS</option>
                          <option value="100MBPS">100 MBPS</option>
                          <option value="300MBPS">300 MBPS</option>
                        </select>
                        <label for="inputPlan">Plan</label>
                      </div>
                      <div class="form-floating mb-3">
                        <input class="form-control" id="inputPassword" name="password" type="password" placeholder="Enter your password" required />
                        <label for="inputPassword">Password</label>
                      </div>
                      <div class="mt-4 mb-0">
                        <div class="d-grid">
                          <button type="submit" class="btn btn-primary btn-block">Create Account</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="card-footer text-center py-3">
                    <div class="small"><a href="login.html">Have an account? Go to login</a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </main>
      </div>
      <div id="layoutAuthentication_footer">
        <footer class="py-4 bg-light mt-auto">
          <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
              <div class="text-muted">Copyright &copy; Your Website 2023</div>
              <div><a href="#">Privacy Policy</a> &middot; <a href="#">Terms &amp; Conditions</a></div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>