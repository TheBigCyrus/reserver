@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl shadow-lg overflow-hidden mb-8">
        <div class="p-8 text-white">
            <h1 class="text-4xl font-bold mb-2">تنظیمات سیستم</h1>
            <p class="text-blue-100">مدیریت تنظیمات سیستم رزرو</p>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 mb-6 rounded-r-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-emerald-500"></i>
                </div>
                <div class="mr-3">
                    <p class="text-sm text-emerald-700">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- اطلاعات ورود -->
    <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-shadow duration-300 mb-8">
        <div class="flex items-center mb-6">
            <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300">
                <i class="fas fa-user-shield text-white text-xl"></i>
            </div>
            <div class="mr-4">
                <h2 class="text-lg font-semibold text-gray-900">اطلاعات ورود</h2>
                <p class="text-sm text-gray-500">تنظیمات نام کاربری و رمز عبور</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- نام کاربری -->
            <div class="group">
                <label for="username" class="block text-sm font-medium text-gray-700 mb-2">نام کاربری</label>
                <div class="flex items-center">
                    <div class="flex-1">
                        <div class="relative">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <i class="fas fa-user text-gray-400 group-hover:text-blue-500 transition-colors duration-300"></i>
                            </div>
                            <input type="text" id="username" name="username" 
                                class="block w-full pr-10 border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:shadow-lg transition-all duration-300 hover:border-blue-300" 
                                value="{{ $config->username ?? config('app.register.UnameMarkazi') }}" readonly>
                        </div>
                    </div>
                    <button type="button" onclick="enableEdit('username')" class="mr-2 p-2 text-gray-500 hover:text-blue-500 transition-colors duration-300">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" onclick="saveField('username')" class="hidden p-2 text-green-500 hover:text-green-600 transition-colors duration-300">
                        <i class="fas fa-check"></i>
                    </button>
                </div>
            </div>

            <!-- رمز عبور -->
            <div class="group">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">رمز عبور</label>
                <div class="flex items-center">
                    <div class="flex-1">
                        <div class="relative">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <i class="fas fa-lock text-gray-400 group-hover:text-blue-500 transition-colors duration-300"></i>
                            </div>
                            <input type="password" id="password" name="password" 
                                class="block w-full pr-10 border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:shadow-lg transition-all duration-300 hover:border-blue-300" 
                                value="{{ $config->password ?? config('app.register.password') }}" readonly>
                        </div>
                    </div>
                    <button type="button" onclick="enableEdit('password')" class="mr-2 p-2 text-gray-500 hover:text-blue-500 transition-colors duration-300">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" onclick="saveField('password')" class="hidden p-2 text-green-500 hover:text-green-600 transition-colors duration-300">
                        <i class="fas fa-check"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- تنظیمات صندلی‌ها -->
    <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-shadow duration-300 mb-8">
        <div class="flex items-center mb-6">
            <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300">
                <i class="fas fa-chair text-white text-xl"></i>
            </div>
            <div class="mr-4">
                <h2 class="text-lg font-semibold text-gray-900">تنظیمات صندلی‌ها</h2>
                <p class="text-sm text-gray-500">تنظیم شناسه صندلی‌های مورد نظر</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- صندلی اول -->
            <div class="group">
                <label for="seat_one" class="block text-sm font-medium text-gray-700 mb-2">صندلی اول</label>
                <div class="flex items-center">
                    <div class="flex-1">
                        <div class="relative">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <div class="w-6 h-6 rounded-full bg-gradient-to-br from-purple-100 to-purple-200 flex items-center justify-center shadow-sm group-hover:shadow-md transition-all duration-300">
                                    <span class="text-purple-600 font-bold">1</span>
                                </div>
                            </div>
                            <input type="text" id="seat_one" name="seat_one" 
                                class="block w-full pr-10 border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-purple-500 focus:border-purple-500 focus:shadow-lg transition-all duration-300 hover:border-purple-300" 
                                value="{{ $config->seat_one ?? config('app.btn.first') }}" readonly>
                        </div>
                    </div>
                    <button type="button" onclick="enableEdit('seat_one')" class="mr-2 p-2 text-gray-500 hover:text-purple-500 transition-colors duration-300">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" onclick="saveField('seat_one')" class="hidden p-2 text-green-500 hover:text-green-600 transition-colors duration-300">
                        <i class="fas fa-check"></i>
                    </button>
                </div>
            </div>

            <!-- صندلی دوم -->
            <div class="group">
                <label for="seat_two" class="block text-sm font-medium text-gray-700 mb-2">صندلی دوم</label>
                <div class="flex items-center">
                    <div class="flex-1">
                        <div class="relative">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <div class="w-6 h-6 rounded-full bg-gradient-to-br from-purple-100 to-purple-200 flex items-center justify-center shadow-sm group-hover:shadow-md transition-all duration-300">
                                    <span class="text-purple-600 font-bold">2</span>
                                </div>
                            </div>
                            <input type="text" id="seat_two" name="seat_two" 
                                class="block w-full pr-10 border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-purple-500 focus:border-purple-500 focus:shadow-lg transition-all duration-300 hover:border-purple-300" 
                                value="{{ $config->seat_two ?? config('app.btn.second') }}" readonly>
                        </div>
                    </div>
                    <button type="button" onclick="enableEdit('seat_two')" class="mr-2 p-2 text-gray-500 hover:text-purple-500 transition-colors duration-300">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" onclick="saveField('seat_two')" class="hidden p-2 text-green-500 hover:text-green-600 transition-colors duration-300">
                        <i class="fas fa-check"></i>
                    </button>
                </div>
            </div>

            <!-- صندلی سوم -->
            <div class="group">
                <label for="seat_three" class="block text-sm font-medium text-gray-700 mb-2">صندلی سوم</label>
                <div class="flex items-center">
                    <div class="flex-1">
                        <div class="relative">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <div class="w-6 h-6 rounded-full bg-gradient-to-br from-purple-100 to-purple-200 flex items-center justify-center shadow-sm group-hover:shadow-md transition-all duration-300">
                                    <span class="text-purple-600 font-bold">3</span>
                                </div>
                            </div>
                            <input type="text" id="seat_three" name="seat_three" 
                                class="block w-full pr-10 border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-purple-500 focus:border-purple-500 focus:shadow-lg transition-all duration-300 hover:border-purple-300" 
                                value="{{ $config->seat_three ?? config('app.btn.third') }}" readonly>
                        </div>
                    </div>
                    <button type="button" onclick="enableEdit('seat_three')" class="mr-2 p-2 text-gray-500 hover:text-purple-500 transition-colors duration-300">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" onclick="saveField('seat_three')" class="hidden p-2 text-green-500 hover:text-green-600 transition-colors duration-300">
                        <i class="fas fa-check"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- وضعیت سیستم -->
    <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-shadow duration-300">
        <div class="flex items-center mb-6">
            <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300">
                <i class="fas fa-power-off text-white text-xl"></i>
            </div>
            <div class="mr-4">
                <h2 class="text-lg font-semibold text-gray-900">وضعیت سیستم</h2>
                <p class="text-sm text-gray-500">فعال یا غیرفعال کردن سیستم</p>
            </div>
        </div>

        <div class="flex items-center">
            <button type="button" id="statusButton" 
                class="w-24 h-10 rounded-lg transition-all duration-300 font-medium text-white {{ ($config->status ?? true) ? 'bg-emerald-500 hover:bg-emerald-600' : 'bg-gray-400 hover:bg-gray-500' }}"
                onclick="toggleStatus()">
                فعال
            </button>
        </div>
    </div>
