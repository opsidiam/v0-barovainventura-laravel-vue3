@extends('admin.layouts.app')
@section('css')
    <style>
        .ck-editor__editable_inline:not(.ck-comment__input *) {
            height: 300px;
            overflow-y: auto;
        }
    </style>
@endsection
@section('content')
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Nový newsletter</h1>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-body">
                        <form method="POST" action="{{ route('newsletter.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="subject">Predmet</label>
                                <input type="text" name="subject" id="subject"
                                       class="form-control @error('subject') is-invalid @enderror"
                                       placeholder="Zadajte predmet newsletteru"
                                       value="{{ old('subject') }}">
                                @error('subject')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="content">Obsah</label>
                                <textarea name="content" id="editor" style="height: 400px;"
                                          class="form-control @error('content') is-invalid @enderror"
                                          placeholder="Zadajte obsah newsletteru">{{ old('content') }}</textarea>
                                @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save mr-2"></i> Uložiť
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                placeholder: 'Sem napíšte obsah newsletteru...'
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
