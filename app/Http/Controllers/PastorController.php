<?php

namespace App\Http\Controllers;

use App\Models\Pastor;
use Illuminate\Http\Request;
use App\Http\Requests\StorePastorRequest;
use App\Http\Requests\UpdatePastorRequest;

use App\Models\Church;


class PastorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pastors = Pastor::latest()->paginate(10);
        

        return view('pastors.index', compact('pastors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $churches = Church::all();
        return view ('pastors.create',compact('churches'));
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(StorePastorRequest $request)
{
    Pastor::create($request->validated());

    return redirect()->route('pastors.index')
        ->with('success', 'Pastor created successfully.');
}

    /**
     * Display the specified resource.
     */
    public function show(Pastor $pastor)
    {
        return view('pastors.show', compact('pastor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pastor $pastor)
    {
         $churches = Church::all();

          return view('pastors.edit', compact('pastor', 'churches'));
          
    }

    /**
     * Update the specified resource in storage.
     */


    public function update(UpdatePastorRequest $request, Pastor $pastor)
{
  

    $pastor->update($request->validated());


    return redirect()
        ->route('pastors.index')
        ->with('success', 'Pastor updated successfully');
}

    /**
     * Remove the specified resource from storage.
     */
        public function destroy(Pastor $pastor)
        {
            $pastor->delete();

            return redirect()
                ->route('pastors.index')
                ->with('success', 'Pastor deleted successfully.');
        }
}
