<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="styles/style.css" rel="stylesheet">
    <title>Pokemon</title>
</head>
<body>
<div id="pokedex">
    <div class="container">
        <div class="tela">
        <?php
            $url = "https://pokeapi.co/api/v2/pokemon/?limit=100"; // limitando a quantidade de pokemons
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $output = curl_exec($ch);
            curl_close($ch);

            $pokemons = json_decode($output);

            foreach ($pokemons->results as $pokemon) {
                $url = $pokemon->url;
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $output = curl_exec($ch);
                curl_close($ch);

                $pokemon_info = json_decode($output);
        ?>
             <div class="pokemon">
                <h1><?= $pokemon_info->name?></h1>
                <div class="imagem">
                    <img src="<?= $pokemon_info->sprites->front_default ?>">
                </div>
                <h2><span class="tipo">Tipo:</span> <?= $pokemon_info->base_experience ?></h2>
                <div class="dados">
                    <p><strong>Peso:</strong> <?= $pokemon_info->weight/10 ?></p>
                    <p><strong>Altura:</strong> <?= $pokemon_info->height/10 ?></p>
                    <p><strong>Força:</strong> <?= $pokemon_info->stats[0]->base_stat ?></p>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
       
    </div>
    <div class="botoes">
        <button id="descer" onclick="descer()"><i class="fa-solid fa-chevron-down"></i></button><button id="subir" onclick="subir()"><i class="fa-solid fa-chevron-up"></i></button>
    </div>
</div>
<script>
    let tela = document.querySelector('.tela');
    let qtd = document.querySelectorAll(".pokemon").length - 1;
    let btdescer = document.querySelector("#descer");
    let btsubir = document.querySelector("#subir");
    btsubir.disabled = true;
    let maximo = qtd * 320;
    let pos = 0;
    function descer() {
        pos += 320;
        if(pos >= maximo){
            pos = maximo;  
            btdescer.disabled = true;
        }else{
            btsubir.disabled = false;         
        }      
       
       tela.scrollTo(0, pos);
    }
    function subir(){
        
        pos -= 320;
        if(pos <= 0){
            pos = 0; 
            btsubir.disabled = true;
        }else{
            btdescer.disabled = false;         
        }
       
       tela.scrollTo(0, pos);
    }        
</script>
    
</body>
</html>