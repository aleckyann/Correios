<?php

$parametros = [
       "nCdEmpresa" => "",
        "sDsSenha" => "",
        "sCepOrigem" => "",
        "sCepDestino" => "",
        "nVlPeso" => "1", //Kg
        "nCdFormato" => "1", //1 CAIXA, 2 ROLO, 3 PRISMA
        "nVlComprimento" => "16",
        "nVlAltura" => "5",
        "nVlLargura" => "15",
        "nVlDiametro" => "0",
        "sCdMaoPropria" => "s", // Carta registrada? 's'im ou 'n'ão,
        "nVlValorDeclarado" => "200", //Valor declarado da encomenda para seguro
        "sCdAvisoRecebimento" => "n", //Avisar sobre a entrega 's'im ou 'n'ão
        "StrRetorno" => "xml",
        "nCdServico" => "40010,41106" //Codigo do serviço, para mais de um, separe por vírgula
    ];

$parametros = http_build_query($parametros);
$url = 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx';
$curl = curl_init($url.'?'.$parametros);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$dados = curl_exec($curl);
$dados = simplexml_load_string($dados);

foreach($dados->cServico as $linhas) {
    if($linhas->Erro == 0) {
        echo $linhas->Codigo.'</br>';
        echo $linhas->Valor .'</br>';
        echo $linhas->PrazoEntrega.' Dias </br>';
    }else {
        echo $linhas->MsgErro;
    }
echo '<hr>';
}

