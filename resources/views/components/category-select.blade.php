<div class="mb-6">
    <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Categoria</label>
    <div class="relative">
        <i class="fas fa-tag absolute left-2 top-3 text-gray-400"></i>
        <select
            id="category"
            name="category"
            class="mt-1 block w-full pl-10 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200 appearance-none"
            required
        >
            <option value="">Selecione uma categoria</option>
            @foreach($categories as $category)
                <option value="{{ $category }}" {{ $selected == $category ? 'selected' : '' }}>
                    {{ $category }}
                </option>
            @endforeach
        </select>
        <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center px-2 text-gray-700">
            <i class="fas fa-chevron-down"></i>
        </div>
    </div>
</div>