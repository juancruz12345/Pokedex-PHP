

<?php 

    require_once 'functions.php';
    $nameArray = array();
    $data;
    $randomName;
    $habilidades;
    for( $i =0; $i< 1302; $i++ ){
        array_push($nameArray,$allData['results'][$i]['name']);
       
    }
    $randomName =  $nameArray[array_rand( $nameArray)];
    if(isset($_POST['nombre'])){
        $name = htmlspecialchars($_POST['nombre']);
        if(in_array( $name, $nameArray)){
            $data = get_data_by_name(API_URL,$name);
            for($j=0;$j<count($data['abilities']);$j++){
                $habilidades[$j] = get_abilites($data['abilities'][$j]['ability']['url']);
               
           } 
        }
        else{
            $data = null;
         }
        
    }
    else if(!isset($_POST['nombre'])){
        $data = get_data_by_name(API_URL, $randomName);
        for($j=0;$j<count($data['abilities']);$j++){
            $habilidades[$j] = get_abilites($data['abilities'][$j]['ability']['url']);
           
       } 
    }
    
 
    function botonRandom($randomName, $data){
        $data = get_data_by_name(API_URL, $randomName);
        return $data;
    }
   
    if(array_key_exists('button1', $_POST)) { 
       $data= botonRandom($randomName, $data); 
    }  
?>


<head>
    <meta charset="UTF-8" />
    <title>Pokedex</title>
    <link rel="stylesheet" href="index.css" />
</head>



<main>
   <header><span class="title">Pokedex Api</span></header>
  
    <pre>
        
        <section>
    <?php if($data!==null): ?> 
        <div class="col1">
       <div class="col1Div">
       <div class="types">
            <h2>Types: </h2>
            <?php for($i=0;$i<count($data['types']);$i++){?>
                <h2> <?=$data['types'][$i]['type']['name']?>  </h2>
             <?php } ?>
        </div>
     <div class="habilidadesDiv">
            <h2>Abilities:</h2>
            <div class="habilidades">
            <?php for($i=0;$i<count($data['abilities']);$i++){ ?>
                
            <span class="habilidad">-<?= $data['abilities'][$i]['ability']['name'] ?>:</span>
           <?php for($j=0;$j<count($habilidades[$i]['flavor_text_entries']);$j++){ ?>
            <?php if($habilidades[$i]['flavor_text_entries'][$j]['language']['name']==='en'){ ?>
                
                <p class="habilidadDescription"><?= $habilidades[$i]['flavor_text_entries'][$j]['flavor_text'] ?></p>
         
            <?php break; }?>
            <?php } ?>
            <?php } ?>
            </div>
       </div>
        </div>
        
    </div>
        <div class='col2'>
       <div class="col2div">
       <span class='gameIndex'>Id: <?= $data['id'] ?></span>
        <span><?= $data['name'] ?></span>
        <img class="pokemonImg" src="<?= $data['sprites']['other']['home']['front_default'] ?>" />
       </div>
        </div>
         
        <div class="col3">
        <div class="col3div">
        <h1>Stats:</h1>
        <div class='stats'>
        
        <span>Base HP: <?= $data['stats'][0]['base_stat'] ?></span>
        <span>Base Attack: <?= $data['stats'][1]['base_stat'] ?></span>
        <span>Base Defense: <?= $data['stats'][2]['base_stat'] ?></span>
        <span>Base Special Attack: <?= $data['stats'][3]['base_stat'] ?></span>
        <span>Base Special Defense: <?= $data['stats'][4]['base_stat'] ?></span>
        <span>Base Speed: <?= $data['stats'][5]['base_stat'] ?></span>
        </div>
        </div>
        </div>
        
    <?php else: ?>
        <div class="col1">
        <div class="col1Div"></div>
        </div>
        <div class='col2'>
       <div class='col2div'><h1>Not found this pokemon...</h1></div>
        </div>
         <div class="col3">
        <div class="col3Div"></div>
        </div>
    <?php endif; ?>
   
  
    </section>
    </pre>
    <div class="divForm">
    <form  method="post">
    <label>Nombre del Pókemon:</label>
    <input type="text" name="nombre" class="input" placeholder="Nombre del Pókemon..."/>
    <button type="submit" class='input'>Buscar</button>
    </form>
    <form method="post">
         <input type="submit" name="button1"class="button" value="Buscar Pokemon Random" />
         
    </form>
    </div>
   
   
   
</main>



