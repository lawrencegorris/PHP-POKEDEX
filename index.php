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
    <?php
    $pokemon_image = '';
    $pokemon_evolutions = '';

    if(!empty($_GET["pokemon"])){
        $pokeapi_url = 'https://pokeapi.co/api/v2/pokemon/' . $_GET["pokemon"];
        $pokespecies_url = 'https://pokeapi.co/api/v2/pokemon-species/' . $_GET["pokemon"];

        $pokemonData = file_get_contents($pokeapi_url);
        $pokespeciesData = file_get_contents($pokespecies_url);

        $pokemonStats = json_decode($pokemonData, true);
        $pokespecies = json_decode($pokespeciesData, true);

        $pokemon_image = $pokemonStats['sprites']['front_default'];
        $pokemon_evolutions = $pokespecies;
    }
    ?>
    <label>
        Search for a pokemon!
        <br>
        <input type="text" name="pokemon">
    </label>
    <br>
    <button type="submit">Search POKéDEX</button>
</form>
</section>

<section id="pokemon-info" class="section">

    <section class="stat-block">
        <h2 id="pokemon-name"><?php echo ucwords($pokemonStats['name']) ?></h2>
        <h3 id="pokemon-id"><?php echo '#' . $pokemonStats['id'] ?></h3>
        <ul id="types">
            <li><?php echo ucwords($pokemonStats['types'][0]['type']['name']) . ' ' ?></li>
            <li><?php echo ' ' . ucwords($pokemonStats['types'][1]['type']['name']) ?></li>
        </ul>

        <img src='<?php echo $pokemon_image ?>' alt="Image of currently searched pokemon">
        <h3>
            <?php
                if($pokemon_evolutions['evolves_from_species'] === null){
                    echo 'This pokemon has no previous form';
                }else{
                    echo 'The evolved form of ' . $pokemon_evolutions['evolves_from_species']['name'];
                }?>
        </h3>
        <ul id="moves">
            Moves:
            <li><?php echo ucwords($pokemonStats['moves'][0]['move']['name']) ?></li>
            <li><?php echo ucwords($pokemonStats['moves'][1]['move']['name']) ?></li>
            <li><?php echo ucwords($pokemonStats['moves'][2]['move']['name']) ?></li>
            <li><?php echo ucwords($pokemonStats['moves'][3]['move']['name']) ?></li>
        </ul>
    </section>

    <section class="stat-block">
        <h3>STATS:</h3>
        <div class="stat">
            <p><?php echo strtoupper($pokemonStats['stats'][0]['stat']['name']) . ': ' ?></p>
            <p><?php echo strtoupper($pokemonStats['stats'][0]['base_stat']) ?></p>
        </div>
        <div class="stat">
            <p><?php echo strtoupper($pokemonStats['stats'][1]['stat']['name']) . ': ' ?></p>
            <p><?php echo strtoupper($pokemonStats['stats'][1]['base_stat']) ?></p>
        </div>
        <div class="stat">
            <p><?php echo strtoupper($pokemonStats['stats'][2]['stat']['name']) . ': ' ?></p>
            <p><?php echo strtoupper($pokemonStats['stats'][2]['base_stat']) ?></p>
        </div>
    </section>
    <section class="stat-block">
        <h3>SHINY VERSION</h3>
        <img src='<?php echo $pokemon_image = $pokemonStats['sprites']['front_shiny']; ?>
          ' alt="Shiny version of currently searched pokemon">
        <h3>ALTERNATE ARTWORK</h3>
        <img id="shiny-version" src='<?php echo $pokemon_image = $pokemonStats['sprites']['other']['official-artwork']['front_default']; ?>
          ' alt="Official artwork of currently searched pokemon">

    </section>

</section>
</body>
</html>