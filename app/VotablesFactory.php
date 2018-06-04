<?php

namespace App;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Votable;

class VotablesFactory {
    
    CONST API_ENDPOINTS = [
        'pokeapi' => [
            'url' => 'https://pokeapi.co/api/v2/pokemon-form/%d/',
            'type' => 'Pokemon',
            'randLimit' => 5,
            'properties' => [
                'name' => 'name',
                'img' => 'front_default'
            ],
        ],
        'swapi' => [
            'url' => 'https://swapi.co/api/people/%d/',
            'type' => 'Starwars (people)',
            'randLimit' => 5,
            'properties' => [
                'name' => 'name'
            ]
        ]
    ];
    
    public static function fetch() {
        $client = new Client(); 
        $arr= [];
        foreach (self::API_ENDPOINTS as $key => $value) {
            $url = sprintf($value['url'], rand(1, $value['randLimit']));
            $obj = json_decode($client->get($url)->getBody());
                    
            if (!empty($obj)) {
                $arr[$key] = Votable::find($url);
                if (empty($arr[$key])) {
                    $arr[$key] = new Votable();
                    $arr[$key]->url =  $url;
                    $arr[$key]->type= $value['type'];
                    
                    if (!empty($obj->sprites)) {
                        $obj->front_default = $obj->sprites->front_default;
                    }
                    
                    foreach ($value['properties'] as $propertyKey => $propertyValue) {
                        $arr[$key]->$propertyKey = $obj->$propertyValue;
                    }
                    
                    $arr[$key]->save();
                }
                $obj = false;    
            }
        }
        
        return $arr;
    }
}