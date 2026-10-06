<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Listado de usuarios.
     */
    public function index(Request $request)
    {
        $query = User::with('role');

        // Búsqueda por nombres, apellidos o correo.
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filtro por rol.
        if ($request->filled('role')) {
            $query->where('role_id', $request->role);
        }

        // Filtro por estado.
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $users = $query
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->paginate(10)
            ->withQueryString();

        $roles = Role::orderBy('name')->get();

        return view('users.index', compact('users', 'roles'));
    }

    /**
     * Formulario de creación.
     */
    public function create()
    {
        $roles = Role::orderBy('name')->get();

        return view('users.create', compact('roles'));
    }

    /**
     * Registrar usuario.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => [
                'required',
                'string',
                'max:100',
            ],

            'last_name' => [
                'required',
                'string',
                'max:100',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],

            'role_id' => [
                'required',
                'exists:roles,id',
            ],

            'status' => [
                'required',
                'boolean',
            ],
        ], [
            'first_name.required' => 'Los nombres son obligatorios.',
            'last_name.required' => 'Los apellidos son obligatorios.',

            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Ingresa un correo electrónico válido.',
            'email.unique' => 'Este correo electrónico ya está registrado.',

            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',

            'role_id.required' => 'Selecciona un rol.',
            'role_id.exists' => 'El rol seleccionado no es válido.',

            'status.required' => 'Selecciona un estado.',
        ]);

        User::create($validated);

        return redirect()
            ->route('users.index')
            ->with('success', 'Usuario registrado correctamente.');
    }

    /**
     * Detalle del usuario.
     */
    public function show(User $user)
    {
        $user->load('role');

        return view('users.show', compact('user'));
    }

    /**
     * Formulario de edición.
     */
    public function edit(User $user)
    {
        $roles = Role::orderBy('name')->get();

        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Actualizar usuario.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'first_name' => [
                'required',
                'string',
                'max:100',
            ],

            'last_name' => [
                'required',
                'string',
                'max:100',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],

            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],

            'role_id' => [
                'required',
                'exists:roles,id',
            ],

            'status' => [
                'required',
                'boolean',
            ],
        ], [
            'first_name.required' => 'Los nombres son obligatorios.',
            'last_name.required' => 'Los apellidos son obligatorios.',

            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Ingresa un correo electrónico válido.',
            'email.unique' => 'Este correo electrónico ya está registrado.',

            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',

            'role_id.required' => 'Selecciona un rol.',
            'role_id.exists' => 'El rol seleccionado no es válido.',
        ]);

        // No reemplazar la contraseña si se deja vacía.
        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        // Evitar que el usuario administrador se desactive a sí mismo.
        if (
            auth()->id() === $user->id &&
            isset($validated['status']) &&
            !$validated['status']
        ) {
            return back()
                ->withErrors([
                    'status' => 'No puedes desactivar tu propia cuenta mientras estás utilizando el sistema.',
                ])
                ->withInput();
        }

        $user->update($validated);

        return redirect()
            ->route('users.show', $user)
            ->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Activar o desactivar usuario.
     */
    public function toggleStatus(User $user)
    {
        if (auth()->id() === $user->id) {
            return back()->with(
                'error',
                'No puedes desactivar tu propia cuenta.'
            );
        }

        $user->update([
            'status' => !$user->status,
        ]);

        $message = $user->status
            ? 'Usuario activado correctamente.'
            : 'Usuario desactivado correctamente.';

        return back()->with('success', $message);
    }
}