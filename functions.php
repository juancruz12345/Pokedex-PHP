<?php

declare(strict_types= 1);

const API_URL = "https://pokeapi.co/api/v2/pokemon/";
const API_URL_TODOS = "https://pokeapi.co/api/v2/pokemon?limit=100000&offset=0";
const API_URL_ABILITES = "https://pokeapi.co/api/v2/ability/";

function get_data_by_name($url, $name){
    
    $result = file_get_contents($url."".$name."");
    $data = json_decode($result, true);
    return $data;
}
function get_all_data($url){
    $result = file_get_contents($url);
    $data = json_decode($result, true);
    return $data;
}
function get_abilites($url){
    $result = file_get_contents($url);
    $data = json_decode($result, true);
    return $data;
}

$allData = get_all_data(API_URL_TODOS);


    
   
