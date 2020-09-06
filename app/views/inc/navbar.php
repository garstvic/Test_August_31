<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
  <div class="container">
    <a class="navbar-brand" href="<?=URLROOT;?>">SilkSky</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link" href="<?=URLROOT;?>">Home</a>
          </li>
      </ul>
      <ul class="navbar-nav ml-md-auto">
        <?php if(isset($_SESSION['user'])){?>
          <li class="nav-item">
            <a class="nav-link" href="<?=URLROOT;?>/index.php?url=user/logout">Logout</a>
          </li>
        <?php }else{?>
          <li class="nav-item">
            <a class="nav-link" href="<?=URLROOT;?>/index.php?url=user/signup">Sign Up</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=URLROOT;?>/index.php?url=user/login">Login</a>
          </li>          
        <?php }?>
      </ul>
    </div>
  </div>
</nav>