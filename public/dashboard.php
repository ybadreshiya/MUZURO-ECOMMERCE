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
            <div class="col-md-12">
                <h1 class="text-center">Welcome, <?php echo $_SESSION['name'] ?? $_SESSION['username']; ?>!</h1>
                <h4 class="text-center bg-info"><?php display_message();?></h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Your Account</h3>
                    </div>
                    <div class="panel-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <a href="user_profile.php"><i class="fa fa-user"></i> View Profile</a>
                            </li>
                            <li class="list-group-item">
                                <a href="order_history.php"><i class="fa fa-history"></i> Order History</a>
                            </li>
                            <li class="list-group-item">
                                <a href="checkout.php"><i class="fa fa-shopping-cart"></i> Shopping Cart</a>
                            </li>
                            <li class="list-group-item">
                                <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Quick Actions</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="thumbnail">
                                    <div class="caption text-center">
                                        <h4>Browse Products</h4>
                                        <p>Discover our latest computer products and accessories</p>
                                        <a href="shop.php" class="btn btn-primary">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="thumbnail">
                                    <div class="caption text-center">
                                        <h4>Your Cart</h4>
                                        <p>Review items in your shopping cart</p>
                                        <a href="checkout.php" class="btn btn-info">View Cart</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="thumbnail">
                                    <div class="caption text-center">
                                        <h4>Order History</h4>
                                        <p>Track your previous orders and purchases</p>
                                        <a href="order_history.php" class="btn btn-success">View Orders</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Products -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Featured Products</h3>
                    </div>
                    <div class="panel-body">
                        <?php include(TEMPLATE_FRONT.DS.'products.php'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container -->

  <?php include(TEMPLATE_FRONT.DS.'footer.php'); ?> 
