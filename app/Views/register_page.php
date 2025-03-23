<!-- Registration Form -->
<div class="container">
    <div class="register-container">
        <div class="register-header">
            <img src="<?=base_url('assets/images/logo.jpg')?>" alt="POS Logo">
            <h2>Create Account</h2>
            <p>Please fill in your information</p>
        </div>

        <?php if (session()->getFlashdata('response')):
            $response_data = $_SESSION['response']['response_data'];
            $response_status = $_SESSION['response']['response_status'];
                if ($response_status == 'Success'):?>
                <div class="alert alert-success">
                    <?=$response_data;?>
                </div>
            <?php elseif($response_status == 'Error'):?>
                <div class="alert alert-danger d-flex flex-column">
                    <?php foreach($response_data as $key => $value):?>
                        <span><?=$value?></span>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>


        <form action="<?= base_url('register/verify') ?>" method="POST">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="fname" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="fname" name="fname" >
                </div>
                <div class="col-md-4 mb-3">
                    <label for="mname" class="form-label">Middle Name</label>
                    <input type="text" class="form-control" id="mname" name="mname">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="lname" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lname" name="lname" >
                </div>
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>

            <button type="submit" class="btn btn-register">Create Account</button>
        </form>

        <div class="text-center mt-3">
            Already have an account? <a href="<?= site_url('') ?>" class="btn btn-link">Login here</a>
        </div>
    </div>
</div>

