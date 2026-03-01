@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.palabra.actions.index'))

@section('body')

    <palabra-listing
        :data="{{ $data->toJson() }}"
        :url="'{{ url('admin/palabras') }}'"
        inline-template>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> {{ trans('admin.palabra.actions.index') }}
                        <a class="btn btn-primary btn-spinner btn-sm pull-right m-b-0" href="{{ url('admin/palabras/create') }}" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('admin.palabra.actions.create') }}</a>
                    </div>
                    <div class="card-body" v-cloak>
                        <div class="card-block">
                            <form @submit.prevent="">
                                <div class="row justify-content-md-between">
                                    <div class="col col-lg-7 col-xl-5 form-group">
                                        <div class="input-group">
                                            <input class="form-control" placeholder="{{ trans('brackets/admin-ui::admin.placeholder.search') }}" v-model="search" @keyup.enter="filter('search', $event.target.value)" />
                                            <span class="input-group-append">
                                                <button type="button" class="btn btn-primary" @click="filter('search', search)"><i class="fa fa-search"></i>&nbsp; {{ trans('brackets/admin-ui::admin.btn.search') }}</button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-auto form-group ">
                                        <select class="form-control" v-model="pagination.state.per_page">
                                            
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                </div>
                            </form>

                            <table class="table table-hover table-listing">
                                <thead>
                                    <tr>
                                        <th class="bulk-checkbox">
                                            <input class="form-check-input" id="enabled" type="checkbox" v-model="isClickedAll" v-validate="''" data-vv-name="enabled"  name="enabled_fake_element" @click="onBulkItemsClickedAllWithPagination()">
                                            <label class="form-check-label" for="enabled">
                                                #
                                            </label>
                                        </th>

                                        <th is='sortable' :column="'id'">{{ trans('admin.palabra.columns.id') }}</th>
                                        <th is='sortable' :column="'nombre'">{{ trans('admin.palabra.columns.nombre') }}</th>
                                        <th is='sortable' :column="'slug'">{{ trans('admin.palabra.columns.slug') }}</th>
                                        <th is='sortable' :column="'estado'">{{ trans('admin.palabra.columns.estado') }}</th>
                                        <th is='sortable' :column="'categoria_id'">{{ trans('admin.palabra.columns.categoria_id') }}</th>

                                        <th></th>
                                    </tr>
                                    <tr v-show="(clickedBulkItemsCount > 0) || isClickedAll">
                                        <td class="bg-bulk-info d-table-cell text-center" colspan="6">
                                            <span class="align-middle font-weight-light text-dark">{{ trans('brackets/admin-ui::admin.listing.selected_items') }} @{{ clickedBulkItemsCount }}.  <a href="#" class="text-primary" @click="onBulkItemsClickedAll('/admin/palabras')" v-if="(clickedBulkItemsCount < pagination.state.total)"> <i class="fa" :class="bulkCheckingAllLoader ? 'fa-spinner' : ''"></i> {{ trans('brackets/admin-ui::admin.listing.check_all_items') }} @{{ pagination.state.total }}</a> <span class="text-primary">|</span> <a
                                                        href="#" class="text-primary" @click="onBulkItemsClickedAllUncheck()">{{ trans('brackets/admin-ui::admin.listing.uncheck_all_items') }}</a>  </span>

                                            <span class="pull-right pr-2">
                                                <button class="btn btn-sm btn-danger pr-3 pl-3" @click="bulkDelete('/admin/palabras/bulk-destroy')">{{ trans('brackets/admin-ui::admin.btn.delete') }}</button>
                                            </span>

                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(item, index) in collection" :key="item.id" :class="bulkItems[item.id] ? 'bg-bulk' : ''">

                                    <!-- Checkbox -->
                                    <td class="bulk-checkbox">
                                        <input class="form-check-input"
                                            :id="'enabled' + item.id"
                                            type="checkbox"
                                            v-model="bulkItems[item.id]"
                                            @click="onBulkItemClicked(item.id)"
                                        >
                                        <label class="form-check-label" :for="'enabled' + item.id"></label>
                                    </td>

                                    <!-- ID -->
                                    <td>@{{ item.id }}</td>

                                    <!-- Nombre -->
                                    <td>@{{ item.nombre }}</td>

                                    <!-- Slug -->
                                    <td>@{{ item.slug }}</td>

                                    <!-- Estado -->
                                    <td>
                                        <span v-if="item.estado == 1" class="badge badge-success">Activo</span>
                                        <span v-else class="badge badge-danger">Inactivo</span>
                                    </td>

                                    <!-- Categoria -->
                                    <td>@{{ item.categoria_nombre }}</td>

                                    <!-- Acciones -->
                                    <td>
                                        <div class="row no-gutters">
                                            <div class="col-auto">
                                                <a class="btn btn-sm btn-info" :href="item.resource_url + '/edit'">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </div>
                                            <form @submit.prevent="deleteItem(item.resource_url)">
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></button>
                                            </form>
                                        </div>
                                    </td>

                                </tr>
                                </tbody>

                            </table>

                            <div class="row" v-if="pagination.state.total > 0">
                                <div class="col-sm">
                                    <span class="pagination-caption">{{ trans('brackets/admin-ui::admin.pagination.overview') }}</span>
                                </div>
                                <div class="col-sm-auto">
                                    <pagination></pagination>
                                </div>
                            </div>

                            <div class="no-items-found" v-if="!collection.length > 0">
                                <i class="icon-magnifier"></i>
                                <h3>{{ trans('brackets/admin-ui::admin.index.no_items') }}</h3>
                                <p>{{ trans('brackets/admin-ui::admin.index.try_changing_items') }}</p>
                                <a class="btn btn-primary btn-spinner" href="{{ url('admin/palabras/create') }}" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('admin.palabra.actions.create') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </palabra-listing>

@endsection