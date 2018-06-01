<script src="<?php echo base_url("img/jquery.flot.min.js");?>" ></script>
<script src="<?php echo base_url("img/jquery.flot.pie.min.js");?>" ></script>
<script src="<?php echo base_url("img/jquery.flot.categories.min.js");?>" ></script>
<script src="<?php echo base_url("img/jquery.flot.barnumbers.js");?>"></script>
<script src="<?php echo base_url("img/jquery.flot.time.min.js");?>" ></script>
<script src="<?php echo base_url("img/jquery.flot.axislabels.js");?>" ></script>


    <script type="text/javascript">	 
  	 $(function() {
		 var data = [
		 <?php foreach($z as $row):?>
		 	{ label: "<?= $row["nazwa"];?>: <?= $row["suma_pracownikow"];?>",  data: <?= $row["suma_pracownikow"];?>},
			<?php endforeach;?>
		];
	 	var data2 = [
	 <?php foreach($z as $row):?>
	 	{ label: "<?= $row["nazwa"];?>: <?= $row["suma_upo"];?>",  data: <?= $row["suma_upo"];?>},
		<?php endforeach;?>
	];
		 $.plot('#pracownicy_stat', data, {
		     series: {
		         pie: {
		             show: true
		         }
		     },
		     legend: {
		         show: false
		     }
		 });
		 $.plot('#upo_stat', data2, {
		     series: {
		         pie: {
		             show: true
		         }
		     },
		     legend: {
		         show: false
		     }
		 });
 
	var year = <?= date("Y");?>;
	var month = <?= date("n");?>;
	var licznik =  [
	<?php $start = 1;?>
 <?php foreach($logi as $row):?>
 <?php for($i=$start;$i<=date("d");$i++):?>
	 		<? if($row["dzien"] == $i):?>
	[day(<?= $row["dzien"];?>),  <?= $row["ile"];?>],
	<?php $start = $i + 1; break;?>
			<? else:?>
	[day(<?= $i;?>), 0],
		<? endif;?>
		<?php endfor;?>
	<?php endforeach;?>
	<? if($row["dzien"] < date("d")):?>
	[day(<?= date("d");?>), 0],
	<? endif;?>
	
	];
	
	var zdarzenia =  [
	<?php $start = 1;?>
 <?php foreach($zdarzenia as $row):?>
 <?php for($i=$start;$i<=date("d")+1;$i++):?>
	 		<? if($row["dzien"] == $i):?>
	[day(<?= $row["dzien"];?>),  <?= $row["ile"];?>],
	<?php $start = $i + 1; break;?>
			<? else:?>
	[day(<?= $i;?>), 0],
		<? endif;?>
		<?php endfor;?>
	<?php endforeach;?>
	<? if($row["dzien"] < date("d")):?>
	[day(<?= date("d");?>), 0],
	<? endif;?>
	
	];

	
	var dataSet = [
	{ label: "&nbsp;Zdarzenia", data: zdarzenia, color: "#E8E800"},
	{ label: "&nbsp;Logowania", data: licznik, color: "#0077FF"}

	];
	
	function day(day) {    
	    return new Date(year, month, day).getTime();
	}
	
$.plot("#licznik_stat", dataSet, {
				series: {
					lines: {
						show: true,
						fill: true
					},	
			 },
			 xaxis: {
			     axisLabel: "Dzień",
			     axisLabelUseCanvas: true,
			     axisLabelFontSizePixels: 12,
			     axisLabelFontFamily: 'Verdana, Arial',
			     axisLabelPadding: 10,           
			     mode: "time",
			     tickSize: [1, "day"],
			     timeformat: "%e"
			 },
			yaxis: {
		    axisLabel: "Ilość akcji",
		    axisLabelUseCanvas: true,
		    axisLabelFontSizePixels: 12,
		    axisLabelFontFamily: 'Verdana, Arial',
		    axisLabelPadding: 5
			 },
				 grid: {
				     hoverable: true,
				     borderWidth: 2,
				     backgroundColor: { colors: ["#ffffff", "#EDF5FF"] }
				 },
				 legend: {
				     noColumns: 1,
				     labelBoxBorderColor: "#858585",
				     position: "nw"
				 }
			 
			});
			var previousPoint = null, previousLabel = null;
 
	$.fn.UseTooltip = function () {
			    $(this).bind("plothover", function (event, pos, item) {
  if (item) {
      if ((previousLabel != item.series.label) ||
           (previousPoint != item.dataIndex)) {
          previousPoint = item.dataIndex;
          previousLabel = item.series.label;
          $("#tooltip").remove();

          var x = item.datapoint[0];
          var y = item.datapoint[1];

          var color = item.series.color;                       

          showTooltip(item.pageX,
                  item.pageY,
                  color,
                  "<strong>" + item.series.label + "</strong><br>" + new Date(x).getDate() + "/" + new Date(x).getMonth() + "/" + new Date(x).getFullYear() +
                  " : <strong>Ilość: " + y + "</strong>");               
			            }
			        } else {
			            $("#tooltip").remove();
			            previousPoint = null;
			        }
			    });
			};
 
			function showTooltip(x, y, color, contents) {
			    $('<div id="tooltip">' + contents + '</div>').css({
			        position: 'absolute',
			        display: 'none',
			        top: y - 10,
			        left: x + 10,
			        border: '2px solid ' + color,
			        padding: '3px',
			        'font-size': '9px',
			        'border-radius': '5px',
			        'background-color': '#fff',
			        'font-family': 'Verdana, Arial, Helvetica, Tahoma, sans-serif',
			        opacity: 0.9
			    }).appendTo("body").fadeIn(200);
			}
			$("#licznik_stat").UseTooltip();
	  });
    </script>
	 <p>
	 </p>
