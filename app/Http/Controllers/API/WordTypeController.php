<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateWordTypeRequest;
use App\Models\Word;
use App\Models\WordType;
use Exception;
use http\Client\Curl\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

/**
 * Word Type Endpoints
 *
 * Sets endpoints for word types and management of data and authorization.
 *
 * @group Endpoints
 *
 */

class WordTypeController extends Controller
{
    protected function checkAuthorization(String $role): bool
    {
        if (!auth('sanctum')->user()->hasRole([$role]))
        {
            return false;
        }
        else {
            return true;
        }
    }

    /**
     * GET wordtypes
     *
     * Displays a full list of the stored resources with pagination.
     *
     * @return JsonResponse
     * @response
     * "current_page": 1,
     * "data": [
     * {
     * "id": 1,
     * "code": "TS",
     * "name": "Test",
     * "created_at": "2023-12-06T09:19:36.000000Z",
     * "updated_at": "2024-01-19T05:06:42.000000Z"
     * },
     * {
     * "id": 11,
     * "code": "AC",
     * "name": "Acronym",
     * "created_at": "2023-12-06T09:19:36.000000Z",
     * "updated_at": "2023-12-06T09:19:36.000000Z"
     * }
     * ]
     *
     */
    public function index(): JsonResponse
    {
        if (!$this->checkAuthorization('admin')) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $wordTypes = WordType::paginate();

        if ($wordTypes->isEmpty()) {
            return response()->json(['error' => 'no data'], 404);
        }

        return response()->json($wordTypes);
    }

    /**
     * GET wordtype
     *
     * Displays a single specified resource in storage.
     *
     * @param int $id
     * @return JsonResponse
     * @response
     * {
     * "id": 1,
     * "code": "TS",
     * "name": "Test",
     * "created_at": "2023-12-05T12:07:15.000000Z",
     * "updated_at": "2023-12-06T06:07:26.000000Z"
     * }
     */
    public function show(int $id): JsonResponse
    {
        if (!$this->checkAuthorization('admin')) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $wordType = WordType::find($id);

        if (!$wordType)
        {
            return response()->json(['error' => 'no data'], 404);
        }

        return response()->json($wordType);
    }

    /**
     * POST wordtype
     *
     * Stores a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     * @response
     * {
     * "created": {
     * "code": "TS",
     * "name": "Test",
     * "created_at": "2023-12-05T12:07:15.000000Z",
     * "updated_at": "2023-12-06T06:07:26.000000Z"
     * "id": 1
     * }
     * }
     */
    public function store(Request $request): JsonResponse
    {
        if (!$this->checkAuthorization('admin')) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        if (auth('sanctum')->check())
        {
            $request->request->add(['user_id' => auth('sanctum')->id()]);
        }

        $validator = Validator::make($request->all(), [
            'code' => ['required', 'min:2', Rule::unique('word_types', 'code')],
            'name' => 'required',
            'user_id' => 'required'
        ], [
            'code.unique' => 'The code is already in use. Please use a different code.',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $wordType = WordType::create($request->all());
        return response()->json(['created' => $wordType], 201);
    }

    /**
     * PATCH wordtype
     *
     * Updates a single specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     * @response
     * {
     * "updated": {
     * "code": "TS",
     * "name": "New Test",
     * "created_at": "2023-12-05T12:07:15.000000Z",
     * "updated_at": "2023-12-06T06:07:26.000000Z"
     * "id": 1
     * }
     * }
     */
    public function update(Request $request, int $id): JsonResponse
    {
        if (!$this->checkAuthorization('admin')) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $wordType = WordType::find($id);

        if (!$wordType) {
            return response()->json(['error' => 'no data'], 404);
        }


        $validator = Validator::make($request->all(),
            [
            'code' => ['required', Rule::unique('word_types', 'code')->ignore($wordType->id)],
            'name' => ['required', 'max:64']
            ],
            [
            'code.unique' => 'The code is already in use. Please use a different code.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $wordType->update($request->all());
        return response()->json(['updated' => $wordType], 201);
    }

    /**
     * DELETE wordtype
     *
     * Removes a single specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     * @response
     * {
     * "deleted": {
     * "id": 1
     * "code": "TS",
     * "name": "New Test",
     * "created_at": "2023-12-05T12:07:15.000000Z",
     * "updated_at": "2023-12-06T06:07:26.000000Z"
     * }
     * }
     */
    public function destroy(int $id): JsonResponse
    {
        if (!$this->checkAuthorization('admin')) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $wordType = WordType::find($id);

        if (!$wordType) {
            return response()->json(['error' => 'no data'], 404);
        }

        $oldWordType = $wordType;
        $wordType->delete();

        return response()->json(['deleted' => $oldWordType]);
    }
}
