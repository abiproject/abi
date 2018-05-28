<p align="center"><font size="12"><b>
			UPOWAŻNIENIE/<del>ANULOWANIE UPOWAŻNIENIA*</del> 			
			 Nr <?php echo $nr; ?></b></font>
		<br/>
	<font size="9"><b>do przetwarzania danych osobowych</b></font><br/>
	<b>w systemie informatycznym lub w zbiorze w wersji papierowej</b></font></p>
		<br/>
		<p><font size="9" >Z dniem <b><?php echo $data_od; ?></b> 
		upoważniam/<del>anuluję Upoważnienie Nr <b><?php echo $nr; ?></del>
		</b>*</font></p>
<p><font size="9" >
		<?php if($plec == "M"): ?>
		<del>Panią</del>/<del>Pani</del>/Pana*
		<?php else:?>
		Panią/<del>Pani</del>/<del>Pana</del>*
		<?php endif;?>
			
	<b><?php echo $nazwiskoimie; ?></b>,</font></p>
<p align="justify"><font size="9" >pracownika <b><?php echo $miejsce;?></b>,</font></font>
</p>
<br/><font size="9" >(nazwa jednostki i komórki organizacyjnej <?php echo $nazwa_zakladu;?>) </font></font>
<br/>
<br/><font size="9">a) <b>do obsługi systemu informatycznego:</b>
<br/>
<table width="100%" cellpadding="0" cellspacing="0" border="1">
	<col width="33%"><col width="33%"><col width="33%">
	<tr valign="top">
		<td width="33%">
			<p align="center"><strong>Nazwa systemu</strong></p>
		</td>
		<td width="33%" >
			<p align="center"><strong>Login</strong></p>
		</td>
		<td width="33%">
			<p align="center"><strong>Zakres*</strong></p>
		</td>
	</tr>
<?php foreach ($si as $item):?>
<?php if($item["login"] != NULL OR $item["zakres"] != NULL):?>
	<tr><td width="33%">
				<p align="center"><?php echo $item["nazwa"];?>
				</p>
			</td>
			<td width="33%">
				<p align="center"><?php echo $item["login"];?>
				</p>
			</td>
			<td width="33%" >
				<p align="center"><?php echo $item["zakres"];?>
				</p>
			</td>
		</tr>
	<?php endif;?>
<?php endforeach;?>
</table>
	<p align="center">*(O) Odczyt, (W) wprowadzania, (M) modyfikacji, (U) usuwania, (A) archiwizacji</p>
	<p><font size="9">b) <b>do obsługi zbioru w wersji papierowej</b></font>
		<br/>
	<table width="100%" cellpadding="0" cellspacing="0" border="1">
		<col width="50%"><col width="50%">
		<tr valign="top">
			<td width="50%" >
				<p  align="center"><strong>Nazwa zbioru</strong></p>
			</td>
			<td width="50%">
				<p  align="center"><strong>Zakres*</strong></p>
			</td>
		</tr>
<?php foreach ($zb as $item):?>
	<?php if($item["zakres"] != NULL):?>
			<tr><td width="50%">
						<p align="center"><?php echo $item["nazwa"];?>
						</p>
					</td>
					<td width="50%">
						<p align="center"><?php echo $item["zakres"];?>
						</p>
					</td>
				</tr>
			<?php endif;?>
<?php endforeach;?>
</table>
<p align="center">*(O) Odczyt, (W) wprowadzania, (M) modyfikacji, (U) usuwania, (A) archiwizacji</p>
<p align="justify"><font size="9">Zobowiązuję 
<?php if($plec == "M"):?>
	<del>Panią</del>/Pana*
	<?php else:?> 
	Panią/<del>Pana</del>*
<?php endif;?>
	do przestrzegania przepisów dotyczących ochrony danych osobowych oraz wprowadzonych i
wdrożonych do stosowania przez Administratora dokumentacji związanej z ochrona danych osobowych. W związku z niniejszym
upoważnieniem tracą moc poprzednie upoważnienia.</font></p>
	<table width="100%" cellpadding="0" cellspacing="0" border="0">
		<tr valign="top"><td width="50%"><p align="center"><?php echo $miasto;?>, 
				<?php echo $data_od; ?>
		</p></td>
			<td width="50%"><p align="center">................................</p></td>
		</tr>
		<tr valign="top"><td width="50%"><p align="center">(miejscowość
i data)</p></td>
			<td width="50%"><p align="center">(pieczęć i podpis ABI)</p></td>
		</tr>
	</table>
<br/><font size="10" >__________________________________________________________________</font></font><br/>
<p align="justify"><font size="9"><i><b>Wypełnia
Administrator danego systemu:</b></i></font></font>
</p>
<p ><font size="9" >Data
zarejestrowania w systemach:
............................................................................*</font></p>
<p><font size="9" >Data
wyrejestrowania użytkownika</font><br/>
<font size="9" >(zablokowania
dostępu) z systemu:
.........................................................................**</font></p>
<font size="9" ><p>Podpis
Administratora:
.............................................................................................</p>
<p>*) niepotrzebne skreślić<br/>
**) wypełnić w przypadku wydania upoważnienia</p></font>
</p>
</body>
</html>