@extends('layouts.app')

@section('title', 'Buat Laporan')
@section('page-title', 'Buat Laporan Kerusakan')
@section('page-subtitle', 'Laporkan kerusakan fasilitas kampus')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-card rounded-2xl border border-border shadow-sm">
        <div class="p-6 border-b border-border">
            <h2 class="font-display font-bold text-lg">Form Laporan Kerusakan</h2>
            <p class="text-sm text-muted-foreground mt-1">Isi form berikut untuk melaporkan kerusakan fasilitas</p>
        </div>

        <form action="{{ route('anggota.laporan.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf

            <div class="space-y-2">
                <label for="fasilitas_id" class="text-sm font-medium text-foreground">Fasilitas</label>
                <select 
                    id="fasilitas_id" 
                    name="fasilitas_id"
                    class="w-full px-4 py-3 rounded-xl border border-border bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all @error('fasilitas_id') border-destructive @enderror"
                    required
                >
                    <option value="">Pilih fasilitas</option>
                    @foreach($fasilitas as $item)
                        <option value="{{ $item->id }}" {{ old('fasilitas_id', request('fasilitas_id')) == $item->id ? 'selected' : '' }}>
                            {{ $item->nama }} - {{ $item->lokasi }}
                        </option>
                    @endforeach
                </select>
                @error('fasilitas_id')
                    <p class="text-sm text-destructive">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="deskripsi" class="text-sm font-medium text-foreground">Deskripsi Kerusakan</label>
                <textarea 
                    id="deskripsi" 
                    name="deskripsi"
                    rows="5"
                    class="w-full px-4 py-3 rounded-xl border border-border bg-background text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all resize-none @error('deskripsi') border-destructive @enderror"
                    placeholder="Jelaskan kerusakan secara detail..."
                    required
                >{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <p class="text-sm text-destructive">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="foto" class="text-sm font-medium text-foreground">Foto Kerusakan</label>
                <div class="border-2 border-dashed border-border rounded-xl p-8 text-center hover:border-primary/50 transition-colors">
                    <input 
                        type="file" 
                        id="foto" 
                        name="foto"
                        accept="image/*"
                        class="hidden"
                        onchange="previewImage(this)"
                    >
                    <label for="foto" class="cursor-pointer">
                        <div id="preview-container" class="hidden mb-4">
                            <img id="preview-image" class="max-h-48 mx-auto rounded-lg" alt="Preview">
                        </div>
                        <div id="upload-placeholder">
                            <svg class="h-12 w-12 mx-auto mb-4 text-muted-foreground" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="text-muted-foreground">Klik untuk upload foto</p>
                            <p class="text-xs text-muted-foreground mt-1">PNG, JPG max 2MB</p>
                        </div>
                    </label>
                </div>
                @error('foto')
                    <p class="text-sm text-destructive">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-4">
                <a href="{{ route('anggota.laporan') }}" class="flex-1 text-center py-3 px-4 rounded-xl border border-border text-foreground font-medium hover:bg-muted transition-colors">
                    Batal
                </a>
                <button type="submit" class="flex-1 gradient-primary text-white font-semibold py-3 px-4 rounded-xl hover:opacity-90 transition-all shadow-lg shadow-primary/25">
                    Kirim Laporan
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function previewImage(input) {
    const preview = document.getElementById('preview-image');
    const previewContainer = document.getElementById('preview-container');
    const placeholder = document.getElementById('upload-placeholder');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.classList.remove('hidden');
            placeholder.classList.add('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
@endsection