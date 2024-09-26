<?php
/**
 * @see App\Http\Controllers\HomeController::home()
 * @var App\Modules\Product\ProductStd[] $products
 */
?>

@extends('layout.app')

@section('content')
    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-8 bg-success">
                    <h3 class="mt-3">Exist product IDs</h3>

                    @if($products->isEmpty())
                        <div class="alert alert-warning">Products not found</div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>Image</td>
                                    <td>Name</td>
                                    <td>Description</td>
                                    <td>Price</td>
                                    <td>Add to cart</td>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td class="align-middle">{{ $product->getId() }}</td>
                                            <td class="align-middle">{{ !empty($image = $product->getImage()) ? $image : '' }}</td>
                                            <td class="align-middle">{{ $product->getName() }}</td>
                                            <td class="align-middle">{{ $product->getDescription() }}</td>
                                            <td class="align-middle">{{ $product->getPrice() }}</td>
                                            <td class="align-middle">
                                                <button class="btn btn-success w-100"
                                                    data-add-to-cart
                                                    data-product-id="{{ $product->getId() }}"
                                                    data-qnt="1"
                                                >Add to cart</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
                <div class="col-md-4 bg-danger">
                    <h3 class="mt-3">Products with problem</h3>

                   <div class="table-responsive">
                       <table class="table table-bordered table-striped table-hover">
                            <thead>
                                 <tr>
                                      <td>Problem</td>
                                      <td class="text-center">Add to cart</td>
                                 </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="align-middle">Empty product ID</td>
                                    <td>
                                        <button class="btn btn-success w-100"
                                                data-add-to-cart
                                        >Add to cart</button>
                                    </td>
                                </tr>
                                <tr>
                                      <td class="align-middle">ID not in DB</td>
                                      <td>
                                          <button class="btn btn-success w-100"
                                              data-add-to-cart
                                              data-product-id="99"
                                              data-qnt="1"
                                          >Add to cart</button>
                                      </td>
                                 </tr>
                                 <tr>
                                     <td class="align-middle">To much count for 1 product, count: 999 </td>
                                     <td>
                                         <button class="btn btn-success w-100"
                                                 data-add-to-cart
                                                 data-product-id="1"
                                                 data-qnt="999"
                                         >Add to cart</button>
                                     </td>
                                 </tr>
                                 <tr>
                                     <td class="align-middle">Empty count</td>
                                     <td>
                                         <button class="btn btn-success w-100"
                                                 data-add-to-cart
                                                 data-product-id="1"
                                         >Add to cart</button>
                                     </td>
                                 </tr>
                            </tbody>
                       </table>
                   </div>

                </div>
                <div class="col-12 pt-4">
                    <div class="text-dark mb-1">Response</div>
                    <div class="bg-light">
                        <pre id="response" class="p-2">Press the cart button to result ...</pre>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
