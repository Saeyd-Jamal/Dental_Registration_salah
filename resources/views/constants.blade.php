<x-front-layout>
    <div class="row">
        <div class="col-12 my-4">
            <div class="card shadow">
                <div class="card-header">
                    <h1 class="card-title">ثوابت النظام</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('constants.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <h2>أسنان رجال</h2>
                            <div class="form-group col-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            عدد حالات الطبيب العامة
                                        </span>
                                    </div>
                                    <input type="number" name="num_saher" min="0" value="{{$constants->where('key', 'num_saher')->first()->value}}" class="form-control" >
                                </div>
                            </div>
                            <div class="form-group col-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            عدد حالات المراجعة
                                        </span>
                                    </div>
                                    <input type="number" name="num_in_saher" min="0" value="{{$constants->where('key', 'num_in_saher')->first()->value}}" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <h2>أسنان نساء</h2>
                            <div class="form-group col-3">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            عدد حالات الطبيب العامة
                                        </span>
                                    </div>
                                    <input type="number" name="num_dodo" min="0" value="{{$constants->where('key', 'num_dodo')->first()->value}}"  class="form-control" >
                                </div>
                            </div>
                            <div class="form-group col-3">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            عدد حالات المراجعة
                                        </span>
                                    </div>
                                    <input type="number" name="num_in_dodo" min="0" value="{{$constants->where('key', 'num_in_dodo')->first()->value}}" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end ml-2">
                            <button type="submit" class="btn btn-primary">حفظ</button>

                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- Bordered table -->
    </div>
</x-front-layout>
