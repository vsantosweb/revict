<?php
include '../../autoload.php';

$fatura = new models\Faturas; 



header('Location: ./?message='. $fatura->alter_venc($_POST['fat_vencimento'], $_POST['fat_id']));
