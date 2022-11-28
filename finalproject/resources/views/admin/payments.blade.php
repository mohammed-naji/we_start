<x-admin-layout :title="'All Payments'">

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @if (session('msg'))
                        <div class="alert alert-{{ session('type') }}">
                            {{ session('msg') }}
                        </div>
                    @endif

                    <div>
                        <h2>All payments</h2>
                        <table class="table table-bordered">
                            <thead>
                                <tr class="bg-dark">
                                    <th>ID</th>
                                    <th>Customer</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($payments as $payment)
                                    <tr id="row_{{ $payment->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $payment->user->name }}</td>
                                        <td>{{ $payment->total }}</td>
                                        <td>{{ $payment->status }}</td>
                                        <td>{{ $payment->created_at->format('F m, Y') }}</td>
                                        <td>
                                            <a href="" class="btn btn-success btn-sm btn-edit"><i class="fas fa-eye"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">No Data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $payments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
</x-admin-layout>
