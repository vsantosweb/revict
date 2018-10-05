

<?php include '../../autoload.php'; ?>
<?php include '../../config/config.php'; ?>
<?php include '../../template/head.php'; ?>
<?php include '../../template/navbar.php'; ?>

<?php $cliente = new models\Clientes; 

$row_match = $cliente->find($_GET['id']);

foreach($row_match as $keys)
	{?>


		<div class="main_wrapper">
			<div class="main_container container">
				<div class="row">
					<div class="col-md-10">
						<div class="main_header row">
							<div class="col-md-2">

								<a href="index.php" class="rvct_btn_primary">
									<- Voltar
								</a>
							</div>
							<div class="col-md-10">
								<h3 class="rvct_title">Alterar Cadastro </h3>
							</div>
						</div>
						<div class="row">
							<form class="form_cadastros" method="post" action="save.php?token=<?php echo sha1('alter'); ?>">
								<div class="form-row">
									<input hidden="true" name='id' value="<?php  echo $keys['id']?>">
									<div class="form-group col-md-12">
										<label>Nome Completo</label>
										<input name="cli_nome" type="text" class="form-control" placeholder="Nome do cliente" required value="<?php echo $keys['cli_nome']; ?>">
									</div>
									<div class="form-group col-md-6">
										<label>CPF</label>
										<input name="cli_cpf" type="text" class="form-control" placeholder="CPF do cliente" required value="<?php echo $keys['cli_cpf']; ?>">
									</div>
									<div class="form-group col-md-6">
										<label>Telefone</label>
										<input name="cli_phone" type="tel" class="form-control" placeholder="Telefone do Cliente" required value="<?php echo $keys['cli_phone']; ?>">
									</div>
									<div class="form-group col-md-12">
										<label>Email</label>
										<input name="cli_email" type="email" class="form-control"placeholder="Email do Cliente" required value="<?php echo $keys['cli_email']; ?>">
									</div>
								</div>
								<button type="submit" class="rvct_btn_primary">Alterar</button>
								<h2 style="font-size:22px;"><?php echo isset($_GET['status'])? $_GET['status'] : false ; ?></h2>
							</form>
						</div>
					</div>

				<?php }?>
				<?php include('sidebar.php');?>
			</div>
		</div>
	</div>

	<?php include '../../template/footer.php'; ?>