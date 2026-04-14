<?php

namespace App\Http\Controllers;

use App\Models\Giving;
use Illuminate\Http\Request;
use App\Models\Member;


class GivingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Giving::query();

        //Search by church name if provided
        if ($search = request('search')) {
            $query->whereHas('church', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }
        $givings = Giving::with('church')->latest()->paginate(10);
        return view('givings.index', compact('givings'));
    }

    /**
     * Show the form for creating a new resource.
     */
   public function create()
{

    $churches = \App\Models\Church::orderBy('name')->get();
    $members = Member::orderBy('name')->get();

    return view('givings.create', compact('churches', 'members'));
}

public function store(Request $request)
{
    // Validation
    $request->validate([
    'church_id' => 'required|exists:churches,id',
    'member_id' => 'nullable|exists:members,id',
    'or_number' => 'required|string|max:50|unique:givings,or_number',
    'giving_date' => 'required|date',
    'type' => 'required|string',
    'amount' => 'required|numeric|min:0',
    'notes' => 'nullable|string',
    ]);

    // Store Giving
    Giving::create([
        'church_id' => $request->church_id,
        'member_id' => $request->member_id,
        'or_number' => $request->or_number,
        'giving_date' => $request->giving_date,
        'type' => $request->type,
        'amount' => $request->amount,
        'notes' => $request->notes,
    ]);

    return redirect()->route('givings.index')->with('success', 'Giving created successfully!');
}

  
    /**
     * Display the specified resource.
     */
    public function show($id)
{
    $giving = \App\Models\Giving::with('church', 'member')->findOrFail($id);

    return view('givings.show', compact('giving'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Giving $giving)
    {
        $churches = \App\Models\Church::orderBy('name')->get();
        return view('givings.edit', compact('giving', 'churches'));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, $id)
{



    $request->validate([
        'church_id' => 'required|exists:churches,id',
        'member_id' => 'nullable|exists:members,id',
        'or_number' => 'required|unique:givings,or_number,' . $id,
        'giving_date' => 'required|date',
        'type' => 'required|string',
        'amount' => 'required|numeric|min:1',
        'notes' => 'nullable|string',
    ]);

    $giving = \App\Models\Giving::findOrFail($id);

    $giving->update([
        'church_id' => $request->church_id,
        'member_id' => $request->member_id,
        'or_number' => $request->or_number,
        'giving_date' => $request->giving_date,
        'type' => $request->type,
        'amount' => $request->amount,
        'notes' => $request->notes,
    ]);

    return redirect()->route('givings.index', $giving->id)
        ->with('success', 'Giving updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $giving = \App\Models\Giving::findOrFail($id);
    $giving->delete();

    return redirect()->route('givings.index')
        ->with('success', 'Giving deleted successfully.');
}
}
