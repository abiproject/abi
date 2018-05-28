<p align="Left"><font size="10"><strong>Ewidencja udostępniania danych</strong></font></p>
<p></p><table border="1" cellspacing="0" cellpadding="2">
    <thead>
        <tr>
			<th style="text-align:center" width="4%"><strong>Lp</strong></th>
			<th style="text-align:center" width="10%"><strong>Data udostępnienia danych</strong></th>
			<th style="text-align:center" width="19%"><strong>Podmiot, któremu dane udostępniono</strong></th>
			<th style="text-align:center" width="19%"><strong>Podstawa prawna udostępnienia danych</strong></th>
			<th style="text-align:center" width="19%"><strong>Zakres udostępnionych danych</strong></th>
			<th style="text-align:center" width="19%"><strong>Dane osobowe</strong></th>
			<th style="text-align:center" width="10%"><strong>Uwagi</strong></th>					
		  </tr>
    </thead><tbody>
	<?php $i=$lp; ?>
<?php foreach($rejestr as $row):?>
<tr>
<td style="text-align: center;"  width="4%"><?php echo $i;?></td>
<td style="text-align: center;"  width="10%"><?php echo $row["data"];?></td>
<td style="text-align: center;"  width="19%"><?php echo $row["podmiot"];?></td>
<td style="text-align: center;"  width="19%"><?php echo $row["podstawa_prawna"];?></td>
<td style="text-align: center;"  width="19%"><?php echo $row["zakres"];?></td>
<td style="text-align: center;"  width="19%"><?php echo $row["dane_osobowe"];?></td>
<td style="text-align: center;"  width="10%"><?php if($row["flaga"] == 0) echo "odmowa";?></td>
</tr>
<?php $i++;?>
<?php endforeach;?>
</tbody></table>
<p align="Left"><font size="10">Zakład pracy: <b><?php echo $row["nazwa_zakladu"];?></b></font></p>
