<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\BaseService;
use App\Services\UserService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

abstract class BaseController extends Controller
{
    protected BaseService $baseService;

    public function __construct(BaseService $baseService)
    {
        $this->baseService = $baseService;
    }

    protected abstract function resolveStoreRequest(): FormRequest;

    protected abstract function resolveUpdateRequest(): FormRequest;

    public function index()
    {
        $data = $this->baseService->all();
        return response()->json($data,200);
    }

    public function show($id)
    {
        $user = $this->baseService->find($id);
        if (!$user) {
            return response()->json(['success'=>false], 404);
        }
        return response()->json($user,200);
    }

    public function store()
    {
        $validatedData = $this->resolveStoreRequest()->validated();

        return response()->json($this->baseService->create($validatedData), 201);
    }

    public function update($id)
    {
        $validatedData = $this->resolveUpdateRequest()->validated();

        $updated = $this->baseService->update($id, $validatedData);

        if (!$updated) {
            return response()->json(['success'=> false], 404);
        }
        return response()->json($updated,200);
    }

    public function destroy($id)
    {
        if ($this->baseService->delete($id)) {
            return response()->noContent();
        }
        return response()->json(['success'=> false ], 404);
    }
}
