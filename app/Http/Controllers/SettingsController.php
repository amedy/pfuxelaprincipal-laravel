<?php

namespace App\Http\Controllers;

use App\Http\Requests\Settings\storeAppearanceRequest;
use App\Http\Requests\Settings\storeRequest;
use App\Http\Services\CombustivelService;
use App\Http\Services\SettingsService;
use Illuminate\Http\Request;

class SettingsController extends HomeController
{
    public function show()
    {
        return view('settings.show', [
            'gasolina' => CombustivelService::getPetrol(),
            'diesel' => CombustivelService::getDiesel(),
        ]);
    }

    public function storeAppearance(storeAppearanceRequest $request)
    {
        SettingsService::storeAppearance($request);

        session()->flash('title', 'Definições');
        return back()->with('success-message', 'Salvadas com sucesso!');
    }

    public function store(storeRequest $request)
    {
        SettingsService::store($request);

        session()->flash('title', 'Definições');
        return back()->with('success-message', 'Salvadas com sucesso!');
    }
}
