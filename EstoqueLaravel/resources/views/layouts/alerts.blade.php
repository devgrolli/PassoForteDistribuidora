<link rel="stylesheet" type="text/css" href="css/default-template.css">

@if($errors->any()) <!-- existe algum erro neste array? -->
    <div class="alert alert-warning"> 
        @foreach($errors-all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

@if(session('success')) <!-- existe algum erro neste array? -->
    <div class="alert alert-dark alert-dismissible">
        <i class="bi bi-check2-circle">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
                <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
            </svg>
        </i>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>{{session('success')}}</strong>
    </div>
@endif

@if(session('warning')) <!-- existe algum erro neste array? -->
    <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>{{session('warning')}}</strong>
    </div>
@endif

@if(session('error')) <!-- existe algum erro neste array? -->
    <div class="alert alert-danger alert-dismissible">
        <i class="bi bi-exclamation-triangle">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
                <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
            </svg>
        </i>
        <button type="button" class="close" width="25" height="25" data-dismiss="alert">&times;</button>
        <strong>{{session('error')}}</strong>
    </div>
@endif