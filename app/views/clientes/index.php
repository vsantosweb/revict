<?php include '../../autoload.php'; ?>
<?php include '../../config/config.php'; ?>
<?php include '../../template/head.php'; ?>
<?php include '../../template/navbar.php'; ?>

<?php $cliente = new models\Clientes; 


?>

<div class="main_wrapper">
	<div class="main_container container-fluid">
		<div class="row">
			<div class="col-md-10">
				<div class="main_header row">
					<div class="col-md-2">

						<a href="addcliente.php" class="rvct_btn_primary">
							Cadastrar
						</a>
					</div>
					<div class="col-md-10">
						<h3 class="rvct_title"> Clientes</h3>
					</div>
				</div>
				<div class="row">
					<!-- MUDA-->
					<?php if(count($cliente->data['total']) <= 0 ){
						print 'Não há clientes cadastrados!';
					}?>
					<table class="rvct_table table">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Nome</th>
								<th scope="col">Email</th>
								<th scope="col">CPF</th>
								<th scope="col">Status</th>
								<th scope="col">Dt. Registro</th>
								<th scope="col">Ações</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($cliente->list() as $keys => $value) { ?>
								<tr>
									<td scope="row"><?php echo $value['id']; ?></td>
									<td><?php echo $value['cli_nome']; ?></td>
									<td><?php echo $value['cli_email']; ?></td>
									<td><?php echo $value['cli_cpf']; ?></td>
									<td><span 
										<?php echo ($value['cli_status'] == 'negativado') ? 'class="status_2"' : (($value['cli_status'] == 'ativo') ? 'class="status_1"': ($value['cli_status'] == 'desativado' ? 'class="status_3"': 'false'));?>>
										<?php  echo ucfirst($value['cli_status']);?><span></td>
									<td><?php echo date_format(new DateTime($keys['cli_data_reg']), "d/m/Y");?></td>
									<td>
										<div class="btn-group">
											<button type="button" class="btn rvct_simple_btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<i class="fa fa-gear"></i> Ações
											</button>
											<div class="dropdown-menu dropdown-menu-right rvct_dropdown">
												<a href="updatecliente.php?id=<?php echo $value['id'];?>" class="dropdown-item"><i class="fa fa-user"></i> Alterar Dados</a>
												<a href="deletecliente.php?id=<?php echo $value['id'];?>" class="dropdown-item"><i class="fa fa-trash"></i> Exluir</a>
											</div>
										</div>
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

					for($i = 1; $i <= $cliente->pagination; $i++){

						echo '<li class="page-item material_shadow"><a class="page-link" href=?page='.$i.'>'.$i.'</a></li>';
					}
					?>
				</ul>
			</div>
		</nav>
	</div>
</div>

<?php include '../../template/footer.php'; ?>

