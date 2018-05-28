<h2>Spis użytkowników</h2>
<?php if(strlen($wyszukiwanie) > 2) echo "<h4>Wyszukiwanie dla: ".$wyszukiwanie."</h4>"; ?>
<br/><?php echo $pagination;?>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
			<th style="text-align:center">Nazwisko i imię [Login]</th>
			<th style="text-align:center">Ostatnie logowanie</th>
			<th style="text-align:center">Uprawnienia</th>
         <th style="text-align:center">Opcje</th>
        </tr>
    </thead><tbody>
  <?php $i=0;?>
	<?php foreach($uzytkownicy as $row):?>	 
			<?php if($i%2 == 0):?>
				<tr class="odd">
			<?php else:?>
					<tr>
			<?php endif;?>

<td><?php echo $row["nazwa"];?> [<?php echo $row["login"];?>]</td>
<td style="text-align: center;"><?php echo $row["last_log"];?></td>
<td style="text-align: center;">
	<a data-toggle="tooltip" rel="tooltip" title="Edytuj uprawnienia użytkownika" href='<?php echo site_url("uzytkownicy/acl/".$row["id"]."");?>'>
		<img src="<?php echo base_url("img/acl.png");?>"></a>
</td>
<td style="text-align: center;">
	<a data-toggle="tooltip" rel="tooltip" title="Wygeneruj nowe hasło" href='<?php echo site_url("uzytkownicy/index/haslo/".$row["id"]."");?>'><img src="<?php echo base_url("img/key.png");?>"></a>
	

<?php if($row["aktywne_konto"] == 1):?>
	<a data-toggle="tooltip" rel="tooltip" title="Zablokuj konto użytkownika" href='<?php echo site_url("uzytkownicy/index/zablokuj/".$row["id"]."");?>'>
		<img src="<?php echo base_url("img/nolock.png");?>"></a>
<?php else:?>
	<a data-toggle="tooltip" rel="tooltip" title="Odblokuj konto użytkownika" href='<?php echo site_url("uzytkownicy/index/odblokuj/".$row["id"]."");?>'>
		<img src="<?php echo base_url("img/lock.png");?>"></a>
<?php endif?>
<a data-toggle="tooltip" rel="tooltip" title="Edytuj użytkownika" href='<?php echo site_url("uzytkownicy/edytuj/".$row["id"]."");?>'>
	<img src="<?php echo base_url("img/grupa_e.png");?>"></a>
<a data-toggle="tooltip" rel="tooltip" title="Usuń konto użytkownika" href='<?php echo site_url("uzytkownicy/index/usun/".$row["id"]."");?>'>
	<img src="<?php echo base_url("img/delete.png");?>"></a>
				</td>
		</tr>	<?php $i++; ?>
	<?php endforeach;?>
</tbody></table>
