@extends('layout.master.inner_two')

@section('sidebar')
    @include('layout.partial.teacher.side_menu')
@endsection

@section('content')
    <div class="row mt">

        <div class="col-md-12" style="padding-bottom: 20px">
            <a href="{{ Url::route('teacher.form.create', ['period' => $period]) }}" class="btn btn-primary">New Form</a>
            <a href="{{ URL::route('teacher.period.index') }}" class="btn btn-primary">Back</a>
        </div>
        <div class="col-md-12">
            <div class="content-panel showback">
                <h4>Forms</h4><hr><table class="table table-striped table-advance table-hover">
                    <thead>
                    <tr>
                        <th class="col-md-1">Form ID</th>
                        <th class="col-md-1">End Date</th>
                        <th class="col-md-2">Status</th>
                        <th class="col-md-2">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($formList as $form)
                        <tr>
                            <td>{{ $form->form_id }}</td>
                            <td>{{ $form->end_date_time }}</td>
                            <td>{{ $form->status }} </td>
                            <td>
                                <a href="{{URL::route('teacher.form.question', ['period' => $period, 'form' => $form->form_id, 'type' => 'self']) }}" class="btn btn-primary btn-xs"><span class="label label-primary">Manage Self</span></a>
                                <a href="{{URL::route('teacher.form.question', ['period' => $period,'form' => $form->form_id, 'type' => 'peer']) }}" class="btn btn-primary btn-xs"><span class="label label-primary">Manage Peer</span></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!-- /content-panel -->
        </div><!-- /col-md-12 -->
    </div>
@endsection

