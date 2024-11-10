@if (Session::has('status'))
    @if(session('status')=='success')
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" aria-hidden="true" class="close">
            <i class="fa fa-times"></i>
        </button>
        <span><b> Success - </b> {!! session('message') !!}</span>
    </div>
    @else
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" aria-hidden="true" class="close">
            <i class="fa fa-times"></i>
        </button>
        <span><b> Failed - </b> {!! session('message') !!}</span>
    </div>
    @endif
@endif
