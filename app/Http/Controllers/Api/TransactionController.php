<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function startTransaction(Request $request)
    {
        $transactionData = [
            'amount' => $request->amount,
            'destination_account' => $request->destination_account,
            'status' => 'pending' 
        ];

        // Lưu thông tin giao dịch vào session
        session(['transaction' => $transactionData]);

        return response()->json([
            'message' => 'Giao dịch đã được khởi tạo.',
            'transaction' => session('transaction')
        ]);
    }

    // Cập nhật trạng thái giao dịch
    public function updateTransactionStep(Request $request)
    {
        $transaction = session('transaction');

        if ($transaction) {
            $transaction['status'] = 'in_progress'; // Cập nhật trạng thái đang thực hiện

            // Cập nhật lại session
            session(['transaction' => $transaction]);

            return response()->json([
                'message' => 'Bước tiếp theo đã được lưu.',
                'transaction' => session('transaction')
            ]);
        } else {
            return response()->json([
                'message' => 'Không tìm thấy phiên giao dịch.'
            ], 404);
        }
    }

    // Hoàn tất giao dịch
    public function completeTransaction()
    {
        $transaction = session('transaction');

        if ($transaction) {
            $transaction['status'] = 'completed';

            Transaction::create($transaction);

            // Xóa session sau khi hoàn tất
            session()->forget('transaction');

            return response()->json([
                'message' => 'Giao dịch đã hoàn tất thành công.'
            ]);
        } else {
            return response()->json([
                'message' => 'Không tìm thấy phiên giao dịch.'
            ], 404);
        }
    }

    // Hủy giao dịch
    public function cancelTransaction()
    {
        $transaction = session('transaction');

        if ($transaction) {
            // Xóa session để hủy giao dịch
            session()->forget('transaction');

            return response()->json([
                'message' => 'Giao dịch đã bị hủy.'
            ]);
        } else {
            return response()->json([
                'message' => 'Không tìm thấy phiên giao dịch.'
            ], 404);
        }
    }

    // Kiểm tra trạng thái phiên giao dịch
    public function checkTransactionStatus()
    {
        $transaction = session('transaction');

        if ($transaction) {
            return response()->json([
                'message' => 'Phiên giao dịch hiện tại:',
                'transaction' => $transaction
            ]);
        } else {
            return response()->json([
                'message' => 'Không có phiên giao dịch nào đang diễn ra.'
            ]);
        }
    }
}
