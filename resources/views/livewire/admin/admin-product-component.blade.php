<div>
    <style>
        nav svg{
            height: 20px;
        }
        nav .hidden{
            display: block;
        }
    </style>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Home</a>
                    <span></span> All Products
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container"> 
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                <div class="col-md-6">
                                    All Products
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('admin.product.add') }}" class="btn btn-success float-end">Add New Product</a>
                                </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @if (Session::has('message'))
                                <div class="alert alert-success" role="alert">{{Session::get('message') }}</div>
                                    
                                @endif
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Stock</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i =($products->currentPage()-1)*$products->perPage();
                                    @endphp
                                    @foreach ($products as $product )
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td><img  src="{{ asset('assets/imgs/products')}}/{{$product->image}}" alt="{{ $product->name }}" width="60"> </td>
                                            <td>{{$product->name}}</td>
                                            <td>{{$product->stock_status  }}</td>
                                            <td>{{$product->regular_price}}</td>
                                            <td>{{$product->category->name}}</td>
                                            <td>{{$product->created_at}}</td>

                                           
                                            <td>
                                                <a href="{{ route('admin.product.edit',['product_id'=>$product->id]) }}" class="text-info" style="margin-left: 30px" title="Edit">
                                                    <i class="fi-rs-pencil"></i>
                                                </a>
                                                <a href="#" class=" text-danger" onclick="deleteConfirmation({{$product->id }})"  style="margin-left: 30px" title="Delete"> <i class="fi-rs-trash"></i></a>
                                                <a href="#" class=" text-success" onclick="productDetails({{$product->id }})"    style="margin-left: 30px" title="Details"> <i class="fi-rs-eye"></i></a>
                                            </td>
                                                
                                            </td>
                                            

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $products->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
<div class="modal" id="deleteConfirmation">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body pb-30 pt-30">
                <div class="row">
                    <div class="col-md-12 text-center">
                <h4 class="pb-3 ">Do you want to delete this record ? </h4>
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-toggle="#deleteConfirmation">Cancel</button>       
            <button type="button" class="btn btn-danger" onclick="deleteProduct()">Delete</button>    
        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Bootstrap -->
<div class="modal" id="productDetails">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body pb-30 pt-30">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h4 class="pb-3">Product Details</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <ul>
                            <li><strong>Name:</strong> <span id="productName"></span></li>
                            <li><strong>Slug:</strong> <span id="productSlug"></span></li>
                            <li><strong>Short Description:</strong> <span id="productShortDescription"></span></li>
                            <li><strong>Description:</strong> <span id="productDescription"></span></li>
                            <li><strong>Regular Price:</strong> <span id="productRegularPrice"></span></li>
                            <li><strong>Sale Price:</strong> <span id="productSalePrice"></span></li>
                            <li><strong>SKU:</strong> <span id="productSKU"></span></li>
                            <li><strong>Stock Status:</strong> <span id="productStockStatus"></span></li>
                            <li><strong>Featured:</strong> <span id="productFeatured"></span></li>
                            <li><strong>Quantity:</strong> <span id="productQuantity"></span></li>
                            <li><strong>Category ID:</strong> <span id="productCategoryID"></span></li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <img id="productImage" src="" alt="Product Image">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
   function deleteConfirmation(id){
       @this.set('product_id',id);
       $('#deleteConfirmation').modal('show');
   } 

   function deleteProduct(){
    @this.call('deleteProduct');
       $('#deleteConfirmation').modal('hide');
   }
</script>
<script>
    function productDetails(id){
        @this.set('product_id',id);
        $('#productDetails').modal('show');
    } 
 
   
 </script>
@endpush
