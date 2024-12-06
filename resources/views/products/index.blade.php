<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Store Application Coalition Test</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
   
</head>

<body>
   
 
           <div class="row mt-5">
                <div class="col-12 text-center">
                    <h4 class="text-center" style="font-weight: 800">Add New Product</h4>
        
                    <div class="row mt-5" style="display: flex; justify-content: center">      
                        <form id="create-form" style="font-weight: 600" method="POST" data-status="create">
                            @csrf
                            @if (session()->has('error'))
                                <div class="alert alert-danger text-center" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <div>
                                <label for="email">Product Name</label>
                                <div class="input-group custom mb-1">
                                    <input id="product_name" type="text" name="product_name" class="form-control form-control-lg" value="" placeholder="Enter Product Name" required>
                                </div>
                                @error('product_name')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            <div class="mt-3">
                                <label for="qty">Quantity In Stock</label>
                                <div class="input-group custom mb-1">
                                    <input id="qty" type="number" name="qty" class="form-control form-control-lg" value="" placeholder="Enter Qty in Stock" required>
                                </div>
                                @error('qty')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            <div class="mt-3">
                                <label for="price">Price per Item</label>
                                <div class="input-group custom mb-1">
                                    <input id="price" type="number" name="price" class="form-control form-control-lg" value="" placeholder="Enter Price per item" required>
                                </div>
                                @error('price')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            
                            
                            <div class="row mt-5">
                                <div class="col-sm-12">
                                    <div class="input-group mb-0">
                                        <button id="submit" type="submit" class="btn btn-primary btn-lg btn-block">Add New Product</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
           </div>

           <div class="row mt-5 px-5 pb-5">
                <div class="col-12">
                    <h4 class="mb-3" style="font-weight: 800">Products</h4>
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Qty In Stock</th>
                            <th scope="col">Price Per Item</th>
                            <th scope="col">Datetime Submitted</th>
                            <th scope="col">Total value number</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody id="products">
                            @include('products.list', compact('products') )
                        </tbody>
                      </table>
                </div>
           </div>
   
           <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>        
           <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>


        <script>

            let create = document.getElementById('create-form');
            let productId;

            create.addEventListener('submit', (e) => {

                e.preventDefault();

                let status = document.getElementById('create-form').getAttribute('data-status');

                if( status === 'create') createProduct();
                if( status === 'update') updateProduct();                
                
            })

            const edit = (name, qty, price, id) => {

                productId = id;

                document.getElementById('product_name').value = name;
                document.getElementById('qty').value = qty;
                document.getElementById('price').value = price;
                document.getElementById('submit').innerText = 'Update Product';
                document.getElementById('create-form').setAttribute('data-status', 'update');
            }


            const createProduct = () => {

                let submit = document.getElementById('submit');

                submit.disabled = true;
                submit.innerText = 'Adding Product...'
                
             

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    method: 'POST',
                    url: '/product/create',
                    data: $("#create-form").serialize(),
                    success: function(data) {

                        $.ajax({
                            method: 'GET',
                            url: '/products',
                            success: function(data) {
                                document.getElementById('products').innerHTML = data;
                            }
                        });

                        submit.disabled = false;
                        submit.innerText = 'Add New Product';
                    }
                });
            }

            const updateProduct = () => {

                let submit = document.getElementById('submit');

                submit.disabled = true;
                submit.innerText = 'Updating Product...'
                
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    method: 'POST',
                    url: '/product/update/'+productId,
                    data: $("#create-form").serialize(),
                    success: function(data) {

                        $.ajax({
                            method: 'GET',
                            url: '/products',
                            success: function(data) {
                                document.getElementById('products').innerHTML = data;
                            }
                        });

                        document.getElementById('product_name').value = '';
                        document.getElementById('qty').value = '';
                        document.getElementById('price').value = '';

                        submit.disabled = false;
                        submit.innerText = 'Add New Product';
                        document.getElementById('create-form').setAttribute('data-status', 'create');
                    }   
                });

            }
        
        </script>

</body>

</html>