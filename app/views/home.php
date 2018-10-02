<?php include '../template/head.php'; ?>
<?php include '../template/navbar.php'; ?>

<div class="main_wrapper">
 <div class="main_container container">
  <div class="main_header row">
    <div class="col-md-6">
      <h1> Clientes </h1>
    </div>
    <div class="col-md-6">
      <div class="row">
        <div class="col-md-6">
          <div class="card" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">Total</h5>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">Cadastrar Novo</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
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

<?php include '../template/footer.php'; ?>