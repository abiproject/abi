<p align="Left"><h2>Raport pokontrolny nr <?php echo $pok["nr"];?></h2></p><br />
		<table border="1" width="100%" cellpadding="5" cellspacing="0">
			<tr>
				<td><p align="Left">Miejsce kontroli: <?php echo $pok["miejsce"]; ?><br/>
Kierownik kontrolowanego obszaru: <?php echo $pok["kier_kontrolowanego_ob"]; ?><br />
Osoba(y) kontrolowane(e): <?php echo $pok["osoby_kontrolowane"]; ?>
				</p></td>
				<td><p align="Left">Termin wykonania kontroli: <?php echo $pok["termin"]; ?><br />
					Godzina rozpoczęcia: <?php echo $pok["godz_start"]; ?><br />
					Godzina zakończenia: <?php echo $pok["godz_meta"]; ?>
				</p></td>
			</tr>
			<tr>
				<td><p align="Left">Kontrolerzy: <?php echo $pok["kontrolerzy"]; ?><br /></p></td>
				<td><p align="Left">Kontrolowany obszar: <?php echo $pok["obszar_kontrolowany"]; ?><br /><br /></p></td>
			</tr>
		</table>
		Podstawa audytu (zaznacz właściwe):<br/>
		<table border="0" width="100%">
			<tr>
				<?php if($pok["podstawa"] == 1):?>
				<td><p align="Left">[<strong>X</strong>] - planowa kontrola,			</p>	</td>
				<td><p align="Center">[] - kontrola specjalna 		</p>	</td>
				<td><p align="Right">[] - kontrola sprawdzająca		</p>	</td>
			<?php elseif($pok["podstawa"] == 2):?>
				<td><p align="Left">[] - planowa kontrola,			</p>	</td>
				<td><p align="Center">[<strong>X</strong>] - kontrola specjalna 		</p>	</td>
				<td><p align="Right">[] - kontrola sprawdzająca		</p>	</td>
				<?php else: ?>
					<td><p align="Left">[] - planowa kontrola,			</p>	</td>
					<td><p align="Center">[] - kontrola specjalna 		</p>	</td>
					<td><p align="Right">[<strong>X</strong>] - kontrola sprawdzająca		</p>	</td>
			<?php endif;?>
			</tr>
		</table><br/><br/>
		<table border="1" width="100%" cellpadding="5" cellspacing="0">
			<tr>
				<td><p align="Center"><b>
					Zakres
				</b></p></td>
				<td><p align="Center">
<strong>Uchybienie / spostrzeżenie / (U1, U2, U3 ... lub S1, S2, S3 ...) </strong>
				</p></td>
			</tr>
			<tr>
				<td><p align="Left">
					Przesłanki legalności przetwarzania danych osobowych zwykłych i wrażliwych
				</p></td>
				<td><p align="Center"><?php echo $pok["uchybienie_1"]; ?></p></td>
			</tr>
			<tr>
				<td><p align="Left">Zakres i cel przetwarzania danych</p></td>
				<td><p align="Center"><?php echo $pok["uchybienie_2"]; ?></p></td>
			</tr>
			<tr>
				<td><p align="Left">
					Merytoryczna poprawność danych i ich adekwatność do celu przetwarzania
				</p></td>
				<td><p align="Center"><?php echo $pok["uchybienie_3"]; ?></p></td>
			</tr>
			<tr>
				<td><p align="Left">
					Obowiązek informacyjny (art. 24) dane osobowe zbierane od osoby, której dotyczą
				</p></td>
				<td><p align="Center"><?php echo $pok["uchybienie_4"]; ?></p></td>
			</tr>
			<tr>
				<td><p align="Left">
					Obowiązek informacyjny (art. 25) dane osobowe zbierane nie od osoby, której dotyczą
				</p></td>
				<td><p align="Center"><?php echo $pok["uchybienie_5"]; ?></p></td>
			</tr>
			<tr>
				<td><p align="Left">
					Zgłoszenie zbioru do rejestracji
				</p></td>
				<td><p align="Center"><?php echo $pok["uchybienie_6"]; ?></p></td>
			</tr>
			<tr>
				<td><p align="Left">
					Przekazywanie danych do państwa trzeciego
				</p></td>
				<td><p align="Center"><?php echo $pok["uchybienie_7"]; ?></p></td>
			</tr>
			<tr>
				<td><p align="Left">
					Powierzenie przetwarzania danych
				</p></td>
				<td><p align="Center"><?php echo $pok["uchybienie_8"]; ?></p></td>
			</tr>
			<tr>
				<td><p align="Left">
					Zabezpieczenia organizacyjne
				</p></td>
				<td><p align="Center"><?php echo $pok["uchybienie_9"]; ?></p></td>
			</tr>
			<tr>
				<td><p align="Left">
					Zabezpieczenia fizyczne
				</p></td>
				<td><p align="Center"><?php echo $pok["uchybienie_10"]; ?></p></td>
			</tr>
			<tr>
				<td><p align="Left">
					Zabezpieczenia infrastruktury informatycznej (informatycznej i telekomunikacyjnej)
				</p></td>
				<td><p align="Center"><?php echo $pok["uchybienie_11"]; ?></p></td>
			</tr>
			<tr>
				<td><p align="Left">
					Zabezpieczenia infrastruktury informatycznej (baz i aplikacji z danymi osobowymi)
				</p></td>
				<td><p align="Center"><?php echo $pok["uchybienie_12"]; ?></p></td>
			</tr>
			<tr>
				<td><p align="Left">
					Wymagania dla systemów przetwarzających dane osobowe
				</p></td>
				<td><p align="Center"><?php echo $pok["uchybienie_13"]; ?></p></td>
			</tr>
			<tr>
				<td><p align="Left">
					Zabezpieczenia osobowe
				</p></td>
				<td><p align="Center"><?php echo $pok["uchybienie_14"]; ?></p></td>
			</tr>
		</table><br/><p></p>
		<table border="0" width="100%">
			<tr>
				<td><p align="Left">
					Kontrolowany<br />
					.............................
				</p></td>
				<td><p align="Right">
					Kontroler <br />
					.............................
				</p></td>
			</tr>
		</table>
	</body>
</html>