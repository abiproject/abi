<nav class="navbar navbar-default" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">

          <a class="navbar-brand" href="#">Dodaj nowy raport: </a>
			 <a href="<?php echo site_url("raporty/pokontrolny/");?>" class="btn btn-warning navbar-btn" role="button">Pokontrolny ODO</a>
			 <a href="<?php echo site_url("raporty/roczny");?>" class="btn btn-warning navbar-btn" role="button">Roczny ODO</a>
        </div>
       
      </div>
    </nav>
	 <?php if(strlen($error) > 0) echo '<div class="alert alert-danger" role="alert" id="errorMsg">'.$error.'</div>';?>
	 <?php if(strlen($msg) > 0) echo '<div class="alert alert-success" role="alert" id="okMsg">'.$msg.'</div>';?>