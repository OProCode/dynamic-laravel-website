<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Word;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Word endpoint management.
 *
 * Sets endpoints for words and management of data and authorization.
 *
 * @group Endpoints
 *
 */

class WordController extends Controller
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
     * GET words
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
     * "name": "FTP",
     * "word_type_id": 16,
     * "user_id": 1,
     * "created_at": "2024-01-19T08:09:48.000000Z",
     * "updated_at": "2024-01-19T08:09:48.000000Z"
     * },
     * {
     * "id": 2,
     * "name": "IBM",
     * "word_type_id": 16,
     * "user_id": 1,
     * "created_at": "2024-01-19T08:09:48.000000Z",
     * "updated_at": "2024-01-19T08:09:48.000000Z"
     * },
     * ]
     *
     */
    public function index(): JsonResponse
    {
        $words = Word::paginate();

        if ($words->isEmpty()) {
            return response()->json(['error' => 'no data'], 404);
        }
        return response()->json($words);
    }

    /**
     * GET word
     *
     * Displays a single specified resource in storage.
     *
     * @param int $id
     * @return JsonResponse
     * @response
     * {
     * "id": 1,
     * "word_id": 1,
     * "word_type_id": 16,
     * "definition": "File Transfer Protocol",
     * "user_id": 1,
     * "appropriate": 0,
     * "created_at": "2024-01-19T08:09:48.000000Z",
     * "updated_at": "2024-01-19T08:09:48.000000Z"
     * },
     */
    public function show(int $id): JsonResponse
    {
        $word = Word::find($id);

        if (!$word)
        {
            return response()->json(['error' => 'no data'], 404);
        }

        return response()->json($word);
    }

    /**
     * POST word
     *
     * Stores a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     * @response
     * {
     * "created": {
     * "id": 18
     * "name": "Digital Audio Workstation",
     * "word_type_id": 16,
     * "user_id": 1,
     * "updated_at": "2024-01-19T08:22:01.000000Z",
     * "created_at": "2024-01-19T08:22:01.000000Z",
     * }
     * }
     */
    public function store(Request $request): JsonResponse
    {
        $request->request->add(['user_id' => auth('sanctum')->id()]);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'word_type_id' => 'required',
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $word = Word::create($request->all());
        return response()->json(['created' => $word], 201);
    }

    /**
     *
     * PATCH word
     *
     * Updates a single specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     * @response
     * {
     * "updated": {
     * "id": 18
     * "name": "Digital Audio Workspace",
     * "word_type_id": 18,
     * "user_id": 1,
     * "updated_at": "2024-01-19T08:09:48.000000Z",
     * "created_at": "2024-01-19T08:24:54.000000Z",
     * }
     * }
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $word = Word::find($id);

        if (!$this->checkAuthorization($word))
        {
            return response()->json(["message" => 'Unauthorized'], 401);
        }

        if (!$word) {
            return response()->json(['error' => 'no data'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'word_type_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        if (!$this->checkAuthorization($word)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $word->update($request->all());
        return response()->json(['updated' => $word], 201);
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
     * "id": 18
     * "name": "Digital Audio Workspace",
     * "word_type_id": 18,
     * "user_id": 1,
     * "updated_at": "2024-01-19T08:09:48.000000Z",
     * "created_at": "2024-01-19T08:24:54.000000Z",
     * }
     * }
     */
    public function destroy(int $id): JsonResponse
    {
        $word = Word::find($id);

        if (!$word) {
            return response()->json(['error' => 'no data'], 404);
        }

        if (!$this->checkAuthorization($word))
        {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $oldWord = $word;
        $word->delete();

        return response()->json(['deleted' => $oldWord]);
    }
}
