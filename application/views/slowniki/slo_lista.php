<h2>Wybierz słownik do modyfikacji:</h2>
<?php foreach ($row as $item):?>
<a class="btn btn-info" href=<?php echo site_url("slowniki/index/".$item['id']."");?>><?php echo $item['nazwa'];?></a>
<?php endforeach;?><br/><br/>


<?php if((!empty($zbiory_bez_zakresu) or !empty($zbiory_bez_zab)) and $show == 1) : ?>
<div class="alert alert-danger" role="alert">
  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
<strong>Napraw poniższe błędy:</strong><br/>
<ul>
	<?php if(!empty($zbiory_bez_zakresu)):?>
<br/><strong>Zbiory bez zakresu gromadzonych danych:</strong><br/>
	  <?php foreach($zbiory_bez_zakresu as $item):?>
   <?= $item["nazwa"];?>, 
 <?php endforeach;?>
<?php endif;?>

	<?php if(!empty($zbiory_bez_zab)):?>
<br/><strong>Zbiory bez wpisu o zabezpieczeniu gromadzonych danych:</strong><br/>
	  <?php foreach($zbiory_bez_zab as $item):?>
   <?= $item["nazwa"];?>, 
 <?php endforeach;?>
<?php endif;?>
  </ul>
</div>
<?php endif;?>
