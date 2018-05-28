<h2>Rejestr incydentów:</h2>
<?php if(strlen($error) > 0) echo '<div class="alert alert-danger" role="alert" id="errorMsg">'.$error.'</div>';?>
<?php if(strlen($msg) > 0) echo '<div class="alert alert-success" role="alert" id="okMsg">'.$msg.'</div>';?>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
			<th style="text-align:center">Nr</th>
			<th style="text-align:center">Zakład</th>
			<th style="text-align:center">Data wykrycia</th>
			<th style="text-align:center">Opis incydnetu</th>
			<th style="text-align:center">Data zgłoszenia do ADO</th>
			<th style="text-align:center">Opis procedury naprawczej</th>			
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
<td style="text-align: center;"><?php echo $row["data_wykrycia"];?></td>
<td style="text-align: center;"><?php echo $row["opis"];?></td>
<td style="text-align: center;"><?php echo $row["data_zgloszenia"];?></td>
<td style="text-align: center;"><?php echo $row["opis_pr_napr"];?></td>
<td style="text-align: center;">
<a data-toggle="tooltip" rel="tooltip" title="Usuń pozycję" href='<?php echo site_url("rejestr_inc/index/usun/".$row["id"]."");?>'>
	<img src="<?php echo base_url("img/delete.png");?>"></a></td>
	<?php $i++; ?>
	<?php endforeach;?>
</tbody></table>