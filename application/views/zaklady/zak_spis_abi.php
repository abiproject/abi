<div class="panel panel-warning">
            <div class="panel-heading">
              <h3 class="panel-title">Dodaj nowe zgłoszenie</h3>
            </div>
            <div class="panel-body">
<a class="btn btn-success" href='<?php echo site_url("zaklady/abi_dodaj/".$zaklad[0]['id']."");?>'>
	<span class="glyphicon glyphicon-plus-sign"></span> <?php echo $zaklad[0]["nazwa_zakladu"];?></a>
</div></div>


<h2>Spis zgłoszeń ABI do GIODO:</h2>
<?php if(strlen($error) > 0) echo '<div class="alert alert-danger" role="alert" id="errorMsg">'.$error.'</div>';?>
<?php if(strlen($msg) > 0) echo '<div class="alert alert-success" role="alert" id="okMsg">'.$msg.'</div>';?>
<?php echo $pagination;?>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
			<th style="text-align:center">Nazwa zakładu</th>
			<th style="text-align:center">Imię nazwisko ABI</th>
			<th style="text-align:center">Data powołania</th>
			<th style="text-align:center">Data odowłania</th>
         <th style="text-align:center">Opcje</th>
        </tr>
    </thead><tbody>
  <?php $i=0;?>
	<?php foreach($abi as $row):?>	 
			<?php if($i%2 == 0):?>
				<tr class="odd">
			<?php else:?>
					<tr>
			<?php endif;?>

<td style="text-align: center;"><?php echo $row["nazwa_zakladu"];?></td>
<td style="text-align: center;"><?php echo $row["imie_nazwisko"];?></td>
<td style="text-align: center;"><?php echo $row["data_powolania"];?></td>
<td style="text-align: center;"><span data-toggle="tooltip" rel="tooltip" title="<?= $row["przyczyna_od"];?>"><?php echo $row["data_odwolania"];?></span></td>
<td style="text-align: center;">
	<a data-toggle="tooltip" rel="tooltip" title="Pobierz PDF" href='<?php echo site_url("export/pdf_abi/".$row["id_abi"]."");?>'>
		<img src="<?php echo base_url("img/pdf.png");?>"></a>

	<a data-toggle="tooltip" rel="tooltip" title="Usuń zgłoszenie" href='<?php echo site_url("zaklady/abi/usun/".$row["id_abi"]."");?>'>
		<img src="<?php echo base_url("img/delete.png");?>"></a>
	<a data-toggle="modal" rel="tooltip" title="Odwołaj ABI" data-target="#myModal<?= $row["id_abi"]?>"  type="button" href='#'>
		<img src="<?php echo base_url("img/back.png");?>"></a>
	
		<div class="modal fade" id="myModal<?= $row["id_abi"]?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Odwołanie ABI <?=$row["imie_nazwisko"];?> </h4>
		      </div>
		      <div class="modal-body">
				<?php 
				$atr = array(
					"class" => "form",
					"role"  => "form");
					$hid = array(
							"uid" => $zaklad[0]['id']
						);
				echo form_open('zaklady/abi/odwolaj/'.$row["id_abi"],$atr,$hid); ?>
           <div class="form-group">
             <label for="przyczyna" class="control-label">Data odwołania ABI:</label>
             <input class="form-control datepick" name="data_odwolania" AUTOCOMPLETE=OFF type="text" placeholder="Data odwołania">
           </div>
	           <div class="form-group">
	             <label for="przyczyna" class="control-label">Podaj przyczynę odwołania ABI:</label>
	             <textarea class="form-control" name="przyczyna" id="przyczyna"></textarea>
	           </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
		        <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
		      </div>
				</form>
		    </div>
		  </div>
		</div>
	<a data-toggle="tooltip" rel="tooltip" title="Pobierz PDF - Odwołanie ABI" href='<?php echo site_url("export/pdf_abi/".$row["id_abi"]."/odwolaj");?>'>
			<img src="<?php echo base_url("img/pdf_a.png");?>"></a>
	
			<?php $i++; ?>
	<?php endforeach;?>
</tbody></table>
