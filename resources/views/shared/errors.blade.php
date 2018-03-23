@if ($errors->any())
    <div class="form-group">
        <div class="col-md-12 mt-3 text-left">
            <ul class="pl-0">
                @foreach ($errors->all() as $error)
                    <li class="error">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif