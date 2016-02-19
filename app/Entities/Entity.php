<?php
/**
 * Created by PhpStorm.
 * User: emerson
 * Date: 16/02/16
 * Time: 20:46
 */

namespace TeachMe\Entities;


use Illuminate\Database\Eloquent\Model;

class Entity extends Model{

    public static function getClass()
    {
        return get_class(new static);

    }

}