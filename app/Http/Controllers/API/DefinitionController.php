<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Definition;
use App\Models\DefinitionRating;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


/**
 * Definition endpoint management.
 *
 * Sets endpoints for definitions and management of data and authorization.
 *
 * @group endpoints/definitions
 *
 */

class DefinitionController extends Controller
{
    /**
     * Authorization management.
     *
     * Checks if the current user has authorization to alter the stored data.
     *
     * @param $data
     * @return bool boolean
     *
     * When unauthorized:
     *
     * @response
     * {
     * "message": "Unauthorized"
     * }
     */
    public function checkAuthorization($data): bool
    {
        if (!auth('sanctum')->user()->hasRole('admin'))
        {
            if ($data->user->hasRole('admin')) {
                return false;
            }
        }

        if (auth('sanctum')->user()->hasRole('user')){
            if (auth('sanctum')->id() !== $data->user->id) {
                return false;
            }
        }
        return true;
    }

    /**
     * GET definitions
     *
     * Displays a full list of the stored resources with pagination.
     *
     *
     * @return JsonResponse
     * @response
     * {
     * "current_page": 1,
     * "data": [
     * {
     * "id": 1,
     * "word_id": 1,
     * "word_type_id": 1,
     * "definition": "Test",
     * "user_id": 1,
     * "appropriate": 0,
     * "created_at": "2023-12-05T12:07:15.000000Z",
     * "updated_at": "2023-12-06T06:07:26.000000Z"
     * },
     * },
     * {
     * "id": 2,
     * "word_id": 2,
     * "word_type_id": 2,
     * "definition": "New",
     * "user_id": 1,
     * "appropriate": 0,
     * "created_at": "2023-12-05T12:07:15.000000Z",
     * "updated_at": "2023-12-06T06:07:26.000000Z"
     * }
     *
     */
    public function index(): JsonResponse
    {
        $definitionRatings = DefinitionRating::all();
        $definitions = Definition::paginate();

        if ($definitions->isEmpty()) {
            return response()->json(['message' => 'no data'], 404);
        }

        return response()->json([$definitions, $definitionRatings]);
    }

    /**
     * GET definition
     *
     * Displays a single specified resource in storage.
     *
     * @param int $id
     * @return JsonResponse
     * @response
     * {
     * "id": 1,
     * "word_id": 1,
     * "word_type_id": 1,
     * "definition": "Test",
     * "user_id": 1,
     * "appropriate": 0,
     * "created_at": "2023-12-05T12:07:15.000000Z",
     * "updated_at": "2023-12-06T06:07:26.000000Z"
     * }
     */
    public function show(int $id): JsonResponse
    {
        $definition = Definition::find($id);

        if (!$definition)
        {
            return response()->json(['message' => 'no data'], 404);
        }

        return response()->json($definition);
    }

    /**
     * POST definition
     *
     * Stores a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     * @response
     * {
     * "created": {
     * "definition": "Test",
     * "word_id": 1,
     * "word_type_id": 1,
     * "user_id": 1,
     * "created_at": "2023-12-05T12:07:15.000000Z",
     * "updated_at": "2023-12-06T06:07:26.000000Z"
     * "id": 1
     * }
     * }
     */
    public function store(Request $request): JsonResponse
    {
        if (auth('sanctum')->check())
        {
            $request->request->add(['user_id' => auth('sanctum')->id()]);
        }

        $validator = Validator::make($request->all(), [
            'definition' => 'required',
            'word_id' => 'required',
            'word_type_id' => 'required',
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $definition = Definition::create($request->all());
        return response()->json(['created' => $definition], 201);

    }

    /**
     *
     * PATCH definition
     *
     * Updates a single specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     * @response
     * {
     * "updated": {
     * "id": 28,
     * "word_id": "4",
     * "word_type_id": 1,
     * "definition": "New Test",
     * "user_id": 1,
     * "appropriate": 0,
     * "created_at": "2024-01-19T07:46:21.000000Z",
     * "updated_at": "2024-01-19T07:51:03.000000Z"
     * }
     * }
     */
    public function update(Request $request, int $id): JsonResponse
    {

        $definition = Definition::find($id);

        if (!$definition){
            return response()->json(['message' => 'no data'], 404);
        }

        $validator = Validator::make($request->all(), [
            'definition' => ['required'],
            'word_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        if (!$this->checkAuthorization($definition))
        {
            return response()->json(['message' => 'unauthorized'], 401);
        }

        $definition->update($request->all());
        return response()->json(['updated' => $definition], 201);
    }

    /**
     * DELETE word
     *
     * Removes a single specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     * @response
     * {
     * "deleted": {
     * "id": 28,
     * "word_id": "4",
     * "word_type_id": 1,
     * "definition": "New Test",
     * "user_id": 1,
     * "appropriate": 0,
     * "created_at": "2024-01-19T07:46:21.000000Z",
     * "updated_at": "2024-01-19T07:51:03.000000Z"
     * }
     * }
     */
    public function destroy(int $id): JsonResponse
    {

        $definition = Definition::find($id);

        if (!$definition) {
            return response()->json(['error' => 'no data'], 404);
        }

        if (!$this->checkAuthorization($definition))
        {
            return response()->json(['message' => 'unauthorized'], 401);
        }

        $oldDefinition = $definition;
        $definition->delete();

        return response()->json(['deleted' => $oldDefinition]);
    }
}
