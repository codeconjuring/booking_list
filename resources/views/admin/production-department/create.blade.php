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
            <form class="forms-sample" action="{{ route('admin.production-department.store') }}" method="POST" autocomplete="off">
            @csrf
            <div class="row">
            <div class="col-lg-12">
            <div class="form-group">
              <label for="exampleInputUsername1">House Name</label>
                <span class="text-danger">*</span>
              <div class="position-relative">
                <select type="text" name="house" value="{{ old('house') }}" class="form-control" id="exampleInputUsername1" placeholder="Production House Name">
                  <option value="">Select house</option>
                  @foreach($production_houses as $house)
                    <option value="{{ $house->id }}">{{ $house->house }}</option>
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
              <label for="exampleInputUsername1">Year</label>
                <span class="text-danger">*</span>
              <div class="position-relative">
                <select type="text" name="year" value="{{ old('year') }}" class="form-control" placeholder="Production year">
                  @for($i = date('Y'); $i >= date('Y') - 100; $i--)
                    <option val date('Y') ue="{{ $i }}"> {{ $i }} </option>
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
              <label for="exampleInputUsername1">Month</label>
                <span class="text-danger">*</span>
              <div class="position-relative">
                <select type="text" name="month" value="{{ old('month') }}" class="form-control" placeholder="Production month">
                  @php
                    $month_arr = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                  @endphp
                  @for($i = 0; $i < 12; $i++)
                    <option value="{{ $month_arr[$i] }}"> 
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
                  <option value="1">Books</option>
                  <option value="2">Tracts</option>
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
                <input type="text" name="total_titles" value="{{ old('total_titles') }}" class="form-control" id="totalTitlesId" placeholder="No. of titles produced">
              </div>
              @error('total_titles')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="col-lg-12" id="titleInputDivId">
          </div>
            <div class="col-lg-12">
            <div class="form-group">
              <label for="exampleInputUsername1">Production Cost</label>
                <span class="text-danger">(Optional)</span>
              <div class="position-relative">
                <input type="number" step="any" name="production_cost" value="{{ old('production_cost') }}" class="form-control" placeholder="Production cost"/>
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
  $('#totalTitlesId').on('input', function(){
    var totalTitles     = $('#totalTitlesId').val();
    console.log($('#totalTitlesId').val());

    var seriesOptions   = "<option value = ''>Select Series</option>";

    @foreach ($series as $s)
      seriesOptions    += "<option value = '{{ $s->category_id }}'>{{ $s->serise->name }}</option>";
    @endforeach

    $('#titleInputDivId').html("");

    for(let i = 0; i < totalTitles; i++){
      $('#titleInputDivId').append("<div class='row my-3'><div class='col-lg-4'><label for='exampleInputUsername1'>Series</label><select class='form-control' id=seriesId"+i+" data-series="+i+" onChange=seriesLansWiseData(this.dataset.series)>"+seriesOptions+"</select></div><div class='col-lg-2'><label for='exampleInputUsername1'>Languages</label><select class='form-control' id=lansId"+i+" name='lans[]'data-lan="+i+" onChange=seriesLansWiseData(this.dataset.lan)></select></div><div class='col-lg-4'><label for='exampleInputUsername1'>Titles</label><select class='form-control' id=titlesId"+i+" name='titles[]'></select></div><div class='col-lg-2'><label for='exampleInputUsername1'>Total Produced</label><input class='form-control' name='totals[]' type='number' step='any' /></div></div>");
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
        console.log(result);
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
