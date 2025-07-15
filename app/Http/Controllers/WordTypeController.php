<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWordTypeRequest;
use App\Http\Requests\UpdateWordTypeRequest;
use App\Models\WordType;
use Illuminate\View\View;

class WordTypeController extends Controller
{

    public function __construct()
    {
        $this->middleware(
            'role:admin'
        );
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $wordTypes = WordType::paginate();
        return view('wordtypes.index', compact(['wordTypes']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('wordtypes.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWordTypeRequest $request)
    {
        $validatedData = $request->validated(); // returns to error page if not validated
        $validatedData['user_id'] = auth()->user()->id; // sets logged-in user's id as the user_id field
        $wordType = WordType::create($validatedData); // pass validated details

        if ($wordType) {
            return redirect(route('wordtypes.index'))->with('create-success', "Created '{$wordType->name}'"); // redirect to desired page with success message
        } else {
            return redirect(route('wordtypes.index'))->with('create-error', "Failed to create '{$wordType->name}'"); // redirect to desired page with fail message
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(WordType $wordType): View
    {
        return view('wordtypes.show', compact(['wordType']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WordType $wordType)
    {
        $wordTypes = WordType::all();
        return view('wordtypes.edit', compact(['wordType', 'wordTypes']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWordTypeRequest $request, WordType $wordType)
    {
        $validatedData = $request->validated();

        if ($wordType->update($validatedData)) {
            return redirect(route('wordtypes.index'))
                ->with('update-success', "Updated '{$wordType->name}'");
        } else {
            return redirect(route('wordtypes.index'))
                ->with('update-error', "Failed to update '{$wordType->name}'");
        }
    }

    public function delete(wordType $wordType)
    {
        return view('wordtypes.delete', compact(['wordType']));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WordType $wordType)
    {
        $oldWordType = $wordType;
        if ($wordType->delete()) {
            return redirect(route('wordtypes.index'))->with('delete-success', "Deleted '{$oldWordType->name}'");
        } else {
            return redirect(route('wordtypes.index'))->with('delete-error', "Failed to delete '{$oldWordType->name}'");
        }
    }
}
