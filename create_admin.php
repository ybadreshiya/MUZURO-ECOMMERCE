<?php
// Enhanced Admin Management System
require_once('kresources/config.php');

$message = '';
$messageType = '';

// Handle admin creation
if(isset($_POST['create_admin'])) {
    $name = escape_string($_POST['name']);
    $username = escape_string($_POST['username']);
    $email = escape_string($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Validation
    if(empty($name) || empty($username) || empty($email) || empty($password)) {
        $message = "All fields are required!";
        $messageType = "error";
    } elseif($password !== $confirm_password) {
        $message = "Passwords do not match!";
        $messageType = "error";
    } elseif(strlen($password) < 6) {
        $message = "Password must be at least 6 characters long!";
        $messageType = "error";
    } else {
        // Check if username or email already exists
        $check_user = query("SELECT * FROM users WHERE username = '{$username}' OR email = '{$email}'");
        confirm($check_user);
        
        if(mysqli_num_rows($check_user) > 0) {
            $message = "Username or email already exists!";
            $messageType = "error";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            // Insert new admin
            $insert_admin = query("INSERT INTO users (name, email, username, password, is_admin) 
                                  VALUES ('{$name}', '{$email}', '{$username}', '{$hashed_password}', 1)");
            
            if($insert_admin) {
                $message = "✅ Admin user '{$username}' created successfully!";
                $messageType = "success";
            } else {
                $message = "❌ Error creating admin user!";
                $messageType = "error";
            }
        }
    }
}

// Handle admin deletion
if(isset($_POST['delete_admin']) && isset($_POST['user_id'])) {
    $user_id = escape_string($_POST['user_id']);
    
    // Try both possible ID column names
    $delete_user = query("DELETE FROM users WHERE (user_id = '{$user_id}' OR id = '{$user_id}') AND is_admin = 1");
    
    if($delete_user) {
        $message = "Admin user deleted successfully!";
        $messageType = "success";
    } else {
        $message = "Error deleting admin user!";
        $messageType = "error";
    }
}

// Get all admin users
$admin_users = query("SELECT * FROM users WHERE is_admin = 1 ORDER BY user_id");
confirm($admin_users);

// Reset the result pointer for reuse
$admin_users_rewind = query("SELECT * FROM users WHERE is_admin = 1 ORDER BY user_id");
confirm($admin_users_rewind);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MUZURO ECOMMERCE - Admin Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .admin-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            backdrop-filter: blur(10px);
            margin: 2rem auto;
            max-width: 1200px;
        }
        .header-section {
            background: linear-gradient(45deg, #2c3e50, #3498db);
            color: white;
            padding: 2rem;
            border-radius: 15px 15px 0 0;
            text-align: center;
        }
        .form-section {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
        .admin-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s ease;
        }
        .admin-card:hover {
            transform: translateY(-2px);
        }
        .btn-custom {
            border-radius: 25px;
            padding: 10px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-primary-custom {
            background: linear-gradient(45deg, #3498db, #2980b9);
            border: none;
            color: white;
        }
        .btn-primary-custom:hover {
            background: linear-gradient(45deg, #2980b9, #1f6391);
            transform: translateY(-1px);
        }
        .btn-danger-custom {
            background: linear-gradient(45deg, #e74c3c, #c0392b);
            border: none;
            color: white;
        }
        .alert-custom {
            border-radius: 10px;
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="admin-container">
            <!-- Header -->
            <div class="header-section">
                <h1><i class="fas fa-shield-alt me-3"></i>MUZURO ECOMMERCE</h1>
                <h3>Admin Management System</h3>
                <p class="mb-0">Create and manage administrator accounts</p>
            </div>

            <div class="p-4">
                <!-- Messages -->
                <?php if($message): ?>
                    <div class="alert <?php echo $messageType == 'success' ? 'alert-success' : 'alert-danger'; ?> alert-custom" role="alert">
                        <i class="fas <?php echo $messageType == 'success' ? 'fa-check-circle' : 'fa-exclamation-triangle'; ?> me-2"></i>
                        <?php echo $message; ?>
                    </div>
                <?php endif; ?>

                <!-- Create New Admin Form -->
                <div class="form-section">
                    <h4 class="mb-4"><i class="fas fa-user-plus me-2"></i>Create New Admin User</h4>
                    <form method="POST" class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label"><i class="fas fa-user me-1"></i>Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="username" class="form-label"><i class="fas fa-at me-1"></i>Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="col-md-12">
                            <label for="email" class="form-label"><i class="fas fa-envelope me-1"></i>Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label"><i class="fas fa-lock me-1"></i>Password</label>
                            <input type="password" class="form-control" id="password" name="password" required minlength="6">
                        </div>
                        <div class="col-md-6">
                            <label for="confirm_password" class="form-label"><i class="fas fa-lock me-1"></i>Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        </div>
                        <div class="col-12">
                            <button type="submit" name="create_admin" class="btn btn-primary-custom btn-custom">
                                <i class="fas fa-plus me-2"></i>Create Admin User
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Existing Admin Users -->
                <div class="mb-4">
                    <h4 class="mb-4"><i class="fas fa-users-cog me-2"></i>Current Admin Users</h4>
                    <?php if(mysqli_num_rows($admin_users_rewind) > 0): ?>
                        <div class="row">
                            <?php while($admin = fetch_array($admin_users_rewind)): ?>
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <div class="admin-card p-3">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="bg-primary rounded-circle p-2 me-3">
                                                <i class="fas fa-user-shield text-white"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0"><?php echo htmlspecialchars($admin['name'] ?? $admin['username']); ?></h6>
                                                <small class="text-muted">Administrator</small>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <p class="mb-1"><strong>Username:</strong> <?php echo htmlspecialchars($admin['username']); ?></p>
                                            <p class="mb-1"><strong>Email:</strong> <?php echo htmlspecialchars($admin['email'] ?? 'N/A'); ?></p>
                                            <p class="mb-0"><strong>ID:</strong> <?php echo isset($admin['user_id']) ? $admin['user_id'] : (isset($admin['id']) ? $admin['id'] : 'N/A'); ?></p>
                                        </div>
                                        <form method="POST" onsubmit="return confirm('Are you sure you want to delete this admin user?')">
                                            <input type="hidden" name="user_id" value="<?php echo isset($admin['user_id']) ? $admin['user_id'] : (isset($admin['id']) ? $admin['id'] : ''); ?>">
                                            <button type="submit" name="delete_admin" class="btn btn-danger-custom btn-sm btn-custom">
                                                <i class="fas fa-trash me-1"></i>Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-warning alert-custom">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            No admin users found. Create your first admin user above.
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Quick Links -->
                <div class="form-section">
                    <h4 class="mb-3"><i class="fas fa-external-link-alt me-2"></i>Quick Links</h4>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <a href="public/login.php" class="btn btn-outline-primary btn-custom w-100">
                                <i class="fas fa-sign-in-alt me-2"></i>Login Page
                            </a>
                        </div>
                        <div class="col-md-6 mb-2">
                            <a href="public/admin/" class="btn btn-outline-success btn-custom w-100">
                                <i class="fas fa-tachometer-alt me-2"></i>Admin Dashboard
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Database Structure Check -->
                <div class="form-section">
                    <h4 class="mb-3"><i class="fas fa-database me-2"></i>Database Structure Check</h4>
                    <?php
                    // Check if users table has required columns
                    $check_table = query("DESCRIBE users");
                    confirm($check_table);
                    
                    echo "<div class='table-responsive'>";
                    echo "<table class='table table-striped table-hover'>";
                    echo "<thead class='table-dark'><tr><th>Column</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th></tr></thead><tbody>";
                    
                    $has_is_admin = false;
                    $has_name = false;
                    $has_email = false;
                    
                    while($row = fetch_array($check_table)) {
                        echo "<tr>";
                        echo "<td><i class='fas fa-columns me-1'></i>" . $row['Field'] . "</td>";
                        echo "<td>" . $row['Type'] . "</td>";
                        echo "<td>" . $row['Null'] . "</td>";
                        echo "<td>" . $row['Key'] . "</td>";
                        echo "<td>" . ($row['Default'] ?? 'NULL') . "</td>";
                        echo "</tr>";
                        
                        if($row['Field'] == 'is_admin') $has_is_admin = true;
                        if($row['Field'] == 'name') $has_name = true;
                        if($row['Field'] == 'email') $has_email = true;
                    }
                    echo "</tbody></table></div>";
                    
                    // Show warnings for missing columns
                    if(!$has_is_admin || !$has_name || !$has_email) {
                        echo "<div class='alert alert-warning alert-custom mt-3'>";
                        echo "<h6><i class='fas fa-exclamation-triangle me-2'></i>Missing Database Columns</h6>";
                        echo "<p>The following columns are missing from your users table:</p><ul>";
                        
                        if(!$has_is_admin) echo "<li><code>is_admin</code> - Required for admin permissions</li>";
                        if(!$has_name) echo "<li><code>name</code> - For storing full names</li>";
                        if(!$has_email) echo "<li><code>email</code> - For email addresses</li>";
                        
                        echo "</ul><p><strong>Run these SQL commands in phpMyAdmin:</strong></p>";
                        echo "<div class='bg-dark text-light p-3 rounded'><code>";
                        
                        if(!$has_is_admin) echo "ALTER TABLE users ADD COLUMN is_admin TINYINT(1) DEFAULT 0;<br>";
                        if(!$has_name) echo "ALTER TABLE users ADD COLUMN name VARCHAR(255) NULL;<br>";
                        if(!$has_email) echo "ALTER TABLE users ADD COLUMN email VARCHAR(255) NULL;<br>";
                        
                        echo "</code></div></div>";
                    } else {
                        echo "<div class='alert alert-success alert-custom mt-3'>";
                        echo "<i class='fas fa-check-circle me-2'></i>All required database columns are present!";
                        echo "</div>";
                    }
                    ?>
                </div>

                <!-- Security Notice -->
                <div class="alert alert-danger alert-custom">
                    <h6><i class="fas fa-shield-alt me-2"></i>Security Notice</h6>
                    <p class="mb-0">
                        <strong>Important:</strong> After setting up your admin users, delete this file 
                        (<code>create_admin.php</code>) from your server for security reasons. This page should 
                        only be used during initial setup or when you need to recover admin access.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Password confirmation validation
        document.getElementById('confirm_password').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirmPassword = this.value;
            
            if(password !== confirmPassword) {
                this.setCustomValidity('Passwords do not match');
            } else {
                this.setCustomValidity('');
            }
        });

        // Form validation feedback
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</body>
</html>
