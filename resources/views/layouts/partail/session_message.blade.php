@if (session('success'))
    <div class="alert alert-success w-25 alert-dismissible fade show m-2" style="position: absolute; z-index: 2000;" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>{{__('site.' .session('success'))}}</strong>
    </div>
@endif
