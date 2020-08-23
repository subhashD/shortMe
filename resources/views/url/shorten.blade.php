@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
           
            <div class="card">
                  <div class="card-header">
                    <div class="input-group mb-3">
                      <input type="text" name="link" id="link-field" class="form-control" placeholder="Enter URL" aria-label="Recipient's username" aria-describedby="basic-addon2">
                      <div class="input-group-append">
                        <button class="btn btn-success" type="button" id="shorten-btn">Generate Shorten Link</button>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
               
                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                <p>{{ Session::get('success') }}</p>
                            </div>
                        @endif
               
                        <table class="table table-bordered table-sm table-responsive links-table-height" id="user-links-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Short Link</th>
                                    <th>Link</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                  </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset(mix('js/shorten.js')) }}"></script>
@endpush

