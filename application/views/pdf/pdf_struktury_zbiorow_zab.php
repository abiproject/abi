<h2>Wykaz zabezpieczeń zbiorów danych osobowych</h2>
<strong>Legenda:</strong>
<ul>
<li><strong>(1)</strong> nazwa zwyczajowa lub własna, np.: dane osobowe, dokumentacja ZFŚS,  baza klientów stałych,</li>
<li><strong>(2)</strong> np.: mySQL, Oracle, MS SQL, PostgreSQL, baza zewnętrza (outsourcing)</li>
<li><strong>(3)</strong> np.: (I) indywidualne hasło dostępu do bazy danych, (S) szyfrowanie danych, (F) wydzielona fizycznie sieć, (UPSB) – UPS bazy</li>
<li><strong>(4)</strong> (S) – serwerownia, (K) – miejsce przechowywania kopii bezpieczeństwa, (U) – pomieszczenia użytkowników, (PI) – pomieszczenie informatyka</li>
<li><strong>(5)</strong> (K) – kraty w oknach, (A) – alarm, (W) – wzmocnienie drzwi, (D) – dozór całodobowy, (KD) – kontrola dostępu, (KL) – klimatyzacja, (SP) – sygnalizacja PPOŻ, (GAS) –gaśnice, (ZP) – zamki patentowe,  (SF)- Sejf, (SO) – Sejf Ogniotrwały, (SK)- szafa zamykana na klucz, (UPS) – UPS stacji</li>
</ul>
<table border="1" cellpadding="3" cellspacing="0">
    <thead>
        <tr>
			<th width="3%" style="text-align:center"><strong>Lp</strong></th>
			<th width="8%" style="text-align:center"><strong>Nazwa zbioru danych (1)</strong></th>
			<th width="8%" style="text-align:center"><strong>Baza danych (2)</strong></th>
         <th width="11%" style="text-align:center"><strong>Zabezpieczenie bazy (3)</strong></th>
         <th width="10%" style="text-align:center"><strong>Program służący do<br/>przetwarzania baz danych</strong></th>
         <th style="text-align:center"><strong>Rejestracja w GIODO</strong></th>
         <th style="text-align:center"><strong>Lokalizacja (4)</strong></th>
         <th style="text-align:center"><strong>Nr pokoju, piętro</strong></th>
         <th style="text-align:center"><strong>Funkcja lokalizacji (4)</strong></th>
         <th width="11%" style="text-align:center"><strong>Zabezpieczenia fizyczne (5)</strong></th>
         <th width="13%" style="text-align:center"><strong>Podstawa<br/>przetwarzania</strong></th>
        </tr>
    </thead><tbody>
  <?php $i=1;?>
	<?php foreach($zbiory as $row):?>	 
<tr>
<td width="3%" style="text-align: center;"><?php echo $i;?></td>
<td width="8%" style="text-align: center;"><?php echo $row["nazwa"];?></td>
<td width="8%" style="text-align: center;"><?php echo $row["baza_danych"];?></td>
<td width="11%" style="text-align: center;"><?php echo $row["zab_bazy"];?></td>
<td width="10%" style="text-align: center;"><?php echo $row["program"];?></td>
<?php if($row["giodo"] ==  1):?>
	<td style="text-align: center;">TAK</td>	
<?php else:?>
	<td style="text-align: center;">NIE</td>
<?php endif;?>
<td style="text-align: center;"><?php echo $row["lokalizacja"];?></td>
<td style="text-align: center;"><?php echo $row["pokoj_pietro"];?></td>
<td style="text-align: center;"><?php echo $row["f_lokalizacji"];?></td>
<td width="11%" style="text-align: center;"><?php echo $row["zab_fizyczne"];?></td>
<td width="13%" style="text-align: center;"><?php echo $row["podstawa_prze"];?></td>
</tr>	<?php $i++; ?>
	<?php endforeach;?>
</tbody></table>
</div></div>