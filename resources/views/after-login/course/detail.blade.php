@extends('layout.user')

@section('title', 'Detail Course')
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
                        <x-text.PopUpMenu title="Nama MK" subtitle="{{ $course->nama }}" />
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 mt-2 mt-sm-2 mt-md-3">
                        <x-text.PopUpMenu title="Deskripsi MK" subtitle="{{ $course->deskripsi }}" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>

<div class="col-8">
    <div class="card table">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-12 col-sm-12 col-md-5">
                    <h4>Materi Perkuliahan</h4>
                </div>
                <div class="col-12 col-sm-12 col-md-7 d-flex justify-content-start justify-content-md-end gap-2">
                    @if (isDosen())
                    <button class="btn btn-primary text-capitalize" data-bs-toggle="modal"
                        data-bs-target="#tambahPemberitaan">
                        <x-svg.icon.addfile />
                        Tambah
                    </button>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body">
            <div id="media-online-container">
                <x-table id="media-online-dataTable">
                    @slot('slotHeading')
                    <tr>
                        <th scope="col" class="w-25">NAMA</th>
                        <th scope="col" class="w-35">FILE</th>
                    </tr>
                    @endslot

                    @slot('slotBody')
                    @foreach ($materials as $item)
                    <tr>
                        <td>
                            {{ $item->title }}
                        </td>
                        <td>

                            <a target="_blank" href="{{ asset('storage/materials/' . $item->file_path) }}">
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

<br>

<div class="col-8">
    <div class="card table">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-12 col-sm-12 col-md-5">
                    <h4>Assignment</h4>
                </div>
                <div class="col-12 col-sm-12 col-md-7 d-flex justify-content-start justify-content-md-end gap-2">
                    @if (isDosen())
                    <button class="btn btn-primary text-capitalize" data-bs-toggle="modal"
                        data-bs-target="#tambahAssingment">
                        <x-svg.icon.addfile />
                        Tambah
                    </button>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body">
            <div id="media-online-container">
                <x-table id="media-online-dataTable">
                    @slot('slotHeading')
                    <tr>
                        <th scope="col" class="w-25">NAMA</th>
                        <th scope="col" class="w-35">DESKRIPSI</th>
                        <th scope="col" class="w-35">DEADLINE</th>
                        <th scope="col" class="w-35">AKSI</th>
                    </tr>
                    @endslot

                    @slot('slotBody')
                    @foreach ($assignment as $item2)
                    <tr>
                        <td>
                            {{ $item2->title }}
                        </td>
                        <td>
                            {{ $item2->description }}
                        </td>
                        <td>
                            {{ $item2->deadline }}
                        </td>
                        <td>
                            <a href="{{route('assignment.detail', ['id' => $item2->id])}}">
                                <x-svg.icon.info />
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


<x-modals.admin id="tambahPemberitaan" action="{{ route('materials.store', ['id' => $course->id]) }}">
    @slot('slotHeader')
    <h5 class="modal-title" id="exampleModalLabel">Tambah Materi</h5>
    @endslot

    @slot('slotBody')
    <div class="mb-3">
        <x-forms.input label="Nama Materi" name="title" placeholder="Masukkan Nama Materi" :isRequired="true" />
    </div>

    <div class="mb-3">
        <x-forms.file name="file_path" label="File Materi" placeholder="Upload File" />
    </div>

    @endslot

    @slot('slotFooter')
    <button type="submit" class="btn btn-primary btn-tutup-modal">Simpan</button>
    @endslot
</x-modals.admin>

<x-modals.admin id="tambahAssingment" action="{{ route('assignment.store', ['id' => $course->id]) }}">
    @slot('slotHeader')
    <h5 class="modal-title" id="exampleModalLabel">Tambah Assignment</h5>
    @endslot

    @slot('slotBody')
    <div class="mb-3">
        <x-forms.input label="Nama Assignment" name="title" placeholder="Masukkan Nama Assignment" :isRequired="true" />
    </div>

    <div class="mb-3">
        <x-forms.input label="Deskripsi" name="description" placeholder="Masukkan Deskripsi Assignment" :isRequired="true" />
    </div>

    <div class="mb-3">
        <x-forms.date label="Tanggal Deadline" name="deadline" placeholder="Pilih Tanggal" />
    </div>

    @endslot

    @slot('slotFooter')
    <button type="submit" class="btn btn-primary btn-tutup-modal">Simpan</button>
    @endslot
</x-modals.admin>

@endsection
@section('scripts')
<script>
    gambarHandler('file_path')

</script>
@endsection
