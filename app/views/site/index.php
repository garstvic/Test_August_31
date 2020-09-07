<?php require APPROOT.'/views/inc/header.php';?>

    <div class="jumbotron jombotron-flud text-center">
        <div class="container">
            <h1 class="display-3"><?=$data['title'];?></h1>
            <p class="lead">
                <?=$data['description'];?>
            </p>

            <?php if(isset($_SESSION['user'])){?>
                <div class="col-md-6 mx-auto">
                    <div class="card bg-light mt-5">
                        <div class="card-body">
                            <h2>Update An Account</h2>                    
                            <p>Please fill out this form to update</p>
                            <form action="<?=URLROOT;?>/index.php?url=user/update" method="POST">
                                <div class="form-group">
                                    <label class="col-form-label" for="name">Name: <sup>*</sup></label>
                                    <input id="name" type="text" name="name" class="form-control form-control-md <?php if(!empty($data['name_err'])){?>is-invalid<?php }?>" value="<?=$data['name'];?>"/>
                                    <span class="invalid-feedback"><?=$data['name_err'];?></span>                                
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="old_password">Old Password: <sup>*</sup></label>
                                    <input id="old_password" type="password" name="old_password" class="form-control form-control-md <?php if(!empty($data['old_password_err'])){?>is-invalid<?php }?>" value="<?=$data['old_password'];?>"/>
                                    <span class="invalid-feedback"><?=$data['old_password_err'];?></span>                                
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="password">New Password: <sup>*</sup></label>
                                    <input id="password" type="password" name="password" class="form-control form-control-md <?php if(!empty($data['password_err'])){?>is-invalid<?php }?>" value="<?=$data['password'];?>"/>
                                    <span class="invalid-feedback"><?=$data['password_err'];?></span>                                
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input type="submit" value="Update" class="btn btn-success btn-block"/>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> 
                </div>
            <?php } ?>
        </div>
    </div>

<?php require APPROOT.'/views/inc/footer.php';?>