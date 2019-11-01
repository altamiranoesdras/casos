<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class CasoEstado
 * @package App\Models
 * @version November 1, 2019, 1:15 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection casoBitacoras
 * @property \Illuminate\Database\Eloquent\Collection casos
 * @property string nombre
 */
class CasoEstado extends Model
{

    public $table = 'caso_estados';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'nombre'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function casoBitacoras()
    {
        return $this->hasMany(\App\Models\CasoBitacora::class, 'caso_estado_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function casos()
    {
        return $this->hasMany(\App\Models\Caso::class, 'caso_estado_id');
    }
}
