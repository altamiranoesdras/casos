<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class Empresa
 * @package App\Models
 * @version October 31, 2019, 5:02 pm UTC
 *
 * @property \App\Models\User admin
 * @property \Illuminate\Database\Eloquent\Collection oficinas
 * @property string nombre
 * @property string direccion
 * @property string telefono
 * @property string correo
 */
class Empresa extends Model
{

    public $table = 'empresas';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $with = ['admin'];

    public $fillable = [
        'nombre',
        'direccion',
        'telefono',
        'correo',
        'admin'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'direccion' => 'string',
        'telefono' => 'string',
        'correo' => 'string',
        'admin' => 'integer'
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function admin()
    {
        return $this->belongsTo(\App\User::class, 'admin');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function oficinas()
    {
        return $this->hasMany(\App\Models\Oficina::class, 'empresa_id');
    }
}
