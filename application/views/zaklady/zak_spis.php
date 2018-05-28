<h2>Spis zakładów:</h2>
<?php if(strlen($error) > 0) echo '<div class="alert alert-danger" role="alert" id="errorMsg">'.$error.'</div>';?>
<?php if(strlen($msg) > 0) echo '<div class="alert alert-success" role="alert" id="okMsg">'.$msg.'</div>';?>
<!-- <?php echo $pagination;?> --!>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
			<th style="text-align:center">Nazwa zakładu</th>
			<th style="text-align:center">Miasto</th>
			<th style="text-align:center">Adres</th>
			<th style="text-align:center">NIP</th>
			<th style="text-align:center">REGON</th>
         <th style="text-align:center">Opcje</th>
        </tr>
    </thead><tbody>
  <?php $i=0;?>
	<?php foreach($zaklady as $row):?>	 
			<?php if($i%2 == 0):?>
				<tr class="odd">
			<?php else:?>
					<tr>
			<?php endif;?>

<td><?php echo $row["nazwa_zakladu"];?> </td>
<td style="text-align: center;"><?php echo $row["miasto"];?></td>
<td style="text-align: center;"><?php echo $row["adres"];?></td>
<td style="text-align: center;"><?php echo $row["nip"];?></td>
<td style="text-align: center;"><?php echo $row["regon"];?></td>
<td style="text-align: center;">
	<?php if(isset($row["api_key"])):?>
<a data-toggle="tooltip" rel="tooltip" title="Link do API" href="https://abi.informatics.jaworzno.pl/index.php/api/giodo/<?php echo $row['api_key'];?>">
	<img src="<?php echo base_url("img/api_link.png");?>"></a>	
	<?php else:?>
<a data-toggle="tooltip" rel="tooltip" title="Dodaj API" href='<?php echo site_url("zaklady/index/api_dodaj/".$row["id"]."");?>'>
	<img src="<?php echo base_url("img/api_add.png");?>"></a>
	<?php endif;?>
<a data-toggle="tooltip" rel="tooltip" title="Zgłoszenie Powołania/Odwołania ABI do GIODO" href='<?php echo site_url("zaklady/abi/".$row["id"]."");?>'>
	<img src="<?php echo base_url("img/abi.png");?>"></a>
<a data-toggle="tooltip" rel="tooltip" title="Edytuj zakład" href='<?php echo site_url("zaklady/edytuj/".$row["id"]."");?>'>
	<img src="<?php echo base_url("img/grupa_e.png");?>"></a>
<a data-toggle="tooltip" rel="tooltip" title="Usuń zakład (tylko w przypadku braku pracowników w danym zakładzie)" href='<?php echo site_url("zaklady/index/usun/".$row["id"]."");?>'>
	<img src="<?php echo base_url("img/delete.png");?>"></a>
			<?php $i++; ?>
	<?php endforeach;?>
</tbody></table>
