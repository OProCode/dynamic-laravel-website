<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreratingRequest;
use App\Http\Requests\UpdateRatingRequest;
use App\Models\rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:admin');
    }

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
        $ratings = Rating::paginate();
        return view('ratings.index', compact(['ratings']));
    }

    /**
     * Show the form for creating a new rating resource.
     */
    public function create(Rating $rating)
    {
        $icons = $rating->getIcons();
        return view('ratings.add', compact('icons'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreratingRequest $request)
    {
        $details = $request->validated(); // returns to error page if not validated
        $rating = Rating::create($details); // pass validated details

        if ($rating){
            return redirect(route('ratings.index'))->with('create-success', "Created '{$rating->name}'."); // redirect to desired page with success message
        } else {
            return redirect(route('ratings.index'))->with('create-error', "Failed to create '{$rating->name}'."); // redirect to desired page with fail message
        }
    }

    /**
     * Display the specified resource.
     */

    public function show(Rating $rating)
    {
        return view('ratings.show', compact(['rating']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rating $rating, Request $request)
    {
        $icons = $rating->getIcons();
        return view('ratings.edit', compact(['rating', 'icons']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRatingRequest $request, Rating $rating)
    {
        $validated = $request->validated(); // returns validated data

        if(!$this->checkAuthorization($rating))
        {
            return redirect(route('ratings.index'))->with("message", "Unauthorized action.");
        }

        if ($rating->update($validated)) {
            return redirect(route('ratings.index'))->with('update-success', "Updated '{$rating->name}'.");
        } else {
            return redirect(route('ratings.index'))->with('update-error', "Failed to update '{$rating->name}'.");
        }
    }

    /**
     * Remove the specified resource from storage.
     */

    public function delete(rating $rating)
    {
        if(!$this->checkAuthorization($rating))
        {
            return redirect(route('ratings.index'))->with("message", "Unauthorized action.");
        }

        return view('ratings.delete', compact(['rating']));
    }

    public function destroy(rating $rating)
    {
        if(!$this->checkAuthorization($rating))
        {
            return redirect(route('ratings.index'))->with("message", "Unauthorized action");
        }

        $oldRating = $rating;
        if ($rating->delete()) {
            return redirect(route('ratings.index'))->with('delete-success', "Deleted '{$oldRating->name}'.");
        } else {
            return redirect(route('ratings.index'))->with('delete-error', "Failed to delete '{$oldRating->name}'.");
        }
    }
}
