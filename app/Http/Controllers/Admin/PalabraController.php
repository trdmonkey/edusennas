<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Palabra\BulkDestroyPalabra;
use App\Http\Requests\Admin\Palabra\DestroyPalabra;
use App\Http\Requests\Admin\Palabra\IndexPalabra;
use App\Http\Requests\Admin\Palabra\StorePalabra;
use App\Http\Requests\Admin\Palabra\UpdatePalabra;
use App\Models\Palabra;
use App\Models\Categorium;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PalabraController extends Controller
{

    public function index(IndexPalabra $request)
    {
        $data = AdminListing::create(Palabra::class)
            ->modifyQuery(function($query) {
                // Obtenemos el usuario logueado
                $user = auth()->user();

                $query->leftJoin('categoria as c', 'palabra.categoria_id', '=', 'c.id')
                    ->selectRaw("
                    palabra.*, 
                    c.nombre as categoria_nombre,
                    CASE WHEN palabra.estado = 1 THEN 'Activo' ELSE 'Inactivo' END as estado_texto
                ");

                // solo mostramos lo que le pertenece a ese user_id -- este trabajo es temporal porque el admin id 1 puede cambiar
                if ($user->id !== 1) {
                    $query->where('palabra.user_id', $user->id);
                }
            })
            ->processRequestAndGet(
                $request,
                ['id', 'nombre', 'estado_texto', 'categoria_nombre'],
                ['id', 'nombre', 'slug', 'descripcion', 'link']
            );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return ['bulkItems' => $data->pluck('id')];
            }
            return ['data' => $data];
        }

        return view('admin.palabra.index', ['data' => $data]);
    }

    public function create()
    {
        $this->authorize('admin.palabra.create');

        // ****** NUEVO: cargar categorías ******
        $categorias = Categorium::orderBy('nombre')->get();

        return view('admin.palabra.create', [
            'categorias' => $categorias
        ]);
    }

    public function store(StorePalabra $request)
    {
        $sanitized = $request->getSanitized();

        // Asignamos el ID del usuario que está creando el registro
        $sanitized['user_id'] = auth()->user()->id;

        $palabra = Palabra::create($sanitized);

        \Log::info('FILES RECIBIDOS:', [
            'hasFile(video)' => $request->hasFile('video'),
            'allFiles' => $request->allFiles()
        ]);

        if ($request->hasFile('video')) {
            $palabra->addMediaFromRequest('video')
                ->toMediaCollection('video');
        }

        return redirect('admin/palabras')
            ->with('success', 'Guardado correctamente');
    }


    public function show(Palabra $palabra)
    {
        return view('admin.palabra.show', [
            'palabra' => $palabra
        ]);
    }

    public function edit(Palabra $palabra)
    {
        $this->authorize('admin.palabra.edit', $palabra);

        // ****** NUEVO: cargar categorías ******
        $categorias = Categorium::orderBy('nombre')->get();

        return view('admin.palabra.edit', [
            'palabra' => $palabra,
            'categorias' => $categorias
        ]);
    }

    public function update(UpdatePalabra $request, Palabra $palabra)
    {
        $sanitized = $request->getSanitized();

        $palabra->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/palabras'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/palabras');
    }

    public function destroy(DestroyPalabra $request, Palabra $palabra)
    {
        $palabra->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    public function bulkDestroy(BulkDestroyPalabra $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Palabra::whereIn('id', $bulkChunk)->delete();
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
