<h3>Wyszukiwanie dla: <span class="label label-warning"><?php echo (strlen($wyszukiwanie) > 0) ? $wyszukiwanie : "%"; ?></span> - wyników: <span class="label label-info"><?php echo $suma;?></span> <a href="<?php echo site_url("admin/upo/clean");?>" role="button" class="btn btn-danger" data-toggle="tooltip" rel="tooltip" title="Reset wyników wyszukiwania"><span class="glyphicon glyphicon-trash"></span></a></h3>
<?php echo $pagination;?>
<table class="table table-bordered table-hover">
    <thead>
    <tr style="text-align: center;">
				<th style="text-align: center;">Nr</th>
				<th style="text-align: center;">Nazwisko i imię</th>
				<th style="text-align: center;">Miejsce Pracy</th>
				<th style="text-align: center;">Data od - Data do</th>
				<th style="text-align: center;">ASI</th>
				<th style="text-align: center;">ABI</th>
				<th style="text-align: center;">Opcje</th>
		</tr>
</thead>
<tbody>
<?php foreach ($row as $item):?>
<?php if($i%2 == 0): ?>
<tr class="odd">
<?php else: ?>
<tr>
<?php endif;?>			

<td style="text-align: center;"><?php echo $item["nr"];?></td>
<td style="text-align: left;"><?php if (isset($item["nazwiskoimie"])) echo $item["nazwiskoimie"];?></a></td>
<td style="text-align: center;"><?php echo $item["nazwa_zakladu"];?></td>
<td style="text-align: center;"><?php if (isset($item["data_od"])) echo $item["data_od"].' - '.$item["data_do"].' ';?>
<?php if (isset($item["data_do"])) if(date_create($item["data_do"]) < date_create(date("Y-m-d"))): ?>			
<a data-toggle="tooltip" rel="tooltip" title="Wygasłe upoważnienie"><img src="<?php echo base_url("img/red.png");?>"></a>
<?php elseif(date_create($item["data_do"]) < date_create($tydzien)):?>			
	<?php 	
	$interval = date_diff(date_create($tydzien),date_create($item["data_do"]));
	$dni = $interval->d;
	$zostalo = 15 - $dni;
	?>
<?php if($zostalo < 1):?>
<a data-toggle="tooltip" rel="tooltip" title="Upoważnienie dziś wygaśnie"><img src="<?php echo base_url("img/yellow.png");?>"></a>
<?php else:?>
<a data-toggle="tooltip" rel="tooltip" title="Upoważnienie wygaśnie za <?php echo $zostalo;?> dni"><img src="<?php echo base_url("img/yellow.png");?>"></a>
<?php endif;?>										
<?php else: ?>
<a data-toggle="tooltip" rel="tooltip" title="Aktualne upoważnienie"><img src="<?php echo base_url("img/green.png");?>"></a>
<?php endif;?>										
									<?php									
									
					if (isset($item["ASI"])) if($item["ASI"] > 0)
					{
						$asi = "<img src=".base_url("img/green.png").">";
					}
					else
					{                                               
						$asi = "<img src=".base_url("img/red.png").">";
					}                                               
					                                                
					if (isset($item["ABI"])) if($item["ABI"] > 0)                               
					{                                               
						$abi = "<img src=".base_url("img/green.png").">";
					}                                               
					else                                            
					{                                               
						$abi = "<img src=".base_url("img/red.png").">";
					}
					?>
									
</td>
<td style="text-align: center;"><?php if (isset($asi)) echo $asi;?></td>
<td style="text-align: center;"><?php if (isset($abi)) echo $abi;?></td>
<td style="text-align: center;">
<a data-toggle="tooltip" rel="tooltip" title="Wyczyść upoważnienie" href='<?php echo site_url("admin/upo/upo_wyczysc/".$item["uid"]."");?>'>
	<img src="<?php echo base_url("img/delete.png");?>"></a>
<a data-toggle="tooltip" rel="tooltip" title="Edytuj upoważnienie" href='<?php echo site_url("admin/upo_edytuj/".$item["uid"]."");?>'>
	<img src="<?php echo base_url("img/edit.png");?>"></a>
<a data-toggle="tooltip" rel="tooltip" title="Pobierz PDF upoważenienie" href='<?php echo site_url("export/pdf/".$item["uid"]."");?>'>
	<img src="<?php echo base_url("img/pdf.png");?>"></a>

	<span  data-toggle="modal" data-target="#myModal<?php echo $item["uid"] ?>">
		<a rel="tooltip" title="Cofnij upoważnienie" data-toggle="tooltip" >
	<img src="<?php echo base_url("img/back.png");?>"></a></span>
	<div id="myModal<?php echo $item["uid"] ?>" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Cofnij upoważnienie <?=$item["nazwiskoimie"];?>:</h4>
	      </div>
	      <div class="modal-body">
	        	<?php 
	  			$hidden = array("uid" => $item["uid"]);
	  			$atr = array(
	  				"class" => "form-inline",
	  				"role"  => "form");
	  			echo form_open('admin/upo/cofnij/',$atr,$hidden); ?>
	  			 <div class="form-group">
	  				  <label for="data">Data cofnięcia upoważnienia: </label>
					  <script>
					    $(function() {
					  $("#datepicker<?php echo $item["uid"] ?>").datepicker({
					  					  changeMonth: true,
					  				      changeYear: true,
					  					  dateFormat: "yy-mm-dd",
					  					  locale: "pl" });
									  });
					  </script>
			  <input class="form-control" name="data_cofniecia" AUTOCOMPLETE=OFF type="text" id="datepicker<?php echo $item["uid"] ?>"></p>
		
	  			</span> </div> 
	  		</fieldset>
	  		      </div>
	  		      <div class="modal-footer">
	  		 		  <button type="button" class="btn btn-default" data-dismiss="modal">Anuluj</button>
			        <button type="submit" class="btn btn-success">Cofnij upoważnienie</button>
	  		</form>
	      </div>
	    </div>

	  </div>
	</div>
<a data-toggle="tooltip" rel="tooltip" title="Pobierz PDF - Anulowane upoważnienie" href='<?php echo site_url("export/pdf/".$item["uid"]."/anuluj");?>'>
		<img src="<?php echo base_url("img/pdf_a.png");?>"></a>
<a data-toggle="tooltip" rel="tooltip" title="Przedłuż upoważnienie o 5 lat" href='<?php echo site_url("admin/upo/5lat/".$item["uid"]."");?>'>
		<img src="<?php echo base_url("img/time.png");?>"></a>		
	</td>
</tr>
<?php $i++;?>
<?php endforeach;?>
</tbody></table>
<?php echo $pagination;?>