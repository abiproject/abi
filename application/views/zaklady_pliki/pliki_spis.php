<h2>Spis plików</h2>
<?php if(strlen($error) > 0) echo '<div class="alert alert-danger" role="alert" id="errorMsg">'.$error.'</div>';?>
<?php if(strlen($msg) > 0) echo '<div class="alert alert-success" role="alert" id="okMsg">'.$msg.'</div>';?>
<table class="table table-bordered table-striped table-hover table_pliki">
    <thead>
        <tr>
			<th style="text-align:center">Nazwa pliku</th>
			<th style="text-align:center">Komentarz</th>
			<th style="text-align:center">Zakład</th>
         <th style="text-align:center">Opcje</th>
		  </tr>
    </thead>
	 <tbody>
 </tbody>
    <tfooter>
        <tr>
			<th style="text-align:center">Nazwa pliku</th>
			<th style="text-align:center">Komentarz</th>
			<th style="text-align:center">Zakład</th>
         <th style="text-align:center">Opcje</th>
		  </tr>
    </tfooter>

</table>

<style media="all" type="text/css">
    .alignRight { text-align: right; }
	 .alignLeft { text-align: left; }
	 .alignCenter { text-align: center; }
</style>
<script src="<?php echo base_url('js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('js/dataTables.bootstrap.js')?>"></script>

<script>
 $('.table_pliki').DataTable({
 "deferRender": true,
 "lengthMenu": [[20, 50, 100, -1], [20, 50, 100, "Wszystkie"]],
 "processing": true,
 "order": [[ 0, "asc" ]],
 "ajax": "<?= $json_url;?>",
 "columns": [
		 { "render": function ( data, type, full, meta ) {
			 $("[data-toggle=tooltip]").tooltip();
         var nazwa  = full.nazwa_pliku;
         var id  = full.pid;
			var size = full.plik_rozmiar;
			var text = '<a data-toggle="tooltip" data-container="body" title="Pobierz plik" href="<?php echo site_url('zaklady_pliki/index/pobierz/');?>/'+id+'">'+nazwa+' ['+size+'kb]</a>';
				return text;
}, sClass: "alignCenter"},
	 { "data": "komentarz" , sClass: "alignCenter" },
	 { "data": "nazwa_zakladu" , sClass: "alignCenter" },	 		
	 { "render": function ( data, type, full, meta ) {
				 $("[data-toggle=tooltip]").tooltip();
            var id  = full.pid;
				var uname = full.unazwa;
				var date = full.data;
				var text = '<img data-toggle="tooltip" data-container="body" title="Dodane przez: '+uname+'" src="<?php echo base_url('img/abi.png');?>">';
	
            return text+' <img data-toggle="tooltip" data-container="body" title="Data dodania: '+date+'" src="<?php echo base_url('img/date.png');?>"> <a data-container="body" data-toggle="tooltip" title="Usuń plik" href="<?php echo site_url('zaklady_pliki/index/usun/');?>/'+id+'"><img src="<?php echo base_url('img/delete.png');?>"></a> ';
	}, sClass: "alignCenter"
}
	
		 		 	] 
});
</script>







