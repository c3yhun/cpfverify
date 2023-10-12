<?php
function validateCPF($cpf) {
    $cpf = preg_replace('/[^0-9]/', '', $cpf);
    
    if (strlen($cpf) !== 11) {
        return false;
    }
    
    $invalidCPFs = [
        '00000000000', '11111111111', '22222222222', '33333333333',
        '44444444444', '55555555555', '66666666666', '77777777777',
        '88888888888', '99999999999'
    ];
    if (in_array($cpf, $invalidCPFs)) {
        return false;
    }
    
    for ($i = 9; $i < 11; $i++) {
        $sum = 0;
        for ($j = 0; $j < $i; $j++) {
            $sum += intval($cpf[$j]) * (($i + 1) - $j);
        }
        $remainder = $sum % 11;
        if (($cpf[$i] != ($remainder < 2 ? 0 : 11 - $remainder))) {
            return false;
        }
    }
    return true;
}

if (isset($_REQUEST['cpf'])) {
    $cpf = $_REQUEST['cpf'];
    
    if (validateCPF($cpf)) {
        echo 'true';
    } else {
        echo 'false';
    }
} else {
    echo 'false';
}
?>
