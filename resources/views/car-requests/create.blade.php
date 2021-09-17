@extends('layouts.main')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">New Form</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('car-requests.store') }}">
                            @csrf

{{--                            <div class="form-group row">--}}
{{--                                <label for="type" class="col-md-4 col-form-label text-md-right">Type</label>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <select id="type" class="form-control" name="type"></select>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <div class="form-group row">
                                <label for="brand" class="col-md-4 col-form-label text-md-right">Brand</label>

                                <div class="col-md-6">
                                    <select id="brand" class="form-control" name="brand"></select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="brand" class="col-md-4 col-form-label text-md-right">Model</label>

                                <div class="col-md-6">
                                    <select id="model" class="form-control" name="model"></select>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">Phone</label>

                                <div class="col-md-6">
                                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">

                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Send
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection()

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/4.0.9/jquery.inputmask.bundle.min.js"></script>
    <script>

        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#phone').inputmask('+38-999-999-99-99');

            $.ajax({
                type: 'get',
                url: '{{ route('autoria.brands') }}',
                success: function (data) {
                    // console.log(data);
                    data.forEach(element => $('#brand')
                        .append(
                            $('<option>', {
                                value: element.marka_id,
                                text: element.name
                            })
                        )
                    );
                   getModels(data[0].marka_id);
                }
            });

            $('#brand').change(function (e) {

                let id = $(this).find(":selected").attr('value');
                // console.log(id);
                getModels(id);
            });

            function getModels(id) {
                $.ajax({
                    type: 'get',
                    url: '{{ route('autoria.models') }}',
                    data: {
                        brand: id
                    },
                    success: function (data) {
                        console.log(data);
                        $('#model').find('option').remove();
                        data.forEach(element => $('#model')
                            .append(
                                $('<option>', {
                                    value: element.model_id,
                                    text: element.name
                                })
                            )
                        );
                    }
                });
            }
        });

    </script>
@stop
