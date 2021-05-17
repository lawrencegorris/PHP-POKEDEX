<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>POKEDEX-PHP STYLE</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
<h1>POKEDEX - PHP STYLE</h1>

<section id="search-box" class="section">
<form action="">
    <label>
        Search for a pokemon!
        <br>
        <input type="text" name="pokemon">
    </label>
    <br>
    <button type="submit">Search POKéDEX</button>
</form>
</section>

<section id="pokemon-stats" class="section">
    <?php
        $pokemon_name = '';
        $pokemon_id = '';
        $pokemon_image = '';
        $pokemon_evolutions = '';

        if(!empty($_GET["pokemon"])){
            $pokeapi_url = 'https://pokeapi.co/api/v2/pokemon/' . $_GET["pokemon"];
            $pokespecies_url = 'https://pokeapi.co/api/v2/pokemon-species/' . $_GET["pokemon"];

            $pokemonData = file_get_contents($pokeapi_url);
            $pokespeciesData = file_get_contents($pokespecies_url);

            $pokemonStats = json_decode($pokemonData, true);
            $pokespecies = json_decode($pokespeciesData, true);

            $pokemon_name = $pokemonStats['name'];
            $pokemon_id = $pokemonStats['id'];
            $pokemon_image = $pokemonStats['sprites']['front_default'];
            $pokemon_evolutions = $pokespecies;
        }
    ?>
    <h2><?php echo $pokemon_name ?></h2>
    <h2><?php echo $pokemon_id ?></h2>
    <h2>
        <?php
            if($pokemon_evolutions['evolves_from_species'] === null){
                echo 'This pokemon has no previous form';
            }else{
                echo 'The previous form of this pokemon is ' . $pokemon_evolutions['evolves_from_species']['name'];
            }?>
    </h2>
    <ul>
        <li><?php echo $pokemonStats['moves'][0]['move']['name'] ?></li>
        <li><?php echo $pokemonStats['moves'][1]['move']['name'] ?></li>
        <li><?php echo $pokemonStats['moves'][2]['move']['name'] ?></li>
        <li><?php echo $pokemonStats['moves'][3]['move']['name'] ?></li>
    </ul>
    <img src='<?php echo $pokemon_image ?>' width=200 alt="Image of currently searched pokemon">
</section>

</body>
</html>