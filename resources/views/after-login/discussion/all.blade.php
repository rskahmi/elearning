@extends('layout.user')

@section('title', 'Discussion')

@section('content')
<div class="container py-5">
    <h4 class="mb-4">Pilih Course untuk Diskusi</h4>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach($courses as $course)
            <div class="col">
                <div class="card shadow-sm border-light">
                    <div class="card-body">
                        <h5 class="card-title">{{ $course->nama }}</h5>
                        <p class="card-text">Mulai diskusi tentang materi di course ini.</p>
                        <br>
                        <a href="{{ route('discussion.index', ['courseId' => $course->id]) }}" class="btn btn-primary stretched-link">Lanjutkan Diskusi</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
