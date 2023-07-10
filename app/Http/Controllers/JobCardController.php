<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobCard\storeRequest;
use App\Http\Services\JobCardService;
use App\Http\Services\OcorrenciaService;
use App\Http\Services\TecnicoService;
use App\Http\Services\ViaturaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class JobCardController extends HomeController
{
    public function create($ocorrencia = null)
    {
        return view('job-card.create', [
            'ocorrencia' => ($ocorrencia) ? OcorrenciaService::get($ocorrencia) : null,
            'viaturas' => ViaturaService::index(),
        ]);
    }

    public function update($id)
    {
        return view('job-card.update', [
            'job' => JobCardService::get($id),
        ]);
    }

    public function show($id)
    {
        return view('job-card.show', [
            'job' => JobCardService::get($id),
            'trabalhos' => JobCardService::indexJobs($id),
        ]);
    }

    public function jobs($id)
    {
        return view('job-card.jobs', [
            'job' => JobCardService::get($id),
            'tecnicos' => TecnicoService::index(),
            'trabalhos' => Session::get('jobs'),
        ]);
    }

    public function store(storeRequest $request, $ocorrencia = null)
    {
        JobCardService::store($request, $ocorrencia);

        session()->flash('title', 'Job Card');
        return to_route('job-card.list')->with('success-message', 'Registado com sucesso!');
    }

    public function storeJobs($job)
    {
        JobCardService::storeJobs($job);

        session()->flash('title', 'Trabalhos efectuados');
        return to_route('job-card.list')->with('success-message', 'Registados com sucesso!');
    }

    public function put(storeRequest $request, $id)
    {
        JobCardService::put($request, $id);

        session()->flash('title', 'Job Card');
        return to_route('job-card.list')->with('success-message', 'Actualizado com sucesso!');
    }

    public function delete($id)
    {
        JobCardService::delete($id);

        session()->flash('title', 'Job Card');
        return back()->with('success-message', 'Eliminado com sucesso!');
    }

    public function addJob(Request $request)
    {
        return view('job-card.components.table', [
            'trabalhos' => JobCardService::addJob($request),
        ]);
    }

    public function removeJob(Request $request)
    {
        JobCardService::removeJob($request);
    }

    public function index()
    {
        return view('job-card.index', [
            'jobs' => JobCardService::index()
        ]);
    }
}
