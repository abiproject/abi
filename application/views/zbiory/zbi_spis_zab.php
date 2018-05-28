<strong>Legenda:</strong><br/>
<ul>
<li><strong>(1)</strong> nazwa zwyczajowa lub własna, np.: dane osobowe, dokumentacja ZFŚS,  baza klientów stałych,</li>
<li><strong>(2)</strong> np.: MySQL, Oracle, MS SQL, PostgreSQL, baza zewnętrza (outsourcing)</li>
<li><strong>(3)</strong> np.: (I) indywidualne hasło dostępu do bazy danych, (S) szyfrowanie danych, (F) wydzielona fizycznie sieć, (UPSB) – UPS bazy</li>
<li><strong>(4)</strong> (S) – serwerownia, (K) – miejsce przechowywania kopii bezpieczeństwa, (U) – pomieszczenia użytkowników, (PI) – pomieszczenie informatyka</li>
<li><strong>(5)</strong> (K) – kraty w oknach, (A) – alarm, (W) – wzmocnienie drzwi, (D) – dozór całodobowy, (KD) – kontrola dostępu, (KL) – klimatyzacja, (SP) – sygnalizacja PPOŻ, (GAS) –gaśnice, (ZP) – zamki patentowe,  (SF)- Sejf, (SO) – Sejf Ogniotrwały, (SK)- szafa zamykana na klucz, (UPS) – UPS stacji</li>
</ul>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
			<th style="text-align:center; vertical-align: middle">Lp</th>
			<th style="text-align:center; vertical-align: middle">Nazwa zbioru danych (1)</th>
			<th style="text-align:center; vertical-align: middle">Baza danych (2)</th>
         <th style="text-align:center; vertical-align: middle">Zabezpieczenie bazy (3)</th>
         <th style="text-align:center; vertical-align: middle">Program służący do przetwarzania baz danych</th>
         <th style="text-align:center; vertical-align: middle">Rejestracja w GIODO</th>
         <th style="text-align:center; vertical-align: middle">Lokalizacja (4)</th>
         <th style="text-align:center; vertical-align: middle">Nr pokoju, piętro</th>
         <th style="text-align:center; vertical-align: middle">Funkcja lokalizacji (4)</th>
         <th style="text-align:center; vertical-align: middle">Zabezpieczenia fizyczne (5)</th>
         <th style="text-align:center; vertical-align: middle">Podstawa przetwarzania</th>
        </tr>
    </thead><tbody>
  <?php $i=1;?>
	<?php foreach($zbiory as $row):?>	 
			<?php if($i%2 == 0):?>
				<tr class="odd">
			<?php else:?>
					<tr>
			<?php endif;?>

<td style="text-align: center;"><?php echo $i;?></td>
<td style="text-align: center;"><a href="<?php echo site_url("zbiory/edytuj_zab/".$row["id"]."/".$slownik_id."");?>"><?php echo $row["nazwa"];?></a></td>
<td style="text-align: center;"><?php echo $row["baza_danych"];?></td>
<td style="text-align: center;"><?php echo $row["zab_bazy"];?></td>
<td style="text-align: center;"><?php echo $row["program"];?></td>
<?php if($row["giodo"] ==  1):?>
	<td style="text-align: center;">TAK</td>	
<?php else:?>
	<td style="text-align: center;">NIE</td>
<?php endif;?>
<td style="text-align: center;"><?php echo $row["lokalizacja"];?></td>
<td style="text-align: center;"><?php echo $row["pokoj_pietro"];?></td>
<td style="text-align: center;"><?php echo $row["f_lokalizacji"];?></td>
<td style="text-align: center;"><?php echo $row["zab_fizyczne"];?></td>
<td style="text-align: center;"><?php echo $row["podstawa_prze"];?></td>
</tr>	<?php $i++; ?>
	<?php endforeach;?>
</tbody></table></div></div>