<h2>Statystyki</h2>

<div class="row">
	
	<div class="col-md-4"><div id="pracownicy_stat" style="width:350px; height:350px;"></div>	</div>
	<div class="col-md-8">
		<div class="alert alert-info"><h3>Ilość pracowników w poszczególnych zakładach</h3><br/>
	<?php foreach($z as $row):?>
	<div class="row">
		<div class="col-md-5">Zakład: <strong><?= $row["nazwa"]; ?></strong></div>
		<div class="col-md-3">Suma pracowników: <strong><?= $row["suma_pracownikow"];?></strong></div>
	</div>
	<?php endforeach; ?>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-8">
		<div class="alert alert-info"><h3>Ilość wystawionych upoważnień w poszczególnych zakładach</h3><br/>
	<?php foreach($z as $row):?>
	<div class="row">
		<div class="col-md-5">Zakład: <strong><?= $row["nazwa"]; ?></strong></div>
		<div class="col-md-3">Suma upoważnień: <strong><?= $row["suma_upo"];?></strong></div>
	</div>
	<?php endforeach; ?>
		</div>
	</div>
	<div class="col-md-4"><div id="upo_stat" style="width:350px; height:350px;"></div>	</div>
	
</div>

<div class="row">
	<h3>Statystyki miesiąca - <?= date("m/Y");?></h3>
	<div class="col-md-8">
		<div id="licznik_stat" style="width: 600px; height: 300px;"></div>	
</div>
</div>
<!-- <?php foreach($z as $row):?>
	<div class="alert alert-info">
Zakład: <strong><?= $row["nazwa"]; ?></strong><br/>
Suma pracowników: <strong><?= $row["suma_pracownikow"];?></strong><br/>
Suma wystawionych upoważnień: <strong><?= $row["suma_upo"];?></strong><br/>
Suma aktualnych upoważnień: <strong><?= $row["suma_upo_aktualnych"];?></strong><br/>
Suma wygasających upoważnień: <strong><?= $row["suma_upo_wygasajacych"];?></strong><br/>


</div>
<?php endforeach; ?> -->