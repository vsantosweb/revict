<?php include '../../autoload.php'; ?>
<?php include '../../config/config.php'; ?>
<?php include '../../template/head.php'; ?>
<?php include '../../template/navbar.php'; ?>

<?php $fatura = new models\Faturas; 

$fatura->fat_rules();



?>

<div class="main_wrapper">
	<div class="main_container container-fluid">
		<div class="row">
			<div class="col-md-10">
				<div class="main_header row">
					<div class="col-md-2">

						<a href="addfatura.php" class="rvct_btn_primary">
							Nova Fatura
						</a>
					</div>
					<div class="col-md-10">
						<h3 class="rvct_title"> Faturas</h3>
					</div>
				</div>
				<div class="row">
					<?php if(count($fatura->data['total']) <= 0 ){
						print 'Não há faturas cadastradas!';
					}
					if(isset($_GET['message'])){
						echo $_GET['message'];
					}
					
					?>
					<?php 
					foreach($fatura->list() as $keys => $value){

						if(isset($_GET['inserepgto']) && isset($_GET['id'])){

							if($_GET['inserepgto']== true && $_GET['id'] == $value['id']){
								echo '<form class=" form_cadastros form-inline" method="POST" action="inserepgto.php">
								<div class="form-group mb-2">
								<h4>'.$value['cli_nome'].' | </h4>
								<h6>Restante </h6>
								<h5> R$ '.$value['fat_balanco'].'</h5>
								</div>
								<div class="form-group mx-sm-3 mb-2">
								<input name="fat_pgto" type="text" class="form-control"placeholder="Valor">
								<input name="fat_id" type="text" hidden="true" value="'.$value['id'].'">
								</div>
								<button type="submit" class="btn btn-primary mb-2">Pagar</button>
								</form>';
							}
						}
						if(isset($_GET['altvenc']) && isset($_GET['id'])){

							if($_GET['altvenc']== true && $_GET['id'] == $value['id']){
								echo '<form class=" form_cadastros form-inline" method="POST" action="altervenc.php">
								<div class="form-group mb-2">
								<h4>'.$value['cli_nome'].' | </h4>
								<h5> VENCE EM:  '. date_format(new DateTime($value['fat_vencimento']) , 'd-m-Y').'</h5>
								</div>
								<div class="form-group mx-sm-3 mb-2">
								<input name="fat_vencimento" type="date" class="form-control"  placeholder="Data">
								<input name="fat_id" type="text" hidden="true" value="'.$value['id'].'">
								</div>
								<button type="submit" class="btn btn-primary mb-2">Alterar</button>
								</form>';
							}
						}

					}

					?>
				</div>
				<div class="row">
					<!-- MUDA-->
					
					<table class="rvct_table table">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Cliente</th>
								<th scope="col">Total</th>
								<th scope="col">Pago</th>
								<th scope="col">Balanço</th>
								<th scope="col">Dt. Emissão</th>
								<th scope="col">Dt. Registro</th>
								<th scope="col">Venc.</th>
								<th scope="col">Status</th>
								<th scope="col">Ações</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($fatura->list() as $keys => $value) { ?>

								<tr>
									<td scope="row"><?php echo $value['id']; ?></td>
									<td><?php echo $value['cli_nome']; ?></td>
									<td><?php echo $value['fat_total']; ?></td>
									<td><?php echo $value['fat_pgto']; ?></td>
									<td><?php echo $value['fat_balanco']; ?></td>
									<td><?php echo date_format(new DateTime($value['fat_data_emissao']), "d-m-Y");?></td>
									<td><?php echo date_format(new DateTime($value['fat_data_reg']), "d-m-Y");?></td>
									<td><?php echo date_format(new DateTime($value['fat_vencimento']), "d-m-Y");?></td>
									<td><span 
										<?php echo ($value['fat_status'] == 'atrasado') ? 'class="status_2"' : (($value['fat_status'] == 'pago') ? 'class="status_1"': ($value['fat_status'] == 'desativado' ? 'class="status_3"': ($value['fat_status'] == 'aberto' ? 'class="status_4"' : ($value['fat_status'] == 'parcial' ? 'class="status_5"' : 'false'))));?>>
										<?php  echo ucfirst($value['fat_status']);?><span></td>
											<td>
												<?php if($value['fat_status'] != 'pago'){ ?>
													<div class="btn-group">
														<button type="button" class="btn rvct_simple_btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															<i class="fa fa-gear"></i> Ações
														</button>
														<div class="dropdown-menu dropdown-menu-right rvct_dropdown">
															<a href="?altvenc=true&id=<?php echo $value['id'];?>" class="dropdown-item"><i class="fa fa-calendar"></i> Alterar Venc.</a>
															<a href="?inserepgto=true&id=<?php echo $value['id'];?>" class="dropdown-item"><i class="fa fa-money"></i> Inserir Pgto</a>
														</div>
													</div>
												<?php } ;?>
											</td>
										</tr>
									<?php }; ?>
								</tbody>
							</table>
						</div>
					</div>
					<?php include('sidebar.php');?>
				</div>
				<div class="row">
					<nav aria-label="Page navigation example">
						<ul class="pagination ">
							<?php

							for($i = 1; $i <= $fatura->pagination; $i++){

								echo '<li class="page-item material_shadow"><a class="page-link" href=?page='.$i.'>'.$i.'</a></li>';
							}
							?>
						</ul>
					</div>
				</nav>
			</div>
		</div>

		<?php include '../../template/footer.php'; ?>

