<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCasoAPIRequest;
use App\Http\Requests\API\UpdateCasoAPIRequest;
use App\Models\Caso;
use App\Repositories\CasoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class CasoController
 * @package App\Http\Controllers\API
 */

class CasoAPIController extends AppBaseController
{
    /** @var  CasoRepository */
    private $casoRepository;

    public function __construct(CasoRepository $casoRepo)
    {
        $this->casoRepository = $casoRepo;
    }

    /**
     * Display a listing of the Caso.
     * GET|HEAD /casos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $casos = $this->casoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($casos->toArray(), 'Casos retrieved successfully');
    }

    /**
     * Store a newly created Caso in storage.
     * POST /casos
     *
     * @param CreateCasoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCasoAPIRequest $request)
    {
        $input = $request->all();

        $caso = $this->casoRepository->create($input);

        return $this->sendResponse($caso->toArray(), 'Caso saved successfully');
    }

    /**
     * Display the specified Caso.
     * GET|HEAD /casos/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Caso $caso */
        $caso = $this->casoRepository->find($id);

        if (empty($caso)) {
            return $this->sendError('Caso not found');
        }

        return $this->sendResponse($caso->toArray(), 'Caso retrieved successfully');
    }

    /**
     * Update the specified Caso in storage.
     * PUT/PATCH /casos/{id}
     *
     * @param int $id
     * @param UpdateCasoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCasoAPIRequest $request)
    {
        $input = $request->all();

        /** @var Caso $caso */
        $caso = $this->casoRepository->find($id);

        if (empty($caso)) {
            return $this->sendError('Caso not found');
        }

        $caso = $this->casoRepository->update($input, $id);

        return $this->sendResponse($caso->toArray(), 'Caso updated successfully');
    }

    /**
     * Remove the specified Caso from storage.
     * DELETE /casos/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Caso $caso */
        $caso = $this->casoRepository->find($id);

        if (empty($caso)) {
            return $this->sendError('Caso not found');
        }

        $caso->delete();

        return $this->sendResponse($id, 'Caso deleted successfully');
    }
}
