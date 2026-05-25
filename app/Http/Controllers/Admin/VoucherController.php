<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    // LIST
    public function index()
    {
        $vouchers = Voucher::latest()->paginate(10);

        return view('admin.vouchers.index', compact('vouchers'));
    }

    // CREATE PAGE
    public function create()
    {
        return view('admin.vouchers.create');
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:vouchers',
            'discount' => 'required|integer',
            'expired_at' => 'required|date',
        ]);

        Voucher::create([
            'code' => $request->code,
            'discount' => $request->discount,
            'max_discount' => $request->max_discount,
            'expired_at' => $request->expired_at,
            'is_active' => $request->is_active ?? true,
        ]);

        return redirect()
            ->route('admin.vouchers.index')
            ->with('success', 'Voucher created');
    }

    // EDIT PAGE
    public function edit(Voucher $voucher)
    {
        return view('admin.vouchers.edit', compact('voucher'));
    }

    // UPDATE
    public function update(Request $request, Voucher $voucher)
    {
        $request->validate([
            'code' => 'required|unique:vouchers,code,' . $voucher->id,
            'discount' => 'required|integer',
            'expired_at' => 'required|date',
        ]);

        $voucher->update([
            'code' => $request->code,
            'discount' => $request->discount,
            'max_discount' => $request->max_discount,
            'expired_at' => $request->expired_at,
            'is_active' => $request->is_active ?? true,
        ]);

        return redirect()
            ->route('admin.vouchers.index')
            ->with('success', 'Voucher updated');
    }

    // DELETE
    public function destroy(Voucher $voucher)
    {
        $voucher->delete();

        return redirect()
            ->route('admin.vouchers.index')
            ->with('success', 'Voucher deleted');
    }
}