@extends('dashboard.layouts.main')
@section('container')
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Welcome back, {{ auth()->user()->name }}</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Dashboard Analytics</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="card">
            <h5 class="card-header">Edit Data Penelusuran Katalog</h5>
            <div class="card-body table-border-style">
                <div class="col-lg-10">
                    <form method="POST" action="/dashboard/koleksidigitals/{{ $koleksidigital->slug }}" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <form>
                        <div class="mb-3 row">
                            <label for="title" class="col-md-2 col-form-label">Title</label>
                            <div class="col-md-10">
                              <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title', $koleksidigital->title) }}" required autofocus/>
                            @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="slug" class="col-md-2 col-form-label">Slug</label>
                            <div class="col-md-10">
                              <input class="form-control @error('slug') is-invalid @enderror" type="text" name="slug" id="slug" value="{{ old('slug', $koleksidigital->slug) }}"/>
                            @error('slug')
                              <div class="invalid-feedback">
                                  {{ $message }}
                              </div>
                            @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                                <label for="category" class="col-md-2 col-form-label">Category</label>
                                <div class="col-md-10">
                                <select class="form-control" id="category" name="category_id">
                                    @foreach ($categories as $category)
                                    @if (old('category_id', $koleksidigital->category_id) == $category->id)
                                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                    @else
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                                </div>
                          </div>
                          <div class="mb-3 row">
                            <label for="penulis" class="col-md-2 col-form-label">Penulis</label>
                            <div class="col-md-10">
                            <select class='fstdropdown-select' id="first" name="author_id">
                                @foreach ($authors as $author)
                                @if (old('author_id', $koleksidigital->author_id) == $author->id)
                                <option value="{{ $author->id, $koleksidigital->author_id }}" selected>{{ $author->nama }}</option>
                                @else
                                <option value="{{ $author->id }}">{{ $author->nama }}</option>
                                @endif
                                @endforeach
                            </select>
                            </div>
                        </div>
                          <div class="mb-3 row">
                            <label for="edisi" class="col-md-2 col-form-label">Edisi</label>
                            <div class="col-md-10">
                              <input class="form-control" type="text" name="edisi" id="edisi" value="{{ old('edisi', $koleksidigital->edisi) }}"/>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="isbn" class="col-md-2 col-form-label">ISBN</label>
                            <div class="col-md-10">
                              <input class="form-control" type="text" name="isbn" id="isbn" value="{{ old('isbn', $koleksidigital->isbn) }}"/>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="penerbit" class="col-md-2 col-form-label">Penerbit</label>
                            <div class="col-md-10">
                              <input class="form-control" type="text" name="penerbit" id="penerbit" value="{{ old('penerbit', $koleksidigital->penerbit) }}"/>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="tempat_terbit" class="col-md-2 col-form-label">Tempat Terbit</label>
                            <div class="col-md-10">
                              <input class="form-control" type="text" name="tempat_terbit" id="tempat_terbit" value="{{ old('tempat_terbit', $koleksidigital->tempat_terbit) }}"/>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="tahun_terbit" class="col-md-2 col-form-label">Tahun Terbit</label>
                            <div class="col-md-10">
                              <input class="form-control" type="year" name="tahun_terbit" id="tahun_terbit" value="{{ old('tahun_terbit', $koleksidigital->tahun_terbit) }}"/>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="jumlah" class="col-md-2 col-form-label">Jumlah</label>
                            <div class="col-md-10">
                              <input class="form-control" type="number" name="jumlah" id="jumlah" value="{{ old('jumlah', $koleksidigital->jumlah) }}" required/>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="bahasa" class="col-md-2 col-form-label">Bahasa</label>
                            <div class="col-md-10">
                              <input class="form-control" type="text" name="bahasa" id="bahasa" value="{{ old('bahasa', $koleksidigital->bahasa) }}"/>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="image" class="col-md-2 col-form-label">Upload Gambar</label>
                            <div class="col-md-10">
                            <input type="hidden" name="oldImage" value="{{ $koleksidigital->image }}">
                            @if ($koleksidigital->image)
                            <img src="{{ asset('storage/' . $koleksidigital->image) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">                                
                            @else
                            <img class="img-preview img-fluid mb-3 col-sm-5">
                            @endif
                                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()"/>
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                              @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="filekoleksidigital" class="col-md-2 col-form-label">Upload File</label>
                            <div class="col-md-10">
                            <input type="hidden" name="oldFile" value="{{ $koleksidigital->filekatalog }}">
                            @if ($koleksidigital->filekatalog)
                            <iframe src="{{ asset('storage/' . $koleksidigital->filekatalog) }}" width="75%" height="300px">
                            </iframe>
                            @else
                            <canvas id="pdfViewer"></canvas>
                            @endif
                            <input class="form-control @error('filekatalog') is-invalid @enderror" type="file" id="filekatalog" name="filekatalog" onchange="previewfilekatalog()"/>
                            <canvas id="pdfViewer"></canvas>
                            @error('filekatalog')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                              @enderror
                            </div>
                        </div>
                          <div class="mb-3 row">
                            <label for="body" class="col-md-2 col-form-label">Sinopsis</label>
                             <div class="col-md-10">
                                 <input id="body" type="hidden" name="body" value="{{ old('body', $koleksidigital->body) }}">
                                 <trix-editor input="body"></trix-editor>
                                 @error('body')
                                 <p class="text-danger">{{ $message }}</p>
                                 @enderror
                             </div>
                          </div>
                        <button type="submit" class="btn btn-primary" style="float:right">Update Data</button>
                      </form>
                </div>
            </div>
        </div>  
        <!-- [ Main Content ] end -->
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
<script>
    //SLUG
    const title = document.querySelector('#title');
    const slug = document.querySelector('#slug');

    title.addEventListener('change', function() {
        fetch('/dashboard/koleksidigitals/checkSlug?title=' +title.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
    });

    //TRIX-EDITOR
    document.addEventListener('trix-file-accept', function(e) {
        e.preventDefault();
    })

    document.addEventListener('trix-file-accept', function(e) {
        e.preventDefault();
    })

      // IMAGE
      function previewImage(){
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }

    // FILE PDF
    $("#filekatalog").on("change", function(e){
        var file = e.target.files[0]
        if(file.type == "application/pdf"){
            var fileReader = new FileReader();  
            fileReader.onload = function() {
                var pdfData = new Uint8Array(this.result);
                // Using DocumentInitParameters object to load binary data.
                var loadingTask = pdfjsLib.getDocument({data: pdfData});
                loadingTask.promise.then(function(pdf) {
                console.log('PDF loaded');
                
                // Fetch the first page
                var pageNumber = 1;
                pdf.getPage(pageNumber).then(function(page) {
                    console.log('Page loaded');
                    
                    var scale = 0.5;
                    var viewport = page.getViewport({scale: scale});

                    // Prepare canvas using PDF page dimensions
                    var canvas = $("#pdfViewer")[0];
                    var context = canvas.getContext('2d');
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;

                    // Render PDF page into canvas context
                    var renderContext = {
                    canvasContext: context,
                    viewport: viewport
                    };
                    var renderTask = page.render(renderContext);
                    renderTask.promise.then(function () {
                    console.log('Page rendered');
                    });
                });
                }, function (reason) {
                // PDF loading error
                console.error(reason);
                });
            };
            fileReader.readAsArrayBuffer(file);
        }
    });


    //Dropdown Search
    function setDrop() {
            if (!document.getElementById('third').classList.contains("fstdropdown-select"))
                document.getElementById('third').className = 'fstdropdown-select';
            setFstDropdown();
        }
        setFstDropdown();
        function removeDrop() {
            if (document.getElementById('third').classList.contains("fstdropdown-select")) {
                document.getElementById('third').classList.remove('fstdropdown-select');
                document.getElementById("third").fstdropdown.dd.remove();
                document.querySelector("#third~.fstdiv").remove();
            }
        }
        function addOptions(add) {
            var select = document.getElementById("fourth");
            for (var i = 0; i < add; i++) {
                var opt = document.createElement("option");
                var o = Array.from(document.getElementById("fourth").querySelectorAll("option")).slice(-1)[0];
                var last = o == undefined ? 1 : Number(o.value) + 1;
                opt.text = opt.value = last;
                select.add(opt);
            }
        }
        function removeOptions(remove) {
            for (var i = 0; i < remove; i++) {
                var last = Array.from(document.getElementById("fourth").querySelectorAll("option")).slice(-1)[0];
                if (last == undefined)
                    break;
                Array.from(document.getElementById("fourth").querySelectorAll("option")).slice(-1)[0].remove();
            }
        }
        function updateDrop() {
            document.getElementById("fourth").fstdropdown.rebind();
        }

</script>
@endsection