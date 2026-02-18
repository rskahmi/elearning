@extends('layout.user')

@section('headers')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
@endsection

@section('title', 'Course')
@section('content')

<div class="animate__animated animate__fadeInUp">
    <div class="card table">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-12 col-sm-12 col-md-5">
                    <h4>List Course</h4>
                </div>
                <div class="col-12 col-sm-12 col-md-7 d-flex justify-content-start justify-content-md-end gap-2">
                    <x-search />
                    @if (isDosen())
                    <button class="btn btn-primary text-capitalize" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <x-svg.icon.addfile />
                        Tambah Course
                    </button>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body">
            <x-table>
                @slot('slotHeading')
                <tr>
                    <th scope="col">NAMA</th>
                    <th scope="col">DESKRIPSI</th>
                    @if(auth()->user()->role == 'mahasiswa')
                    <th scope="col">STATUS</th>
                    @endif
                    <th class="text-center">AKSI</th>
                </tr>

                @endslot

                @slot('slotBody')
                @foreach ($course as $item )
                <tr>
                    <td class="w-30">
                        {{$item->nama}}
                    </td>
                    <td class="w-30">
                        {{$item->deskripsi}}
                    </td>
                    @if(auth()->user()->role == 'mahasiswa')
                    <td class="w-30">
                        <span class="badge text-capitalize bg-success">TERDAFTAR</span>
                    </td>
                     @endif
                    <td>
                        <div class="aksi">
                            @if (isDosen())
                            <a href="#" data-action="{{ route('course.update', $item->id) }}"
                                data-nama="{{ $item->nama }}" data-deskripsi="{{ $item->deskripsi }}"
                                onclick="modalEditCourse(this)" data-bs-toggle="modal" data-bs-target="#editModal">

                                <x-svg.icon.edit />
                            </a>
                            <x-layout.delete action="{{route('course.destroy', ['id' => $item->id])}}" />
                            @endif

                            <a href="{{route('course.detail', ['id' => $item->id])}}">
                                <x-svg.icon.info />
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
                @endslot
            </x-table>
        </div>
    </div>

    <x-pagination />
</div>

<!-- Modal -->
<x-modals.admin action="{{route('course.store')}}">
    @slot('slotHeader')
    <h5 class="modal-title" id="exampleModalLabel">Tambah Course</h5>
    @endslot
    @slot('slotBody')
    <div class="mb-3">
        <x-forms.input label="Nama MK" name="nama" placeholder="Masukkan Nama Mata Kuliah" :isRequired="true" />
    </div>
    <div class="mb-3">
        <x-forms.input label="Deskripsi MK" name="deskripsi" placeholder="Masukkan Deskripsi MK" />
    </div>
    @endslot
    @slot('slotFooter')
    <button type="submit" class="btn btn-primary btn-tutup-modal">Simpan</button>
    @endslot
</x-modals.admin>

<x-modals.admin action="{{route('course')}}" id="editModal" isUpdate=true>
    @slot('slotHeader')
    <h5 class="modal-title" id="editModalLabel">Edit Pengajuan</h5>
    @endslot

    @slot('slotBody')
    <div class="mb-3">
        <x-forms.input label="Nama MK" name="edtNama" placeholder="Masukkan Nama Mata Kuliah" :isRequired="true" />
    </div>
    <div class="mb-3">
        <x-forms.textarea label="Deskripsi MK" name="edtDeskripsi" placeholder="Masukkan Deskripsi MK" />
    </div>
    @endslot

    @slot('slotFooter')
    <button type="submit" class="btn btn-primary btn-tutup-modal">Simpan</button>
    @endslot
</x-modals.admin>

@endsection
