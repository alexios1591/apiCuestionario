<label for="provincia" class="text-lg font-sans">Provincia</label>
<select id="provincia" name="provincia_id" class="border border-blue-500 py-2 px-4 rounded-xl outline-none">
    <option value="">Seleccione una provincia</option>
    @foreach($provincias as $provincia)
        <option value="{{ $provincia->id }}">{{ $provincia->nombre }}</option>
    @endforeach
</select>
