<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
<?php

use LDAP\Result;

include '../../vendor/autoload.php';

$parser = new \Smalot\PdfParser\Parser();
$pdf    = $parser->parseFile('./teste.pdf');

$text =  $pdf->getText();

function name($text){
    
    $foundNome = true;
    $idx = 0;
    $nomeLength = 0;
    
    while($foundNome)
    {
        $posInicial= strpos($text,  "Nome: ");
        
        if($posInicial === false)
        {
            $foundNome = false;
            continue;
        }
        
        $posFinal = strpos($text,  "Siape:");
    
        for($i = 0; $i<1; $i++) {
    
            $r = substr($text, $posInicial+5, $posFinal);        
            $t = strpos($r, "Siape:");
            $tt = substr($r, 0, $t);
            $arrayNome[$idx] = $tt;
        }
    
        $nomeLength = strlen($tt);
    
        $nome = substr($text, $posInicial+5, $nomeLength);
        $arrayNome[$idx++] = $nome;
        $posFinal = $posFinal+7;
        $text = substr($text, $posFinal);
    }
    
    $arrlengthNome = count($arrayNome);
    
    for($x = 0; $x < $arrlengthNome; $x++) {
        echo $arrayNome[$x]."<br><br>";
    }
}


function CPF($text) {

    $found = true;
    $idx = 0;
    $cpfLength = 14;
    
    while($found)
    {
        
        $posInicial= strpos($text,  "CPF: ");
    
        if($posInicial === false)
        {
            $found = false;
            continue;
        }
        
        $posFinal = strpos($text,  "Órgão:");
        $cpf = substr($text, $posInicial+5, $cpfLength);
        $arrayCpf[$idx++] = $cpf;
        $posFinal = $posFinal+7;
        $text = substr($text, $posFinal);    
    }
    
    $arrlength = count($arrayCpf);
    
    for($x = 0; $x < $arrlength; $x++) {
        echo $arrayCpf[$x]."<br><br>";
    }
}

?>
<table width="100%">
    <tr>
        <th>Nome</th>
        <th>CPF</th> 
    </tr>
    <tr>
        <td><?php print_r(name($text)); ?></td>
        <td><?php print_r(CPF($text)); ?></td>
    </tr>

</table>
</body>
</html>