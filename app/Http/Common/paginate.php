<?php

namespace App\Http\Common;

class Paginate{
    public static function paginate($query, $limit){
        return $query->paginate($limit);
    }
}