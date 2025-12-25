@extends('layouts.app')

@section('title', 'Manajemen Fasilitas')
@section('page-title', 'Manajemen Fasilitas')
@section('page-subtitle', 'Kelola data fasilitas kampus')

@section('content')
<div class="space-y-6">
    <!-- Header Actions -->
    <div class="flex justify-between items-center">
        <form action="{{ route('admin.fasilitas') }}" method="GET" class="flex gap-4">
            <input 
                type="text" 
                name="search" 
                value="{{ request('search') }}"
                class="px-4 py-2 rounded-xl border border-border bg-background text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                placeholder="Cari fasilitas..."
            >
        </form>
        <button 
            type="button" 
            onclick="openModal('create')"
            class="gradient-primary text-white font-semibold py-2 px-4 rounded-xl hover:opacity-90 transition-all flex items-center gap-2"
        >
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Fasilitas
        </button>
    </div>

    <!-- Facilities Table -->
    <div class="bg-card rounded-2xl border border-border shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-muted/50 border-b border-border">
                    <tr>
                        <th class="text-left px-6 py-4 font-medium text-foreground">Gambar</th>
                        <th class="text-left px-6 py-4 font-medium text-foreground">Nama</th>
                        <th class="text-left px-6 py-4 font-medium text-foreground">Lokasi</th>
                        <th class="text-left px-6 py-4 font-medium text-foreground">Jenis</th>
                        <th class="text-right px-6 py-4 font-medium text-foreground">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @forelse($fasilitas as $item)
                        <tr class="hover:bg-muted/30 transition-colors">
                            <td class="px-6 py-4">
                                <div class="h-12 w-16 rounded-lg bg-muted overflow-hidden">
                                    @if($item->gambar)
                                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-muted-foreground">
                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-medium text-foreground">{{ $item->nama }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-muted-foreground">{{ $item->lokasi }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-lg bg-primary/10 text-primary text-xs font-medium">
                                    {{ $item->jenis }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button 
                                        type="button" 
                                        onclick="openModal('edit', {{ json_encode($item) }})"
                                        class="p-2 text-muted-foreground hover:text-foreground transition-colors"
                                    >
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </button>
                                    <form action="{{ route('admin.fasilitas.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus fasilitas ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-destructive hover:text-destructive/80 transition-colors">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-muted-foreground">
                                Belum ada fasilitas
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($fasilitas->hasPages())
        <div class="flex justify-center">
            {{ $fasilitas->links() }}
        </div>
    @endif
</div>

<!-- Modal -->
<div id="modal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/50" onclick="closeModal()"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="bg-card rounded-2xl border border-border shadow-xl w-full max-w-lg relative">
            <div class="p-6 border-b border-border flex items-center justify-between">
                <h2 id="modal-title" class="font-display font-bold text-lg">Tambah Fasilitas</h2>
                <button type="button" onclick="closeModal()" class="text-muted-foreground hover:text-foreground">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <form id="modal-form" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                @csrf
                <input type="hidden" name="_method" id="form-method" value="POST">
                
                <div class="space-y-2">
                    <label for="nama" class="text-sm font-medium text-foreground">Nama Fasilitas</label>
                    <input 
                        type="text" 
                        id="nama" 
                        name="nama"
                        class="w-full px-4 py-3 rounded-xl border border-border bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                        required
                    >
                </div>

                <div class="space-y-2">
                    <label for="lokasi" class="text-sm font-medium text-foreground">Lokasi</label>
                    <input 
                        type="text" 
                        id="lokasi" 
                        name="lokasi"
                        class="w-full px-4 py-3 rounded-xl border border-border bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                        required
                    >
                </div>

                <div class="space-y-2">
                    <label for="jenis" class="text-sm font-medium text-foreground">Jenis</label>
                    <select 
                        id="jenis" 
                        name="jenis"
                        class="w-full px-4 py-3 rounded-xl border border-border bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                        required
                    >
                        <option value="">Pilih jenis</option>
                        <option value="Ruangan">Ruangan</option>
                        <option value="Elektronik">Elektronik</option>
                        <option value="Furniture">Furniture</option>
                        <option value="Sanitasi">Sanitasi</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <label for="gambar" class="text-sm font-medium text-foreground">Gambar</label>
                    <input 
                        type="file" 
                        id="gambar" 
                        name="gambar"
                        accept="image/*"
                        class="w-full px-4 py-3 rounded-xl border border-border bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                    >
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="button" onclick="closeModal()" class="flex-1 py-3 px-4 rounded-xl border border-border text-foreground font-medium hover:bg-muted transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 gradient-primary text-white font-semibold py-3 px-4 rounded-xl hover:opacity-90 transition-all">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function openModal(mode, data = null) {
    const modal = document.getElementById('modal');
    const form = document.getElementById('modal-form');
    const title = document.getElementById('modal-title');
    const method = document.getElementById('form-method');
    
    if (mode === 'create') {
        title.textContent = 'Tambah Fasilitas';
        form.action = '{{ route("admin.fasilitas.store") }}';
        method.value = 'POST';
        form.reset();
    } else {
        title.textContent = 'Edit Fasilitas';
        form.action = `/admin/fasilitas/${data.id}`;
        method.value = 'PUT';
        document.getElementById('nama').value = data.nama;
        document.getElementById('lokasi').value = data.lokasi;
        document.getElementById('jenis').value = data.jenis;
    }
    
    modal.classList.remove('hidden');
}

function closeModal() {
    document.getElementById('modal').classList.add('hidden');
}
</script>
@endpush
@endsection