<div class="form-group">
    <label for="feeling_name">Name : </label>
    <input type="text" name="feeling_name" id="feeling_name"
        class="form-control @error('feeling_name') is-invalid @enderror"
        value="{{ isset($feeling) ? $feeling->feeling_name : old('feeling_name') }}">

    @error('feeling_name')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>



<div class="form-group">
    <label for="fname">Status </label>
    <div class="form-check">
        <input type="checkbox" id="is_active" name="is_active" value="1"
            class="form-check-input @error('is_active') is-invalid @enderror"
            {{ isset($feeling) && $feeling->is_active ? 'checked' : old('is_active') }}>

        @error('is_active')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
</div>


<div class="form-group">
    
        <button type="submit" class="btn btn-primary">
            Submit
        </button>
 
</div>
