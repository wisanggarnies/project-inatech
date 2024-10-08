@extends('layouts.template')
@section('title', 'Kelola Pengguna')
@section('content')
    <div class="card">
        <div class="card-header">Data Pengguna</div>
        <div class="card-body">
            <table class="table mb-3" id="table_kelolaPengguna">
                <thead>
                    <tr class="text-center">
                        <th>NAMA</th>
                        <th>NO HP</th>
                        <th>POSISI</th>
                        <th>ROLE</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@push('css')
@endpush
@push('js')
    <script>
        $(document).ready(function() {
            var dataKelolaPengguna = $('#table_kelolaPengguna').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ url('kelolaPengguna/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "error": function(xhr, error, thrown) {
                        console.error('Error fetching data: ', thrown);
                    }
                },
                columns: [{
                        data: "nama",
                        className: "", // Jika tidak ada class, hapus baris ini
                        orderable: true,
                        searchable: true,
                        // render: function(data, type, row) {
                        //     // Menggunakan route yang lebih umum dengan hanya ID
                        //     return '<a href="{{ url('/') }}/' + id_user + '">' + data + '</a>';
                        // }
                    },
                    {
                        data: "no_hp",
                        className: "", // Jika tidak ada class, hapus baris ini
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "posisi",
                        className: "", // Jika tidak ada class, hapus baris ini
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "role.nama",
                        className: "", // Jika tidak ada class, hapus baris ini
                        orderable: false,
                        searchable: true
                    },
                ],
                pagingType: "simple_numbers", // Tambahkan ini untuk menampilkan angka pagination
                dom: 'frtip', // Mengatur layout DataTables
                language: {
                    search: "" // Menghilangkan teks "Search"
                }
            });
            // Tambahkan tombol "Tambah" setelah kolom pencarian
            $("#table_kelolaPengguna_filter").append(
                '<select class="form-control" name="id_role" id="id_role" required style="margin-left: 30px; width: 150px;">' +
                '<option value="">- SEMUA -</option>' +
                '@foreach ($role as $item)' +
                '<option value="{{ $item->id_role }}">{{ $item->nama }}</option>' +
                '@endforeach' +
                '</select>' +
                '<button id="btn-tambah" class="btn btn-primary ml-2">Tambah</button>');
            // Tambahkan event listener untuk tombol
            $("#btn-tambah").on('click', function() {
                window.location.href =
                    "{{ url('kelolaPengguna/create') }}"; // Arahkan ke halaman tambah pengguna
            });
            // Menambahkan placeholder pada kolom search
            $('input[type="search"]').attr('placeholder', 'Cari data Pengguna...');
        });
    </script>
@endpush
