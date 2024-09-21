<x-front-layout>
    <div class="row">
        <!-- Bordered table -->
        <div class="col-12 my-4">
            <div class="card shadow">
                <div class="card-header">
                    <div class="row justify-content-end ml-2">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#printMali">
                            <i class="fe fe-dollar-sign"></i>
                            تقرير مالي
                        </button>
                        <button type="button" class="btn btn-primary ml-2" data-toggle="modal"
                            data-target="#createRec">
                            حجز جديد
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <livewire:table :records="$records" :doctors="$doctors" />
                </div>
            </div>
        </div> <!-- Bordered table -->
    </div>

    <!-- Modal -->
    <div class="modal fade" id="createRec" tabindex="-1" role="dialog" aria-labelledby="createRecLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createRecLabel">حجز جديد</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <livewire:modal />
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="printMali" tabindex="-1" role="dialog" aria-labelledby="printMaliLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="printMaliLabel">طباعة تقرير مالي لعدد الحالات</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('records.printMali') }}" method="post" target="_blank">
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="form-group mb-3 col-6">
                                <x-form.input type="date"  name="from_date" label="من تاريخ" value="{{date('Y-m-d')}}" required />
                            </div>
                            <div class="form-group mb-3 col-6">
                                <x-form.input type="date"  name="to_date" label="الى تاريخ" value="{{date('Y-m-d')}}" required />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">طباعة</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-front-layout>
