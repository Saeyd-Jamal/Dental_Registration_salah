
<div class="row">
    <div class="form-group p-3 col-4">
        <x-form.input label="الاسم" :value="$user->name"  name="name" placeholder="محمد ...." required autofocus/>
    </div>
    <div class="form-group p-3 col-4">
        <x-form.input label="اسم المستخدم" :value="$user->username"  name="username" placeholder="username" required/>
    </div>
    <div class="form-group p-3 col-4">
        @if (isset($btn_label))
        <x-form.input type="password" label="كلمة المرور" name="password" placeholder="****"  />
        @else
        <x-form.input type="password" label="كلمة المرور" name="password" placeholder="****" required />
        @endif
    </div>
    <div class="form-group p-3 col-4">
        <label for="type">نوع المستخدم</label>
        <select name="type" id="type" class="form-control" required>
            <option value="" selected>النوع</option>
            <option value="user">كاتب</option>
            <option value="doctor">طبيب</option>
            <option value="admin">مدير</option>
        </select>
    </div>

</div>


<div class="row align-items-center mb-2">
    <div class="col">
        <h2 class="h5 page-title"></h2>
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary">
            {{$btn_label ?? "أضف"}}
        </button>
    </div>
</div>
