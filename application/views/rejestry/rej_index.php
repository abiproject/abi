	<?php if(strlen($error) > 0) echo '<div class="alert alert-danger" role="alert" id="errorMsg">'.$error.'</div>';?>
	<?php if(strlen($msg) > 0) echo '<div class="alert alert-success" role="alert" id="okMsg">'.$msg.'</div>';?>
<nav class="navbar navbar-default" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
			 <?php if(@$acl["rejestry_unk"] > 0): ?>
			 <a href="<?php echo site_url("rejestry_unk");?>" class="btn btn-primary navbar-btn" role="button">Rejestr uszkodzonych nośników komputerowych</a>
			 <?php endif;?>
 			 <?php if(@$acl["rejestry_ud"] > 0): ?>
			  <a href="<?php echo site_url("rejestry_ud");?>" class="btn btn-primary navbar-btn" role="button">Rejestr udostępniania danych</a>
			  <?php endif;?>
 			 <?php if(@$acl["rejestr_inc"] > 0): ?>
			  <a href="<?php echo site_url("rejestr_inc");?>" class="btn btn-primary navbar-btn" role="button">Rejestr incydentów</a>
		  		<?php endif;?>
 			 <?php if(@$acl["rejestr_u"] > 0): ?>
			  <a href="<?php echo site_url("rejestr_u");?>" class="btn btn-primary navbar-btn" role="button">Rejestr umów</a>

			  <?php endif;?>
        </div>
       
      </div>
    </nav>
<div class="well">
	 <?php if(@$acl["upo"] > 0): ?>
<ul><strong>Ewidencja Upoważnień</strong>
<ul>
	<?php foreach($zaklady as $item):?>
		<li>
			<a data-toggle="tooltip" rel="tooltip" data-placement="right"  title="Wygeneruj XLS" href='<?php echo site_url("rejestry/upowaznienia/".$item["id"]."");?>'><?php echo $item["nazwa_zakladu"];?></a></li>
	<?php endforeach;?>
</ul></ul>
<?php endif;?>
<?php if(@$acl["zbiory"] > 0): ?>
<ul><strong>Opis struktury zbiorów danych</strong>
<ul>
	<?php foreach($zaklady as $item):?>
		<li>
			<a data-toggle="tooltip" rel="tooltip" data-placement="right"  title="Wygeneruj PDF" href='<?php echo site_url("rejestry/struktury_zbiorow/".$item["id"]."");?>'><?php echo $item["nazwa_zakladu"];?></a></li>
	<?php endforeach;?>
</ul></ul>
<ul><strong>Opis zabezpieczeń zbiorów danych</strong>
<ul>
	<?php foreach($zaklady as $item):?>
		<li>
			<a data-toggle="tooltip" rel="tooltip" data-placement="right"  title="Wygeneruj PDF" href='<?php echo site_url("rejestry/struktury_zbiorow_zab/".$item["id"]."");?>'><?php echo $item["nazwa_zakladu"];?></a></li>
	<?php endforeach;?>
</ul></ul>
<?php endif;?>
 <?php if(@$acl["rejestr_pz"] > 0): ?>
<?php endif;?>
 <?php if(@$acl["rejestry_unk"] > 0): ?>
<ul><strong>Rejestr uszkodzonych nośników komputerowych</strong>
<ul>
	<?php foreach($zaklady as $item):?>
		<li>
			<a data-toggle="tooltip" rel="tooltip" data-placement="right"  title="Wygeneruj PDF" href='<?php echo site_url("rejestry/rejestr_unk_pdf/".$item["id"]."");?>'><?php echo $item["nazwa_zakladu"];?></a></li>
	<?php endforeach;?>
</ul></ul>
<?php endif;?>
 <?php if(@$acl["rejestry_ud"] > 0): ?>
<ul><strong>Rejestr udostępniania danych</strong>
<ul>
	<?php foreach($zaklady as $item):?>
		<li>
			<a data-toggle="tooltip" rel="tooltip" data-placement="right"  title="Wygeneruj PDF" href='<?php echo site_url("rejestry/rejestr_ud_pdf/".$item["id"]."");?>'><?php echo $item["nazwa_zakladu"];?></a></li>
	<?php endforeach;?>
</ul></ul>
<?php endif;?>
<ul><strong>Rejestr umów</strong>
<ul>
	<?php foreach($zaklady as $item):?>
		<li>
			<a data-toggle="tooltip" rel="tooltip" data-placement="right"  title="Wygeneruj PDF" href='<?php echo site_url("rejestry/rejestr_umow_pdf/".$item["id"]."");?>'><?php echo $item["nazwa_zakladu"];?></a></li>
	<?php endforeach;?>
</ul></ul>

</div>