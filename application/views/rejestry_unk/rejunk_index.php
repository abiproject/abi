<h2>Rejestr podmiotów zewnętrznych:</h2>
<?php if(strlen($error) > 0) echo '<div class="alert alert-danger" role="alert" id="errorMsg">'.$error.'</div>';?>
<?php if(strlen($msg) > 0) echo '<div class="alert alert-success" role="alert" id="okMsg">'.$msg.'</div>';?>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
			<th style="text-align:center">Nr</th>
			<th style="text-align:center">Zakład</th>
			<th style="text-align:center">Data</th>
			<th style="text-align:center">Komórka</th>
			<th style="text-align:center">Opcje</th>
		  </tr>
    </thead><tbody>
  <?php $i=0;?>
	<?php foreach($rejestr as $row):?>	 
			<?php if($i%2 == 0):?>
				<tr class="odd">
			<?php else:?>
					<tr>
			<?php endif;?>

<td style="text-align: center;"><?php echo $row["nr"];?></td>
<td style="text-align: center;"><?php echo $row["nazwa_zakladu"];?></td>
<td style="text-align: center;"><?php echo $row["data"];?></td>
<td style="text-align: center;"><?php echo $row["komorka"];?></td>
<td style="text-align: center;">
<a data-toggle="tooltip" rel="tooltip" title="Wydrukuj protokół" href='<?php echo  site_url("rejestry_unk/drukuj/".$row["id"]."");?>'>
<img src="<?php echo base_url("img/pdf.png");?>"></a>
<a data-toggle="tooltip" rel="tooltip" title="Usuń pozycję" href='<?php echo site_url("rejestry_unk/index/usun/".$row["id"]."");?>'>
	<img src="<?php echo base_url("img/delete.png");?>"></a></td>
	<?php $i++; ?>
	<?php endforeach;?>
</tbody></table>