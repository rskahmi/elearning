@extends('layout.user')

@section('title', 'Detail Assignment')
@section('headers')
<script src="https://cdn.ckeditor.com/ckeditor5/41.2.0/classic/ckeditor.js"></script>
@endsection
@section('content')

<div class="row detail-pengajuan">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 animate__animated animate__fadeInLeft">
        <div class="card standart">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 mt-2 mt-sm-2 mt-md-3">
                        <x-text.PopUpMenu title="Nama Assignment" subtitle="{{ $assignment->title }}" />
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 mt-2 mt-sm-2 mt-md-3">
                        <x-text.PopUpMenu title="Deskripsi Assignment" subtitle="{{ $assignment->description }}" />
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 mt-2 mt-sm-2 mt-md-3">
                        <x-text.PopUpMenu title="Deadline Assignment" subtitle="{{ $assignment->deadline }}" />
                    </div>

                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 mt-2 mt-sm-2 mt-md-3">
                        <div class="col-12 popup-text">
                            <h6>Upload Submission</h6>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="d-flex gap-3">
                                <button class="btn btn-warning text-capitalize" data-bs-toggle="modal"
                                    data-bs-target="#modalVerifikasiPengajuan">
                                    Upload
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>

@if (isDosen())
<div class="col-8">
    <div class="card table">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-12 col-sm-12 col-md-5">
                    <h4>List Mahasiswa yang Sudah Upload</h4>
                </div>
                <div class="col-12 col-sm-12 col-md-7 d-flex justify-content-start justify-content-md-end gap-2">
                </div>
            </div>
        </div>
        <div class="card-body">
            <div id="media-online-container">
                <x-table id="media-online-dataTable">
                    @slot('slotHeading')
                    <tr>
                        <th scope="col" class="w-25">NAMA</th>
                        <th scope="col" class="w-35">SKOR</th>
                        <th scope="col" class="w-35">FILE</th>
                    </tr>
                    @endslot

                    @slot('slotBody')
                    @foreach ($submissions as $item)
                    <tr>
                        <td>{{ $item->user->nama }}</td>
                        <td>
                            @if(is_null($item->score))
                            <span class="text-danger">
                                Belum diberi score,
                                <a href="">
                                    tekan ini untuk berikan score
                                </a>
                                {{-- {{ route('submission.score', $item->id) }} --}}
                            </span>
                            @else
                            {{ $item->score }}
                            @endif
                        </td>

                        <td>
                            <a target="_blank" href="{{ asset('storage/submission/' . $item->file_path) }}">
                                <img src="{{ asset('assets/img/icon/Download.svg') }}" alt="Icon Download">
                                Download Disini
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    @endslot
                </x-table>

                <x-pagination id="media-online-dataTable" />
            </div>
        </div>
    </div>
</div>
@endif



<x-modals.admin id="modalVerifikasiPengajuan" action="" class="modal-xl">
    @slot('slotHeader')
    <h5 class="modal-title" id="exampleModalLabel">
        Upload Submission
    </h5>
    @endslot
    @slot('slotBody')
    <div class="mb-3">
        <x-forms.file name="file_path" label="File Submission" placeholder="Upload File" />
    </div>
    @endslot

    @slot('slotFooter')
    <button type="submit" class="btn btn-primary btn-tutup-modal">Upload</button>
    @endslot
    </x-modal.admin>


    @endsection
    @section('scripts')
    <script>
        gambarHandler('file_path')

    </script>
    @endsection
