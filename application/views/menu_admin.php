 <div class="header" style="padding-bottom:10px">
        <!-- <ul class="nav nav-pills pull-right"> -->
    <ul class="nav nav-tabs pull-right" role="tablist">
  <li <?php if($this->uri->segment(2) == "index" && $this->uri->segment(1) == "admin") echo 'class="active"';?>>
	<a href="<?php echo site_url('admin/index');?>">Start</a></li>
	
<?php if(@$acl["pracownicy"] > 0 or @$acl["slowniki"] > 0 or @$acl["zbiory"] > 0 or @$acl["repo"] > 0 or @$acl["raporty"] > 0 or @$acl["rejestry"] > 0 or @$acl["zaklady"] > 0): ?>
   <li class="dropdown">
     <a class="dropdown-toggle" data-toggle="dropdown" href="#">
       Zakłady <span class="caret"></span>
     </a>
     <ul class="dropdown-menu" role="menu">


<?php if(@$acl["pracownicy"] > 0): ?>
		 <li <?php if($this->uri->segment(1) == "pracownicy") echo 'class="active"';?>>
		 	<a href="<?php echo site_url('pracownicy');?>">Pracownicy</a></li>
<?php endif;?>

<?php if(@$acl["slowniki"] > 0): ?>
		 <li <?php if($this->uri->segment(1) == "slowniki") echo 'class="active"';?>>
		 	<a href="<?php echo site_url('slowniki');?>">Zbiory i słowniki</a></li>
<?php endif;?>

<?php if(@$acl["zbiory"] > 0): ?>
  		 <li <?php if($this->uri->segment(1) == "zbiory") echo 'class="active"';?>>
  		 	<a href="<?php echo site_url('zbiory');?>">Wykaz zbiorów</a></li>
<?php endif;?>

<?php if(@$acl["repo"] > 0): ?>
		 <li <?php if($this->uri->segment(1) == "repo") echo 'class="active"';?>>
		 	<a href="<?php echo site_url('repo');?>">Repozytoria dokumentów</a></li>
<?php endif;?>

<?php if(@$acl["raporty"] > 0): ?>
  		 <li <?php if($this->uri->segment(1) == "raporty") echo 'class="active"';?>>
  		 	<a href="<?php echo site_url('raporty');?>">Raporty</a></li>
<?php endif;?>

<?php if(@$acl["rejestry"] > 0): ?>
  		 <li <?php if($this->uri->segment(1) == "rejestry") echo 'class="active"';?>>
  		 	<a href="<?php echo site_url('rejestry');?>">Rejestry i opisy</a></li>
			<?php if(@$acl["rejestr_u"] > 0): ?>
				 <li class="divider"></li>
  		 <li <?php if($this->uri->segment(1) == "rejestr_u") echo 'class="active"';?>>
			  		 	<a href="<?php echo site_url('rejestr_u');?>">Rejestr umów</a></li>
			<?php endif;?>
  			<?php if(@$acl["rejestr_inc"] > 0): ?>
    		 <li <?php if($this->uri->segment(1) == "rejestr_inc") echo 'class="active"';?>>
  			  		 	<a href="<?php echo site_url('rejestr_inc');?>">Rejestr incydentów</a></li>
  			<?php endif;?>
  			<?php if(@$acl["rejestry_ud"] > 0): ?>
    		 <li <?php if($this->uri->segment(1) == "rejestry_ud") echo 'class="active"';?>>
  			  		 	<a href="<?php echo site_url('rejestry_ud');?>">Rejestr udostępnień</a></li>
  			<?php endif;?>
  			<?php if(@$acl["transfer"] > 0): ?>
    		 <li <?php if($this->uri->segment(1) == "transfer") echo 'class="active"';?>>
  			  		 	<a href="<?php echo site_url('transfer');?>">Transfer z HD</a></li>
  			<?php endif;?>
<?php endif;?>
      

<?php if(@$acl["zaklady"] > 0): ?>
	 <li class="divider"></li>
		 <li <?php if($this->uri->segment(1) == "zaklady") echo 'class="active"';?>>
		 	<a href="<?php echo site_url('zaklady');?>">Zarządzanie zakładami</a></li>
<?php endif;?>   
<?php if(@$acl["zaklady_pliki"] > 0): ?>
		 <li <?php if($this->uri->segment(1) == "zaklady_pliki") echo 'class="active"';?>>
		 	<a href="<?php echo site_url('zaklady_pliki');?>">Pliki dla zakładów</a></li>
<?php endif;?>       
     </ul>
   </li>
<?php endif;?>

<?php if(@$acl["upo"] > 0): ?>
<li <?php if($this->uri->segment(2) == "upo") echo 'class="active"';?>>
	<a href="<?php echo site_url('admin/upo');?>">Upoważnienia</a></li>
<?php endif;?>    

<?php if(@$acl["adm"] > 0): ?>
   <li class="dropdown">
     <a class="dropdown-toggle" data-toggle="dropdown" href="#">
       Admin <span class="caret"></span>
     </a>
     <ul class="dropdown-menu" role="menu">
		 <li <?php if($this->uri->segment(1) == "uzytkownicy") echo 'class="active"';?>>
		 	<a href="<?php echo site_url('uzytkownicy');?>">Użytkownicy</a></li>
       
		 <li <?php if($this->uri->segment(2) == "logi") echo 'class="active"';?>>
		 	<a href="<?php echo site_url('adm/logi');?>">Logi zdarzeń</a></li>
		 <li <?php if($this->uri->segment(2) == "logowania") echo 'class="active"';?>>
		 	<a href="<?php echo site_url('adm/logowania');?>">Historia logowań</a></li>
       
		 <li <?php if($this->uri->segment(2) == "stat") echo 'class="active"';?>>
		 	<a href="<?php echo site_url('adm/stat');?>">Statystyki</a></li>
       
     </ul>
   </li>
<?php endif;?>
<li><a href="<?php echo site_url('start/wyloguj');?>">Wyloguj <span class="glyphicon glyphicon-log-out"></span> </a></li>
</ul><?php 
 	 
	 $kolor = array( 
	  0 => "#428bca",
	  1 => "#5cb85c",
	  2 => "#5bc0de",
	  3 => "#f0ad4e",
	  4 => "#d9534f");
	  
	  $rand = rand(0,4);
  ?>
        <h3 class="text-muted"><span style="color: <?php echo $kolor[$rand];?>;" class="glyphicon glyphicon-tint"></span>ABI Informatics</h3>
      </div>
<?php echo $breadcrumbs; ?>
