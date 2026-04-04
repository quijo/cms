<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
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
    $roles = Role::all(); 
   
    // $churches = Church::all(); // All churches
    return view('users.create', compact('roles'));
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6',
        'role' => 'required|exists:roles,id', // validate ID exists
    ]);

    // Create user
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // Find the role by ID and assign it
    $role = Role::findOrFail($request->role);
    $user->assignRole($role); // <-- assign Role object, not ID

    return redirect()->route('users.index')->with('success', 'User created successfully.');
}
    public function edit(User $user)
    {
        $roles = Role::all();
        
        return view('users.edit', compact('user', 'roles'));
    }

   public function update(Request $request, User $user)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'role' => 'required|exists:roles,id', // validate role exists
    ]);

    // Update basic info
    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'church' => $request->church,
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
}
