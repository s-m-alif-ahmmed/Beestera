@extends('backend.app')

@section('title', 'System Settings')

@section('content')
{{-- PAGE-HEADER --}}
<div class="page-header">
    <div>
        <h1 class="page-title">System Settings</h1>
    </div>
    <div class="ms-auto pageheader-btn">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Settings</a></li>
            <li class="breadcrumb-item active" aria-current="page">System Settings</li>
        </ol>
    </div>
</div>
{{-- PAGE-HEADER --}}


<div class="row">
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card box-shadow-0">
            <div class="card-body">
                <form method="post" action="{{ route('system.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title" class="form-label">Title:</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    name="title" placeholder="title" id="title"
                                    value="{{ old('title', $setting->title ?? '') }}">
                                @error('title')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email" class="form-label">Email:</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                    name="email" placeholder="System Email" id="email"
                                    value="{{ old('email', $setting->email ?? '') }}">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label for="facebook" class="form-label">Facebook:</label>
                                <input type="text" class="form-control @error('system_name') is-invalid @enderror"
                                    name="facebook" placeholder="Facebook Link" id="facebook"
                                    value="{{ old('facebook', $setting->facebook ?? '') }}">
                                @error('facebook')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="twitter" class="form-label">Twitter:</label>
                                <input type="text" class="form-control @error('twitter') is-invalid @enderror"
                                    name="twitter" placeholder="Twitter Link" id="twitter"
                                    value="{{ old('twitter', $setting->twitter ?? '') }}">
                                @error('twitter')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="instagram" class="form-label">Instagram:</label>
                                <input type="text" class="form-control @error('system_name') is-invalid @enderror"
                                    name="instagram" placeholder="Instagram Link" id="instagram"
                                    value="{{ old('instagram', $setting->instagram ?? '') }}">
                                @error('instagram')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="linkedin" class="form-label">Linkedin:</label>
                                <input type="text" class="form-control @error('system_name') is-invalid @enderror"
                                    name="linkedin" placeholder="Linkedin Link" id="linkedin"
                                    value="{{ old('linkedin', $setting->linkedin ?? '') }}">
                                @error('linkedin')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div> --}}
                    </div>

                    <div class="form-group">
                        <label for="copyRights" class="form-label">Copy Rights Text:</label>
                        <input type="text" class="form-control @error('copyright_text') is-invalid @enderror"
                            name="copyright_text" placeholder="Copy Rights Text" id="copyRights"
                            value="{{ old('copyright_text', $setting->copyright_text ?? '') }}">
                        @error('copyright_text')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="summernote" class="form-label">About System:</label>
                        <textarea class="form-control @error('system_description') is-invalid @enderror" id="summernote" name="system_description"
                            placeholder="About System">{{ old('system_description', $setting->system_description ?? '') }}</textarea>
                        @error('system_description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="logo" class="form-label">Logo:</label>
                                <input type="file" class="dropify @error('logo') is-invalid @enderror" name="logo"
                                    id="logo"
                                    data-default-file="@isset($setting->logo){{ asset($setting->logo) }}@endisset">
                                @error('logo')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="favicon" class="form-label">Favicon:</label>
                                <input type="file" class="dropify @error('favicon') is-invalid @enderror"
                                    name="favicon" id="favicon"
                                    data-default-file="@isset($setting->favicon){{ asset($setting->favicon) }}@endisset">
                                @error('favicon')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
