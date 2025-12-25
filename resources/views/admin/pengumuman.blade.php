@extends('layouts.app')

@section('title', 'Manajemen Pengumuman')
@section('page-title', 'Manajemen Pengumuman')
@section('page-subtitle', 'Kelola pengumuman perbaikan fasilitas')

@section('content')
<div class="space-y-6">
    <!-- Header Actions -->
    <div class="flex justify-between items-center">
        <form action="{{ route('admin.pengumuman') }}" method="GET" class="flex gap-4">
            <select 
                name="status" 
                class="px-4 py-2 rounded-xl border border-border bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                onchange="this.form.submit()"
            >
                <option value="">Semua Status</option>
                <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="aktif" {{ request('status') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="arsip" {{ request('status') === 'arsip' ? 'selected' : '' }}>Arsip</option>
            </select>
        </form>
        <button 
            type="button" 
            onclick="openModal('create')"
            class="gradient-primary text-white font-semibold py-2 px-4 rounded-xl hover:opacity-90 transition-all flex items-center gap-2"
        >
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Buat Pengumuman
        </button>
    </div>

    <!-- Announcements Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($pengumuman as $item)
            <div class="bg-card rounded-2xl border border-border shadow-sm overflow-hidden">
                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <x-status-badge :status="$item->status" />
                        <div class="flex items-center gap-1">
                            <button 
                                type="button" 
                                onclick="openModal('edit', {{ json_encode($item) }})"
                                class="p-1.5 text-muted-foreground hover:text-foreground transition-colors"
                            >
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </button>
                            <form action="{{ route('admin.pengumuman.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengumuman ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 text-destructive hover:text-destructive/80 transition-colors">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    <h3 class="font-display font-bold text-foreground mb-2">{{ $item->judul }}</h3>
                    <p class="text-sm text-muted-foreground line-clamp-3 mb-4">{{ $item->konten }}</p>
                    <p class="text-xs text-muted-foreground">{{ $item->created_at->format('d M Y, H:i') }}</p>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12 text-muted-foreground">
                <svg class="h-16 w-16 mx-auto mb-4 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                </svg>
                <p>Belum ada pengumuman</p>
            </div>
        @endforelse
    </div>

    @if($pengumuman->hasPages())
        <div class="flex justify-center">
            {{ $pengumuman->links() }}
        </div>
    @endif
</div>

<!-- Modal -->
<div id="modal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/50" onclick="closeModal()"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="bg-card rounded-2xl border border-border shadow-xl w-full max-w-lg relative">
            <div class="p-6 border-b border-border flex items-center justify-between">
                <h2 id="modal-title" class="font-display font-bold text-lg">Buat Pengumuman</h2>
                <button type="button" onclick="closeModal()" class="text-muted-foreground hover:text-foreground">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <form id="modal-form" method="POST" class="p-6 space-y-4">
                @csrf
                <input type="hidden" name="_method" id="form-method" value="POST">
                
                <div class="space-y-2">
                    <label for="judul" class="text-sm font-medium text-foreground">Judul</label>
                    <input 
                        type="text" 
                        id="judul" 
                        name="judul"
                        class="w-full px-4 py-3 rounded-xl border border-border bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                        required
                    >
                </div>

                <div class="space-y-2">
                    <label for="konten" class="text-sm font-medium text-foreground">Konten</label>
                    <textarea 
                        id="konten" 
                        name="konten"
                        rows="5"
                        class="w-full px-4 py-3 rounded-xl border border-border bg-background text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all resize-none"
                        required
                    ></textarea>
                </div>

                <div class="space-y-2">
                    <label for="status" class="text-sm font-medium text-foreground">Status</label>
                    <select 
                        id="status" 
                        name="status"
                        class="w-full px-4 py-3 rounded-xl border border-border bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                        required
                    >
                        <option value="draft">Draft</option>
                        <option value="aktif">Aktif</option>
                        <option value="arsip">Arsip</option>
                    </select>
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
        title.textContent = 'Buat Pengumuman';
        form.action = '{{ route("admin.pengumuman.store") }}';
        method.value = 'POST';
        form.reset();
    } else {
        title.textContent = 'Edit Pengumuman';
        form.action = `/admin/pengumuman/${data.id}`;
        method.value = 'PUT';
        document.getElementById('judul').value = data.judul;
        document.getElementById('konten').value = data.konten;
        document.getElementById('status').value = data.status;
    }
    
    modal.classList.remove('hidden');
}

function closeModal() {
    document.getElementById('modal').classList.add('hidden');
}
</script>
@endpush
@endsection