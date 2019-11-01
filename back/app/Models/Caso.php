<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class Caso
 * @package App\Models
 * @version October 31, 2019, 6:47 pm UTC
 *
 * @property \App\Models\CasoEstado casoEstado
 * @property \Illuminate\Database\Eloquent\Collection casoBitacoras
 * @property \Illuminate\Database\Eloquent\Collection oficinas
 * @property integer caso_estado_id
 * @property string titulo
 * @property string cuerpo
 */
class Caso extends Model
{

    public $table = 'casos';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $with = ['estado'];

    public $fillable = [
        'caso_estado_id',
        'titulo',
        'cuerpo'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'caso_estado_id' => 'integer',
        'titulo' => 'string',
        'cuerpo' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'titulo' => 'required',
        'cuerpo' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function estado()
    {
        return $this->belongsTo(\App\Models\CasoEstado::class, 'caso_estado_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function bitacoras()
    {
        return $this->hasMany(\App\Models\CasoBitacora::class, 'caso_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function ruta()
    {
        return $this->belongsToMany(\App\Models\Oficina::class, 'caso_ruta');
    }
}
