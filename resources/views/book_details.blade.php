@extends('layouts._master')
@section('css')
@endsection
@section('content')
<div id="layout-wrapper">
   <div class="cc-cover-main">
      <img class="blur-image" src="https://images.pexels.com/photos/374044/pexels-photo-374044.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" class="img-fluid" alt="">
      <!-- <div class="container-fluid"> -->
      <div class="ic-inner-cover">
         <img src="{{ asset(Storage::url(Settings::get('banner_pic'))) }}" class="img-fluid" alt="">
         <label for="file-cover" class="cc-file-upload">
         <input type="file" id="file-cover" class="d-none">
         Edit cover photo
         </label>
      </div>
      <div class="content">
         <div class="page-content">
            <!-- container-fluid -->
            <div class="row cc-total-datatable-photo">
               <div class="col-xxl-12 col-12 m-auto">
                  <a href="{{ url('/') }}" class="ml-4">Home</a> > <a href="{{ route('index',['selected_series_id' => $book->serise->id]) }}"> {{ $book->serise->name }} </a> > <a href="{{url()->current()}}">{{ $book->title }}</a>
                  <div class="card">
                     <div class="card-body">
                        <div class="row">
                           <div class="col-lg-5 col-md-5">
                              <div class="cc-book-details-img">
                                 @if($book->bookInfos != null)
                                 @if($book->bookInfos->cover_file_name != null)
                                 <img src="{{ asset('storage/covers/'.$book->bookInfos->cover_file_name) }}" class="img-fluid w-100" alt="images">
                                 @else
                                 <img src="{{ asset('storage/covers/placeholder.png') }}" class="img-fluid w-100" alt="images">
                                 @endif
                                 @else
                                 <img src="{{ asset('storage/covers/placeholder.png') }}" class="img-fluid w-100" alt="images">
                                 @endif
                              </div>
                              <div class="holder">
                                 @if(array_key_exists($audio_format_id, $formats))
                                 <div class="audio green-audio-player">
                                    <div class="loading">
                                       <div class="spinner"></div>
                                    </div>
                                    <div class="play-pause-btn">
                                       <svg xmlns="http://www.w3.org/2000/svg" width="18" height="24" viewBox="0 0 18 24">
                                          <path fill="#566574" fill-rule="evenodd" d="M18 12L0 24V0" class="play-pause-icon" id="playPause" />
                                       </svg>
                                    </div>
                                    <div class="controls">
                                       <!-- <span class="current-time">0:00</span> -->
                                       <div class="slider" data-direction="horizontal">
                                          <div class="progress">
                                             <div class="pin" id="progress-pin" data-method="rewind">
                                             </div>
                                          </div>
                                       </div>
                                       <!-- <span class="total-time">0:00</span> -->
                                    </div>
                                    <div class="volume">
                                       <div class="volume-btn">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                             <path fill="#566574" fill-rule="evenodd" d="M14.667 0v2.747c3.853 1.146 6.666 4.72 6.666 8.946 0 4.227-2.813 7.787-6.666 8.934v2.76C20 22.173 24 17.4 24 11.693 24 5.987 20 1.213 14.667 0zM18 11.693c0-2.36-1.333-4.386-3.333-5.373v10.707c2-.947 3.333-2.987 3.333-5.334zm-18-4v8h5.333L12 22.36V1.027L5.333 7.693H0z" id="speaker" />
                                          </svg>
                                       </div>
                                       <div class="volume-controls hidden">
                                          <div class="slider" data-direction="vertical">
                                             <div class="progress">
                                                <div class="pin" id="volume-pin" data-method="changeVolume"></div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <audio crossorigin>
                                       <source @if($book->bookInfos != null)
                                       src="{{asset('storage/audios/'.$book->bookInfos->audio_file_name)}}"
                                       type="audio/mpeg">
                                       @endif
                                    </audio>
                                 </div>
                                 @endif
                              </div>
                              <!-- pages- -->
                              <div class="cc-count-app">
                                 @if($book->bookInfos != null)
                                 <div class="cc-count-items" style="padding: 10px">
                                    <i class="icon-list"></i>
                                    <div>
                                       <p class="cc-number mb-0" style="font-size: 26px;">
                                          {{ $book->bookInfos->pages }}
                                       </p>
                                       <p class="cc-name mb-0">Pages</p>
                                    </div>
                                 </div>
                                 @endif
                                 @if($book->bookInfos != null)
                                 <div class="cc-count-items orange" style="padding: 10px">
                                    <i class="icon-list"></i>
                                    <div>
                                       <p class="cc-number mb-0" style="font-size: 26px;">
                                          {{ $book->bookInfos->to_read }}
                                       </p>
                                       <p class="cc-name mb-0">Hours To Read</p>
                                    </div>
                                 </div>
                                 @endif
                                 @if($book->bookInfos != null)
                                 <div class="cc-count-items sky" style="padding: 10px">
                                    <i class="icon-list"></i>
                                    <div>
                                       <p class="cc-number mb-0" style="font-size: 26px;">
                                          {{ $book->bookInfos->to_listen }}
                                       </p>
                                       <p class="cc-name mb-0">Hours To Listen</p>
                                    </div>
                                 </div>
                                 @endif
                              </div>
                              <!-- pages- -->
                              <!-- app button -->
                              <div class="ic-app-store">
                                 <p class="mb-0">Download our mobile app</p>
                                 <div>
                                    <a href="#"><img src="{{ asset('dashboard/update_assets/images/app.png') }}" alt=""></a>
                                    <a href="#"><img src="{{ asset('dashboard/update_assets/images/google.png') }}" alt=""></a>
                                 </div>
                              </div>
                              <!-- app button -->
                           </div>
                           <div class="col-lg-7 col-md-7">
                              <div class="cc-books-details-content">
                                 <h3>{{ $book->title }}
                                 </h3>
                                 <table class="table table-borderless books-details-table">
                                    <tr>
                                       <td><span>Author</span></td>
                                       <td><span>:</span></td>
                                       <td><span>{{ $author }}</span></td>
                                    </tr>
                                    @if(array_key_exists($audio_format_id, $formats))
                                    @if($book->bookInfos != null)
                                    @if($book->bookInfos->narrators != null)
                                    <tr>
                                       <td><span>Narrator </span></td>
                                       <td><span>:</span></td>
                                       <td><span>
                                          {{ $book->bookInfos->narrators->name }}
                                          </span>
                                       </td>
                                    </tr>
                                    @endif
                                    @endif
                                    @endif
                                    @if($book->books != null)
                                    @if($book->books->copyright_year != null)
                                    <tr>
                                       <td><span>Copyright</span></td>
                                       <td><span>:</span></td>
                                       <td><span>
                                          {{ $book->books->copyright_year }}
                                          </span>
                                       </td>
                                    </tr>
                                    @endif
                                    @endif
                                    <tr>
                                       <td><span>Language</span></td>
                                       <td><span>:</span></td>
                                       <td><span>{{ $language->name }}</span></td>
                                    </tr>
                                    @if(sizeof($translations) > 0)
                                    <tr>
                                       <td><span>Translation</span></td>
                                       <td><span>:</span></td>
                                       <td>
                                          <span>
                                          @php
                                          $countTrans = 0;
                                          $totalTrans = sizeof($translations);
                                          @endphp
                                          @foreach($translations as $trans)
                                          @php
                                          $countTrans+=1;
                                          @endphp
                                          @if($countTrans==$totalTrans)
                                          {{$trans}}
                                          @else
                                          {{$trans.', '}}
                                          @endif
                                          @endforeach
                                          </span>
                                       </td>
                                    </tr>
                                    @endif
                                    <tr>
                                       <td><span>Tags</span></td>
                                       <td><span>:</span></td>
                                       <td>
                                          <span>
                                          @php
                                          $countTags = 0;
                                          $totalTags = sizeof($tags);
                                          @endphp
                                          @foreach($tags as $tag)
                                          @php
                                          $countTags+=1;
                                          @endphp
                                          @if($countTags==$totalTags)
                                          {{$tag->category->name}}
                                          @else
                                          {{$tag->category->name.', '}}
                                          @endif
                                          @endforeach
                                          </span>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td><span>Series</span></td>
                                       <td><span>:</span></td>
                                       <td><span>{{ $book->serise->name }}</span></td>
                                    </tr>
                                    {{-- @if(sizeof($formats) > 0)
                                    <tr>
                                       <td><span>Formats</span></td>
                                       <td><span>:</span></td>
                                       <td>
                                          <div class="cc-formate">
                                             @foreach($formats as $id => $format)
                                             @if(strtolower($format) != 'gfp')
                                             @if(strtolower($format) == 'ebook')
                                             <span class="ic-ebook cc-badege">
                                             <i class="icon-list"></i>
                                             @elseif(strtolower($format) == 'audio')
                                             <span class="ic-adiuo cc-badege">
                                             <i class="icon-sound"></i>
                                             @elseif(strtolower($format) == 'pod-h' or strtolower($format) == 'pod-s')
                                             <span class="ic-pod cc-badege">
                                             <i class="icon-book2"></i>
                                             @else
                                             <span class="ic-pod cc-badege">
                                             <i class="icon-book2"></i>
                                             @endif
                                             {{ $format }}</span>
                                             @endif
                                             @endforeach
                                          </div>
                                       </td>
                                    </tr>
                                    @endif --}}
                                    @if(sizeof($formats) > 0)
                                      @php
                                        $format_price_arr = [];
                                        $price_exists_flag = 0;
                                        foreach($book->bookFormatInfos as $price)
                                        {
                                          if($price->price != null)
                                          {
                                            $format_price_arr[$price->form_builder_id] = $price->price;
                                          
                                            if($price_exists_flag == 0)
                                            {
                                            $price_exists_flag = 1;
                                            }
                                          }
                                        }
                                    @endphp
                                    <tr>
                                       <td>
                                          <span>
                                             Price
                                             <select class="ic-select-details" name="" id="">
                                                <option value="0">$</option>
                                             </select>
                                          </span>
                                       </td>
                                       <td><span></span></td>
                                       <td>
                                          <div class="cc-formate">
                                             @foreach($formats as $key => $format)
                                             @if(strtolower($format) != 'gfp')
                                             @if(strtolower($format) == 'ebook')
                                             <span class="ic-ebook cc-badege dollar">
                                             @elseif(strtolower($format) == 'audio')
                                             <span class="cc-badege ic-adiuo dollar">
                                             @elseif(strtolower($format) == 'pod-h' or strtolower($format) == 'pod-s')
                                             <span class="ic-pod cc-badege dollar">
                                             @endif
                                             {{ 
                                             $format}} 
                                             @if($price_exists_flag == 1)
                                              @if(array_key_exists($key,$format_price_arr))
                                                {{ ': $'.$format_price_arr[$key] }}
                                              @endif
                                             @endif
                                             </span>
                                             @endif
                                             @endforeach
                                          </div>
                                       </td>
                                    </tr>
                                    @endif
                                 </table>
                                 @if($book->bookInfos != null)
                                 <div class="cc-books-details-content">
                                    <p class="synopsis">Synopsis :</p>
                                    <p class="cc-details-books">
                                       {{ $book->bookInfos->synopsis }}
                                    </p>
                                 </div>
                                 @endif
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="cc-books-slider-main-heads mt-5">
                     <h3 class="mb-4">From the Same Series</h3>
                     <div class="ic-books-slider owl-carousel owl-theme">
                        @foreach($same_series_suggestions as $same_series_suggestion)
                        <a href="{{route('get-book-details',['id'=>$same_series_suggestion->id]) }}">
                           <div class="cc-slider-items">
                              @if($same_series_suggestion->bookInfos != null)
                              @if($same_series_suggestion->bookInfos->cover_file_name != null)
                              <img src="{{ asset('storage/covers/'.$same_series_suggestion->bookInfos->cover_file_name) }}" class="img-fluid" alt="">
                              @else
                              <img src="{{ asset('storage/covers/placeholder.png') }}" class="img-fluid" alt="">
                              @endif
                              @else
                              <img src="{{ asset('storage/covers/placeholder.png') }}" class="img-fluid" alt="">
                              @endif
                              <div class="cc-books-name">
                                 <p class="mb-0">{{ $same_series_suggestion->title }}</p>
                              </div>
                           </div>
                        </a>
                        @endforeach
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- </div> -->
   </div>
</div>
@endsection
@section('js')
<script src="{{ asset('dashboard/update_assets/js/audio.js') }}"></script>
<script src="{{ asset('dashboard/update_assets/js/owl.carousel.min.js') }}"></script>
@endsection
@section('script')
