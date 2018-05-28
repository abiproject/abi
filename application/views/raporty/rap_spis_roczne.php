<h2>Raporty roczne ODO:</h2>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
			<th style="text-align:center">Nr</th>
			<th style="text-align:center">Zakład</th>
			<th style="text-align:center">Termin</th>
			<th style="text-align:center">Uczestnicy przeglądu</th>
			<th style="text-align:center">Zagadnienia</th>
			<th style="text-align:center">Opcje</th>
		  </tr>
    </thead><tbody>
  <?php $i=0;?>
	<?php foreach($raporty as $row):?>	 
			<?php if($i%2 == 0):?>
				<tr class="odd">
			<?php else:?>
					<tr>
			<?php endif;?>

<td style="text-align: center;"><?php echo $row["nr"];?></td>
<td style="text-align: center;"><?php echo $row["nazwa_zakladu"];?></td>
<td style="text-align: center;"><?php echo $row["termin"];?></td>
<td style="text-align: center;"><?php echo $row["uczestnicy"];?></td>
<td style="text-align: center;"><?php echo $row["zagadnienia"];?></td>
<td style="text-align: center;">
<a data-toggle="tooltip" rel="tooltip" title="Drukuj raport" href='<?php echo site_url("raporty/roczny/pdf/".$row["rid"]."");?>'>
	<img src="<?php echo base_url("img/pdf.png");?>"></a>
<a data-toggle="tooltip" rel="tooltip" title="Usuń raport" href='<?php echo site_url("raporty/roczny/usun/".$row["rid"]."");?>'>
	<img src="<?php echo base_url("img/delete.png");?>"></a></td>
	<?php $i++; ?>
	<?php endforeach;?>
</tbody></table>