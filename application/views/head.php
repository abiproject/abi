<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="utf-8">
	<title>ABI Informatics</title>
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
.sticky {  
    position: fixed;  
    width: 100%;  
    left: 0;  
    top: 0;  
    z-index: 100;  
    border-bottom: 1px solid;  
}  
.pagination {
  width: 100%;
  background: #eee;
  padding: 10px 20px 10px 20px;
  margin-bottom: 10px;
  margin-top: 0px;
}
	</style>
	<script src="<?php echo base_url("img/jquery-2.1.1.min.js");?>" ></script>
   <script src="<?php echo base_url("img/jquery-ui.min.js");?>"></script>
	<script src="<?php echo base_url("js/bootstrap.min.js");?>" ></script>

  <script>
  $(function() {
$('[data-toggle="tooltip"]').tooltip()
	  	$.datepicker.regional['pl'] = {
	  		closeText: 'Zamknij',
	  		prevText: '&#x3C;Poprzedni',
	  		nextText: 'Następny&#x3E;',
	  		currentText: 'Dziś',
	  		monthNames: ['Styczeń','Luty','Marzec','Kwiecień','Maj','Czerwiec',
	  		'Lipiec','Sierpień','Wrzesień','Październik','Listopad','Grudzień'],
	  		monthNamesShort: ['Styczeń','Luty','Marzec','Kwiecień','Maj','Czerwiec',
	  		'Lipiec','Sierpień','Wrzesień','Październik','Listopad','Grudzień'],
	  		dayNames: ['Niedziela','Poniedziałek','Wtorek','Środa','Czwartek','Piątek','Sobota'],
	  		dayNamesShort: ['Nie','Pn','Wt','Śr','Czw','Pt','So'],
	  		dayNamesMin: ['N','Pn','Wt','Śr','Cz','Pt','So'],
	  		weekHeader: 'Tydz',
	  		dateFormat: 'dd.mm.yy',
	  		firstDay: 1,
	  		isRTL: false,
	  		showMonthAfterYear: false,
	  		yearSuffix: ''};
	  	$.datepicker.setDefaults($.datepicker.regional['pl']);
    $( "#okMsg" ).slideDown( 500 ).delay( 5000 ).fadeOut( 1000 );
	 $( "#errorMsg" ).slideDown( 500 ).delay( 5000 ).fadeOut( 1000 );
    $("#datepicker").datepicker({
					  changeMonth: true,
				      changeYear: true,
					  dateFormat: "yy-mm-dd",
					  locale: "pl" });
					  
 	$("#datepicker2").datepicker({
  					  changeMonth: true,
  				      changeYear: true,
  					  dateFormat: "yy-mm-dd",
  					  locale: "pl" });
   $(".datepick").each(function(){
					      $(this).datepicker({
  					  changeMonth: true,
  				      changeYear: true,
  					  dateFormat: "yy-mm-dd",
  					  locale: "pl" }
					      );
					  });
	
    $("#hide").click(function(){  
        var row = $(this).closest('tr');
        row.hide();
      });
  	
  });
</script>
</head>
<body>
		<div class="container">