<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    use HasFactory;

    protected $primaryKey = "name";
    protected $keyType = "string";

    public $incrementing  = false;

    public static function getValue($name, $default= null)
    {
        $statistic = static::find($name);
        if(!$statistic){
            return $default;
        }
        
        return $statistic->value;
    } 

    public static function setValue($name, $value)
    {

        return static::query()->updateOrCreate([
            'name' => $name,
        ], [
            'value' => $value,
        ]);

    } 
}
