<p align="Left"><font size="10">Opis struktury zbiorów danych wskazujący zawartość poszczególnych pól informacyjnych i powiązania między systemami</font></p>
<h2>1. Wykaz zbiorów wraz z zakresami gromadzonych danych</h2>
<p></p>
<?php 
foreach($zbiory as $row)
{
	if(!isset($nazwa) or $nazwa != $row["nazwa"])
	{
		echo "<h1>Zbiór ".$row["nazwa"]."</h1>";
		$nazwa = $row["nazwa"];
		echo "<h3><i>Wykaz danych:</i></h3>";
		echo "<ul><font size=10>".$row["dana"]."</font></ul>";
		continue;
	}
	else
		echo "<ul><font size=10>".$row["dana"]."</font></ul>";
	
}