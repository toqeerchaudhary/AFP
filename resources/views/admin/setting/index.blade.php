@extends("layouts.backend")

@section("title")
    Change Settings
@stop

@section("styles")
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@stop

@section("content")
    <div class="card mt-3">
        <div class="card-body">
            @include('includes.info-box')
            <div class="">
                <form action="{{ route("admin.settings.store") }}" method="post" class="needs-validation">
                    @csrf
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="general_terms">General Terms:</label>
                            <textarea id="general_terms" name="general_terms">{{ $settings ? $settings->general_terms : "" }}</textarea>
                        </div>


                        <div class="form-group col-12">
                            <label for="project_terms">Project Terms:</label>
                            <textarea id="project_terms" name="project_terms">{{ $settings ?  $settings->project_terms : "" }}</textarea>

                        </div>

                        <div class="form-group col-12">
                            <button class="btn btn-info" type="submit" >Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section("scripts")
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#project_terms, #general_terms').summernote({
                height: 200,
                toolbar: [
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                ]
            });
        });
    </script>
@stop