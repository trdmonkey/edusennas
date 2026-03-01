<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Categorium\BulkDestroyCategorium;
use App\Http\Requests\Admin\Categorium\DestroyCategorium;
use App\Http\Requests\Admin\Categorium\IndexCategorium;
use App\Http\Requests\Admin\Categorium\StoreCategorium;
use App\Http\Requests\Admin\Categorium\UpdateCategorium;
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

class CategoriaController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexCategorium $request
     * @return array|Factory|View
     */
    public function index(IndexCategorium $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Categorium::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'nombre', 'estado'],

            // set columns to searchIn
            ['id', 'nombre', 'slug', 'descripcion']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.categorium.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.categorium.create');

        return view('admin.categorium.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCategorium $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreCategorium $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Categorium
        $categorium = Categorium::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/categoria'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/categoria');
    }

    /**
     * Display the specified resource.
     *
     * @param Categorium $categorium
     * @throws AuthorizationException
     * @return void
     */
    public function show(Categorium $categorium)
    {
        $this->authorize('admin.categorium.show', $categorium);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Categorium $categorium
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Categorium $categorium)
    {
        $this->authorize('admin.categorium.edit', $categorium);


        return view('admin.categorium.edit', [
            'categorium' => $categorium,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCategorium $request
     * @param Categorium $categorium
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateCategorium $request, Categorium $categorium)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Categorium
        $categorium->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/categoria'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/categoria');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyCategorium $request
     * @param Categorium $categorium
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyCategorium $request, Categorium $categorium)
    {
        $categorium->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyCategorium $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyCategorium $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Categorium::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
