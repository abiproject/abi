<div class="well"><h3>Opis struktury zbiorów danych wskazujący zawartość poszczególnych pól informacyjnych i powiązania między systemami <u> [ <?php foreach($row as $item):?>	
								<? if($zaklad_id == $item["id"]):?>
									<?php echo $item["nazwa_zakladu"];?>
								<? endif;?>
							<?php endforeach;?>]</u>
</h3></p>
<strong>1. Wykaz zbiorów wraz z zakresami gromadzonych danych</strong>
<p></p>
<?php 
//var_dump($row);
foreach($zbiory as $row)
{
	if(!isset($nazwa) or $nazwa != $row["nazwa"])
	{
		echo "<h3>Zbiór ".$row["nazwa"]."";
		// echo "<a data-toggle=\"tooltip\" rel=\"tooltip\" title=\"Edycja zakresu gromadzonych danych\" href=\"".site_url("zbiory/edytuj/".$row["id"]."")."\"><img src=\"".base_url("img/zakres_zbiorow.png")."\"></a></h3>";
	echo ' <a type="button" data-toggle="tooltip" rel="tooltip" title="Edycja zakresu gromadzonych danych" href="'.site_url("zbiory/edytuj/".$row["sid"]."/$slownik_id").'" class="btn btn-primary btn-xs" data-placement="right"><span class="glyphicon glyphicon-edit"></span></a></h3>';
		$nazwa = $row["nazwa"];
		echo "<strong><i>Wykaz danych:</i></strong>";
		echo "<ul>".$row["dana"]."</font></ul>";
		continue;
	}
	else
		echo "<ul>".$row["dana"]."</ul>";
	
};?>
</div>