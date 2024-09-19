<x-front-layout>
    <div class="row">
        <!-- Bordered table -->
        <div class="col-md-12 my-4">
            <div class="card shadow">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title">المستخدمين</h5>
                        </div>
                        <div class="col-auto">
                            <a href="{{route('users.create')}}" class="btn btn-primary">
                                <i class="fe fe-plus fe-12"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>حالة النشاط</th>
                                <th>الاسم</th>
                                <th>اسم المستخدم</th>
                                <th>النوع</th>
                                <th>أخر موعد تواجد</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <style>
                                #user-1{
                                    display: none;
                                }
                            </style>
                            @foreach($users as $user)
                            <tr id="user-{{$user->id}}">
                                <td>{{ $loop->iteration - 1 }}</td>
                                @if ($user->last_activity >= now()->subMinutes(5))
                                    <td>
                                        <i class="fe fe-circle text-success bg-success rounded-circle"></i>
                                    </td>
                                @else
                                    <td>
                                        <i class="fe fe-circle"></i>
                                    </td>
                                @endif
                                <td>{{$user->name}}</td>
                                <td>{{$user->username}}</td>
                                <td>{{$user->type}}</td>
                                <td>{{$user->last_activity}}</td>
                                <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="text-muted sr-only">Action</span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" style="margin: 0.5rem -0.75rem; text-align: right;"
                                            href="{{route('users.edit',$user->id)}}">تعديل</a>
                                        <form action="{{route('users.destroy',$user->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="dropdown-item" style="margin: 0.5rem -0.75rem; text-align: right;"
                                            href="#">حذف</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- Bordered table -->
    </div>
</x-front-layout>
