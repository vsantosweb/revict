

<?php include '../../autoload.php'; ?>
<?php include '../../config/config.php'; ?>
<?php include '../../template/head.php'; ?>
<?php include '../../template/navbar.php'; ?>

<?php $fatura = new models\Faturas; 

?>


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
						<h3 class="rvct_title">Cadastrar Fatura </h3>
					</div>
				</div>
				<div class="row">
					<form class="form_cadastros" method="post" action="save.php?token=<?php echo sha1('create'); ?>">
						<div class="form-row">
							<div class="form-group col-md-12">
								<label>Cliente</label>
								<select name="cli_id" class="form-control">
									<?php foreach($fatura->get_clientes()  as $keys => $value){
										echo '<option  value=" '.$value['id'].' ">'. $value['cli_nome'].' </option>';
									} ?>
								</select>
								<input hidden="true" value="<?php echo $value['id']?>">
							</div>
							<div class="form-group col-md-6">
								<label>Emitido em</label>
								<input name="fat_data_emissao" type="date" class="form-control" placeholder="CPF do fatura" required>
							</div>
							<div class="form-group col-md-6">
								<label>Vencimento em</label>
								<input name="fat_vencimento" type="date" class="form-control" placeholder="Telefone do fatura" required>
							</div>
							<div class="form-group col-md-3">
								<label>Valor da fatura</label>
								<input name="fat_total" type="number" class="form-control"placeholder="Email do fatura" required>
							</div>
						</div>
						<button type="submit" class="rvct_btn_primary">Salvar</button>
						<h2 style="font-size:22px;"><?php echo isset($_GET['status'])? $_GET['status'] : false ; ?></h2>
					</form>
				</div>
			</div>
			<?php include('sidebar.php');?>
		</div>
	</div>
</div>

<?php include '../../template/footer.php'; ?>