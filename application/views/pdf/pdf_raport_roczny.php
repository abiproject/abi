<h2>Roczny raport stanu Systemu Ochrony Danych Osobowych</h2>
<h3>Raport nr <strong><?php echo $rap["nr"]; ?> </strong></h3>
<table border="1" width="100%" cellpadding="5" cellspacing="0">
			<tr>
				<td>Uczestnicy przeglądu: <?php echo $rap["uczestnicy"]; ?></td>
				<td>Termin przeprowadzenia przeglądu: <?php echo $rap["termin"]; ?></td>
			</tr>
		</table><br />
		<table border="1" width="100%" cellpadding="5" cellspacing="0">
			<tr>
				<td>Zagadnienia omawiane na przeglądzie: <?php echo $rap["zagadnienia"]; ?></td>
				<td>Komentarze  / uwagi: <?php echo $rap["uwagi"]; ?></td>
			</tr>
		</table><br />
		<table border="1" width="100%" cellpadding="5" cellspacing="0">
			<tr>
				<td>Podsumowanie realizacji zadań z poprzedniego przeglądu</td>
				<td width="50%"><?php echo $rap["podsumowanie"]; ?></td>
			</tr>
			<tr>
				<td>Omówienie wyników kontroli przeprowadzonych</td>
				<td><?php echo $rap["omowienie"]; ?></td>
			</tr>
			<tr>
				<td>Omówienie zarejestrowanych incydentów oraz ilości i powodów ich wystąpienia</td>
				<td><?php echo $rap["omowienie_2"]; ?></td>
			</tr>
			<tr>
				<td>Proponowane zadania do realizacji</td>
				<td><?php echo $rap["propozycje"]; ?></td>
			</tr>
		</table><br />
		<p align="Left">
			Podpisy uczestników przeglądu:
		</p>
