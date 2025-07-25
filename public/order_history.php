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
                <h1 class="text-center">Order History</h1>
                <h4 class="text-center bg-info"><?php display_message();?></h4>
                <div class="text-center">
                    <a href="dashboard.php" class="btn btn-default">← Back to Dashboard</a>
                </div>
                <br>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <?php display_user_orders(); ?>
            </div>
        </div>
    </div>
    <!-- /.container -->

  <?php include(TEMPLATE_FRONT.DS.'footer.php'); ?> 
