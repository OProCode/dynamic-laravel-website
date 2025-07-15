<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\DefinitionRating;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

/**
 * Definition Rating endpoint management.
 *
 * Sets endpoints for definition ratings and management of data and authorization.
 *
 * @group Endpoints
 *
 */

class DefinitionRatingController extends Controller
{
    /**
     * Authorization management
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
     * GET definitionratings
     *
     * Displays a full list of the stored resources with pagination.
     *
     * @return JsonResponse
     * @response
     * {
     * "current_page": 1,
     * "data": [
     * {
     * "id": 1,
     * "definition_id": 1,
     * "rating_id": 1,
     * "user_id": 1,
     * "value": 1,
     * "created_at": "2024-01-19T08:09:48.000000Z",
     * "updated_at": "2024-01-19T08:09:48.000000Z"
     * }
     * ],
     * }
     */
    public function index(): JsonResponse
    {
        $definitionRatings = DefinitionRating::paginate();

        if ($definitionRatings->isEmpty()) {
            return response()->json(['error' => 'no data'], 404);
        }

        if (!auth('sanctum')->user()) {
            return response()->json(['message', 'Unauthenticated'], 406);
        }

        return response()->json($definitionRatings);
    }

    /**
     * GET definitionrating
     *
     * Displays a single specified resource in storage.
     *
     * @param int $id
     * @return JsonResponse
     * @response
     * {
     * "id": 1,
     * "definition_id": 1,
     * "rating_id": 1,
     * "user_id": 1,
     * "value": 1,
     * "created_at": "2024-01-19T08:09:48.000000Z",
     * "updated_at": "2024-01-19T08:09:48.000000Z"
     * }
     */
    public function show(int $id): JsonResponse
    {
        $definitionRating = DefinitionRating::find($id);

        if (!$definitionRating) {
            return response()->json(['error' => 'no data'], 404);
        }

        return response()->json(DefinitionRating::find($id));
    }

    /**
     * POST definitionrating
     *
     * Stores a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     * @response
     * {
     * "created": {
     * "definition_id": 6,
     * "rating_id": 7,
     * "value": 6,
     * "user_id": 1,
     * "updated_at": "2024-01-19T09:12:15.000000Z",
     * "created_at": "2024-01-19T09:12:15.000000Z"
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
            'definition_id' => 'required',
            'rating_id' => 'required',
            'value' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $definitionRating = DefinitionRating::create($request->all());
        return response()->json(['created' => $definitionRating], 201);
    }

    /**
     *
     * PATCH definitionrating
     *
     * Updates a single specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     * @response
     * {
     * "updated": {
     * "id": 1,
     * "definition_id": 1,
     * "rating_id": 1,
     * "user_id": 1,
     * "value": 4,
     * "created_at": "2024-01-19T08:09:48.000000Z",
     * "updated_at": "2024-01-19T09:16:37.000000Z"
     * }
     * }
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $definitionRating = DefinitionRating::find($id);

        if (!$definitionRating) {
            return response()->json(['error' => 'no data'], 404);
        }

        $validator = Validator::make($request->all(), [
            'value' => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json(['error' => $validator->errors()], 422);
        }

        if (!$this->checkAuthorization($definitionRating))
        {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $definitionRating->update($request->all());
        return response()->json(['updated' => $definitionRating], 201);
    }

    /**
     * DELETE definitionrating
     *
     * Removes a single specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     * @response
     * {
     * "deleted": {
     * "id": 1,
     * "definition_id": 1,
     * "rating_id": 1,
     * "user_id": 1,
     * "value": 4,
     * "created_at": "2024-01-19T08:09:48.000000Z",
     * "updated_at": "2024-01-19T09:16:37.000000Z"
     * }
     * }
     */
    public function destroy(int $id): JsonResponse
    {
        $definitionRating = DefinitionRating::find($id);

        if ($definitionRating === null) {
            return response()->json(['error' => 'no data'], 404);
        }

        if (!$this->checkAuthorization($definitionRating))
        {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $oldDefinitionRating = $definitionRating;
        $definitionRating->delete();

        return response()->json(['deleted' => $oldDefinitionRating]);

    }

}
