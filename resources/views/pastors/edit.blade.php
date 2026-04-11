<x-app-layout>

@section('content')
<div class="p-4">
    <h1 class="text-xl font-bold mb-4">Edit Pastor</h1>

    @include('pastors._form', ['pastor' => $pastor])
</div>
@endsection

</x-app-layout>