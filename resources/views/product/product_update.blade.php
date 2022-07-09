@extends('layout_admin.layout')
@section('container')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Update Perfume Model</h3>
        </div>
    </div>
@stop
@section('main')
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('productad.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="name" class="col-form-label">Name: <em style="color: red">*</em></label>
                    <input type="text" class="form-control" name="name" value="{{ $product->name }}"
                        placeholder="Enter name" style="text-align: left; border-style:groove">
                </div>
                @if ($errors->first('name'))
                    <div class="error">
                        <p>{{ $errors->first('name') }}</p>
                    </div>
                @endif

                <div class="form-group">
                    <label for="concentration" class="col-form-label">Concentration: <em style="color: red">*</em></label>
                    <input type="text" class="form-control" name="concentration" value="{{ $product->concentration }}"
                        placeholder="Enter concentration" style="text-align: left; border-style:groove">
                </div>
                @if ($errors->first('concentration'))
                    <div class="error">
                        <p>{{ $errors->first('concentration') }}</p>
                    </div>
                @endif

                <div class="form-group">
                    <label for="description" class="col-form-label">Description: <em style="color: red">*</em></label>
                    <input type="text" class="form-control" name="description" value="{{ $product->description }}"
                        placeholder="Enter description" style="text-align: left; border-style:groove">
                </div>
                @if ($errors->first('description'))
                    <div class="error">
                        <p>{{ $errors->first('description') }}</p>
                    </div>
                @endif

                <div class="form-group">
                    <label for="model" class="col-form-label">Gender: <em style="color: red">*</em></label>
                    <select name="gender">
                        <option value="0" {{ $product->gender == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="1" {{ $product->gender == 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="2" {{ $product->gender == 'Unisex' ? 'selected' : '' }}>Unisex</option>
                    </select>
                </div>
                @if ($errors->first('gender'))
                    <div class="error">
                        <p>{{ $errors->first('gender') }}</p>
                    </div>
                @endif

                <div class="form-group">
                    <label for="model" class="col-form-label">Brand: <em style="color: red">*</em></label>
                    <select name="brand_id">
                        @foreach ($lstBrand as $item)
                            <option value="{{ $item->id }}" @if ($item->id == $product->brand_id) selected @endif>
                                {{ $item->name_brand }}</option>
                        @endforeach
                    </select>
                </div>
                @if ($errors->first('brand_id'))
                    <div class="error">
                        <p>{{ $errors->first('brand_id') }}</p>
                    </div>
                @endif
                <div class="form-group">
                    <label for="model" class="col-form-label">Scent: <em style="color: red">*</em></label>
                    <select name="scent_id">
                        @foreach ($lstScent as $item)
                            <option value="{{ $item->id }}" @if ($item->id == $product->scent_id) selected @endif>
                                {{ $item->name_scent }}</option>
                        @endforeach
                    </select>
                </div>
                @if ($errors->first('scent_id'))
                    <div class="error">
                        <p>{{ $errors->first('scent_id') }}</p>
                    </div>
                @endif
                <label for="file">Image : </label>
                <input type="file" name="image" id="file" />
                <div style="text-align: center">
                    <button type="submit" class="btn btn-primary">Done</button>
                </div>
            </form>
        </div>

        <div class="card">
            <img src="{{ $product->image }}" width="500px" height="500px">
        </div>
    </div>
@stop
