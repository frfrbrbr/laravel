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
            'randLimit' => 5
        ],
        'swapi' => [
            'url' => 'https://swapi.co/api/people/%d/',
            'type' => 'Starwars (people)',
            'randLimit' => 5
        ],
        'dog' => [
            'url' => 'https://dog.ceo/api/breed/boxer/images/random',
            'type' => 'Boxer'
        ]
    ];
    
    public static function fetch() {
        $client = new Client(); 
        $arr= [];
        
        foreach (self::API_ENDPOINTS as $key => $value) {
            $url = !empty($value['randLimit']) ? 
                sprintf($value['url'], rand(1, $value['randLimit'])) :
                    $value['url'];
                    
            $arr[$key] = Votable::find($url);
            
            if (empty($arr[$key])) {
                $obj = json_decode($client->get($url)->getBody());
                $arr[$key]= self::$key($obj, $url, $value['type']);
                $obj = false;
            }
        }
        
        return $arr;
    }
    
    private static function pokeapi($apiResponse, $url, $type) {
        $votable = new Votable();
        $votable->url =  $url;
        $votable->type = $type;
        $votable->name = $apiResponse->name;
        $votable->img = $apiResponse->sprites->front_default;
        $votable->save();
        return $votable;
    }
    
    private static function swapi($apiResponse, $url, $type) {
        $votable = new Votable();
        $votable->url =  $url;
        $votable->type = $type;
        $votable->name = $apiResponse->name;
        $votable->save();
        return $votable;
    }
    
    private static function dog($apiResponse, $url, $type) {
        $votable = Votable::find($apiResponse->message);
        if (empty($votable)) {
            $votable = new Votable();
            $votable->url =  $apiResponse->message;
            $votable->type = $type;
            $votable->name = str_replace("https://images.dog.ceo/breeds/boxer/", "", $apiResponse->message);
            $votable->img = $apiResponse->message;
            $votable->save();
        }
        return $votable;
    }
}