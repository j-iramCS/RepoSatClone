<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminPanelContoller extends Controller
{
    use AuthorizesRequests;
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(User::class);

        $this->middleware('can:panel-control')->only('vistaURP');
        $this->middleware('can:panel-control')->only('vistaRol');
        $this->middleware('can:panel-control')->only('vistaUsuario');
        $this->middleware('can:panel-control')->only('guardarPermisosDelRol');
        $this->middleware('can:panel-control')->only('guardarRolesMasivos');
        $this->middleware('can:panel-control')->only('guardarRoles');
        $this->middleware('can:panel-control')->only('eliminarRol');

        $this->middleware('can:panel-control')->only('guardarPermisos');
    }

    public function index()
    {
        //

        // count users
        $countUsers = count(User::all());

        return Inertia::render('Admin/Index', [
            'countUsers' => $countUsers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function vistaURP()
    {
        $permisos = Permission::all();
        $roles = Role::with('permissions')->get();
        $usuarios = User::with(['roles', 'permissions'])->get();
        $todosUsers = User::all();
        $todosRoles = Role::all();
        return Inertia::render('Admin/URP/Index', [
            'permisos' => $permisos,
            'roles' => $roles,
            'usuarios' => $usuarios,
            'todosUsers' => $todosUsers,
            'todosRoles' => $todosRoles,
        ]);
    }


    // Roles
    public function vistaRol($id) // Vista de un rol específico
    {
        $rol = Role::findOrFail($id);
        $permisosAsignados = $rol->permissions()->get();
        $usersConRol = User::role($rol->name)->get();
        $todosPermisos = Permission::all();


        return Inertia::render('Admin/URP/Rol', [
            'rol' => $rol,
            'permisosAsignados' => $permisosAsignados,
            'todosPermisos' => $todosPermisos,
            'usersConRol' => $usersConRol,

        ]);
    }

    public function guardarPermisosDelRol(Request $request, $id) // Guardar permisos seleccionados para X rol
    {
        DB::beginTransaction();
        try {
            $rol = Role::findOrFail($id);

            // Verificar si el rol es "super-admin"
            if ($rol->name === 'super-admin') {
                return response()->json([
                    'message' => 'No se pueden modificar los permisos del rol "super-admin"',
                ], 403);
            }

            $permisos = Permission::whereIn('id', $request->permisos)->get();
            $rol->syncPermissions($permisos);
            DB::commit();
            return response()->json([
                'message' => 'Permisos guardados correctamente',
                'permisos' => $rol->permissions,
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error al guardar los permisos',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function guardarRolesMasivos(Request $request) // Guardar X roles seleccionados para X usuarios seleccionados
    {
        DB::beginTransaction();
        try {
            $usuarios = User::whereIn('id', $request->usuarios)->get();
            $roles = Role::whereIn('id', $request->roles)->get();

            foreach ($usuarios as $usuario) {
                // Verificar si el usuario es "admin@gmail.com"
                if ($usuario->email === 'admin@gmail.com') {
                    return response()->json([
                        'message' => 'No se pueden modificar los roles del usuario "admin"',
                    ], 403);
                }

                // Agregar roles sin eliminar los existentes
                foreach ($roles as $rol) {
                    $usuario->assignRole($rol);
                }
            }

            DB::commit();
            return response()->json([
                'message' => 'Roles agregados correctamente',
                'usuarios' => $usuarios,
                'roles' => $roles,
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error al agregar los roles',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function guardarRoles(Request $request) // Guardar X roles seleccionados para un usuario
    {
        DB::beginTransaction();
        try {
            $usuario = User::findOrFail($request->usuario);
            $roles = Role::whereIn('id', $request->roles)->get();

            // Verificar si el usuario es "admin@gmail.com
            if ($usuario->email === 'admin@gmail.com') {
                return response()->json([
                    'message' => 'No se pueden modificar los roles del usuario "admin"',
                ], 403);
            }

            $usuario->syncRoles($roles);
            DB::commit();
            return response()->json([
                'message' => 'Roles guardados correctamente',
                'usuario' => $usuario,
                'roles' => $roles,
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error al guardar los roles',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function eliminarRol($rolId, $userId) // Eliminar rol de un usuario
    {
        DB::beginTransaction();
        try {
            $usuario = User::findOrFail($userId);
            $rol = Role::findOrFail($rolId);

            // Verificar si el usuario es "admin@gmail.com"
            if ($usuario->email === 'admin@gmail.com') {
                return response()->json([
                    'message' => 'No se puede eliminar el rol del usuario "admin"',
                ], 403);
            }

            $usuario->removeRole($rol);
            DB::commit();
            return response()->json([
                'message' => 'El rol fue eliminado del usuario correctamente',
                'usuario' => $usuario,
                'rol' => $rol,
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error al eliminar el rol',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    // Usuarios
    public function vistaUsuario($id) // Vista de permisos
    {
        $usuario = User::findOrFail($id);

        $roles = $usuario->roles; // Roles asignados al usuario
        $todosRoles = Role::all();
        $permisos = $usuario->permissions; // Permisos asignados al usuario
        $todosPermisos = Permission::all();

        // dd($permisos);

        return Inertia::render('Admin/URP/Usuario', [
            'usuario' => $usuario,
            'roles' => $roles,
            'permisos' => $permisos,
            'todosRoles' => $todosRoles,
            'todosPermisos' => $todosPermisos,
        ]);
    }

    // Permisos
    public function vistaPermiso($id) // Vista de permisos
    {
        $permiso = Permission::findOrFail($id);
        $roles = Role::whereHas('permissions', function ($query) use ($permiso) {
            $query->where('id', $permiso->id);
        })->get();

        $todosRoles = Role::all();

        return Inertia::render('Admin/URP/Permiso', [
            'permiso' => $permiso,
            'roles' => $roles,
            'todosRoles' => $todosRoles,
        ]);
    }

    public function guardarPermisos(Request $request) // Guardar permisos seleccionados para un usuario
    {
        DB::beginTransaction();
        try {
            $usuario = User::findOrFail($request->usuario);
            $permisos = Permission::whereIn('id', $request->permisos)->get();

            // Verificar si el usuario es "admin@gmail.com"
            if ($usuario->email === 'admin@gmail.com') {
                return response()->json([
                    'message' => 'No se pueden modificar los permisos del usuario "admin"',
                ], 403);
            }
            $usuario->syncPermissions($permisos);
            DB::commit();
            return response()->json([
                'message' => 'Permisos guardados correctamente',
                'usuario' => $usuario,
                'permisos' => $permisos,
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error al guardar los permisos',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function guardarRolesDelPermiso(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $permiso = Permission::findOrFail($id);
            $roles = Role::whereIn('id', $request->roles)->get();
            $permiso->syncRoles($roles);
            DB::commit();
            return response()->json([
                'message' => 'Roles guardados correctamente.',
                'permiso' => $permiso,
                'roles' => $roles,
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'message' => 'Error al guardar los roles',
                'error' => $th->getMessage(),
            ], 500);
        }
    }
};