</div>

<script>
function enableEdit(fieldId) {
    const input = document.getElementById(fieldId);
    const editBtn = input.parentElement.parentElement.parentElement.querySelector('button[onclick^="enableEdit"]');
    const saveBtn = input.parentElement.parentElement.parentElement.querySelector('button[onclick^="saveField"]');
    
    input.removeAttribute('readonly');
    input.focus();
    editBtn.classList.add('hidden');
    saveBtn.classList.remove('hidden');
}

function showMessage(message, type = 'success') {
    const messageDiv = document.createElement('div');
    messageDiv.className = `bg-${type === 'success' ? 'emerald' : 'red'}-50 border-l-4 border-${type === 'success' ? 'emerald' : 'red'}-500 p-4 mb-6 rounded-r-lg`;
    messageDiv.innerHTML = `
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-${type === 'success' ? 'check' : 'exclamation'}-circle text-${type === 'success' ? 'emerald' : 'red'}-500"></i>
            </div>
            <div class="mr-3">
                <p class="text-sm text-${type === 'success' ? 'emerald' : 'red'}-700">${message}</p>
            </div>
        </div>
    `;
    document.querySelector('.max-w-3xl').insertBefore(messageDiv, document.querySelector('.bg-white'));
    
    setTimeout(() => {
        messageDiv.remove();
    }, 3000);
}

function saveField(fieldId) {
    const input = document.getElementById(fieldId);
    const editBtn = input.parentElement.parentElement.parentElement.querySelector('button[onclick^="enableEdit"]');
    const saveBtn = input.parentElement.parentElement.parentElement.querySelector('button[onclick^="saveField"]');
    
    // نمایش لودینگ
    saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
    
    // ارسال درخواست به سرور
    fetch('{{ route("config.update") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            [fieldId]: input.value
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            input.setAttribute('readonly', 'readonly');
            editBtn.classList.remove('hidden');
            saveBtn.classList.add('hidden');
            showMessage('تغییرات با موفقیت ذخیره شد');
        } else {
            showMessage(data.message || 'خطا در ذخیره تغییرات', 'error');
            saveBtn.innerHTML = '<i class="fas fa-check"></i>';
        }
    })
    .catch(error => {
        showMessage('خطا در ارتباط با سرور', 'error');
        saveBtn.innerHTML = '<i class="fas fa-check"></i>';
    });
}

function toggleStatus() {
    const button = document.getElementById('statusButton');
    const isActive = button.classList.contains('bg-emerald-500');
    
    // تغییر فوری ظاهر
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
    
    // ارسال درخواست به سرور
    fetch('{{ route("config.update") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            status: !isActive ? 1 : 0
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // به‌روزرسانی ظاهر
            if (isActive) {
                button.classList.remove('bg-emerald-500', 'hover:bg-emerald-600');
                button.classList.add('bg-red-400', 'hover:bg-red-500');
            } else {
                button.classList.remove('bg-red-400', 'hover:bg-red-500');
                button.classList.add('bg-emerald-500', 'hover:bg-emerald-600');
            }
            showMessage('وضعیت سیستم با موفقیت به‌روزرسانی شد');
        }
    })
    .catch(error => {
        // برگرداندن به حالت قبلی
        button.textContent = isActive ? 'غیرفعال' : 'فعال';
        showMessage('خطا در ارتباط با سرور', 'error');
    });
}
</script>
@endsection