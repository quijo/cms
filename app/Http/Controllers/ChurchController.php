<?php 
namespace App\Http\Controllers;

use App\Models\Church;
use Illuminate\Http\Request;

class ChurchController extends Controller
{

    public function index(Request $request)
    {
        $query = Church::query();

        // Apply ID filter
        if ($request->filled('id')) {
            $query->where('id', $request->id);
        }
        
 // Search by church number
    if ($request->filled('church_number')) {
        $query->where('church_number', 'like', '%' . $request->church_number . '%');
    }

       if ($request->filled('search')) {
    $query->where('name', 'like', '%' . $request->search . '%');
}

        // Paginate results
        $churches = $query->orderBy('id', 'desc')->paginate(10);

        return view('churches.index', compact('churches'));
    }


    public function create()
    {
       
       return view('churches.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'church_number' => 'required|string|max:50|unique:churches,church_number',
            'status' => 'required|in:active,inactive,mission,organized',
            'start_date' => 'required|date',
            'contact_address' => 'nullable|string',
            'nmi' => 'nullable|string',
            'ndi' => 'nullable|string',
            'nyi' => 'nullable|string',
        ]);

        Church::create($request->all());

        return redirect()->route('churches.index')->with('success', 'Church created successfully.');
    }

    public function edit(Church $church)
    {
        return view('churches.edit', compact('church'));
    }

    public function update(Request $request, Church $church)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'church_number' => 'required|string|max:50|unique:churches,church_number,' . $church->id,
            'status' => 'required|in:active,inactive,mission,organized',
            'start_date' => 'required|date',
            'contact_address' => 'nullable|string',
            'nmi' => 'nullable|string',
            'ndi' => 'nullable|string',
            'nyi' => 'nullable|string',
        ]);

        $church->update($request->all());

        return redirect()->route('churches.index')->with('success', 'Church updated successfully.');
    }

    public function destroy(Church $church)
    {
        $church->delete();
        return redirect()->route('churches.index')->with('success', 'Church deleted successfully.');
    }

    public function show($church)
{
    // Find the church by ID, or fail with 404
    $church = \App\Models\Church::findOrFail($church);

    // Pass the church to the show view
    return view('churches.show', compact('church'));
}


public function bulkDelete(Request $request)
{
   
    $request->validate([
        'churches' => 'required|array',
        'churches.*' => 'exists:churches,id',
    ]);

    Church::whereIn('id', $request->churches)->delete();

    return redirect()->route('churches.index')->with('success', 'Selected churches deleted successfully.');
}


}