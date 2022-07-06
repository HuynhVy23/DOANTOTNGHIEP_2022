@extends('layout_admin.layout')
@section('container')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Update Promotion</h3>
        </div>
    </div>
@stop
@section('main')
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('salead.update', $sale->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="name" class="col-form-label">Name: <em style="color: red">*</em></label>
                    <input type="text" class="form-control" name="name" value="{{ $sale->name }}"
                        placeholder="Enter name" style="text-align: left; border-style:groove">
                </div>
                @if ($errors->first('name'))
                    <div class="error">
                        <p>{{ $errors->first('name') }}</p>
                    </div>
                @endif

                <div class="form-group">
                    <label for="date" class="col-form-label">Date Start:</label>
                    <input type="date" class="form-control" name="date_start" value="{{ $sale->date_start }}" min="1930-01-01"
                        max="2010-12-31">
                </div>
                @if ($errors->first('date_start'))
                    <div class="error">
                        <p>{{ $errors->first('date_start') }}</p>
                    </div>
                @endif
    
                <div class="form-group">
                    <label for="date" class="col-form-label">Date End:</label>
                    <input type="date" class="form-control" name="date_end" value="{{ $sale->date_end }}" min="1930-01-01"
                        max="2010-12-31">
                </div>
                @if ($errors->first('date_end'))
                    <div class="error">
                        <p>{{ $errors->first('date_end') }}</p>
                    </div>
                @endif


                <label for="file">Image : </label>
                <input type="file" name="image_brand" id="file" />
                <div style="text-align: center">
                    <button type="submit" class="btn btn-primary">Done</button>
                </div>
            </form>
        </div>

        <div class="card">
            <img src="{{ $sale->image_banner }}" width="500px" height="500px">
        </div>
    </div>
@stop
