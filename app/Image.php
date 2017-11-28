<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Image
 *
 * @package App
 */
class Image extends Model
{

    protected $columns = [
        'title',
        'description',
        'name',
        'is_default',
        'created_at',
        'updated_at',
        'id',
    ];

    /**
     * @var string
     */
    protected $table = 'images';

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'name',
        'is_default',
    ];

    public function scopeExclude($query, $value = []){
        return $query->select(array_diff($this->columns, (array)$value));
    }
}
