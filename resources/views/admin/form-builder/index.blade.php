@extends('admin.layouts._master')



@section('content')
<div class="content-wrapper">

    @include('admin.layouts._page_header',['title'=>$page_title,'type'=>'Form'])

      <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">{{ $page_title }}</h4>
              <form class="forms-sample" action="{{ route('admin.form-builder.store') }}" method="POST">
                @csrf

                <h2>Default Input</h2>
                <ul>
                    <li>Series</li>
                    <li>Title</li>
                    <li>Language</li>
                    @if($form_builer->content)
                    @foreach($form_builer->content as $key=>$content)
                    <div id="item{{ $key }}">
                        <input type="text" value="" name="compare[{{ $key }}]['value']" class="compare-class-{{ $key }}">
                        <li>
                            <input type="text" class="form-control mb-1" onkeyup="trackValue('{{ $key }}','{{ $content['value'] }}')" required name="contents[{{ $key }}][value]" value="{{ $content['value'] }}"><a href="#" onclick="removeItem({{ $key }})" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>

                            <span>Dropdown<input type="radio"  name="contents[{{ $key }}][type]" {{ $content['type']=="dropdown"?'checked':'' }}  value="dropdown">Text Field<input type="radio" name="contents[{{ $key }}][type]" {{ $content['type']=="text"?'checked':'' }}  value="text"></span>
                        </li>
                     </div>
                    @endforeach
                    @endif
                    <div id="newItem"></div>
                </ul>

                <button type="button" onclick="addMore()" class="btn btn-warning">Add More</button>

                <button type="submit" class="btn btn-gradient-primary mr-2">Create Form Builder</button>
                <a href="{{ url()->previous() }}" class="btn btn-light">Back</a>
              </form>
            </div>
          </div>
        </div>


      </div>


</div>


@endsection

@section('js')
    <script>
        let i={{ $form_builer->content?count($form_builer->content):0 }}+1;
        function addMore()
        {
            $('#newItem').append(`<li id="item${i}">
                <input type="text" class="form-control mb-1" required name="contents[${i}][value]" value=""><a href="#" onclick="removeItem(${i})" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                <span>Dropdown<input type="radio"  name="contents[${i}][type]" checked value="dropdown">Text Field<input type="radio" name="contents[${i}][type]" value="text"></span></li>`);
            i+=1;
        }

        function removeItem(item)
        {
            $(`#item${item}`).remove();
        }

        // Track Order
        function trackValue(key,val)
        {
            $(`.compare-class-${key}`).val(val);
        }
    </script>
@endsection
