<div class="form-group">
    <label for="stat">Status <span class="label-required">*</span> </label>
    <select name="stat" id="stat" class="form-control">
        <option value="1" {{ $source->stat == '1' ? 'selected' : '' }}>Active</option>
        <option value="0" {{ $source->stat == '0' ? 'selected' : '' }}>In-Active</option>
    </select>

</div>