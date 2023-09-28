<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceProduct;
use App\Models\Product;
use DB;
use Exception;
use Illuminate\Http\Request;

class invoiceController extends Controller
{
    function invoicePage()
    {
        return view('pages.dashboard.invoice-page');
    }

    function createInvoice(Request $request)
    {
        $userId = $request->header('userId');

        $total = $request->input('total');
        $discount = $request->input('discount');
        $vat = $request->input('vat');
        $payable = $request->input('payable');
        $customerId = $request->input('customer_id');

        DB::beginTransaction();
        try {
            $invoice = Invoice::create([
                "total" => $total,
                "discount" => $discount,
                "vat" => $vat,
                "payable" => $payable,
                "customer_id" => $customerId,
                "user_id" => $userId
            ]);

            $invoiceId = $invoice->id;
            $products = $request->input('products');

            foreach ($products as $product) {
                InvoiceProduct::create([
                    "invoice_id" => $invoiceId,
                    "product_id" => $product['id'],
                    "sale_price" => $product['sale_price'],
                    "quantity" => $product['quantity'],
                    "user_id" => $userId
                ]);
            }
            DB::commit();

            return response()->json([
                "status" => "success",
                "message" => "Invoice created successfully"
            ], 201);

        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                "status" => "failed",
                "message" => "Invoice creation failed"
            ], 400);
        }
    }

    function invoiceList(Request $request)
    {
        $userId = $request->header('userId');
        try {
            $list = Invoice::where('user_id', $userId)->with('customer')->get();
            return response()->json([
                "status" => "success",
                "message" => "",
                "data" => $list
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                "status" => "failed",
                "message" => "something went wrong",
                "data" => []
            ], 400);
        }
    }

    function invoiceDetails(Request $request)
    {
        $userId = $request->header('userId');

        try {
            $invoice = Invoice::where('user_id', $userId)->where('id', $request->input('invoice_id'))
                ->first();
            $customer = Customer::where('user_id', $userId, )->where('id', $request->input('customer_id'))
                ->first();

            $products = InvoiceProduct::where('invoice_id', $request->input('invoice_id'))
                ->where('user_id', $userId)
                ->get();

            return response()->json([
                "status" => "success",
                "message" => "",
                "data" => [
                    "customer" => $customer,
                    "invoice" => $invoice,
                    "products" => $products
                ]
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                "status" => "failed",
                "message" => "failed to load ",
                "data" => []
            ], );
        }
    }

    function deleteInvoice(Request $request)
    {
        $userId = $request->header('userId');
        DB::beginTransaction();
        try {
            InvoiceProduct::where('invoice_id', $request->input('invoice_id'))
                ->where('user_id', $userId)->delete();

            Invoice::where('id', $request->input('invoice_id'))
                ->where('user_id', $userId)->delete();

            DB::commit();
            return response()->json([
                "status" => "successful",
                "message" => "Invoice deleted successfully"
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "status" => "failed",
                "message" => "Invoice deleting failed"
            ], 400);
        }
    }

}