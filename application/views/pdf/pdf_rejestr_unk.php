<p align="Left"><font size="10"><strong>Rejestr Uszkodzonych Nośników Komputerowych</strong></font></p>
<p></p><table border="1" cellspacing="0" cellpadding="2">
    <thead>
        <tr>
			<th style="text-align:center" width="25%"><strong>Nr protokołu</strong></th>
			<th style="text-align:center" width="25%"><strong>Data</strong></th>
			<th style="text-align:center" width="50%"><strong>Komórka</strong></th>
		  </tr>
    </thead><tbody>
<?php foreach($rejestr as $row):?>
<tr>
<td style="text-align: center;"  width="25%"><?php echo $row["nr"];?></td>
<td style="text-align: center;"  width="25%"><?php echo $row["data"];?></td>
<td style="text-align: center;"  width="50%"><?php echo $row["komorka"];?></td>
</tr>
<?php endforeach;?>
</tbody></table>
<p align="Left"><font size="10">Zakład pracy: <b><?php echo $row["nazwa_zakladu"];?></b></font></p>