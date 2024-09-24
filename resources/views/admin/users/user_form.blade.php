<!-- textarea -->
<div class="form-group">
    <label>Post Body</label>
    <textarea class="form-control" name ="post_body" rows="3" placeholder="Enter ..."></textarea>
</div>

<div class="form-group">
    <label>Feeling</label>
    <select class="form-control" name="feeling_id">
        
        @foreach ($feelings as $feeling)
            <option  value="{{ $feeling->id }}" > {{ $feeling->feeling_name }}  </option>
        @endforeach

    </select>
  </div>



<div class="form-check">
    <input type="checkbox" name="is_active" value = "1" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Is_Active</label>
</div>

<!-- /.card-body -->
<div class="form-group">
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>


{{-- <div class="form-check">
        <input
            type="checkbox"
            id="is_active"
            name="is_active"
            value="1"
            class="form-check-input @error('is_active') is-invalid @enderror"
             {{   isset($feeling) && $feeling->is_active ? 'checked' : ''  }}
        >

        @error('is_active')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror


    </div> --}}
