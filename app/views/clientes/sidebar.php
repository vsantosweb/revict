
<div class="col-md-2">
	<div class="card rvct_card" style="width: 18rem;">
		<div class="card-header">
			Informações
		</div>
		<ul class="list-group list-group-flush">
			<li class="list-group-item">total: <?php echo count($cliente->data['total']);?></li>
			<li class="list-group-item">Ativos: <?php echo $cliente->status('ativo'); ?></li>
			<li class="list-group-item">Negativados: <?php echo $cliente->status('negativado'); ?></li>
			<li class="list-group-item">Desativados: <?php echo $cliente->status('desativado'); ?></li>

			<?php 
			
			?>
		</ul>
	</div>
</div>