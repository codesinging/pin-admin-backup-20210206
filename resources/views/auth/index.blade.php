@extends(admin_template('layouts.app'))

@section('content')
    <div id="app">

    </div>
@endsection

@section('script')
    <script>
        const app = new Vue({
            el: '#app',
            data() {
                return {}
            },
        })
    </script>
@endsection

@section('style')

@endsection