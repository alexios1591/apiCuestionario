<div class="bg-fondo flex justify-center items-center h-screen">
    <div class="bg-white rounded-lg p-8 shadow-xl h-auto w-1/3">
        <h2 class="text-gray-800 font-sans font-bold text-xl mb-2">Seleccione su Localidad</h2>

        <form id="localidad-form">
            <div class="flex flex-col gap-4">
                <div class="flex flex-col gap-2">
                    <label for="departamento" class="text-lg font-sans">Departamento</label>
                    <select id="departamento" name="departamento_id" class="border border-blue-500 py-2 px-4 rounded-xl outline-none">
                        <option value="">Seleccione un departamento</option>
                        @foreach($departamentos as $departamento)
                            <option value="{{ $departamento->idDepartamento }}">{{ $departamento->departamento }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col gap-2" id="provincias-container">
                    @include('localidad.partials.provincias', ['provincias' => []])
                </div>

                <div class="flex flex-col gap-2" id="distritos-container">
                    @include('localidad.partials.distritos', ['distritos' => []])
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('departamento').addEventListener('change', function () {
        const departamentoId = this.value;
        fetchProvincias(departamentoId);
    });

    function fetchProvincias(departamentoId) {
        fetch('{{ route('localidad.provincias') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ departamento_id: departamentoId })
        })
        .then(response => response.text())
        .then(html => {
            document.getElementById('provincias-container').innerHTML = html;
        });
    }

    document.getElementById('provincias-container').addEventListener('change', function (e) {
        if (e.target.id === 'provincia') {
            const provinciaId = e.target.value;
            fetchDistritos(provinciaId);
        }
    });

    function fetchDistritos(provinciaId) {
        fetch('{{ route('localidad.distritos') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ provincia_id: provinciaId })
        })
        .then(response => response.text())
        .then(html => {
            document.getElementById('distritos-container').innerHTML = html;
        });
    }
</script>
