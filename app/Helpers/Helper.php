<?php


namespace App\Helpers;


use Illuminate\Support\Str;

class Helper
{
    public static function  changeRequestSnakeCase($input){
        $grouped = collect($input)->flatMap(function ($item, $key) {
            return [Str::snake($key) => $item];
        });
        return $snaked_request = $grouped->toArray();
    }

    public static function  changeResponseCamelCase($input){
        $grouped = collect($input)->flatMap(function ($item, $key) {
            return [Str::camel($key) => $item];
        });
        return $snaked_request = $grouped->toArray();
    }

    public static function  multiArraySnakeCase($input){
        $grouped = collect($input)->map(function ($item){
            return collect($item)->flatMap(function ($value,$key){
                return [Str::snake($key)=>$value];
            })->all();
        });
        return collect($grouped)->all();
    }

    public static function  multiArrayResponseCamelCase($input){
        $grouped = collect($input)->map(function ($item){
            return collect($item)->flatMap(function ($value,$key){
                return [Str::snake($key)=>$value];
            })->all();
        });
        return collect($grouped)->all();
    }

    public static function makeAcronym($string){
        $acronym =  Str::of($string)->explode(' ')->map(function ($item) {
            return  substr($item, 0, 1);
        })->all();
        return Str::upper(implode("",$acronym));
    }

}
