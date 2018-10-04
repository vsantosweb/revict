

<?php include '../../autoload.php'; ?>
<?php include '../../config/config.php'; ?>
<?php include '../../template/head.php'; ?>
<?php include '../../template/navbar.php'; ?>

<?php $cliente = new models\Clientes; 

$row_match = $cliente->find($_GET['id']);

foreach($row_match as $keys)
	{?>


		<div class="main_wrapper">
			<div class="main_container container-fluid">
				<div class="row">
					<div class="col-md-10">
						<div class="main_header row">
							<div class="col-md-2">

								<a href="index.php" class="btn-block rvct_btn_primary">
									<- Voltar
								</a>
							</div>
							<div class="col-md-10">
								<h3 class="rvct_title">Deseja excluir este Cliente? </h3>
							</div>
						</div>
						<div class="row">
							<div class="container">
								<div class="col-md-12">
									<div class="card">
										<div class="card-header">
											<h5 class="card-title"><?php echo $keys['cli_nome']; ?></h5>
										</div>
										<div class="card-body">
											<div class="card">
												<ul class="list-group list-group-flush">
													<li class="list-group-item"><?php echo $keys['cli_cpf']; ?></li>
													<li class="list-group-item"><?php echo $keys['cli_email']; ?></li>
													<li class="list-group-item"><?php echo $keys['cli_data_reg']; ?></li>
												</ul>
											</div>
											<div class="card-footer" style="float: right;">
											<form  method="POST" action="save.php?token=<?php echo sha1('delete');?>">
											<input hidden="true" name="id" value="<?php echo $keys['id'];?>">
											<button type="submit" class="btn btn-danger card-link">Excluir</button>
											<a href="index.php" class="btn btn-warning card-link">Cancelar</a>
											</form>
											</div>
											
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				<?php }?>
				<?php include('sidebar.php');?>
			</div>
		</div>
	</div>

	<?php include '../../template/footer.php'; ?>