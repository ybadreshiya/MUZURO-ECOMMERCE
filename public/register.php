<?php require_once('..\kresources\config.php'); ?>
<?php include(TEMPLATE_FRONT.DS.'header.php'); ?>

    <!-- Page Content -->
    <div class="container">

      <header>
            <h1 class="text-center">User Registration</h1>
            <h2 class="text-center bg-warning"><?php display_message();?></h2>
        <div class="col-sm-6 col-sm-offset-3">         
            <form class="" action="" method="post" enctype="multipart/form-data">
               <?php register_user();?>
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" required>
                </div>
                <div class="form-group text-center">
                    <input type="submit" name="submit" value="Register" class="btn btn-primary btn-lg">
                </div>
                <div class="text-center">
                    <p>Already have an account? <a href="login.php">Login here</a></p>
                </div>
            </form>
        </div>  

    </header>

        </div>

  <?php include(TEMPLATE_FRONT.DS.'footer.php'); ?> 
