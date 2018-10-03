<?php include '../../template/head.php'; ?>
<div class="login_wrapper">
<div class="login_container">
  <h2> Revict</h2>
  <h4> Acesso Restrito </h4>
<form class="login_form" method="POST" action="components/auth.php">
  <div class="form-group">
    <label for="exampleInputEmail1">Email</label>
    <input name="usr_usuario" type="text" class="form-control" aria-describedby="emailHelp" placeholder="Ex: teste@teste.com" value="teste@teste.com">
    <small id="emailHelp" class="form-text text-muted">Digite seu Endereço de Email.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Senha</label>
    <input name="usr_passwd" type="password" class="form-control" placeholder="Senha">
    <small id="emailHelp" class="form-text text-muted">Digite sua Senha.</small>
  </div>
  <button type="submit" class="btn_login rvct_btn_primary">Entrar</button>
</form>
</div>
</div>

<?php include '../../template/head.php'; ?>

