

<div class="form-group">
    <label for="title">Title : </label>
    <input type="text" name="title" id="title"
        class="form-control @error('title') is-invalid @enderror"
        value="{{ isset($post) ? $post->title : old('title') }}">

    @error('title')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>


<!-- textarea -->
<div class="form-group">
    <label for="post_body">Post Body</label>
    <textarea class="form-control  @error('post_body') is-invalid @enderror" name ="post_body" rows="3" placeholder="Enter ..."> {{ isset($post) ? $post->post_body : old('post_body') }}</textarea>

    @error('post_body')
    <p class="invalid-feedback">{{ $message }}</p>
@enderror
</div>

<div class="form-group">
    <label>Feeling</label>
    <select class="form-control" name="feeling_id">
        
        @foreach ($feelings as $feeling)
            <option  value="{{ $feeling->id }}"   
                @selected((isset($post) && $post->feeling_id == $feeling->id) || old('feeling_id') == $feeling->id)
            > 
                
                {{ $feeling->feeling_name }}  
            
            </option>
        @endforeach

    </select>
  </div>


<div class="form-group">
    <label for="pic_name">File input</label>
    <div class="input-group">
        <div class="custom-file">
            <input type="file" name ='pic_name[]' class="custom-file-input " id="pic_name">
            <label class="custom-file-label" for="pic_name">Choose file</label>
        </div>
        <div class="input-group-append">
            <span class="input-group-text">Upload</span>
        </div>
    </div>
</div>


<div class="form-group">
    <label for="fname">Status </label>
    <div class="form-check">
       
        <input type="checkbox" id="is_active" name="is_active" value="1"
            class="form-check-input @error('is_active') is-invalid @enderror"
            {{ isset($post) && $post->is_active ? 'checked' : old('is_active') }}>

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

