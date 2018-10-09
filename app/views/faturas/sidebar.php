
<div class="col-md-2">
	<div class="card rvct_card" style="width: 18rem;">
		<div class="card-header">
			Informações
		</div>
		<ul class="list-group list-group-flush">
			<li class="list-group-item">total: <?php echo count($fatura->data['total']);?></li>
			<li class="list-group-item">Em Aberto: <?php echo $fatura->status('aberto'); ?></li>
			<li class="list-group-item">Pago: <?php echo $fatura->status('pago'); ?></li>
			<li class="list-group-item">Em Atraso: <?php echo $fatura->status('atrasado'); ?></li>

			<?php 
			
			?>
		</ul>
	</div>
</div>