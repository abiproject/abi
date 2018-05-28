<p align="Left"><font size="10"><strong>Rejestr Umów</strong></font></p>
<p></p><table border="1" cellspacing="0" cellpadding="2">
    <thead>
        <tr>
			<th style="text-align:center" width="4%"><strong>Lp</strong></th>
			<th style="text-align:center" width="25%"><strong>Nazwa firmy</strong></th>
			<th style="text-align:center" width="25%"><strong>Cel przetwarzania</strong></th>
			<th style="text-align:center" width="21%"><strong>Data</strong></th>
			<th style="text-align:center" width="25%"><strong>Dodatkowe informacje</strong></th>
		  </tr>
    </thead><tbody>
<?php $i=1;?>
<?php foreach($rejestr as $row):?>
<tr>
<td style="text-align: center;"  width="4%"><?php echo $i;?></td>
<td style="text-align: center;"  width="25%"><?php echo $row["nazwa_firmy"];?></td>
<td style="text-align: center;"  width="25%"><?php echo $row["kategoria_danych"];?></td>
<td style="text-align: center;"  width="21%"><?php echo $row["data_zawarcia"];?> - <?php if($row["data_wygas"] == "0000-00-00"):?>nieokreślony<?php else:?><?php echo $row["data_wygas"];?><?php endif;?></td>
<td style="text-align: center;"  width="25%"><?php 
if ($row["umowa_posiada"] == 0) { echo "Nic" ;}
if ($row["umowa_posiada"] == 1) { echo "Umowa powierzenia poufności";}
if ($row["umowa_posiada"] == 2) { echo "Oświadczenie";}
if ($row["umowa_posiada"] == 3) { echo "Klauzula";}



?></td></tr>
<?php $i++;?>
<?php endforeach;?>
</tbody></table>
<p align="Left"><font size="10">Zakład pracy: <b><?php echo $row["nazwa_zakladu"];?></b></font></p>