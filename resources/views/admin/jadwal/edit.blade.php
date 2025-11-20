{{-- resources/views/admin/jadwal/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Update Jadwal Dokter (Gambar)
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('jadwal-dokter.update', $jadwal) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        {{-- GAMBAR 1 (Jadwal Pagi/Umum) --}}
                        <div class="mb-4 p-3 border rounded">
                            <h5 class="fw-bold text-success">Jadwal Dokter Bagian 1</h5>
                            @if($jadwal->gambar_pagi)
                                <p class="text-muted small">Gambar lama:</p>
                                <img src="{{ asset('storage/' . $jadwal->gambar_pagi) }}" class="img-fluid mb-2 rounded shadow-sm" style="max-height: 250px;" alt="Jadwal Dokter Bagian 1">
                            @endif
                            <label for="gambar_pagi" class="form-label">Upload/Ganti Gambar 1</label>
                            <input class="form-control" type="file" id="gambar_pagi" name="gambar_pagi" accept="image/*">
                            @error('gambar_pagi') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        {{-- GAMBAR 2 (Jadwal Sore/Spesialis Tambahan) --}}
                        <div class="mb-4 p-3 border rounded">
                            <h5 class="fw-bold text-success">Jadwal Dokter Bagian 2</h5>
                            @if($jadwal->gambar_sore)
                                <p class="text-muted small">Gambar lama:</p>
                                <img src="{{ asset('storage/' . $jadwal->gambar_sore) }}" class="img-fluid mb-2 rounded shadow-sm" style="max-height: 250px;" alt="Jadwal Dokter Bagian 2">
                            @endif
                            <label for="gambar_sore" class="form-label">Upload/Ganti Gambar 2</label>
                            <input class="form-control" type="file" id="gambar_sore" name="gambar_sore" accept="image/*">
                            @error('gambar_sore') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <button type="submit" class="btn btn-success mt-3 text-white">Update Jadwal</button>
                    </form>
                    
                    {{-- Form Reset/Delete --}}
                    <form action="{{ route('jadwal-dokter.destroy', $jadwal) }}" method="POST" style="display:inline;" class="ms-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-warning mt-3" onclick="return confirm('Yakin ingin mereset/menghapus semua gambar jadwal?')">Reset Gambar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>