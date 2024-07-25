<?php
    include("cabecalho.php");
    $url = "https://www.canalti.com.br/api/pokemons.json";

    #Inicializar a URL
    $ch = curl_init($url);

    #Configuração da requisição
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    #Executar a requisição
    $response = curl_exec($ch);

    #Avaliar se existe erro
    if(curl_errno($ch)){
        echo "<p> Erro na requisição cURL: ".curl_error($ch)."</p>";
    }else{
        #Decodificar
        $result = json_decode($response);
        
        if($result == null){
           echo "<p>Falha ao decodificar o conteúdo da API</p>";
        }else if(empty($result->pokemon)){
            echo "<p>API não retornou valores</p>";          
        }else{
?>
<table class="table table-striped table-bordered">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Imagem</th>
    </tr>
    <?php
        foreach ($result->pokemon as $value){
    ?>
    <tr>
        <th><?=$value->id?></th>
        <th><?=$value->name?></th>
        <th><img src="<?=$value->img ?>"></th>
    </tr>
    <?php        
    }
    ?>
</table>
<?php
    }
}
    curl_close($ch);
    include("rodape.php");
?>