<div class="panel panel-info">
<div class="panel-heading">
  <h3 class="panel-title">Filtr (pokaż umowy danego zakładu pracy)</h3>
</div>
<div class="panel-body">
	<?php if(!($this->uri->segment(4))):?>
	<a style="margin-bottom: 5px" class="btn btn-xs btn-primary" 
	<?php else:?>
	<a style="margin-bottom: 5px" class="btn btn-xs btn-info"
	<?php endif;?>
	href='<?php echo site_url("rejestr_u/index/");?>'>Wszystko</a>
	<?php foreach ($zaklady as $item):?>
		<?php if($this->uri->segment(4) == $item['id']):?>
			<a style="margin-bottom: 5px"  class="btn btn-xs btn-primary"
		<?php else:?>	
			<a style="margin-bottom: 5px" class="btn btn-xs btn-info"
		<?php endif;?>
	 	href='<?php echo site_url("rejestr_u/index/filtr/".$item['id']."");?>'><?php echo $item["nazwa_zakladu"];?></a>
	<?php endforeach;?>
	</div>
</div>