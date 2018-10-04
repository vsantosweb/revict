
<?php include '../../autoload.php'; ?>
<?php include '../../config/config.php'; ?>
<?php include '../../template/head.php'; ?>
<?php include '../../template/navbar.php'; ?>


<div class="main_wrapper">
 <div class="main_container container-fluid">

  <div class="row">
    <div class="col-md-10">
      <div class="main_header row">
        <div class="col-md-10">
          <h1 class="rvct_title"> Clientes </h1>
        </div>
        <div class="col-md-2">
          <a href="../clientes/?add" class="btn-block rvct_btn_primary">
            Cadastrar Novo
          </a>
        </div>
      </div>
      <div class="row">
        <!-- MUDA-->
        <table class="rvct_table table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">2</th>
            <td>Jacob</td>
            <td>Thornton</td>
            <td>
              <div class="table_list_item col-md-1 col-1 p-0 btn-group">
                <button type="button" class="btn-out-sample-dark" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-gear"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                  <a onclick="__TASK('alter', '91', this, 'cliente', 'list')" href="#" class="dropdown-item" data-toggle="modal"><i class="fa fa-user" data-toggle="modal"></i> Alterar Dados</a>
                  <a onclick="__TASK('del', '91', this, 'cliente', 'list')" href="#" class="dropdown-item" data-toggle="modal"><i class="fa fa-trash"></i> Exluir</a>
                </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
      </div>
    </div>
    <div class="col-md-2">
      <div class="card" >
        <div class="card-body">
          <h5 class="card-title">Total</h5>
          <h6 class="card-subtitle mb-2 text-muted">toal de Clientes</h6>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<?php include '../../template/footer.php'; ?>