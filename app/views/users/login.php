<?php require_once APPROOT . '/views/inc/header.php'; ?>

<body class="register_page">


    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">


                <div class="register_form">
                  <i class="fa fa-user-plus"></i>
                   <h3 class="text-center">Login</h3>
                    <form class="form-horizontal" method="POST" action="">

                        <div class="form-group form-group-lg">
                            <input type="email" name="email" class="form-control <?php echo (!empty($data['email_error'])) ? 'is-invalid' : '' ?>" required placeholder="Your Email">
                            <span class="text-danger"><?php echo $data['email_error'];?></span>
                        </div>
                        <div class="form-group form-group-lg">
                            <input type="password" name="pass" class="form-control <?php echo (!empty($data['password_error'])) ? 'is-invalid' : '' ?>" required placeholder="Your Password">
                            <span class="text-danger"><?php echo $data['password_error'];?></span>
                        </div>
                        <div class="form-group form-group-lg">
                            <input type="submit" name="login" class="btn btn-primary btn-block" value="Login">
                        </div>
                        <a href="<?php echo URLROOT ?>/users/register" class="text-center">Not A Member? Register</a>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <?php require_once APPROOT . '/views/inc/footer.php'; ?>