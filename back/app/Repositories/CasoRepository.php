<?php

namespace App\Repositories;

use App\Models\Caso;
use App\Repositories\BaseRepository;

/**
 * Class CasoRepository
 * @package App\Repositories
 * @version October 31, 2019, 6:47 pm UTC
*/

class CasoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'caso_estado_id',
        'titulo',
        'cuerpo'
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
        return Caso::class;
    }
}
