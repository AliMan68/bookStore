@extends('profile.layout')

@section('main')
    <h5>Enter verify token:</h5>
    <hr>
    <form action="{{url('/authToken')}}" method="post" >
        @csrf
        <div class="form-group">
            <label for="code">Code:</label>
            <input type="text" name="code" id="code" class="form-control"  placeholder="Enter code">
        </div>
        <div class="form-group mt-1">
            <button class="btn btn-primary mt-1" type="submit">
                Verify
            </button>
        </div>
    </form>
@endsection
