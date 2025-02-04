<label for="distrito" class="text-lg font-sans">Distrito</label>
<select id="distrito" name="distrito_id" class="border border-blue-500 py-2 px-4 rounded-xl outline-none">
    <option value="">Seleccione un distrito</option>
    @foreach($distritos as $distrito)
        <option value="{{ $distrito->id }}">{{ $distrito->nombre }}</option>
    @endforeach
</select>