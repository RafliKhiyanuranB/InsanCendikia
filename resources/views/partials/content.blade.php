@extends('index')

@section('content')
<div class="pc-container">
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0">Dashboard</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-md-12 col-xxl-3">
                <div class="card">
                    <div class="card-body">
                        <h4>Welcome Back</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius, perspiciatis ipsam reiciendis eligendi incidunt vero nulla blanditiis illo unde quia quod quo, enim soluta. Culpa sunt harum aliquam blanditiis porro!</p>
                        <a href="" class="btn btn-primary rounded btn-sm px-4">Lets Explore</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
@endsection