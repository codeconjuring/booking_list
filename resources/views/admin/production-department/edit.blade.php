@extends('admin.layout._master')

@section('content')

  <div class="page-content">
    <div class="container-fluid">
    <!-- start page title -->
      <div class="row">
        <div class="col-12">
          <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">{{ $page_title }}</h4>
          </div>
        </div>
      </div>
            <!-- end page title -->
    </div>
        <!-- container-fluid -->

    <div class="row">
      <div class="col-xxl-10 col-12 m-auto">
        <div class="card">
          <div class="card-body">
            <form class="forms-sample" action="{{ route('admin.production-department.update',$department->id) }}" method="POST" autocomplete="off">
            @csrf
            @method('put')
            <div class="row">
            <div class="col-lg-12">
            <div class="form-group">
              <label for="exampleInputUsername1">House Name</label>
                <span class="text-danger">*</span>
              <div class="position-relative">
                <select type="text" name="house" value="{{ old('house') }}" class="form-control" id="exampleInputUsername1" placeholder="Production House Name">
                  <option value="">Select house</option>
                  @foreach($production_houses as $house)
                    <option value="{{ $house->id }}" {{ $house->id == $department->production_house_id ? 'selected' : '' }}>
                      {{ $house->house }}
                    </option>
                  @endforeach
                </select>
              </div>
              @error('house')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>
            <div class="col-lg-6">
            <div class="form-group">
              <label for="exampleInputUsername1">Production Year</label>
                <span class="text-danger">*</span>
              <div class="position-relative">
                <select type="text" name="year" value="{{ old('year') }}" class="form-control" placeholder="Production year">
                  @for($i = date('Y'); $i >= date('Y') - 100 ; $i--)
                    <option value="{{ $i }}" {{ $i == $department->production_year ? 'selected' : '' }}> 
                      {{ $i }} 
                    </option>
                  @endfor
                </select>
              </div>
              @error('year')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>
            <div class="col-lg-6">
            <div class="form-group">
              <label for="exampleInputUsername1">Production Month</label>
                <span class="text-danger">*</span>
              <div class="position-relative">
                <select type="text" name="month" value="{{ old('month') }}" class="form-control" placeholder="Production month">
                  @php
                    $month_arr = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                  @endphp
                  @for($i = 0; $i < 12; $i++)
                    <option value="{{ $month_arr[$i] }}" {{ $month_arr[$i] == $department->production_month ? 'selected' : '' }}> 
                      {{ $month_arr[$i] }} 
                    </option>
                  @endfor
                </select>
              </div>
              @error('month')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>
            <div class="col-lg-6">
            <div class="form-group">
              <label for="exampleInputUsername1">Statistics Type</label>
                <span class="text-danger">*</span>
              <div class="position-relative">
                <select type="text" name="stat_type" value="{{ old('stat_type') }}" class="form-control">
                  <option value="1" {{ $department->stat_type == 'Books' ? 'selected' :'' }}>Books</option>
                  <option value="2" {{ $department->stat_type == 'Tracts' ? 'selected' :'' }}>Tracts</option>
                </select>
              </div>
              @error('stat_type')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>
            <div class="col-lg-6">
            <div class="form-group">
              <label for="exampleInputUsername1">No. of Titles Produced</label>
                <span class="text-danger">*</span>
              <div class="position-relative">
                <input type="number" name="total_titles" value="{{ $department->production_title_count }}" class="form-control" id="totalTitlesId" placeholder="No. of titles produced">
              </div>
              @error('total_titles')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="col-lg-12" id="titleInputDivId">
            @php
              $title_div_no = 1;
            @endphp
            @if($department->production_title != null)
            @foreach($department->production_title as $pt)
            <div class='row my-3' id="title{{ $title_div_no }}">
              <div class='col-lg-4'>
                <label for='exampleInputUsername1'>Series</label>
                <select class='form-control' id="seriesId{{ $title_div_no }}" name='series[]' data-series='{{ $title_div_no }}' onchange="seriesLansWiseData(this.dataset.series)">
                  @foreach($series as $s)
                    <option value="{{ $s->category_id }}" {{ $pt->book_list->category_id == $s->category_id ? 'selected' : '' }}>
                      {{ $s->serise->name }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class='col-lg-2'>
                <label for='exampleInputUsername1'>Languages</label>
                <select class='form-control' id="lansId{{ $title_div_no }}" name='lans[]' data-lan='{{ $title_div_no }}' onchange="seriesLansWiseData(this.dataset.lan)">
                  @foreach($pt->book_list->serieswise_lan as $sl)
                  {
                    <option value="{{ $sl->language }}" {{ $pt->lan == $sl->language ? 'selected' : '' }}>
                      {{ $sl->language }}
                    </option>
                  }
                  @endforeach
                </select>
              </div>
              <div class='col-lg-4'>
                <label for='exampleInputUsername1'>Titles</label>
                <select class='form-control' id="titlesId{{ $title_div_no }}" name='titles[]'>
                  @foreach($pt->book_list->serieslanwise_title as $title)
                    <option value="{{ $title->id }}">
                      {{ $title->title }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class='col-lg-2'>
                <label for='exampleInputUsername1'>Total Produced</label>
                <input class='form-control' name='totals[]' value="{{ $pt->quantity }}" type='number' step='any' />
              </div>
            </div>
            @php 
              $title_div_no += 1;
            @endphp
            @endforeach
            @endif
          </div>
            <div class="col-lg-12">
            <div class="form-group">
              <label for="exampleInputUsername1">Production Cost</label>
                <span class="text-danger">(Optional)</span>
              <div class="position-relative">
                <input type="number" step="any" name="production_cost" value="{{ $department->total_cost }}" class="form-control" placeholder="Production cost"/>
              </div>
              @error('production_cost')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="col-lg-12 text-right">
          <button type="submit" class="btn btn-primary mr-2">Create</button>
          <a href="{{ url()->previous() }}" class="btn btn-light">Back</a>
          </div>
          </div>
            </form>
          </div>
        </div>
        </div>
      </div>
    </div>

@endsection

@section('js')
<script type="text/javascript">

  var production_title_count = {{ sizeof($department->production_title) }};

  $('#totalTitlesId').on('input', function(){

    var totalTitles = 0;

    if($('#totalTitlesId').val()){
      totalTitles     = parseInt($('#totalTitlesId').val());
    }

    console.log($('#totalTitlesId').val());


    var seriesOptions   = "<option value = ''>Select Series</option>";

    @foreach ($series as $s)
      seriesOptions    += "<option value = '{{ $s->category_id }}'>{{ $s->serise->name }}</option>";
    @endforeach

    if(totalTitles < production_title_count)
    {
      for(let n = 1; n <= totalTitles; n++)
      {
        if($('#title'+n).hasClass('d-none'))
        {
          $('#title'+n).removeClass('d-none');
        }
      }
      for(let n = totalTitles + 1; n <= production_title_count; n++)
      {
        console.log("Total Titles: "+n);
        if(!$('#title'+n).hasClass('d-none'))
        {
          $('#title'+n).addClass('d-none');
        }
      }
      if($(".extra").length > 0)
      {
        $(".extra").remove();
      }
    }
    else if(totalTitles >= production_title_count && totalTitles > 0)
    {
      for(let n = 1; n <= totalTitles; n++)
      {
        if($('#title'+n).hasClass('d-none'))
        {
          $('#title'+n).removeClass('d-none');
        }
      }

      for(let i = parseInt(production_title_count)+1; i <= totalTitles; i++){
        $('#title'+i).html('');
      }
      
      for(let i = parseInt(production_title_count)+1; i <= totalTitles; i++){
        $('#titleInputDivId').append("<div class='row my-3 extra' id='title"+i+"'><div class='col-lg-4'><label for='exampleInputUsername1'>Series</label><select class='form-control' id=seriesId"+i+" data-series="+i+" onChange=seriesLansWiseData(this.dataset.series) name='series[]''>"+seriesOptions+"</select></div><div class='col-lg-2'><label for='exampleInputUsername1'>Languages</label><select class='form-control' id=lansId"+i+" name='lans[]'data-lan="+i+" onChange=seriesLansWiseData(this.dataset.lan)></select></div><div class='col-lg-4'><label for='exampleInputUsername1'>Titles</label><select class='form-control' id=titlesId"+i+" name='titles[]'></select></div><div class='col-lg-2'><label for='exampleInputUsername1'>Total Produced</label><input class='form-control' name='totals[]' type='number' step='any' /></div></div>");
      }
    }
    
  });
   function seriesLansWiseData(i)
  {
    console.log("Series ID: " + $("#seriesId"+i+" option:selected").val());
    var seriesFieldId = "seriesId"+i;
    var seriesId = $("#seriesId"+i+" option:selected").val();
    var lan = $("#lansId"+i+" option:selected").val();

    if(lan == null)
    {
      dataToSend = {series_id:seriesId,lan:0,lan_flag:1,title_flag:0,input_field:i};
    }
    else
    {
      dataToSend = {series_id:seriesId,lan:lan,lan_flag:0,title_flag:1,input_field:i};
    }

    $.ajax({
      url:"{{ route('admin.production.get-serieswise-lanstitles') }}",
      method: "GET",
      data: dataToSend,
      success:function(result)
      {
        console.log("ajax result: "+result.input_field);
        if(result.lan_flag == 1)
        {
          $("#lansId"+result.input_field).html('');
          $.each(result.languages,function(key, value)
          {
            $("#lansId"+result.input_field).append(
              "<option value='"+value.language+"'>"+value.language+"</option>"
            );
          });
          $("#titlesId"+result.input_field).html('');
          $.each(result.titles,function(key, value)
          {
            $("#titlesId"+result.input_field).append(
              "<option value='"+value.id+"'>"+value.title+"</option>"
            );
          });
        }
        else
        {
          $("#titlesId"+result.input_field).html('');
          $.each(result.titles,function(key, value)
          {
            console.log("Titles key: "+key+" value: "+value);
            $("#titlesId"+result.input_field).append(
              "<option value='"+value.id+"'>"+value.title+"</option>"
            );
          });
        }
      }
    });
  }
</script>
@endsection
