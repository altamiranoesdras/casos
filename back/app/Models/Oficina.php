<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class Oficina
 * @package App\Models
 * @version October 31, 2019, 6:13 pm UTC
 *
 * @property \App\Models\Empresa empresa
 * @property \App\Models\User responsable
 * @property \Illuminate\Database\Eloquent\Collection casoBitacoras
 * @property \Illuminate\Database\Eloquent\Collection casos
 * @property integer empresa_id
 * @property string nombre
 * @property string telefono
 * @property string correo
 * @property integer responsable
 */
class Oficina extends Model
{

    public $table = 'oficinas';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'empresa_id',
        'nombre',
        'telefono',
        'correo',
        'responsable'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'empresa_id' => 'integer',
        'nombre' => 'string',
        'telefono' => 'string',
        'correo' => 'string',
        'responsable' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'empresa_id' => 'required',
        'nombre' => 'required',
        'responsable' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function empresa()
    {
        return $this->belongsTo(\App\Models\Empresa::class, 'empresa_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function responsable()
    {
        return $this->belongsTo(\App\Models\User::class, 'responsable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function casoBitacoras()
    {
        return $this->hasMany(\App\Models\CasoBitacora::class, 'oficina_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function casos()
    {
        return $this->belongsToMany(\App\Models\Caso::class, 'caso_ruta');
    }
}
