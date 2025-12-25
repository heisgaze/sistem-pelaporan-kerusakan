@props(['status'])

@php
$statusConfig = [
    'pending' => ['class' => 'bg-amber-100 text-amber-700 border-amber-200', 'label' => 'Pending'],
    'diproses' => ['class' => 'bg-blue-100 text-blue-700 border-blue-200', 'label' => 'Diproses'],
    'selesai' => ['class' => 'bg-green-100 text-green-700 border-green-200', 'label' => 'Selesai'],
    'ditolak' => ['class' => 'bg-red-100 text-red-700 border-red-200', 'label' => 'Ditolak'],
    'draft' => ['class' => 'bg-gray-100 text-gray-700 border-gray-200', 'label' => 'Draft'],
    'aktif' => ['class' => 'bg-green-100 text-green-700 border-green-200', 'label' => 'Aktif'],
    'arsip' => ['class' => 'bg-gray-100 text-gray-700 border-gray-200', 'label' => 'Arsip'],
];
$config = $statusConfig[$status] ?? $statusConfig['pending'];
@endphp

<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium border {{ $config['class'] }}">
    {{ $config['label'] }}
</span>