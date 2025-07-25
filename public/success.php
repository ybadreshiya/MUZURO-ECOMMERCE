<?php require_once('..\kresources\config.php'); ?>
<?php include(TEMPLATE_FRONT.DS.'header.php'); ?>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="text-center">
                    <h1 class="text-success"><i class="fa fa-check-circle"></i> Order Successful!</h1>
                    <h4 class="text-center bg-success" style="padding: 10px; border-radius: 5px;"><?php display_message(); ?></h4>
                    
                    <?php if(isset($_GET['order_id'])): ?>
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3>Order Confirmation</h3>
                            </div>
                            <div class="panel-body">
                                <p><strong>Order ID:</strong> #<?php echo escape_string($_GET['order_id']); ?></p>
                                <p><strong>Order Date:</strong> <?php echo date('M d, Y'); ?></p>
                                <p><strong>Payment Method:</strong> Cash on Delivery</p>
                                <p><strong>Status:</strong> <span class="label label-success">Completed</span></p>
                                <hr>
                                <p>Thank you for your order! Your items will be delivered soon.</p>
                                <p>You will receive a confirmation email shortly.</p>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <div class="row" style="margin-top: 30px;">
                        <div class="col-md-4">
                            <a href="dashboard.php" class="btn btn-primary btn-lg btn-block">
                                <i class="fa fa-dashboard"></i> Go to Dashboard
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="order_history.php" class="btn btn-info btn-lg btn-block">
                                <i class="fa fa-history"></i> View Order History
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="shop.php" class="btn btn-success btn-lg btn-block">
                                <i class="fa fa-shopping-bag"></i> Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container -->

  <?php include(TEMPLATE_FRONT.DS.'footer.php'); ?>