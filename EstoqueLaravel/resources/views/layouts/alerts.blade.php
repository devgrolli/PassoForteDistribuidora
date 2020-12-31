@if($errors->any()) <!-- existe algum erro neste array? -->
    <div class="alert alert-warning"> 
        @foreach($errors-all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

@if(session('success')) <!-- existe algum erro neste array? -->
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>{{session('success')}}</strong>
</div>
@endif

@if(session('error')) <!-- existe algum erro neste array? -->
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>{{session('error')}}</strong>
    </div>
@endif