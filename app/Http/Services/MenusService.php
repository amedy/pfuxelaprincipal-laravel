<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class MenusService
{
    public static function sidebar()
    {
        $role_id = DB::table('user_role')->where('user_id', Auth::user()->id)->first()->role_id;
        $subs = DB::table('submenu')
                            ->join('submenu_role', 'submenu.id', '=', 'submenu_role.submenu_id')
                            ->where('role_id', $role_id)
                            ->whereNull('submenu_role.deleted_at')
                            ->select([
                                'submenu.menu_id',
                            ])
                            ->groupBy('submenu.menu_id')
                            ->get();
        foreach ($subs as $key => $submenu) {
            $menus[$key] = $submenu->menu_id;
        }

        $cats = DB::table('menu_categoria')
                    ->join('menu', 'categoria_id', '=', 'menu_categoria.id')
                    ->whereIn('menu.id', $menus)
                    ->select([
                        'menu_categoria.id',
                    ])
                    ->groupBy('menu_categoria.id')
                    ->get();
        foreach ($cats as $key => $cat) {
            $categ[$key] = $cat->id;
        }

        $categorias = DB::table('menu_categoria')
                    ->whereIn('id', $categ)
                    ->get();

        $main_menus = DB::table('menu_categoria')
                    ->join('menu', 'categoria_id', '=', 'menu_categoria.id')
                    ->whereIn('menu.id', $menus)
                    ->select([
                        'menu.*',
                    ])
                    ->get();

        $sub_menus = DB::table('submenu')
                            ->join('submenu_role', 'submenu.id', '=', 'submenu_role.submenu_id')
                            ->where('role_id', $role_id)
                            ->whereNull('submenu_role.deleted_at')
                            ->select([
                                'submenu.*',
                            ])
                            ->get();

        return [
            'categorias' => $categorias,
            'menus' => $main_menus,
            'submenus' => $sub_menus,
        ];
    }

    public static function store($request)
    {

        DB::table('bombas')
                    ->insert([
                        'nome' => $request->nome,
                        'tipo' => $request->tipo,
                        'capacidade' => $request->capacidade_das_bombas,
                        'disponivel' => $request->qtd_disponivel,
                        'estado' => 'Disponível',
                        'created_by' => Auth::user()->id,
                        'created_at' => now(),
                    ]);

    }

    public static function indexCategorias()
    {
        return DB::table('menu_categoria')->get();
    }

    public static function indexMenus()
    {
        return DB::table('menu')->get();
    }

    public static function indexSubmenus()
    {
        return DB::table('submenu')->get();
    }

    public static function indexSubmenuRoles($id)
    {
        return DB::table('submenu_role')
                        ->where('role_id', Crypt::decrypt($id))
                        ->whereNull('deleted_at')
                        ->get();
    }

    public static function update()
    {
        return DB::table('bombas')->get();
    }

    public static function access()
    {
        $role_id = DB::table('user_role')->where('user_id', Auth::user()->id)->first()->role_id;

        $sub_menus = DB::table('submenu')
                            ->join('submenu_role', 'submenu.id', '=', 'submenu_role.submenu_id')
                            ->where('role_id', $role_id)
                            ->whereNull('submenu_role.deleted_at')
                            ->select([
                                'submenu.*',
                            ])
                            ->get();

        foreach ($sub_menus as $key => $submenu) {
            $submenus[$submenu->route] = $submenu;
        }

        return $submenus;

    }

    public static function permissions($route)
    {
        $role_id = DB::table('user_role')->where('user_id', Auth::user()->id)->first()->role_id;

        $sub_menus = DB::table('submenu')
                            ->join('submenu_role', 'submenu.id', '=', 'submenu_role.submenu_id')
                            ->where('role_id', $role_id)
                            ->where('sidebar', 0)
                            ->where('route', 'like', '%' . ltrim($route, '/') . '%')
                            ->whereNull('submenu_role.deleted_at')
                            ->select([
                                'submenu.*',
                            ])
                            ->get();
        $permissions = [];
        foreach ($sub_menus as $key => $submenu) {
            $permissions[$submenu->route] = $submenu;
        }


        return $permissions;

    }

}
