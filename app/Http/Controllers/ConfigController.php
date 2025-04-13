<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConfigController extends Controller
{
    public function index()
    {
        $config = Config::first();
        return view('config.index', compact('config'));
    }

    public function update(Request $request)
    {
        try {
            DB::beginTransaction();

            $config = Config::first();
            if (!$config) {
                $config = new Config();
            }

            // اگر درخواست AJAX است
            if ($request->wantsJson()) {
                $field = array_key_first($request->all());
                $value = $request->input($field);
                
                $config->{$field} = $value;
                $config->save();

                DB::commit();
                return response()->json(['success' => true]);
            }

            // اگر درخواست معمولی است
            $validated = $request->validate([
                'username' => 'required|string',
                'password' => 'required|string',
                'seat_one' => 'required|string',
                'seat_two' => 'required|string',
                'seat_three' => 'required|string',
                'status' => 'boolean'
            ]);

            $config->fill($validated);
            $config->save();

            DB::commit();
            return redirect()->route('config.index')->with('success', 'تنظیمات با موفقیت به‌روزرسانی شد.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
            }
            
            return redirect()->route('config.index')->with('error', 'خطا در به‌روزرسانی تنظیمات: ' . $e->getMessage());
        }
    }
} 