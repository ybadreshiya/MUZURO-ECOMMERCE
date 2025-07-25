 <?php require_once('..\kresources\config.php'); ?>
<?php include(TEMPLATE_FRONT.DS.'header.php'); ?>

    <!-- Page Content -->
    <div class="container">


<!-- /.row --> 

<div class="row">
      <h4 class="text-center bg-danger"><?php display_message(); ?></h4>
      <h1>Checkout</h1>

<?php process_order_checkout(); ?>

<form action="" method="post">
    <table class="table table-striped">
        <thead>
          <tr>
           <th>Product</th>
           <th>Price</th>
           <th>Quantity</th>
           <th>Sub-total</th>
     
          </tr>
        </thead>
        <tbody>

          <?php cart(); ?>

        </tbody>
    </table>
    
    <!-- Order Summary and Checkout Button -->
    <div class="row">
        <div class="col-md-8">
            <?php if(isset($_SESSION['user_id'])): ?>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4>Order Information</h4>
                    </div>
                    <div class="panel-body">
                        <p><strong>Customer:</strong> <?php echo $_SESSION['name'] ?? $_SESSION['username']; ?></p>
                        <p><strong>Order Date:</strong> <?php echo date('M d, Y'); ?></p>
                        <p><strong>Payment Method:</strong> Cash on Delivery</p>
                        <p><strong>Shipping:</strong> Free Shipping</p>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-warning">
                    <h4>Please Login</h4>
                    <p>You need to login to place an order. <a href="login.php" class="btn btn-primary">Login</a> or <a href="register.php" class="btn btn-success">Register</a></p>
                </div>
            <?php endif; ?>
        </div> 

        <div class="col-md-4">
<!--  ***********CART TOTALS*************-->
<h2>Cart Totals</h2>

<table class="table table-bordered" cellspacing="0">

<tr class="cart-subtotal">
<th>Items:</th>
<td><span class="amount"><?php 
echo isset($_SESSION['item_quantity']) ? $_SESSION['item_quantity'] : $_SESSION['item_quantity'] = "0";?></span></td>
</tr>
<tr class="shipping">
<th>Shipping and Handling</th>
<td>Free Shipping</td>
</tr>

<tr class="order-total">
<th>Order Total</th>
<td><strong><span class="amount">$<?php 
echo isset($_SESSION['item_total']) ? number_format($_SESSION['item_total'], 2) : '0.00';?></span></strong></td>
</tr>

</table>

<?php if(isset($_SESSION['user_id']) && isset($_SESSION['item_total']) && $_SESSION['item_total'] > 0): ?>
    <div class="text-center">
        <button type="submit" name="place_order" class="btn btn-success btn-lg">
            <i class="fa fa-shopping-cart"></i> Place Order
        </button>
    </div>
    <br>
    <div class="alert alert-info">
        <small><i class="fa fa-info-circle"></i> By clicking "Place Order", you agree to our terms and conditions. This order will be processed for cash on delivery.</small>
    </div>
<?php elseif(!isset($_SESSION['user_id'])): ?>
    <div class="text-center">
        <a href="login.php" class="btn btn-primary btn-lg">Login to Checkout</a>
    </div>
<?php else: ?>
    <div class="text-center">
        <button class="btn btn-default btn-lg" disabled>Cart is Empty</button>
    </div>
<?php endif; ?>

</div><!-- CART TOTALS-->
    </div><!-- row -->
</form>


 </div><!--Main Content-->


    </div>
    <!-- /.container -->



 <?php include(TEMPLATE_FRONT.DS.'footer.php'); ?>