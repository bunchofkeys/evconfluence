@extends('layout.master.inner_two')

@section('sidebar')
    @include('layout.partial.teacher.side_menu')
@endsection

@section('content')
    <div class="row mt">

        <div class="col-md-12" style="padding-bottom: 20px">
            <a href="{{ Url::route('teacher.form.question.create', ['period' => $period, 'form' => $form, 'type' => $type]) }}" class="btn btn-primary">New Question</a>
            <a href="{{ URL::route('teacher.form.index', ['period' => $period]) }}" class="btn btn-primary">Back</a>
        </div>
        <div class="col-md-12">
            <div class="content-panel showback">
                <h4>{{ $type }} evaluation questions</h4><hr><table class="table table-striped table-advance table-hover">
                    <thead>
                    <tr>
                        <th class="col-md-1">Question Number</th>
                        <th class="col-md-8">Question</th>
                        <th class="col-md-2">Format</th>
                        <th class="col-md-1">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($questionList as $question)
                        <tr>
                            <td>{{ $question->question_number }}</td>
                            <td>{{ $question->question_text }}</td>
                            <td>{{ $question->format }}</td>
                            <td>
                                <a href="{{URL::route('teacher.form.question.edit', ['period' => $period, 'form' => $form, 'type' => $type, 'questionId' => $question->question_id]) }}" class="btn btn-primary btn-xs"><span class="label label-primary">Edit</span></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!-- /content-panel -->
        </div><!-- /col-md-12 -->
    </div>
@endsection

