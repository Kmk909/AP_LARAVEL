@extends ('layout')

@section('content')
    <h3>Contact us</h3>
    <?php foreach($data as $key =>$value){
        echo $key .'='. $value.'<br/>';
    }?>
@endsection