<?php

namespace App\Http\Controllers;

use App\Modules\Basket\BasketService;
use App\Modules\Product\ProductService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class BasketController extends Controller
{
    public function __construct(
        private ProductService $productService,
        private BasketService $basketService,
    )
    {
    }

    public function basket()
    {
        $basket = $this->basketService->getList(session()->getId());

        return view('basket.index', [
            'basket' => $basket,
            'sessionId' => session()->getId(),
        ]);
    }

    public function xhrAddToBasket($id)
    {
        if (empty($id) || $id < 0) {
            return $this->responseError(
                message: 'Empty productId',
                code: Response::HTTP_BAD_REQUEST
            );
        }

        if (!$this->productService->check($id)) {
            return $this->responseError(
                message: 'Product not found in DB',
                code: Response::HTTP_NOT_FOUND
            );
        }

        $qnt = request()->post('qnt') ?? null;

        if (empty($qnt) || $qnt < 0) {
            return $this->responseError(
                message: 'Empty quantity',
                code: Response::HTTP_BAD_REQUEST
            );
        }

        if ($qnt > 10) {
            return $this->responseError(
                message: 'To many products for one user',
                code: Response::HTTP_NOT_ACCEPTABLE
            );
        }

        $userId = auth()->id() ?? null;
        if (!empty($userId)) {
            // TODO: If user is logged in update session table with user_id
        }

        $sessionId = session()->getId();

        $totalQnt = $this->basketService->add(
            sessionId: $sessionId,
            productId: $id,
            quantity: $qnt
        );

        return $this->responseSuccess([
            'sessionId' => $sessionId,
            'id' => $id,
            'quantity' => $totalQnt,
        ]);
    }

    public function xhrDeleteFromBasket($id)
    {
        $sessionId = request()->post('sessionId') ?? null;

        if (empty($sessionId)) {
            return $this->responseError(
                message: 'Empty sessionId',
                code: Response::HTTP_BAD_REQUEST
            );
        }

        if (empty($id) || $id < 0) {
            return $this->responseError(
                message: 'Empty productId',
                code: Response::HTTP_BAD_REQUEST
            );
        }

        $status = $this->basketService->delete(
            sessionId: $sessionId,
            productId: $id
        );

        if(empty($status)) {
            return $this->responseError(
                message: 'Without accept to action',
                code: Response::HTTP_NOT_ACCEPTABLE
            );
        }

        return $this->responseSuccess([
            'sessionId' => $sessionId,
            'message' => 'Product deleted',
            'productId' => $id,
        ]);
    }

    public function xhrActionCount($id, $action)
    {
        $session = request()->post('session') ?? null;

        if (empty($session)) {
            return $this->responseError(
                message: 'Empty sessionId',
                code: Response::HTTP_BAD_REQUEST
            );
        }

        $count = $this->basketService->countUpdate($id, $session, $action);

        if($count === 0) {
            return $this->responseError(
                message: 'Product deleted',
                code: Response::HTTP_OK
            );
        }

        return $this->responseSuccess([
            'sessionId' => $session,
            'productId' => $id,
            'quantity' => $count,
        ]);
    }


    private function responseError($message, $code = 0, $status = Response::HTTP_OK): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'error' => [
                'code' => $code,
                'message' => $message,
            ],
        ], $status);
    }

    private function responseSuccess($data = []): JsonResponse
    {
        return response()->json([
            'status' => 'ok',
            'data' => $data,
        ]);
    }
}
