<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCasoEstadoAPIRequest;
use App\Http\Requests\API\UpdateCasoEstadoAPIRequest;
use App\Models\CasoEstado;
use App\Repositories\CasoEstadoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class CasoEstadoController
 * @package App\Http\Controllers\API
 */

class CasoEstadoAPIController extends AppBaseController
{
    /** @var  CasoEstadoRepository */
    private $casoEstadoRepository;

    public function __construct(CasoEstadoRepository $casoEstadoRepo)
    {
        $this->casoEstadoRepository = $casoEstadoRepo;
    }

    /**
     * Display a listing of the CasoEstado.
     * GET|HEAD /casoEstados
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $casoEstados = $this->casoEstadoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($casoEstados->toArray(), 'Caso Estados retrieved successfully');
    }

    /**
     * Store a newly created CasoEstado in storage.
     * POST /casoEstados
     *
     * @param CreateCasoEstadoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCasoEstadoAPIRequest $request)
    {
        $input = $request->all();

        $casoEstado = $this->casoEstadoRepository->create($input);

        return $this->sendResponse($casoEstado->toArray(), 'Caso Estado saved successfully');
    }

    /**
     * Display the specified CasoEstado.
     * GET|HEAD /casoEstados/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var CasoEstado $casoEstado */
        $casoEstado = $this->casoEstadoRepository->find($id);

        if (empty($casoEstado)) {
            return $this->sendError('Caso Estado not found');
        }

        return $this->sendResponse($casoEstado->toArray(), 'Caso Estado retrieved successfully');
    }

    /**
     * Update the specified CasoEstado in storage.
     * PUT/PATCH /casoEstados/{id}
     *
     * @param int $id
     * @param UpdateCasoEstadoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCasoEstadoAPIRequest $request)
    {
        $input = $request->all();

        /** @var CasoEstado $casoEstado */
        $casoEstado = $this->casoEstadoRepository->find($id);

        if (empty($casoEstado)) {
            return $this->sendError('Caso Estado not found');
        }

        $casoEstado = $this->casoEstadoRepository->update($input, $id);

        return $this->sendResponse($casoEstado->toArray(), 'CasoEstado updated successfully');
    }

    /**
     * Remove the specified CasoEstado from storage.
     * DELETE /casoEstados/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var CasoEstado $casoEstado */
        $casoEstado = $this->casoEstadoRepository->find($id);

        if (empty($casoEstado)) {
            return $this->sendError('Caso Estado not found');
        }

        $casoEstado->delete();

        return $this->sendResponse($id, 'Caso Estado deleted successfully');
    }
}
