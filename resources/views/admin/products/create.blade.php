@extends('layouts.admin')
@section('title', 'Add Product')

@section('content')
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left"></i>
    </a>
    <h4 class="fw-bold mb-0">Add New Product</h4>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-4">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Product Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}" required placeholder="e.g. Wireless Earbuds Pro">
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea name="description" class="form-control" rows="4"
                                  placeholder="Describe the product...">{{ old('description') }}</textarea>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Category <span class="text-danger">*</span></label>
                            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                <option value="">Select category</option>
                                @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Price (৳) <span class="text-danger">*</span></label>
                            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                                   value="{{ old('price') }}" required min="0" step="0.01" placeholder="0.00">
                            @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Sale Price (৳)</label>
                            <input type="number" name="sale_price" class="form-control"
                                   value="{{ old('sale_price') }}" min="0" step="0.01" placeholder="Optional">
                        </div>
                    </div>

                    <div class="mt-3">
                        <label class="form-label fw-semibold">Stock Quantity <span class="text-danger">*</span></label>
                        <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror"
                               value="{{ old('stock', 0) }}" required min="0" style="max-width:160px">
                        @error('stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Product Image</label>
                    <div class="border rounded p-3 text-center mb-3" id="imagePreviewBox" style="min-height:160px;background:#f8f9fa">
                        <img id="imagePreview" src="" alt="" class="img-fluid d-none" style="max-height:140px;object-fit:contain">
                        <div id="imagePlaceholder" class="text-muted py-4">
                            <div style="font-size:3rem">🖼️</div>
                            <div class="small mt-1">No image selected</div>
                        </div>
                    </div>
                    <input type="file" name="image" class="form-control" accept="image/*" id="imageInput">

                    <div class="form-check mt-4">
                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" checked>
                        <label class="form-check-label fw-semibold" for="is_active">Active (visible in shop)</label>
                    </div>
                </div>
            </div>

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-danger px-4">
                    <i class="fas fa-save me-1"></i>Save Product
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
            document.getElementById('imagePlaceholder').classList.add('d-none');
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endpush
@endsection
