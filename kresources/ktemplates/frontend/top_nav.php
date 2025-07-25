 <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Home</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="shop.php">Market</a>
                    </li>
                    <?php if(isset($_SESSION['username'])): ?>
                        <li>
                            <a href="dashboard.php">Dashboard</a>
                        </li>
                        <?php if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
                            <li>
                                <a href="admin">Admin</a>
                            </li>
                        <?php endif; ?>
                        <li>
                            <a href="order_history.php">My Orders</a>
                        </li>
                        <li>
                            <a href="logout.php">Logout (<?php echo $_SESSION['username']; ?>)</a>
                        </li>
                    <?php else: ?>
                        <li>
                            <a href="login.php">Login</a>
                        </li>
                        <li>
                            <a href="register.php">Register</a>
                        </li>
                    <?php endif; ?>
                     <li>
                        <a href="checkout.php">Shopping Cart</a>
                    </li>
                    <li>
                        <a href="contact.php">Contact</a>
                    </li>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
