<div class="container-fluid">
    <div class="row justify-content-between col-12">
        <h5 class="card-title col-3">جدول الحجز للأسنان</h5>
        <div class="row col-9">
            <form action="#" method="post" id="filter-form" class="row col-11">
                @if (Auth::user()->type != 'doctor')
                <div class="form-group mb-3 col-3">
                    <label for="payment_type">نوع الدفع</label>
                    <select name="payment_type" id="payment_type" class="form-control" wire:model="payment_type" wire:change="filterPaymentType($event.target.value)">
                        <option value="" selected>الجميع</option>
                        <option value="مدفوع" selected>مدفوع</option>
                        <option value="مجاني">مجاني</option>
                    </select>
                </div>
                <div class="form-group col-3">
                    <label for="doctor">الطبيب</label>
                    <select name="doctor" id="doctor" class="form-control" wire:model="doctor_id" wire:change="filterDoctor($event.target.value)"   >
                        <option value="" selected>الجميع</option>
                        @foreach ($doctors as $doctor)
                            <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                        @endforeach
                    </select>
                </div>
                @endif
                <div class="form-group col-3">
                    <x-form.input type="search" name="patient_name" value="" placeholder="للبحث عن المريض" wire:input="filterName($event.target.value)"/>
                </div>
                <div class="form-group mb-3 col-3">
                    <x-form.input type="date" name="day" id="day" wire:model="day" wire:input="filterDay"/>
                </div>
            </form>
            @if (Auth::user()->type != 'doctor')
            <div class="form-group mb-3 col-2">

                <form action="{{ route('records.print') }}" id="view_pdf" method="post" class="d-inline" target="_blank">
                    @csrf
                    <input type="hidden" name="records" value="{{ $records }}">
                    <input type="hidden" name="day" value="{{ $day }}">
                    <button type="submit" class="btn btn-primary" title="تحميل pdf">
                        <i class="fe fe-printer"></i>PDF
                    </button>
                </form>
            </div>
            @endif
        </div>
    </div>
    <table class="table table-bordered table-hover mb-0">
        <thead>
            <tr>
                <th>رقم الحجز</th>
                <th>اسم المريض</th>
                <th>التاريخ</th>
                <th>نوع الحجز</th>
                <th>الطبيب</th>
                <th>المدخل</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($records as $record)
                <tr>
                    <td>{{ $record->num_rec }}</td>
                    <td>{{ $record->patient_name }}</td>
                    <td>{{ $record->date_rec }}</td>
                    <td>{{ $record->type }}</td>
                    <td>{{ $record->doctor->name }}</td>
                    <td>{{ $record->user->name }}</td>
                    <td>
                        <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#model-{{$record->id}}">
                            <i class="fe fe-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @foreach ($records as $record)
    <div class="modal fade" id="model-{{$record->id}}" tabindex="-1" role="dialog" aria-labelledby="model-{{$record->id}}Label"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="model-{{$record->id}}Label">هل تريد حذف العنصر</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">لا</button>
                    <form action="{{ route('records.destroy', $record->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">نعم</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
