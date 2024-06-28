<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                            <a href="{{ route('viewtambahkaryawan') }}"><button class="btn btn-warning">Tambah
                                    Karyawan</button></a>
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Divisi</th>
                                        <th>Nilai Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ky as $k)
                                    <tr>
                                        <td>{{ $k->nama }}</td>
                                        <td>{{ $k->divisi->nama_divisi }}</td>
                                        <td>
                                            @php
                                            $nt = 0;
                                            @endphp
                                            @foreach ($k->penilaian as $n)
                                            @php
                                            $nt += $n->nilai;
                                            @endphp
                                            @endforeach
                                            {{ $nt }}
                                        </td>
                                        <td>
                                            <a href="{{ route('viewnilaikaryawan', ['id' => $k->id]) }}"><button class="btn btn-default">Kasih Nilai</button></a>
                                            <a href="{{ route('karyawanedit', ['id' => $k->id]) }}"><button class="btn btn-default">Edit Profil</button></a>
                                            <form action="{{ route('hapuskaryawan', ['id' => $k->id]) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <input type="submit" class="btn btn-error" value="Hapus Karyawan">
                                            </form>



                                        </td>

                                    </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Divisi</th>
                                        <th>Nilai</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
