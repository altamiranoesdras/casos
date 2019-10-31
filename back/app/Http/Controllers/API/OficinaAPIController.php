<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOficinaAPIRequest;
use App\Http\Requests\API\UpdateOficinaAPIRequest;
use App\Models\Oficina;
use App\Repositories\OficinaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class OficinaController
 * @package App\Http\Controllers\API
 */

class OficinaAPIController extends AppBaseController
{
    /** @var  OficinaRepository */
    private $oficinaRepository;

    public function __construct(OficinaRepository $oficinaRepo)
    {
        $this->oficinaRepository = $oficinaRepo;
    }

    /**
     * Display a listing of the Oficina.
     * GET|HEAD /oficinas
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $oficinas = $this->oficinaRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($oficinas->toArray(), 'Oficinas retrieved successfully');
    }

    /**
     * Store a newly created Oficina in storage.
     * POST /oficinas
     *
     * @param CreateOficinaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateOficinaAPIRequest $request)
    {
        $input = $request->all();

        $oficina = $this->oficinaRepository->create($input);

        return $this->sendResponse($oficina->toArray(), 'Oficina saved successfully');
    }

    /**
     * Display the specified Oficina.
     * GET|HEAD /oficinas/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Oficina $oficina */
        $oficina = $this->oficinaRepository->find($id);

        if (empty($oficina)) {
            return $this->sendError('Oficina not found');
        }

        return $this->sendResponse($oficina->toArray(), 'Oficina retrieved successfully');
    }

    /**
     * Update the specified Oficina in storage.
     * PUT/PATCH /oficinas/{id}
     *
     * @param int $id
     * @param UpdateOficinaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOficinaAPIRequest $request)
    {
        $input = $request->all();

        /** @var Oficina $oficina */
        $oficina = $this->oficinaRepository->find($id);

        if (empty($oficina)) {
            return $this->sendError('Oficina not found');
        }

        $oficina = $this->oficinaRepository->update($input, $id);

        return $this->sendResponse($oficina->toArray(), 'Oficina updated successfully');
    }

    /**
     * Remove the specified Oficina from storage.
     * DELETE /oficinas/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Oficina $oficina */
        $oficina = $this->oficinaRepository->find($id);

        if (empty($oficina)) {
            return $this->sendError('Oficina not found');
        }

        $oficina->delete();

        return $this->sendResponse($id, 'Oficina deleted successfully');
    }
}
