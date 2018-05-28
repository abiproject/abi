<h2>Rejestr umów:</h2>
<?php if(strlen($error) > 0) echo '<div class="alert alert-danger" role="alert" id="errorMsg">'.$error.'</div>';?>
<?php if(strlen($msg) > 0) echo '<div class="alert alert-success" role="alert" id="okMsg">'.$msg.'</div>';?>
<table class="table table-bordered table-hover table_u">
    <thead>
        <tr>
			<th style="text-align:center">Lp</th>
			<th style="text-align:center">Zakład</th>
			<th style="text-align:center">Nazwa firmy</th>
			<th style="text-align:center">Cel przetwarzania danych</th>
			<th style="text-align:center">Data umowy</th>
			<th style="text-align:center">Dodatki do umowy</th>			
			<th style="text-align:center; width: 10%;">Opcje</th>
		  </tr>
    </thead>
	 <tbody>
	 </tbody>
	 <tfooter>
	        <tr>
				<th style="text-align:center">Lp</th>
				<th style="text-align:center">Zakład</th>
				<th style="text-align:center">Nazwa firmy</th>
				<th style="text-align:center">Cel przetwarzania danych</th>
				<th style="text-align:center">Data umowy</th>
				<th style="text-align:center">Dodatki do umowy</th>			
				<th style="text-align:center;width: 10%;">Opcje</th>
			  </tr>
	    </tfooter>
</table>
<script src="<?php echo base_url('js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('js/dataTables.bootstrap.js')?>"></script>
<style media="all" type="text/css">
    .alignRight { text-align: right; }
	 .alignLeft { text-align: left; }
	 .alignCenter { text-align: center; }
</style>
<?php
$formularz = trim(preg_replace('/\s+/', ' ', form_open('rejestr_u/index/zmien')));
?>
<script>
$('.table_u').DataTable({
 "lengthMenu": [[20, 50, 100, -1], [20, 50, 100, "Wszystkie"]],
 "processing": true,
 "serverSide": true,
 "searchDelay": 0,
 "ajax": { "url": "<?= $json_url;?>",
	   "type": "POST",
	"data": {
        "<?= $this->security->get_csrf_token_name();?>": "<?=$this->security->get_csrf_hash();?>"
	} } ,
 "columns": [
             { "render": function ( data, type, row, meta ) {
					 return meta.row + meta.settings._iDisplayStart + 1;
					 
				}, sClass: "alignCenter", "orderable": false },	
             { "data": "nazwa_zakladu", sClass: "alignCenter" },
             { "data": "nazwa_firmy" , sClass: "alignCenter" },
             { "data": "kategoria_danych"  },
 			    { "render": function ( data, type, full, meta ) {
					 var data_od = full.data_zawarcia;
					 var data_do = full.data_wygas;
					 var text = data_od + ' - ';
					 	if(data_do == '0000-00-00')
							return text + 'nieokreślony';
						else
							return text + data_do; }, sClass: "alignCenter", "orderable": false },	 
	 			 { "render": function ( data, type, full, meta ) {
					var umowa_typ = full.umowa_posiada;
					var pid		  = full.id;					
					var form = '<?= $formularz;?> <input type="hidden" name="id" value="' + pid +'" />';
					var s1 = '<select name="typ" onchange="this.form.submit()">';
      			var s2 = '</select>';
					var t1 = '<option ';
					if(umowa_typ == 1){
						t1 = t1+ 'SELECTED'; 
					}
						t1 = t1+' value="1" >Umowa powierzenia poufności</option><option ';
					if(umowa_typ == 2){
						t1 = t1+ 'SELECTED ';
					}
						t1 = t1+ ' value="2">Oświadczenie</option><option ';
					if(umowa_typ == 3){
						t1 = t1+ 'SELECTED ';
					}
						t1 = t1+ 'value="3">Klauzula</option><option ';
					if(umowa_typ == 0){
						t1 = t1+ 'SELECTED ';
					}
						t1 = t1+ ' value="0">Nic</option></form>';
					
					return form+s1+t1+s2;
					}, sClass: "alignCenter", "orderable": false}
				
				<?php if($perm == 2):?>,
		 		 { "render": function ( data, type, full, meta ) {
 				 $("[data-toggle=tooltip]").tooltip();
               var id = full.id;
					
               return '<a data-toggle="tooltip" rel="tooltip" title="Edytuj pozycję" href="<?php echo site_url('rejestr_u/edytuj/');?>/'+id+'"><img src="<?php echo base_url("img/edit.png");?>"></a> <a data-toggle="tooltip" rel="tooltip" title="Dodaj/zmień zbiory danych" href="<?php echo site_url('rejestr_u/zbiory/');?>/'+id+'"><img src="<?php echo base_url("img/zakres_zbiorow.png");?>"></a> <a data-toggle="tooltip"  title="Usuń pozycję" href="<?php echo site_url('rejestr_u/index/usun/');?>/'+id+'"><img src="<?php echo base_url('img/delete.png');?>"></a>';
					
 		}, sClass: "alignCenter", "orderable": false
	}	<?php endif;?>] 
});
			 </script>
