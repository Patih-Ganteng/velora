<!DOCTYPE html>
<html>
<head>
    <title>Buat Undangan - Velora</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-8">
    <div class="max-w-xl mx-auto bg-white p-8 rounded shadow">
        <a href="{{ route('dashboard') }}" class="text-blue-500 mb-4 inline-block">&larr; Kembali ke Dashboard</a>
        <h1 class="text-2xl font-bold mb-6">Buat Undangan Baru</h1>

        <form action="{{ route('invitations.store') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Judul Acara</label>
                <input type="text" name="title" class="w-full border p-2 rounded" placeholder="Misal: Pernikahan Budi & Ani" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Tanggal Acara</label>
                <input type="datetime-local" name="event_date" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Kategori</label>
                <select name="category" id="category" class="w-full border p-2 rounded" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $key => $cat)
                        <option value="{{ $key }}">{{ $cat['label'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 mb-2">Sub-Tema</label>
                <select name="sub_theme" id="sub_theme" class="w-full border p-2 rounded" required disabled>
                    <option value="">-- Pilih Kategori Dulu --</option>
                </select>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                Simpan Undangan
            </button>
        </form>
    </div>

    <!-- Script buat nampilin sub-tema otomatis pas kategori dipilih -->
    <script>
        const categoriesData = @json($categories);
        const categorySelect = document.getElementById('category');
        const themeSelect = document.getElementById('sub_theme');

        categorySelect.addEventListener('change', function() {
            const selectedCat = this.value;
            themeSelect.innerHTML = '<option value="">-- Pilih Sub-Tema --</option>';
            
            if (selectedCat && categoriesData[selectedCat]) {
                themeSelect.disabled = false;
                const themes = categoriesData[selectedCat].themes;
                
                themes.forEach(function(theme) {
                    const option = document.createElement('option');
                    option.value = theme;
                    // Ubah format teks (kpop -> Kpop)
                    option.textContent = theme.replace('-', ' ').replace(/\b\w/g, l => l.toUpperCase());
                    themeSelect.appendChild(option);
                });
            } else {
                themeSelect.disabled = true;
            }
        });
    </script>
</body>
</html>