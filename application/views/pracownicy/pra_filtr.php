<div class="panel panel-info">
<div class="panel-heading">
  <h3 class="panel-title">Filtr (pokaż pracowników danego zakładu pracy)</h3>
</div>
<div class="panel-body">
	<?php if(!($this->uri->segment(4))):?>
	<a class="btn btn-xs btn-primary" style="margin-bottom: 5px"
	<?php else:?>
	<a class="btn btn-xs btn-info" style="margin-bottom: 5px"
	<?php endif;?>
	href='<?php echo site_url("pracownicy/index/");?>'>Wszystko</a>
	<?php foreach ($zaklady as $item):?>
		<?php if($this->uri->segment(4) == $item['id']):?>
			<a class="btn btn-xs btn-primary" style="margin-bottom: 5px"
		<?php else:?>	
			<a class="btn btn-xs btn-info" style="margin-bottom: 5px"
		<?php endif;?>
	 	href='<?php echo site_url("pracownicy/index/filtr/".$item['id']."");?>'><?php echo $item["nazwa_zakladu"];?></a>
	<?php endforeach;?>
	</div>
</div>