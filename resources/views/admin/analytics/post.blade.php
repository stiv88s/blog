@extends('admin.layouts')

@section('content')

    <div class="col-12" id="app">

        <analytics-component
            :analyticDataRange="{{json_encode($dateRange)}}"
            startDateFormat="{{$startDateFormat}}"
            applocale="{{app()->getLocale()}}"
            posturl="{{route('post.analytic',app()->getLocale())}}"
            endDateFormat="{{$endDateFormat}}"
            :topPosts = "{{json_encode($topPosts)}}"
            :postsAnalytic ="{{json_encode($postsAnalytic)}}"

         ></analytics-component>
        <br>

    </div>

@endsection

@push('scripts')

@endpush
