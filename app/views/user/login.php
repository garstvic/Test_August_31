<?php require APPROOT.'/views/inc/header.php';?>

    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card bg-light mt-5">
                <div class="card-body">
                    <h2>Login</h2>                    
                    <p>Please fill in your credentials to log in</p>
                    <form action="<?=URLROOT;?>/index.php?url=user/login" method="POST">
                        <div class="form-group">
                            <label class="col-form-label" for="email">Email: <sup>*</sup></label>
                            <input id="email" type="email" name="name" class="form-control form-control-md <?php if(!empty($data['email_err'])){?>is-invalid<?php }?>" value="<?=$data['email'];?>"/>
                            <span class="invalid-feedback"><?=$data['email_err'];?></span>                                
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="password">Password: <sup>*</sup></label>
                            <input id="password" type="password" name="name" class="form-control form-control-md <?php if(!empty($data['password_err'])){?>is-invalid<?php }?>" value="<?=$data['password'];?>"/>
                            <span class="invalid-feedback"><?=$data['password_err'];?></span>                                
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="submit" value="Login" class="btn btn-success btn-block"/>
                            </div>
                            <div class="col">
                                <a href="<?=URLROOT;?>/index.php?url=user/signup" class="btn btn-ligh btn-block">No account? Sign Up</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div> 
        </div>
    </div>

<?php require APPROOT.'/views/inc/footer.php';?>