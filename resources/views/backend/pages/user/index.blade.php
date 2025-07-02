@extends('backend.layout.master')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-0">Products Overview</h5>
                        </div>
                        <div class="font-22 ms-auto">
                            <a  class="btn btn-warning text-white">
                                <i class="bx bx-layer-plus"></i> insert
                            </a>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive" style="max-height: calc(100vh - 14.5rem); overflow-y: auto;">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th style="position: sticky ; top:0"></th>

                                    <th style="position: sticky ; top:0">Id</th>
                                    <th style="position: sticky ; top:0">User Name</th>
                                    <th style="position: sticky ; top:0">Email</th>
                                    <th style="position: sticky ; top:0">Role</th>

                                    <th style="position: sticky ; top:0">created_at</th>
                                    <th style="position: sticky ; top:0">updated_at</th>
                                </tr>
                            </thead>
                            <tbody>



                                @foreach ($users as $user)
                                    @if ($user->email !== 'ismail_admin@gmail.com')
                                        <tr>
                                            <td style="background: #0000000a  !important ; padding:0">
                                                <div class="d-flex order-actions">

                                                    <form action="{{ route('admin.user.delete', $user->id) }}"
                                                        method="POST" class="d-inline" style="">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="delete-btn btn btn-sm mb-0 px-2 py-1"
                                                            title="Delete">
                                                            <a href="">
                                                                <i class="far fa-trash-alt text-danger"
                                                                    style="font-size: 1.1rem">
                                                                </i>
                                                            </a>
                                                        </button>
                                                    </form>



                                                    <form method="GET" action="{{ route('admin.user.edit', $user->id) }}"
                                                        style="">
                                                        @csrf
                                                        @if ($user->hasRole('admin'))
                                                            <button
                                                                type="submit"class="update-btn btn btn-sm  mb-0 px-2 py-1 ">
                                                                <a href="javascript:;" class="ms-4"
                                                                    style="margin: 0 !important">
                                                                    <i class="fas fa-user-shield text-success"
                                                                        style="font-size: 1.1rem">
                                                                    </i>
                                                                </a>
                                                            </button>
                                                        @else
                                                            <button
                                                                type="submit"class="update-btn btn btn-sm  mb-0 px-2 py-1 ">
                                                                <a href="javascript:;" class="ms-4"
                                                                    style="margin: 0 !important">
                                                                    <i class="fas fa-user text-warning"
                                                                        style="font-size: 1.1rem">
                                                                        
                                                                    </i>
                                                                </a>
                                                            </button>
                                                        @endif

                                                    </form>



                                                </div>
                                            </td>
                                            <td style="text-align: center">{{ $user->id }} </td>
                                            <td>{{ $user->name }} </td>
                                            <td>{{ $user->email }} </td>
                                            <td>{{ $user->roles->first()->name ?? 'User' }} </td>
                                            <td>{{ $user->created_at }}</td>
                                            <td>{{ $user->updated_at }}</td>
                                        </tr>
                                    @endif
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
