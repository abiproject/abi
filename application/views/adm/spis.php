<h2>Historia zdarzeń</h2>
<table class="table table-bordered table-hover table_logi">
    <thead>
        <tr>
			<th style="text-align:center">Data</th>
			<th style="text-align:center">Użytkownik</th>
			<th style="text-align:center">Akcja</th>
         <th style="text-align:center">Parametry</th>
			<!-- <th style="text-align:center">json</th> -->
        </tr>
    </thead><tbody></tbody>
</table>
  <style media="all" type="text/css">
      .alignRight { text-align: right; }
  	 .alignLeft { text-align: left; }
  	 .alignCenter { text-align: center; }
  </style>
  <script src="<?php echo base_url('js/jquery.dataTables.min.js')?>"></script>
  <script src="<?php echo base_url('js/dataTables.bootstrap.js')?>"></script>
  <script>
   $('.table_logi').DataTable({
   "deferRender": true,
   "lengthMenu": [[20, 50, 100, -1], [20, 50, 100, "Wszystkie"]],
   "processing": true,
	"order": [[ 0, "desc" ]],
   "ajax": "<?= $json_url;?>",
   "columns": [
		{ "data" : "data", sClass: "alignCenter" },
		{ "data": "nazwa" , sClass: "alignCenter" },
		{ "data": "nazwa_log" , sClass: "alignCenter" },
		{ "data": "parametr" , sClass: "alignCenter" }] 
  });
  </script>