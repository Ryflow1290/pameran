@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ __('Edit Pameran') }}</h1>

@if (session('success'))
<div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger border-left-danger" role="alert">
    <ul class="pl-4 my-2">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="row">


    <div class="col-lg-12 order-lg-1">

        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Pameran {{ $pameran->title }}</h6>
            </div>

            <div class="card-body">

                <form method="POST" action="{{ route('pameran.update', $pameran->id) }}" enctype="multipart/form-data" autocomplete="off">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <input type="hidden" name="_method" value="PUT">

                    <h6 class="heading-small text-muted mb-4">Pameran information</h6>

                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="title">Judul<span class="small text-danger">*</span></label>
                                    <input type="text" id="title" class="form-control" name="title" placeholder="title" value="{{ old('title', $pameran->title) }}">
                                </div>
                            </div>
                            @if(Auth::user()->role != 'admin')
                            <div class="col-lg-6">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="user">Author</label>
                                    <input type="text" id="user" class="form-control" placeholder="Last name" value="{{ old('user', $pameran->user->name) }}" @if(Auth::user()->role != 'admin') disabled @endif>
                                </div>
                            </div>
                            @else
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label class="form-control-label" for="user">Author</label>
                                <!-- <input type="text" id="user" class="form-control" name="user" placeholder="Last name" value="{{ old('user', $pameran->user->name) }}" @if(Auth::user()->role != 'admin') disabled @endif> -->
                                <select name="user" id="user" class="form-control" >
                                    @foreach($users as $u)
                                    <option value="{{$u->id}}">{{$u->name}} {{$u->last_name}}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>

                            @endif
                
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="abstract">Abstrak<span class="small text-danger">*</span></label>
                                    <textarea type="text" id="abstract" class="form-control" name="abstract" placeholder="Penelitian ini bertujuan" rows="20" required>{{old('abstract', $pameran->abstract)}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="description">Deskripsi<span class="small text-danger"></span></label>
                                    <textarea type="text" id="description" class="form-control" name="description" placeholder="Penelitian ini bertujuan">{{old('description', $pameran->description)}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="jurusan">Jurusan</label>
                                    <select type="text" id="jurusan" class="form-control" name="jurusan" placeholder="Last name">
                                        @foreach($jurusans as $j)
                                        <option value="{{$j->id}}" @if($j->id == $pameran->jurusan_id) class="bg-danger" selected @endif>{{$j->code}} - {{$j->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="form-group focused">
                                    <label class="form-control-label">Tambah File</label>
                                    <button id="addFiles" class="form-control bg-primary" onclick="event.preventDefault();">
                                        <i class="fas fa-plus  text-gray-300"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div id="tempatFile">

                            @forelse($pameran->files as $f)
                            <div class="row" id="submittedKe{{$loop->iteration}}">
                                <div class="col-lg-2">
                                    <div class="form-group focused">
                                        @if($loop->iteration == 1)
                                        <label class="form-control-label">File Submmited *</label>
                                        @endif
                                        <input type="text" id="file{{$loop->iteration}}" class="form-control" name="submittedFile[]" placeholder="" value="{{$f->id}}" hidden>
                                        <a href="{{Storage::url('public/'.$f->path)}}" class="form-control bg-primary text-white text-center">
                                            <i class="fas fa-eye  text-gray-300"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        @if($loop->iteration == 1)
                                        <label class="form-control-label">Caption (name) *</label>
                                        @endif
                                        <input type="text" class="form-control" name="captionSubmitted[]" placeholder="" value="{{old('captionSubmitted[$loop->iteration]',$f->caption)}}" required>
                                        
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        @if($loop->iteration == 1)
                                        <label class="form-control-label" for="type0">Type</label>
                                        @endif

                                        <select name="submittedType[]" id="{{$loop->iteration}}" class="form-control" readonly>
                                            <option value="image" @if($f->type == 'image') selected @endif>
                                                Image Flyer (png,jpg,jpeg)
                                            </option>
                                            <option value="flyer" @if($f->type == 'flyer') selected @endif>
                                                Laporan Tugas Akhir (pdf)
                                            </option>
                                            <option value="video" @if($f->type == 'video') selected @endif>
                                                Video Demo (mp4)
                                            </option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group focused">
                                        @if($loop->iteration == 1)
                                        <label class="form-control-label" for="type0">Action</label>
                                        @endif
                                        <div class="row">
                                            <button onclick="event.preventDefault(); deleteFile('#submittedKe{{$loop->iteration}}')" class="form-control col-lg-6 bg-danger">
                                                <i class="fas fa-trash  text-gray-300"></i>
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            @empty
                            <div class="row" id="fileKe0">
                                <div class="col-lg-2">
                                    <div class="form-group focused">
                                        <label class="form-control-label">File</label>
                                        <input type="file" id="file" class="form-control" name="file[]" placeholder="">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label">Caption (name) *</label>
                                        <input type="text" class="form-control" name="caption[]" placeholder="" value="">
                                        
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="type-empty">Type</label>
                                        <select name="type[]" id="type-empty" class="form-control" >
                                            <option value="image">
                                                Image Flyer (png,jpg,jpeg)
                                            </option>
                                            <option value="flyer">
                                                Laporan Tugas Akhir (pdf)
                                            </option>
                                            <option value="video">
                                                Video Demo (mp4)
                                            </option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="type0">Action</label>
                                        <div class="row">
                                            <button onclick="event.preventDefault(); deleteFile('#fileKe0')" class="form-control col-lg-6 bg-danger">
                                                <i class="fas fa-trash  text-gray-300"></i>
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            @endforelse
                        </div>

                    </div>

                    <!-- Button -->
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col text-center">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>

        </div>

    </div>

</div>

@endsection

@section('scripts')

<script>
    const deleteFile = (key) =>{
        $(key).remove()
    }
    $(document).ready(function() {
        CKEDITOR.replace('abstract',{
            versionCheck: false
        });
        
        $('#addFiles').click(function() {
            var count = $("input[name^='file[]']").length
            console.log(count);
            $('#tempatFile').append(`
            <div class="row" id="fileKe${count}">
                                <div class="col-lg-2">
                                    <div class="form-group focused">
                                    ${count == 0 ? '<label class="form-control-label">File</label>' : ''}
                                        
                                        <input type="file" id="file" class="form-control" name="file[]" placeholder="">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        ${count == 0 ? '<label class="form-control-label">Caption (name) *</label>': ''}
                                        <input type="text" class="form-control" name="caption[]" placeholder="" value="">
                                        
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        ${count == 0 ? '<label class="form-control-label" for="type-empty">Type</label>' : ''}
                                        <select name="type[]" id="type-empty" class="form-control">
                                            <option value="image">
                                                Image Flyer (png,jpg,jpeg)
                                            </option>
                                            <option value="flyer">
                                                Laporan Tugas Akhir (pdf)
                                            </option>
                                            <option value="video">
                                                Video Demo (mp4)
                                            </option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group focused">
                                        ${count == 0 ? '<label class="form-control-label" for="type0">Action</label>' : ''}
                                        <div class="row">
                                            <button onclick="event.preventDefault(); deleteFile('#fileKe${count}')" class="form-control col-lg-6 bg-danger">
                                                <i class="fas fa-trash  text-gray-300"></i>
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
            
            `)
        })
    })
</script>

@endsection