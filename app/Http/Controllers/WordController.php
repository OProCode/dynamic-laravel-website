<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWordRequest;
use App\Http\Requests\UpdateWordRequest;
use App\Models\Word;
use App\Models\WordType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WordController extends Controller
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
                return false;
            }
        }
        return true;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $words = Word::paginate();
        return view('words.index', compact('words'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $wordTypes = WordType::all();
        return view('words.add', compact(['wordTypes']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWordRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = auth()->user()->id;
        $word = Word::create($validatedData);

        if ($word) {
            return redirect(route('words.index'))->with('create-success', "Created '{$word->name}'.");
        } else {
            return redirect(route('words.index'))->with('create-error', "Failed to create '{'$word->name}'.");
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Word $word)
    {
        $wordTypes = WordType::all();
        return view('words.show', compact(['word', 'wordTypes']));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Word $word)
    {
        $wordTypes = WordType::all();

        if(!$this->checkAuthorization($word))
        {
            return redirect(route('words.index'))->with("message", "Unauthorized navigation");
        }

        return view('words.edit', compact(['word', 'wordTypes']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWordRequest $request, Word $word)
    {
        $validatedData = $request->validated();

        if(!$this->checkAuthorization($word))
        {
            return redirect(route('words.index'))->with("message", "Unauthorized action");
        }

        if ($word->update($validatedData)) {
            return redirect(route('words.index'))->with('update-success', "Updated '{$word->name}'.");
        } else {
            return redirect(route('words.index'))->with('update-error', "Failed to update '{$word->name}'.");
        }

    }

    public function delete(Word $word)
    {
        if(!$this->checkAuthorization($word))
        {
            return redirect(route('words.index'))->with("message", "Unauthorized navigation");
        }

        return view('words.delete', compact(['word']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Word $word)
    {
        $oldWord = $word;

        foreach($word->definitions as $definition){
            $definition->delete();
        }

        if(!$this->checkAuthorization($word))
        {
            return redirect(route('words.index'))->with("message", "Unauthorized action");
        }

        if ($word->delete()) {
            return redirect(route('words.index'))->with('delete-success', "Deleted '{$oldWord->name}'");
        } else {
            return redirect(route('words.index'))->with('delete-error', "Failed to delete '{$oldWord->name}'");
        }
    }
}
