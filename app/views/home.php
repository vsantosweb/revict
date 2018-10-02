<?php include '../template/head.php'; ?>

<div class="login_wrapper">
  <div class="login_container">
    <h2> Revict</h2>
    <h4> Acesso Restrito </h4>
    <form class="login_form">
      <div class="form-group">
        <label for="exampleInputEmail1">Email</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ex: teste@teste.com">
        <small id="emailHelp" class="form-text text-muted">Digite seu Endereço de Email.</small>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Senha</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Senha">
        <small id="emailHelp" class="form-text text-muted">Digite sua Senha.</small>
      </div>
      <button type="submit" class="btn_login rvct_btn_primary">Entrar</button>
    </form>
  </div>
</div>

<?php include '../template/footer.php'; ?>