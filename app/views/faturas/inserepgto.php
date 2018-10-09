
<?php
include '../../autoload.php';
print_r($_POST);
$fatura = new models\Faturas; 

header('Location: ./?message='. $fatura->insere_pgto($_POST['fat_id'], $_POST['fat_pgto']));
