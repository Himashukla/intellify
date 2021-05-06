@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">        
        @include('layouts.alerts')
        <div class="col-md-8 mt-5">
            <div class="card">
                <div class="card-header">Edit Product Details</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('products.update',$product->id) }}">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group row">
                           <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                           <div class="col-md-6">
                               <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $product->name }}" autocomplete="name" autofocus required>

                               @error('name')
                                   <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                   </span>
                               @enderror
                           </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

                            <div class="col-md-6">
                               <textarea name="description" class="form-control @error('description') is-invalid @enderror" required>{{$product->description}}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Status</label>

                            <div class="col-md-6">
                                <input type="radio" name="status" value="Enable" @if( $product->status == 'Enable') checked @endif> Enable
                                <input type="radio" name="status" value="Disable" @if( $product->status == 'Disable') checked @endif> Disable
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                           <label for="price" class="col-md-4 col-form-label text-md-right">Price</label>

                           <div class="col-md-6">
                               <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $product->price }}" required autocomplete="price">

                               @error('price')
                                   <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                   </span>
                               @enderror
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="quantity" class="col-md-4 col-form-label text-md-right">Quantity</label>

                           <div class="col-md-6">
                               <input id="quantity" type="text" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ $product->quantity }}" required autocomplete="quantity">

                               @error('quantity')
                                   <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                   </span>
                               @enderror
                           </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
