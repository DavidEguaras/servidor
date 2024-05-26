<main>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-10">
                <div class="card border-0">
                    <div class="card-body login-box bg-black">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="login" class="text-info">Username:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="login" name="username" value="<?php if(isset($_COOKIE['username'])) echo $_COOKIE['username']?>">
                                </div>
                                <?php if (isset($errors)) { writeErrors($errors, 'username'); } ?>
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info mt-5">Password:</label>
                                <input type="password" class="form-control" id="password" name="pass">
                                <?php if (isset($errors)) { writeErrors($errors, 'pass'); } ?>
                            </div>
                            <div class="form-check mt-3">
                                <input type="checkbox" class="form-check-input" id="rememberUser" name="rememberUser" <?php if (isset($_COOKIE['username'])) echo 'checked'; ?>>
                                <label class="form-check-label text-info" for="rememberUser">Keep me logged in</label>
                            </div>
                            <?php if (isset($errors)) { writeErrors($errors, 'validated'); } ?>
                            <div class="mt-3">  
                                <button type="submit" name="login" class="btn btn-primary">Login</button>
                                <button type="submit" name="register" class="btn btn-secondary">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
