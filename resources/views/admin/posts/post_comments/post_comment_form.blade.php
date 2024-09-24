<div class="col-12">
    <div class="form-group">
        <label for="comment_body">Comment Body : </label>
        <input
            type="text"
            name="comment_body"
            id="comment_body"
            class="form-control @error('comment_body') is-invalid @enderror"
            value="{{ isset($post_comment ) ? $feeling->feelling_name : old('name') }}">


        @error('comment_body')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
</div>




<div class="col-12">
    <div class="form-group">


        <label for="fname">Status </label>


        <div class="form-check">
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


        </div>
    </div>
</div>

<div class="col-12">
    <div class="form-group">
        <button
            type="submit"
            class="btn btn-primary py-3"
        >
        Submit
        </button>
    </div>
</div>
