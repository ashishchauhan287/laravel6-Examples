<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = 'documents';
    protected $guarded = array();

    public function storeData($input)
    {
        return static::create($input);
    }
}