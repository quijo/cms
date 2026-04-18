<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;
use App\Models\Member;
use App\Models\Church;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
{
    //pulling out users info
    $user = auth()->user();
      
   
   //get all members
    $query = Member::with('church');


   // 🔐 ROLE SCOPING
    if (!$user->hasRole('Admin')) {
        $query->where('church_id', $user->church_id);
    }

    // 🔍 SEARCH
    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%");
        });
    }

    $members = $query->paginate(10);

    return view('members.index', compact('members'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $churches = Church::all();
       $members = Member::all();
       $users = \App\Models\User::all();
       return view('members.create', compact('churches', 'members', 'users'));
     
    }

    /**
     * Store a newly created resource in storage.
     */


public function store(Request $request)
{
$request->merge([
    'is_active' => $request->boolean('is_active'),
]);
    // Validate input
 $validated = $request->validate([
    'name' => 'required|string|max:255',
    'church_id' => 'required|exists:churches,id',
    'user_id' => 'nullable|exists:users,id',
    'email' => 'nullable|email|max:255',
    'contact_number' => 'nullable|string|max:50',
    'age' => 'nullable|integer|min:0',
    'sex' => 'nullable|in:male,female',
    'membership_date' => 'nullable|date',
    'is_active' => 'required|boolean', // ✅ correct
]);

    // Create member
    $member = Member::create([
        'name' => $validated['name'],
        'church_id' => $validated['church_id'],
        'user_id' => $validated['user_id'] ?? null,
        'email' => $validated['email'] ?? null,
        'contact_number' => $validated['contact_number'] ?? null,
        'age' => $validated['age'] ?? null,
        'sex' => $validated['sex'] ?? null,
        'membership_date' => $validated['membership_date'] ?? null,
        'is_active' => $request->has('is_active') ? true : false,
    ]);

    // Redirect back to members list with success message
    return redirect()->route('members.index')->with('success', 'Member added successfully!');
}

    /**
     * Display the specified resource.
     */
   public function show(Member $member)
{
    // Load the related church to avoid N+1 queries
    $member->load('church');

    return view('members.show', compact('member'));
}

   // Show the edit form
    public function edit(Member $member)
    {
        $churches = Church::all(); // Fetch all churches for the dropdown
        return view('members.edit', compact('member', 'churches'));
    }

    // Update the member
    public function update(Request $request, Member $member)
{
    // Normalize BEFORE validation (optional but clean)
    $request->merge([
        'is_active' => $request->boolean('is_active'),
    ]);

    // Validate input
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => "required|email|unique:members,email,{$member->id}",
        'church_id' => 'nullable|exists:churches,id',
        'is_active' => 'required|boolean',
    ]);

    // Update member
    $member->update($validated);

    return redirect()->route('members.index')
                     ->with('success', 'Member updated successfully!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
         $member->delete();
    return redirect()->route('members.index')->with('success', 'Member deleted successfully.');
}
    
}
