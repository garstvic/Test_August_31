<?php require APPROOT.'/views/inc/header.php';?>

    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card bg-light mt-5">
                <div class="card-body">
                    <h2>Create An Account</h2>                    
                    <p>Please fill out this form to register with us</p>
                    <form action="<?=URLROOT;?>/index.php?url=user/signup" method="POST">
                        <div class="form-group">
                            <label class="col-form-label" for="name">Name: <sup>*</sup></label>
                            <input id="name" type="text" name="name" class="form-control form-control-md <?php if(!empty($data['name_err'])){?>is-invalid<?php }?>" value="<?=$data['name'];?>"/>
                            <span class="invalid-feedback"><?=$data['name_err'];?></span>                                
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="email">Email: <sup>*</sup></label>
                            <input id="email" type="email" name="email" class="form-control form-control-md <?php if(!empty($data['email_err'])){?>is-invalid<?php }?>" value="<?=$data['email'];?>"/>
                            <span class="invalid-feedback"><?=$data['email_err'];?></span>                                
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="password">Password: <sup>*</sup></label>
                            <input id="password" type="password" name="password" class="form-control form-control-md <?php if(!empty($data['password_err'])){?>is-invalid<?php }?>" value="<?=$data['password'];?>"/>
                            <span class="invalid-feedback"><?=$data['password_err'];?></span>                                
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="confirm_password">Confirm Password: <sup>*</sup></label>
                            <input id="confirm_password" type="password" name="confirm_password" class="form-control form-control-md <?php if(!empty($data['confirm_password_err'])){?>is-invalid<?php }?>" value="<?=$data['confirm_password'];?>"/>
                            <span class="invalid-feedback"><?=$data['confirm_password_err'];?></span>                                
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="submit" value="Sign Up" class="btn btn-success btn-block"/>
                            </div>
                            <div class="col">
                                <a href="<?=URLROOT;?>/index.php?url=user/login" class="btn btn-ligh btn-block">Have an account? Login</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div> 
        </div>
    </div>

<?php require APPROOT.'/views/inc/footer.php';?>