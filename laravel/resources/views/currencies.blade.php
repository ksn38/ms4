@extends('layout.app')
@section('content')

<div class='d-flex justify-content-around m-2 flex-wrap align-items-start'>
  <div class='flex-column justify-content-center mt-2'>
    <small class='d-flex justify-content-around mt-2 text-secondary'>Changes currencies relative to the ruble for periods:</small> 
    <span class="d-flex flex-nowrap">    
      <form class='d-flex mx-auto mb-2' method="get">        
        <input class='mr-1' type="number" name="mytextbox3" size='3' min='1' max='11000' id='mytextbox3'>
        <input class='mr-1' type="number" name="mytextbox2" size='3' min='1' max='11000' id='mytextbox2'>
        <input class='mr-1' type="number" name="mytextbox1" size='3' min='1' max='11000' id='mytextbox1'>
        <input class='mr-1' type="number" name="mytextbox" size='3' min='1' max='11000' id='mytextbox'>
        <input type="submit" value="days ago" name="mybtn" id='mybtn'>
        <input class='ml-1' type="checkbox" id='checkbox-change'>
      </form>  
    </span>
    <div class='d-flex flex-nowrap'>
      <div  class='flex-column'>
        <div>({{ $date_delta3 }})</div>
        <table class='table-sm table-bordered table-dark' style='height: 0px'>
          @foreach ($dif_plus3 as $key => $value)
            <tr>
              <td class='currency-plus text-secondary'>
                {{ $key }}
              </td>
              <td class='value-plus3 text-dark'>
                {{ $value }}
              </td>
            </tr>
          @endforeach
        </table>
      </div>
      <div  class='flex-column'>
        <div>({{ $date_delta2 }})</div>
        <table class='table-sm table-bordered table-dark' style='height: 0px'>
          @foreach ($dif_plus2 as $key => $value)
            <tr>
              <td class='currency-plus text-secondary'>
                {{ $key }}
              </td>
              <td class='value-plus2 text-dark'>
                {{ $value }}
              </td>
            </tr>
          @endforeach
        </table>
      </div>
      <div  class='flex-column'>
        <div>({{ $date_delta1 }})</div>
        <table class='table-sm table-bordered table-dark' style='height: 0px'>
          @foreach ($dif_plus2 as $key => $value)
            <tr>
              <td class='currency-plus text-secondary'>
                {{ $key }}
              </td>
              <td class='value-plus1 text-dark'>
                {{ $value }}
              </td>
            </tr>
          @endforeach
        </table>
      </div>
      <div class='mb-3'>
        <div class='flex-column justify-content-around'>
          <div>({{ $date_delta }})</div>
        </div>
        <div class='flex-column'>
          <table class='table-sm table-bordered table-dark' style='height: 0px'>
            @foreach ($dif_plus as $key => $value)
              <tr>
                <td class='currency-plus text-secondary'>
                  {{ $key }}
                </td>
                <td class='value-plus text-dark'>
                  {{ $value }}
                </td>
              </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>
  
  <table class='table-sm table-dark table-bordered' id='moex'>
    <caption style='caption-side: top'>
      <span class='d-flex justify-content-start'>
        <small>Stocks moex. Number of</small>
      </span>
      <input type='number' id='days' value='2' size='3' min='2' max='3000'>
      <input type='submit' class='button' id='stocks' value=' days ago'></input>
      <span>20</span>
      <input type="radio" name='lenRows' checked="checked" onchange="deleteRow()"/>
      <span>75</span>
    <input type="radio" name='lenRows' onchange="insRow()"/>
    <div class='date-dict2 text-dark'></div>
    </caption>
    <tr>
      <td class='name-high'>-</td>
      <td class='change-high'>-</td>
      <td class='name-low'>-</td>
      <td class='change-low'>-</td>
    </tr>
    <tr>
      <td class='name-high'>-</td>
      <td class='change-high'>-</td>
      <td class='name-low'>-</td>
      <td class='change-low'>-</td>
    </tr>
    <tr>
      <td class='name-high'>-</td>
      <td class='change-high'>-</td>
      <td class='name-low'>-</td>
      <td class='change-low'>-</td>
    </tr>
    <tr>
      <td class='name-high'>-</td>
      <td class='change-high'>-</td>
      <td class='name-low'>-</td>
      <td class='change-low'>-</td>
    </tr>
    <tr>
      <td class='name-high'>-</td>
      <td class='change-high'>-</td>
      <td class='name-low'>-</td>
      <td class='change-low'>-</td>
    </tr>
    <tr>
      <td class='name-high'>-</td>
      <td class='change-high'>-</td>
      <td class='name-low'>-</td>
      <td class='change-low'>-</td>
    </tr>
    <tr>
      <td class='name-high'>-</td>
      <td class='change-high'>-</td>
      <td class='name-low'>-</td>
      <td class='change-low'>-</td>
    </tr>
    <tr>
      <td class='name-high'>-</td>
      <td class='change-high'>-</td>
      <td class='name-low'>-</td>
      <td class='change-low'>-</td>
    </tr>
    <tr>
      <td class='name-high'>-</td>
      <td class='change-high'>-</td>
      <td class='name-low'>-</td>
      <td class='change-low'>-</td>
    </tr>
    <tr>
      <td class='name-high'>-</td>
      <td class='change-high'>-</td>
      <td class='name-low'>-</td>
      <td class='change-low'>-</td>
    </tr>
    <tr>
      <td class='name-high'>-</td>
      <td class='change-high'>-</td>
      <td class='name-low'>-</td>
      <td class='change-low'>-</td>
    </tr>
    <tr>
      <td class='name-high'>-</td>
      <td class='change-high'>-</td>
      <td class='name-low'>-</td>
      <td class='change-low'>-</td>
    </tr>
    <tr>
      <td class='name-high'>-</td>
      <td class='change-high'>-</td>
      <td class='name-low'>-</td>
      <td class='change-low'>-</td>
    </tr>
    <tr>
      <td class='name-high'>-</td>
      <td class='change-high'>-</td>
      <td class='name-low'>-</td>
      <td class='change-low'>-</td>
    </tr>
    <tr>
      <td class='name-high'>-</td>
      <td class='change-high'>-</td>
      <td class='name-low'>-</td>
      <td class='change-low'>-</td>
    </tr>
    <tr>
      <td class='name-high'>-</td>
      <td class='change-high'>-</td>
      <td class='name-low'>-</td>
      <td class='change-low'>-</td>
    </tr>
    <tr>
      <td class='name-high'>-</td>
      <td class='change-high'>-</td>
      <td class='name-low'>-</td>
      <td class='change-low'>-</td>
    </tr>
    <tr>
      <td class='name-high'>-</td>
      <td class='change-high'>-</td>
      <td class='name-low'>-</td>
      <td class='change-low'>-</td>
    </tr>
    <tr>
      <td class='name-high'>-</td>
      <td class='change-high'>-</td>
      <td class='name-low'>-</td>
      <td class='change-low'>-</td>
    </tr>
    <tr>
      <td class='name-high'>-</td>
      <td class='change-high'>-</td>
      <td class='name-low'>-</td>
      <td class='change-low'>-</td>
    </tr>
  </table>
</div>

<script>
  let delta = {!! $delta !!};
  let delta1 = {!! $delta1 !!};
  let delta2 = {!! $delta2 !!};
  let delta3 = {!! $delta3 !!};
</script>

<script src="{{asset('currencies.js')}}"></script>
@endsection
