
<form action="{{ route('records.store') }}" method="post">
    @csrf
    <div class="modal-body">
        <div class="row">
            <div class="container-fluid col-12">
                <label for="first_name">اسم المريض</label>
                <div class="row">
                    <div class="form-group mb-3 col-3">
                        <x-form.input type="text" name="first_name" placeholder="المريض" required autofocus />
                    </div>
                    <div class="form-group mb-3 col-3">
                        <x-form.input type="text" name="father_name"  placeholder="الاب" />
                    </div>
                    <div class="form-group mb-3 col-3">
                        <x-form.input type="text" name="grandfather_name"  placeholder="الجد" />
                    </div>
                    <div class="form-group mb-3 col-3">
                        <x-form.input type="text" name="family_name" placeholder="العائلة" required />
                    </div>
                </div>
            </div>
            <div class="form-group mb-3 col-6">
                <label for="type">نوع الحجز</label>
                <select name="type" id="type" class="form-control" required wire:model="type">
                    @if(Auth::user()->type == 'admin')
                        <option value="كشفية">كشفية</option>
                        <option value="مراجعة">مراجعة</option>
                    @endif
                    @if (Auth::user()->type == 'user')
                        <option value="كشفية" selected>كشفية</option>
                    @endif
                    @if (Auth::user()->type == 'doctor')
                        <option value="مراجعة">مراجعة</option>
                    @endif
                </select>
            </div>
            <div class="form-group mb-3 col-6">
                <label for="doctor_id">الطبيب</label>
                <select name="doctor_id" id="doctor_id" class="form-control" required wire:model="doctor_id" wire:change="filterDoctor" >
                    <option value="" disabled>اختر الطبيب</option>

                    @if (Auth::user()->type == 'doctor')
                    <option value="{{ Auth::user()->id }}" selected>{{ Auth::user()->name }}</option>
                    @else
                        @foreach ($doctors as $doctor)
                            <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                        @endforeach
                    @endif

                </select>
            </div>
            <div class="form-group mb-3 col-6">
                <label for="date_rec">تاريخ الحجز</label>
                <input class="form-control" type="date" min="{{ date('Y-m-d') }}" name="date_rec"  wire:model="date_rec" wire:change="filterDay" @readonly(Auth::user()->type == 'user') required >
            </div>
            <div class="form-group mb-3 col-6">
                <x-form.input type="number" min="1" name="num_rec" label="رقم الحجز" wire:model="num_rec" readonly required />
            </div>
            @if(Auth::user()->type != 'doctor')
            <div class="form-group mb-3 col-6">
                <label for="payment_type">نوع الدفع</label>
                <select name="payment_type" id="payment_type" class="form-control" required>
                    <option value="مدفوع" selected>مدفوع</option>
                    <option value="مجاني">مجاني</option>
                    <option value='تحت التحصيل'>تحت التحصيل</option>
                </select>
            </div>
            @endif
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">حجز</button>
    </div>
</form>
