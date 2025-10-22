<div style="display: flex; gap: 5px; justify-content: space-between;">
    @foreach ($items as $item)
    <label class="form-label tips-recpie" style="display: flex; align-items: center; gap: 2px;">
        <input type="checkbox" name="{{ $name }}[]" value="{{ $item }}">
        {{ $item }}
    </label>
    @endforeach
</div>