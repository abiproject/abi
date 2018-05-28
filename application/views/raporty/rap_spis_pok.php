<h2>Raporty pokontrolne ODO:</h2>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
			<th style="text-align:center">Nr</th>
			<th style="text-align:center">Zakład</th>
			<th style="text-align:center">Miejsce</th>
			<th style="text-align:center">Termin</th>
			<th style="text-align:center">Kierownik kontrolowanego obszaru</th>
			<th style="text-align:center">Osoby kontrolowane</th>
			<th style="text-align:center">Opcje</th>
		  </tr>
    </thead><tbody>
  <?php $i=0;?>
	<?php foreach($raporty_pok as $row):?>	 
			<?php if($i%2 == 0):?>
				<tr class="odd">
			<?php else:?>
					<tr>
			<?php endif;?>

<td style="text-align: center;"><?php echo $row["nr"];?></td>
<td style="text-align: center;"><?php echo $row["nazwa_zakladu"];?></td>
<td style="text-align: center;"><?php echo $row["miejsce"];?></td>
<td style="text-align: center;"><?php echo $row["termin"];?></td>
<td style="text-align: center;"><?php echo $row["kier_kontrolowanego_ob"];?></td>
<td style="text-align: center;"><?php echo $row["osoby_kontrolowane"];?></td>
<td style="text-align: center;">
<a data-toggle="tooltip" rel="tooltip" title="Drukuj raport" href='<?php echo site_url("raporty/pokontrolny/pdf/".$row["rid"]."");?>'>
	<img src="<?php echo base_url("img/pdf.png");?>"></a>
<a data-toggle="tooltip" rel="tooltip" title="Usuń raport" href='<?php echo site_url("raporty/pokontrolny/usun/".$row["rid"]."");?>'>
	<img src="<?php echo base_url("img/delete.png");?>"></a></td>
	<?php $i++; ?>
	<?php endforeach;?>
</tbody></table>
