<h2>Spis pracowników</h2>
<?php if(strlen($error) > 0) echo '<div class="alert alert-danger" role="alert" id="errorMsg">'.$error.'</div>';?>
<?php if(strlen($msg) > 0) echo '<div class="alert alert-success" role="alert" id="okMsg">'.$msg.'</div>';?>
<table class="table table-bordered table-striped table-hover table_prac">
    <thead>
        <tr>
			<th style="text-align:center">Nazwisko i imię [płeć]</th>
			<th style="text-align:center">Zakład</th>
			<?php if($perm == 2):?>
         <th style="text-align:center">Opcje</th>
		<?php endif;?>
		  </tr>
    </thead>
	 <tbody>
 </tbody>

</table>

<style media="all" type="text/css">
    .alignRight { text-align: right; }
	 .alignLeft { text-align: left; }
	 .alignCenter { text-align: center; }
</style>
<script src="<?php echo base_url('js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('js/dataTables.bootstrap.js')?>"></script>

<script>
 $('.table_prac').DataTable({
 "deferRender": true,
 "lengthMenu": [[20, 50, 100, -1], [20, 50, 100, "Wszystkie"]],
 "processing": true,
 "order": [[ 0, "asc" ]],
 "ajax": "<?= $json_url;?>",
 "columns": [
	 { "render": function ( data, type, full, meta ) {
        		  var nazwiskoimie = full.nazwiskoimie;
				  var plec = full.plec;
				  return nazwiskoimie+" ["+plec+"]";
					}
			},
			{ "data": "nazwa_zakladu" , sClass: "alignCenter" }
			<?php if($perm == 2):?>,	 		
			 { "render": function ( data, type, full, meta ) {
				 $("[data-toggle=tooltip]").tooltip();
            var id  = full.pid;
				var akt = full.aktualny;
				if(akt > 0)
					var text = '<a data-toggle="tooltip" data-container="body" title="Dezaktywuj pracownika" href="<?php echo site_url('pracownicy/index/dez/');?>/'+id+'"><img src="<?php echo base_url('img/on.png');?>"></a>';
				else
					var text = '<a data-toggle="tooltip" data-container="body" title="Aktywuj pracownika" href="<?php echo site_url('pracownicy/index/akt/');?>/'+id+'"><img src="<?php echo base_url('img/off.png');?>"></a>';
	
            return text+' <a data-container="body" data-toggle="tooltip" title="Edytuj pracownika" href="<?php echo site_url('pracownicy/edytuj/');?>/'+id+'"><img src="<?php echo base_url('img/edytuj_u.png');?>"></a> <a data-container="body" data-toggle="tooltip" title="Usuń pracownika" href="<?php echo site_url('pracownicy/index/usun/');?>/'+id+'"><img src="<?php echo base_url('img/delete.png');?>"></a> ';
	}, sClass: "alignCenter"
}
		<?php endif;?>
	
		 		 	] 
});
</script>







