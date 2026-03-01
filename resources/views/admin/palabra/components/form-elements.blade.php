<div class="form-group row align-items-center" :class="{'has-danger': errors.has('nombre'), 'has-success': fields.nombre && fields.nombre.valid }">
    <label for="nombre" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.palabra.columns.nombre') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.nombre" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('nombre'), 'form-control-success': fields.nombre && fields.nombre.valid}" id="nombre" name="nombre" placeholder="{{ trans('admin.palabra.columns.nombre') }}">
        <div v-if="errors.has('nombre')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('nombre') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('slug'), 'has-success': fields.slug && fields.slug.valid }">
    <label for="slug" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.palabra.columns.slug') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.slug" v-validate="nullable" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('slug'), 'form-control-success': fields.slug && fields.slug.valid}" id="slug" name="slug" placeholder="{{ trans('admin.palabra.columns.slug') }}">
        <div v-if="errors.has('slug')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('slug') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('descripcion'), 'has-success': fields.descripcion && fields.descripcion.valid }">
    <label for="descripcion" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.palabra.columns.descripcion') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div>
            <textarea class="form-control" v-model="form.descripcion" v-validate="''" id="descripcion" name="descripcion"></textarea>
        </div>
        <div v-if="errors.has('descripcion')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('descripcion') }}</div>
    </div>
</div>

<div class="form-check row" :class="{'has-danger': errors.has('estado'), 'has-success': fields.estado && fields.estado.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="estado" type="checkbox" v-model="form.estado" v-validate="''" data-vv-name="estado_fake_element"  name="estado_fake_element">
        <label class="form-check-label" for="estado">
            {{ trans('admin.palabra.columns.estado') }}
        </label>
        <input type="hidden" name="estado" :value="form.estado">
        <div v-if="errors.has('estado')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('estado') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('link'), 'has-success': fields.link && fields.link.valid }">
    <label for="link" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.palabra.columns.link') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div>
            <textarea class="form-control" v-model="form.link" v-validate="''" id="link" name="link"></textarea>
        </div>
        <div v-if="errors.has('link')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('link') }}</div>
    </div>
</div>


<div class="form-group row align-items-center" :class="{'has-danger': errors.has('categoria_id'), 'has-success': fields.categoria_id && fields.categoria_id.valid }">
    <label for="categoria_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">
        Categoría
    </label>

    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <select
            v-model="form.categoria_id"
            class="form-control"
            id="categoria_id"
            name="categoria_id"
        >
            <option value="">-- Seleccionar categoría --</option>

            @foreach($categorias as $categoria)
                <option value="{{ $categoria->id }}">
                    {{ $categoria->nombre }}
                </option>
            @endforeach
        </select>

        <div v-if="errors.has('categoria_id')" class="form-control-feedback form-text" v-cloak>
            @{{ errors.first('categoria_id') }}
        </div>
    </div>
</div>

<!-- <div class="form-group row align-items-center">
    <label for="video" class="col-form-label text-md-right col-md-2">
        Video
    </label>

    <div class="col-md-9 col-xl-8">

        {{-- CONTENEDOR ESTILIZADO DEL INPUT FILE --}}
        <div class="border rounded p-3 d-flex justify-content-between align-items-center bg-white">
            <div class="text-muted" id="video-file-name">
                Ningún archivo seleccionado
            </div>

            <button class="btn btn-primary btn-sm" type="button"
                    onclick="document.getElementById('video-input').click();">
                Seleccionar archivo
            </button>

            <input 
                type="file"
                id="video-input"
                name="video"
                class="d-none"
                accept="video/mp4,video/webm"
                onchange="document.getElementById('video-file-name').textContent = this.files[0]?.name ?? 'Ningún archivo seleccionado';"
            >
        </div>

        {{-- PREVIEW DEL VIDEO EXISTENTE --}}
        @if(isset($palabra) && $palabra->getFirstMediaUrl('video'))
            <video width="300" controls class="mt-3">
                <source src="{{ $palabra->getFirstMediaUrl('video') }}" type="video/mp4">
            </video>
        @endif
    </div>
</div> -->

<div class="form-group row align-items-start">
    <label class="col-form-label text-md-right col-md-2">
        Video
    </label>

    <div class="col-md-9 col-xl-8">

        <div class="card shadow-sm border-0">
            <div class="card-body">

                {{-- DROPZONE --}}
                <div
                    class="border rounded p-4 text-center bg-light"
                    style="cursor:pointer"
                    onclick="document.getElementById('video-input').click()"
                >
                    <i class="fa fa-video-camera fa-2x text-primary mb-2"></i>

                    <div class="fw-bold">
                        Arrastra tu video aquí o haz clic para seleccionar
                    </div>

                    <div class="text-muted small mt-1">
                        MP4 / WEBM · archivos grandes permitidos
                    </div>

                    <div id="video-file-name" class="mt-2 text-primary fw-semibold"></div>

                    <input
                        type="file"
                        id="video-input"
                        name="video"
                        class="d-none"
                        accept="video/mp4,video/webm"
                        onchange="handleVideo(this)"
                    >
                </div>

                {{-- PREVIEW NUEVO --}}
                <video
                    id="video-preview"
                    class="mt-3 d-none rounded shadow"
                    width="100%"
                    style="max-height:320px; background:#000"
                    controls
                ></video>

                {{-- PREVIEW EXISTENTE --}}
                @if(isset($palabra) && $palabra->getFirstMediaUrl('video'))
                    <video
                        class="mt-3 rounded shadow"
                        width="100%"
                        style="max-height:320px; background:#000"
                        controls
                        preload="metadata"
                    >
                        <source src="{{ $palabra->getFirstMediaUrl('video') }}" type="video/mp4">
                    </video>
                @endif

            </div>
        </div>

    </div>
</div>

<script>
function handleVideo(input) {
    const fileName = document.getElementById('video-file-name');
    const preview = document.getElementById('video-preview');

    if (!input.files || !input.files[0]) return;

    fileName.textContent = input.files[0].name;
    preview.src = URL.createObjectURL(input.files[0]);
    preview.classList.remove('d-none');
    preview.load();
}
</script>





