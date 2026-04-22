@extends('layouts.admin')
@section('title', 'Products')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">All Products</h4>
    <a href="{{ route('admin.products.create') }}" class="btn btn-danger">
        <i class="fas fa-plus me-1"></i>Add Product
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">#</th>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td class="ps-3 text-muted small">{{ $product->id }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="bg-light rounded d-flex align-items-center justify-content-center flex-shrink-0" style="width:42px;height:42px">
                                    @if($product->image)
                                        <img src="{{ asset('storage/'.$product->image) }}" style="max-width:38px;max-height:38px;object-fit:contain">
                                    @else
                                        <span>📦</span>
                                    @endif
                                </div>
                                <div>
                                    <div class="fw-semibold small">{{ $product->name }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="small">{{ $product->category->name }}</td>
                        <td>
                            <div class="fw-semibold text-danger">৳{{ number_format($product->sale_price ?? $product->price, 0) }}</div>
                            @if($product->sale_price)
                                <div class="text-muted" style="font-size:0.75rem;text-decoration:line-through">৳{{ number_format($product->price, 0) }}</div>
                            @endif
                        </td>
                        <td>
                            @if($product->stock === 0)
                                <span class="badge bg-danger">Out of Stock</span>
                            @elseif($product->stock <= 5)
                                <span class="badge bg-warning text-dark">Low: {{ $product->stock }}</span>
                            @else
                                <span class="badge bg-success">{{ $product->stock }}</span>
                            @endif
                        </td>
                        <td>
                            @if($product->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('product.show', $product->slug) }}" class="btn btn-sm btn-outline-secondary" title="View" target="_blank">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                      onsubmit="return confirm('Delete {{ $product->name }}? This cannot be undone.')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">No products found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($products->hasPages())
    <div class="card-footer bg-white border-0 pt-0 pb-3 px-3">
        {{ $products->links() }}
    </div>
    @endif
</div>
@endsection
