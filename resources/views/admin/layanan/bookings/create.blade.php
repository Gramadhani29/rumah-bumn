@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center mb-6">
            <a href="{{ route('admin.rooms.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h2 class="text-2xl font-bold text-gray-800">Tambah Ruangan Baru</h2>
        </div>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.rooms.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Ruangan *</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" 
                           required>
                </div>

                <div>
                    <label for="capacity" class="block text-sm font-medium text-gray-700 mb-2">Kapasitas *</label>
                    <input type="number" name="capacity" id="capacity" value="{{ old('capacity') }}" min="1"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" 
                           required>
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                    <select name="status" id="status" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" 
                            required>
                        <option value="available" {{ old('status') === 'available' ? 'selected' : '' }}>Tersedia</option>
                        <option value="maintenance" {{ old('status') === 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                        <option value="unavailable" {{ old('status') === 'unavailable' ? 'selected' : '' }}>Tidak Tersedia</option>
                    </select>
                </div>

                <div>
                    <label for="available_from" class="block text-sm font-medium text-gray-700 mb-2">Waktu Mulai *</label>
                    <input type="time" name="available_from" id="available_from" value="{{ old('available_from', '08:00') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" 
                           required>
                </div>

                <div>
                    <label for="available_until" class="block text-sm font-medium text-gray-700 mb-2">Waktu Selesai *</label>
                    <input type="time" name="available_until" id="available_until" value="{{ old('available_until', '17:00') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" 
                           required>
                </div>

                <div class="md:col-span-2">
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Lokasi</label>
                    <input type="text" name="location" id="location" value="{{ old('location') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" 
                           placeholder="Contoh: Lantai 1, Gedung A">
                </div>

                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="description" id="description" rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" 
                              placeholder="Deskripsi ruangan...">{{ old('description') }}</textarea>
                </div>

                <div class="md:col-span-2">
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Gambar Ruangan</label>
                    <input type="file" name="image" id="image" accept="image/*"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <p class="text-sm text-gray-500 mt-1">Format: JPG, PNG, GIF. Maksimal 2MB</p>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Fasilitas</label>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        @php
                        $facilities = [
                            'wifi' => 'WiFi',
                            'proyektor' => 'Proyektor',
                            'ac' => 'AC',
                            'whiteboard' => 'Whiteboard',
                            'sound_system' => 'Sound System',
                            'tv' => 'TV/Monitor',
                            'flipchart' => 'Flipchart',
                            'microphone' => 'Microphone',
                            'printer' => 'Printer'
                        ];
                        $oldFacilities = old('facilities', []);
                        @endphp
                        
                        @foreach($facilities as $key => $label)
                        <div class="flex items-center">
                            <input type="checkbox" name="facilities[]" value="{{ $key }}" id="facility_{{ $key }}"
                                   class="mr-2" {{ in_array($key, $oldFacilities) ? 'checked' : '' }}>
                            <label for="facility_{{ $key }}" class="text-sm text-gray-700">{{ $label }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-4 mt-8">
                <a href="{{ route('admin.rooms.index') }}" 
                   class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition duration-200">
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-200">
                    Simpan Ruangan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection