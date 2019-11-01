<?php

namespace App\Repositories;

use App\Models\CasoEstado;
use App\Repositories\BaseRepository;

/**
 * Class CasoEstadoRepository
 * @package App\Repositories
 * @version November 1, 2019, 1:15 pm UTC
*/

class CasoEstadoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre'
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
        return CasoEstado::class;
    }
}
