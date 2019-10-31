<?php

namespace App\Repositories;

use App\Models\Oficina;
use App\Repositories\BaseRepository;

/**
 * Class OficinaRepository
 * @package App\Repositories
 * @version October 31, 2019, 6:13 pm UTC
*/

class OficinaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'empresa_id',
        'nombre',
        'telefono',
        'correo',
        'responsable'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Oficina::class;
    }
}
