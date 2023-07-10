<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PermissoesService
{
    public static function index()
    {
        return DB::table('role')
                        ->whereNull('deleted_at')
                        ->get();
    }

    public static function get($id)
    {
        return DB::table('role')
                        ->where('id', Crypt::decrypt($id))
                        ->whereNull('deleted_at')
                        ->first();
    }

    public static function store($request)
    {
        DB::table('role')
                ->insert([
                    'nome' => $request->nome_do_grupo,
                    'descricao' => $request->descricao,
                    'created_by' => Auth::user()->id,
                    'created_at' => now(),
                ]);
    }

    public static function put($request, $id)
    {
        DB::table('role')
                ->where('id', Crypt::decrypt($id))
                ->update([
                    'nome' => $request->nome_do_grupo,
                    'descricao' => $request->descricao,
                    'updated_by' => Auth::user()->id,
                    'updated_at' => now(),
                ]);
    }

    public static function putManage($request, $id)
    {
        DB::table('submenu_role')
                ->where('role_id', Crypt::decrypt($id))
                ->whereNotIn('submenu_id', $request->submenus)
                ->update([
                    'deleted_by' => Auth::user()->id,
                    'deleted_at' => now(),
                ]);

        foreach ($request->submenus as $submenu) {
            DB::table('submenu_role')
                    ->updateOrInsert([
                        'submenu_id' => $submenu,
                        'role_id' => Crypt::decrypt($id),
                    ],
                    [
                        'created_by' => Auth::user()->id,
                        'created_at' => now(),
                        'updated_by' => Auth::user()->id,
                        'updated_at' => now(),
                        'deleted_by' => null,
                        'deleted_at' => null,
                    ]
                );
        }
    }

    public static function delete($id)
    {
        DB::table('role')
                    ->where('id', Crypt::decrypt($id))
                    ->update([
                        'deleted_by' => Auth::user()->id,
                        'deleted_at' => now(),
                    ]);
    }

}
