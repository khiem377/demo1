<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HrContact;

class HrContactController extends Controller
{
    public function index()
    {
        $hrs = HrContact::all();
        return view('admin.hr_contacts.index', compact('hrs'));
    }

    public function create()
    {
        return view('admin.hr_contacts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:hr_contacts,email',
            'name' => 'nullable|string|max:255',
        ]);

        HrContact::create($request->only('name', 'email'));

        return redirect()->route('admin.hr_contacts.index')->with('success', 'Thêm email HR thành công.');
    }

    public function edit(HrContact $hrContact)
    {
        return view('admin.hr_contacts.edit', compact('hrContact'));
    }

    public function update(Request $request, HrContact $hrContact)
    {
        $request->validate([
            'email' => 'required|email|unique:hr_contacts,email,' . $hrContact->id,
            'name' => 'nullable|string|max:255',
        ]);

        $hrContact->update($request->only('name', 'email'));

        return redirect()->route('admin.hr_contacts.index')->with('success', 'Cập nhật email HR thành công.');
    }

    public function destroy(HrContact $hrContact)
    {
        $hrContact->delete();
        return redirect()->route('admin.hr_contacts.index')->with('success', 'Xóa email HR thành công.');
    }
}
