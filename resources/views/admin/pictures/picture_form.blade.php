
<div class="form-group">
    <label for="pic_name">File input</label>
    <div class="input-group">
        <div class="custom-file">
            <input type="file" name ='pic_name' class="custom-file-input" id="pic_name">
            <label class="custom-file-label" for="pic_name">Choose file</label>
        </div>
        <div class="input-group-append">
            <span class="input-group-text">Upload</span>
        </div>
    </div>
</div>

{{-- 
<div class="form-check">
    <input type="checkbox" name="is_active" value = "1" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Is_Active</label>
</div> --}}



<div class="form-group">
    <label for="fname">Status </label>
    <div class="form-check">
        <input type="checkbox" id="is_active" name="is_active" value="1"
            class="form-check-input @error('is_active') is-invalid @enderror"
            {{ isset($pictures) && $pictures->is_active ? 'checked' : old('is_active') }}>

        @error('is_active')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
</div>



<!-- /.card-body -->
<div class="form-group">
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>




