<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\Church; // ✅ CORRECT
// use App\Models\Church;

class UserController extends Controller
{


// ===========================
// User Index with Search and Filter
// ===========================
    public function index(Request $request)
{
    $query = User::query();

    // Search by name or email
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%");
        });
    }

    // Filter by role
    if ($request->filled('role')) {
        $role = $request->role;
        $query->whereHas('roles', function($q) use ($role) {
            $q->where('name', $role);
        });
    }

    $users = $query->with('roles')->paginate(10)->withQueryString();
    $roles = Role::pluck('name'); // For filter dropdown

    return view('users.index', compact('users', 'roles'));
}





// ===========================
// User create 
// ===========================

   public function create()
{


 $users = User::with('roles')->paginate(10);
  
    $roles = Role::all(); 
    $churches = Church::all(); // All churches
    return view('users.create', compact('roles', 'churches', 'users'));
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6',
        'role' => 'required|exists:roles,id',
        'church_id' => 'nullable|exists:churches,id',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'church_id' => $request->church_id, // <-- this will save properly
    ]);

    // Assign role via Spatie
    $role = Role::findOrFail($request->role); // get the Role model
    $user->assignRole($role->name);           // pass the role name

    return redirect()->route('users.index')->with('success', 'User created successfully.');
}
    public function edit(User $user)
    {
        $roles = Role::all();
        $churches = Church::all(); // All churches
        return view('users.edit', compact('user', 'roles', 'churches'));
    }

   public function update(Request $request, User $user)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'role' => 'required|exists:roles,id', // validate role exists
        'church_id' => 'nullable|exists:churches,id', // validate church exists
    ]);

    // Update basic info
    $user->update([
        'name' => $request->name,
        'email' => $request->email,
         'church_id' => $request->church_id, // ✅ corrected
    ]);

    // Optional: update password if provided
    if ($request->filled('password')) {
        $user->update([
            'password' => Hash::make($request->password),
        ]);
    }

    // Correct way to update role with Spatie
    $role = Role::findOrFail($request->role);
    $user->syncRoles([$role]); // removes old roles and assigns new

    return redirect()->route('users.index')->with('success', 'User updated successfully.');
}

   public function destroy(User $user)
{
    // Remove all roles and permissions first (optional, but clean)
    $user->syncRoles([]);
    $user->syncPermissions([]);

    // Delete user
    $user->delete();

    return redirect()->route('users.index')
                     ->with('success', 'User deleted successfully.');
}

public function show(User $user)
{
    return view('users.show', compact('user'));
}


}
