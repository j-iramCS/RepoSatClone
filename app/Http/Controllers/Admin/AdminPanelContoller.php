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
        $this->middleware('can:panel-control')->only('crearRol');
        $this->middleware('can:panel-control')->only('eliminarRol');
        $this->middleware('can:panel-control')->only('guardarPermisosDelRol');
        $this->middleware('can:panel-control')->only('guardarRolesMasivos');
        $this->middleware('can:panel-control')->only('guardarRoles');
        $this->middleware('can:panel-control')->only('eliminarRoldelUsuario');
        $this->middleware('can:panel-control')->only('vistaUsuario');
        $this->middleware('can:panel-control')->only('vistaPermiso');
        $this->middleware('can:panel-control')->only('crearPermiso');
        $this->middleware('can:panel-control')->only('eliminarPermiso');
        $this->middleware('can:panel-control')->only('guardarPermisos');
        $this->middleware('can:panel-control')->only('guardarRolesDelPermiso');
        $this->middleware('can:panel-control')->only('eliminarPermisodelUsuario');
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
        // $permisos = Permission::all();
        // $roles = Role::with('permissions')->get();
        $todosUsers = User::all();
        $todosRoles = Role::all();
        $todosPermisos = Permission::all();
        return Inertia::render('Admin/URP/Index', [
            'todosUsers' => $todosUsers,
            'todosRoles' => $todosRoles,
            'todosPermisos' => $todosPermisos,
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

    public function crearRol(Request $request) // Crear un nuevo rol
    {
        DB::beginTransaction();
        try {
            Role::create([
                'name' => $request->name,
                'guard_name' => 'web',
            ]);
            DB::commit();
            return response()->json([
                'message' => 'Rol creado correctamente',
                'update' => Role::all(),
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error al crear el rol',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function eliminarRol(Request $request) // Eliminar un rol
    {
        DB::beginTransaction();
        try {
            $rol = Role::findOrFail($request->id);
            // Verificar si el rol es "super-admin"
            if ($rol->name === 'super-admin') {
                return response()->json([
                    'message' => 'No se puede eliminar el rol "super-admin"',
                ], 403);
            }

            // Verificar si el rol está asociado a algún usuario
            if ($rol->users()->count() > 0) {
                return response()->json([
                    'message' => 'No se puede eliminar el rol porque está asociado a uno o más usuarios',
                ], 403);
            }

            $rol->delete();
            DB::commit();
            return response()->json([
                'message' => 'Rol eliminado correctamente',
                'update' => Role::all(),
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error al eliminar el rol',
                'error' => $th->getMessage(),
            ], 500);
        }
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

    public function eliminarRoldelUsuario($rolId, $userId) // Eliminar rol de un usuario
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
        $usuariosPermiso = User::whereHas('permissions', function ($query) use ($permiso) {
            $query->where('id', $permiso->id);
        })->get();

        return Inertia::render('Admin/URP/Permiso', [
            'permiso' => $permiso,
            'roles' => $roles,
            'todosRoles' => $todosRoles,
            'usuariosPermiso' => $usuariosPermiso,
        ]);
    }

    public function crearPermiso(Request $request) // Crear un nuevo permiso
    {
        DB::beginTransaction();
        try {
            Permission::create([
                'name' => $request->name,
                'guard_name' => 'web',
            ]);
            DB::commit();
            return response()->json([
                'message' => 'Permiso creado correctamente',
                'update' => Permission::all(),
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error al crear el permiso',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function eliminarPermiso(Request $request) // Eliminar un permiso
    {
        DB::beginTransaction();
        try {
            $permiso = Permission::findOrFail($request->id);

            // Verificar si el permiso está asociado a algún rol
            if ($permiso->roles()->count() > 0) {
                return response()->json([
                    'message' => 'No se puede eliminar el permiso porque está asociado a uno o más roles',
                ], 403);
            }

            if ($permiso->users()->count() > 0) {
                return response()->json([
                    'message' => 'No se puede eliminar el permiso porque está asociado directamente a uno o más usuarios',
                ], 403);
            }

            $permiso->delete();
            DB::commit();
            return response()->json([
                'message' => 'Permiso eliminado correctamente',
                'update' => Permission::all(),
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error al eliminar el permiso',
                'error' => $th->getMessage(),
            ], 500);
        }
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

    public function guardarRolesDelPermiso(Request $request, $id) // Guarda los roles seleccionados para un permiso
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

    public function eliminarPermisodelUsuario(Request $request) // Eliminar permiso de un usuario
    {
        DB::beginTransaction();
        try {
            $usuario = User::findOrFail($request->usuarioId);
            $permiso = Permission::findOrFail($request->permisoId);

            $usuario->revokePermissionTo($permiso);
            DB::commit();
            $usuariosPermiso = User::whereHas('permissions', function ($query) use ($permiso) {
                $query->where('id', $permiso->id);
            })->get();

            return response()->json([
                'message' => 'Permiso eliminado correctamente',
                'update' => $usuariosPermiso,
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error al eliminar el permiso',
                'error' => $th->getMessage(),
            ], 500);
        }
    }


    public function permitirAcceso(Request $request) // Permitir acceso a un usuario
    {
        DB::beginTransaction();
        try {
            $usuario = User::findOrFail($request->usuarioId);
            $estado = $request->estado;

            // Verificar si el usuario es "admin@gmail.com"
            if ($usuario->email === 'admin@gmail.com') {
                return response()->json([
                    'message' => 'No se puede modificar el acceso del usuario "admin"',
                ], 403);
            }

            if (!$estado == 1) {
                $usuario->can_login = 1;
                $usuario->save();
                DB::commit();
                return response()->json([
                    'message' => 'Acceso permitido correctamente',
                    'update' => $usuario,
                ], 200);
            } else {
                // Si el estado es 0, se deniega el acceso
                $usuario->can_login = 0;
                $usuario->save();
                DB::commit();
                return response()->json([
                    'message' => 'Acceso denegado correctamente',
                    'update' => $usuario,
                ], 200);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error al permitir el acceso',
                'error' => $th->getMessage(),
            ], 500);
        }
    }
};
