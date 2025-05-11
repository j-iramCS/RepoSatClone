<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\User;

class AdminPanelContoller extends Controller
{
    use AuthorizesRequests;
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(User::class);
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


    public function vistaUsuarios()
    {
        $users = User::all();
        return Inertia::render('Admin/Usuarios/Index', [
            'users' => $users,
        ]);
    }

}
