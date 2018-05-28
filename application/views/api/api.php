<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="utf-8">
	<title>ABI Informatics - API dla klientów</title>
   <link rel="stylesheet" href="<?php echo base_url("css/bootstrap.min.css"); ?>">
	<link rel="stylesheet" href="<?php echo base_url("style.css"); ?>">
   <link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<style>
	body {
		background-color: #fff;
		margin: 20px 0;
		color: #4F5155;
	}
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	</style>
	<script src="<?php echo base_url("img/jquery-2.1.1.min.js");?>" ></script>
   <script src="<?php echo base_url("img/jquery-ui.min.js");?>"></script>
	<script src="<?php echo base_url("js/bootstrap.min.js");?>" ></script>

</head>
<body>
<div class="container">
<div class="table">
	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
	<h2><?php echo $zaklad->nazwa_zakladu." (".@$zaklad->miasto.", ".@$zaklad->adres.")</h2>";
	echo "<h4>NIP: ".@$zaklad->nip.", REGON: ".@$zaklad->regon."</h4>";?></h2>
	<?php 				 $zb = array(); $i=0;
	
							 foreach($zbiory as $zbior){
							 		 $zb[$zbior["nazwa"]][] = $zbior["dana"];
								}
							?>
								
							<?php foreach($zb as $k=>$v):?>
								<?php $i++; ?>
					 		  <div class="panel panel-default">
					 		    <div class="panel-heading" role="tab" id="<?=$i;?>" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$i;?>" aria-expanded="false" aria-controls="collapse<?=$i;?>">
					 		      <h4 class="panel-title">
					 		        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$i;?>" aria-expanded="false" aria-controls="collapse<?=$i;?>">
					 		          Zbiór <?=$k;?>
					 		        </a>
					 		      </h4>
					 		    </div>
					 		    <div id="collapse<?=$i;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="<?=$i;?>">
					 		      <div class="panel-body">
					 				  <table class="table table-striped">
									<tr>
														 <td width="40%"><strong>Zakres danych</strong></td>
														 <td width="60%">
								<li><strong><?= $k ?></strong></li><ul>
									<?php foreach($v as $value):?>
								<li><?= $value ?></li>
							<?php endforeach;?>
							</ul></td></tr>
							
				<?php foreach($podstawy_prawne as $podstawa):?>
					<?php if($podstawa["nazwa"] == $k):?>
								<tr>
									<td width="30%"><strong>Podstawy prawne</strong></td>
									<td width="70%"><?= $podstawa["podstawa_prze"]?></td>
								</tr>
							<?php endif;?>
						<?php endforeach;?>
									
							<?php foreach($zbiory_details as $detail):?>
								<?php if($detail["nazwa"] == $k):?>
							<tr>
								<td width="30%"><strong>Opis kategorii osób</strong></td>
								<td width="70%"><?= $detail["opis_kat_osob"]?></td>
							</tr>
							<tr>
								<td width="30%"><strong>Sposób zbierania danych</strong></td>
								<td width="70%"><?= $detail["sposob_zbierania_dan"]?></td>
							</tr>
							<tr>
								<td width="30%"><strong>Kategoria odbiorców</strong></td>
								<td width="70%"><?= $detail["kat_odbiorcow"]?></td>
							</tr>
							<tr>
								<td width="30%"><strong>Ew. przekazywanie danych do państw trzecich</strong></td>
								<td width="70%"><?= $detail["ew_przekaz_danych"]?></td>
							</tr>
						<?php endif;?>
					<?php endforeach;?>
					<tr>
										 <td width="30%"><strong>Rejestr umów</strong></td>
										 <td width="70%">
		 				
											 <?php foreach($umowy as $umowa):?>
								<?php if($umowa["nazwa"] == $k):?>
								 <table class="table table-border">
									<tr>
									<td width="30%"><strong>Nazwa firmy</strong></td>
									<td width="70%"><?= $umowa["nazwa_firmy"];?></td>
								   </tr>	
									<tr>
									<td width="30%"><strong>Cel przetwarzania</strong></td>
									<td><?= $umowa["kategoria_danych"];?></td>
								   </tr>
									<tr>
									<td width="30%"><strong>Data zawarcia</strong></td>
									<td><?= $umowa["data_zawarcia"];?></td>
								   </tr>
									<tr>
									<td width="30%"><strong>Data wygaśnięcia</strong></td>
									<td>
										<? if($umowa["data_wygas"] == "0000-00-00"): ?>
										czas nieokreślony
										<? else:?>
										<?= $umowa["data_wygas"];?>
									 <? endif;?>
										</td>
								   </tr>
									<tr>
									<td><strong>Zakres przetwarzania</strong></td>
									<td>&nbsp;<?php foreach($zakres as $val):?>
										<?php if($val["id_umowa"] == $umowa["id_umowa"] && $val["nazwa"] == $k ):?>
										<ul>
											<?php if($val["odczyt"] == 1): ?><li>odczyt</li><?php endif;?>
											<?php if($val["modyfikacja"] == 1): ?><li>modifkacja</li><?php endif;?>
											<?php if($val["wprowadzanie"] == 1): ?><li>wprowadzanie</li><?php endif;?>
											<?php if($val["usuwanie"] == 1): ?><li>usuwanie</li><?php endif;?>
											<?php if($val["archiwizacja"] == 1): ?><li>archiwizacja</li><?php endif;?>
										</ul>
									<?php endif;?>
									<?php endforeach;?>
										</td>
								   </tr>
									<tr>
									<td><strong>Data dokonania wpisu</strong></td>
									<td><?= $umowa["data_dokonania_wpisu"];?></td>
								   </tr>
									<tr>
									<td><strong>Typ aktualizacji</strong></td>
									<td><?php if($umowa["typ_aktualizacji"] == 0):?>
										wprowadzenie
									<?php elseif ($umowa["typ_aktualizacji"] == 1):?>
										modyfikacja
									<?php else:?>
										wykreślenie z rejestru
									<?php endif;?>
									</td>
								   </tr>
								</table>
								
								<?php endif; ?>
								
								<?php endforeach;?>
							</td></tr>

											 
											 
							
							
							
							
						</table>
								      </div>
								    </div>
								  </div>
	<? endforeach;?>
	
	
	
	
	
	
	

	</table>
	</div>
		
	<small>Rejestr zbiorów danych zgodnie z § 3 w zw. z § 5  Rozporządzenia  Ministra Administracji i Cyfryzacji z dnia 11 maja 2015 r. w sprawie sposobu  prowadzenia przez administratora bezpieczeństwa informacji rejestru zbiorów  danych (Dz.U. z 2015 r., poz. 719 z późn. zm.)</small>