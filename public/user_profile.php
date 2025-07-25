<?php require_once('..\kresources\config.php'); ?>
<?php
// Check if user is logged in
if(!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
    redirect("login.php");
}
?>
<?php include(TEMPLATE_FRONT.DS.'header.php'); ?>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1 class="text-center">User Profile</h1>
                <h4 class="text-center bg-info"><?php display_message();?></h4>
                <div class="text-center">
                    <a href="dashboard.php" class="btn btn-default">← Back to Dashboard</a>
                </div>
                <br>
                
                <?php
                $user_id = $_SESSION['user_id'];
                $query = query("SELECT * FROM users WHERE user_id = '{$user_id}'");
                confirm($query);
                $user = fetch_array($query);
                ?>
                
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Profile Information</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Full Name:</strong>
                                <p><?php echo $user['name']; ?></p>
                            </div>
                            <div class="col-md-6">
                                <strong>Email:</strong>
                                <p><?php echo $user['email']; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Username:</strong>
                                <p><?php echo $user['username']; ?></p>
                            </div>
                            <div class="col-md-6">
                                <strong>Account Type:</strong>
                                <p><?php echo ($user['is_admin'] == 1) ? 'Administrator' : 'Customer'; ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center">
                            <button class="btn btn-info" onclick="alert('Profile editing feature coming soon!')">
                                <i class="fa fa-edit"></i> Edit Profile
                            </button>
                            <button class="btn btn-warning" onclick="alert('Change password feature coming soon!')">
                                <i class="fa fa-key"></i> Change Password
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Quick Stats -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h4>Order Statistics</h4>
                            </div>
                            <div class="panel-body text-center">
                                <?php
                                $order_count = query("SELECT COUNT(*) as count FROM orders WHERE user_id = '{$user_id}'");
                                confirm($order_count);
                                $count_result = fetch_array($order_count);
                                ?>
                                <h3><?php echo $count_result['count']; ?></h3>
                                <p>Total Orders</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h4>Total Spent</h4>
                            </div>
                            <div class="panel-body text-center">
                                <?php
                                $total_spent = query("SELECT SUM(order_amount) as total FROM orders WHERE user_id = '{$user_id}' AND order_status = 'Completed'");
                                confirm($total_spent);
                                $spent_result = fetch_array($total_spent);
                                $total = $spent_result['total'] ?? 0;
                                ?>
                                <h3>$<?php echo number_format($total, 2); ?></h3>
                                <p>Total Amount</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container -->

  <?php include(TEMPLATE_FRONT.DS.'footer.php'); ?> 
