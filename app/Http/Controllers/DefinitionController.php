<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDefinitionRequest;
use App\Http\Requests\UpdateDefinitionRequest;
use App\Models\Definition;
use App\Models\DefinitionRating;
use App\Models\Rating;
use App\Models\Word;
use App\Models\WordType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DefinitionController extends Controller
{
    /**
     * Checks if the current user has authorization to alter the provided data
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
                return false;            }
        }
        return true;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $definitions = Definition::paginate();
        return view('definitions.index', compact(['definitions']));
    }

    /**
     * Display the specified resource.
     */
    public function show(Definition $definition)
    {
        $ratings = Rating::all();

        if(!Auth::user()) {
            return view('definitions.show', compact(['definition', 'ratings']));
        }

        $userRating = $definition->ratings()->where('user_id', '=', Auth::user()->id)->first();

        return view('definitions.show', compact(['definition', 'ratings', 'userRating']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $words = Word::all();
        $wordTypes = WordType::all();

        return view('definitions.add', compact(['words', 'wordTypes']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDefinitionRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = auth()->user()->id;
        $definition = Definition::create($validatedData);

        if ($definition) {
            return redirect(route('definitions.index'))->with('create-success', "Created '{$definition->definition}'.");
        } else {
            return redirect(route('definitions.index'))->with('create-error', "Failed to create '{$definition->definition}'.");
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Definition $definition,)
    {
        $userRating = $definition->ratings()->where('user_id', '=', Auth::user()->id)->first();

        return view('definitions.edit', compact(['definition', 'userRating']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDefinitionRequest $request, Definition $definition)
    {
        $validatedData = $request->validated();
        $authenticatedUser = Auth::user()->id;
        $definitionRating = DefinitionRating::where("user_id", "=", $authenticatedUser)
            ->where("definition_id", "=", $definition->id)
            ->first();

        $value = Rating::where('id', '=', $validatedData['rating'])
            ->first()->star;

        if ($definitionRating == null) {
            DefinitionRating::create([
                "user_id" => $authenticatedUser,
                "definition_id" => $definition->id,
                "rating_id" => $validatedData["rating"],
                "value" => $value,
            ]);
        } else {
            $definitionRating->update([
                "user_id" => $authenticatedUser,
                "definition_id" => $definition->id,
                "rating_id" => $validatedData["rating"],
                "value" => $value,
            ]);
        }

        if ($definition->update($validatedData)) {
            return redirect(route('definitions.index'))
                ->with("update-success", "Updated '{$definition->definition}'.");
        } else {
            return redirect(route('definitions.index'))
                ->with("update-error", "Failed to update '{$definition->definition}'.");
        }

    }

    public function delete(Definition $definition)
    {
        if(!$this->checkAuthorization($definition))
        {
            return redirect(route('definitions.index'))->with("message", "Unauthorized navigation");
        }

        return view('definitions.delete', compact(['definition']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Definition $definition)
    {
        if(!$this->checkAuthorization($definition))
        {
            return redirect(route('definitions.index'))->with("message", "Unauthorized action.");
        }

        $oldDefinition = $definition;
        if ($definition->delete()) {
            return redirect(route('definitions.index'))->with("delete-success", "Deleted '{$oldDefinition->definition}'.");
        } else {
            return redirect(route('definitions.index'))->with("delete-error", "Error deleting '{$oldDefinition->definition}'.");
        }
    }
}
