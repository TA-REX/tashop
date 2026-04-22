@extends('layouts.admin')
@section('title', 'Edit Product')

@section('content')
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left"></i>
    </a>
    <h4 class="fw-bold mb-0">Edit Product</h4>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="row g-4">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Product Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $product->name) }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea name="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Category <span class="text-danger">*</span></label>
                            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Price (৳) <span class="text-danger">*</span></label>
                            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                                   value="{{ old('price', $product->price) }}" required min="0" step="0.01">
                            @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Sale Price (৳)</label>
                            <input type="number" name="sale_price" class="form-control"
                                   value="{{ old('sale_price', $product->sale_price) }}" min="0" step="0.01" placeholder="Optional">
                        </div>
                    </div>

                    <div class="mt-3">
                        <label class="form-label fw-semibold">Stock Quantity <span class="text-danger">*</span></label>
                        <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror"
                               value="{{ old('stock', $product->stock) }}" required min="0" style="max-width:160px">
                        @error('stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Product Image</label>
                    <div class="border rounded p-3 text-center mb-3" style="min-height:160px;background:#f8f9fa">
                        @if($product->image)
                            <img id="imagePreview" src="{{ asset('storage/'.$product->image) }}" class="img-fluid" style="max-height:140px;object-fit:contain">
                        @else
                            <img id="imagePreview" src="" alt="" class="img-fluid d-none" style="max-height:140px;object-fit:contain">
                            <div id="imagePlaceholder" class="text-muted py-4">
                                <div style="font-size:3rem">🖼️</div>
                                <div class="small">No image</div>
                            </div>
                        @endif
                    </div>
                    <input type="file" name="image" class="form-control" accept="image/*" id="imageInput">
                    <div class="form-text text-muted">Leave empty to keep current image.</div>

                    <div class="form-check mt-4">
                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
                               {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold" for="is_active">Active (visible in shop)</label>
                    </div>
                </div>
            </div>

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-danger px-4">
                    <i class="fas fa-save me-1"></i>Update Product
                </button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary px-4">Cancel</a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.getElementById('imageInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(ev) {
            document.getElementById('imagePreview').src = ev.target.result;
            document.getElementById('imagePreview').classList.remove('d-none');
            const ph = document.getElementById('imagePlaceholder');
            if (ph) ph.classList.add('d-none');
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endpush
@endsection
