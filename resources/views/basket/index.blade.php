<?php
/**
 * @see App\Http\Controllers\BasketController::basket()
 * @var App\Modules\Basket\BasketStd[] $basket
 * @var string $sessionId
 */
?>

@extends('layout.app')

@section('content')
    <main>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped text-center">
                            <thead>
                                <tr>
                                    <td class="w60px">ID</td>
                                    <td class="text-left">Name</td>
                                    <td>Price per product</td>
                                    <td class="w60px">Min</td>
                                    <td class="w60px">Count</td>
                                    <td class="w60px">Plus</td>
                                    <td class="w60px">Delete</td>
                                    <td>Total price</td>
                                </tr>
                            </thead>
                            <tbody>
                            @if($basket->isEmpty())
                                <tr>
                                    <td colspan="8">Basket is empty</td>
                                </tr>
                            @else
                                @foreach($basket as $item)
                                    <tr>
                                        <td class="align-middle">{{ $item->getProductId() }}</td>
                                        <td class="align-middle text-start">{{ $item->getProductName() }}</td>
                                        <td class="align-middle">{{ $item->getProductPrice() }}</td>
                                        <td class="align-middle"><button class="btn btn-warning" data-session="{{ $sessionId }}" data-remove="{{ $item->getProductId() }}">-</button></td>
                                        <td class="align-middle" data-session="{{ $sessionId }}" data-product-id-count="{{ $item->getProductId() }}">{{ $item->getQuantity() }}</td>
                                        <td class="align-middle"><button class="btn btn-success" data-session="{{ $sessionId }}" data-add="{{ $item->getProductId() }}">+</button></td>
                                        <td class="align-middle">
                                            <button class="btn btn-danger" data-session="{{ $sessionId }}" data-delete="{{ $item->getId() }}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </td>
                                        <td class="align-middle">{{ $item->getProductPrice() * $item->getQuantity() }}</td>
                                    </tr>
                                @endforeach
                            @endif
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
