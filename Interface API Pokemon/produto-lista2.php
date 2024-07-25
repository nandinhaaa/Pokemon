<?php
    include("cabecalho.php");
    $url = "https://www.canalti.com.br/api/pokemons.json";

    $jsonContents = file_get_contents($url);

    #verificar se não foi 
    if($jsonContents($ch) === false){
        echo "<p>  Não foi possivel acessar a API </p>";
    } else {
        #Decodificar
        $result = json_decode($response);
        
        if($result == null){
           echo "<p>Falha ao decodificar o conteúdo da API</p>";
        } else if(empty($result->pokemon)){
            echo "<p>API não retornou valores</p>";          
        } else {
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

    include("rodape.php");
?>