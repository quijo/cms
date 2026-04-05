<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Church;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Member::all();
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
        'is_active' => 'sometimes|boolean',
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
        return view('members.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        return view('members.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        return redirect()->route('members.index')->with('success', 'Member updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        return redirect()->route('members.index')->with('success', 'Member deleted successfully.');
    }
}
