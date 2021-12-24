@extends('layout.app')
@section('content')

<div class='d-flex justify-content-around m-2 flex-wrap align-items-start'>
  <table class='table-sm table-dark table-bordered mt-2'>
    <caption style='caption-side: down'><small>Number of vacancies, percent without experience, number applicants on vacancy (from hh.ru)</small></caption>
    @foreach ($langs as $lang)
      <tr>
        @if ($lang->name == 'C%23')
          <td class='bg-dark text-light name_lang'>
          C#
          </td>
        @elseif($lang->name == 'cpp')
          <td class='bg-dark text-light name_lang'>
          C++
          </td>
        @else
          <td class='bg-dark text-light name_lang'>
          {{ $lang->name }}
          </td>
        @endif
        <td class='text-right val-now'>
          {{ $lang->val }}
        </td>
        <td class='text-right val_noexp-now'>
          {{ $lang->val_noexp }}
        </td>
        <td class='text-right res_vac-now'>
          {{ $lang->res_vac }}
        </td>
        <td class='text-right rate-today text-secondary bg-dark'>
          {{ $lang->rate }}
        </td>
      </tr>
    @endforeach
  </table>
  
  <table class='table-sm table-dark table-bordered mt-2'>
    <caption style='caption-side: down'><small>Number of vacancies, percent without experience, number applicants on vacancy (from hh.ru)</small></caption>
    @foreach ($langs2020 as $lang)
      <tr>
        @if ($lang->name == 'C%23')
          <td class='bg-dark text-light name_lang'>
          C#
          </td>
        @elseif($lang->name == 'cpp')
          <td class='bg-dark text-light name_lang'>
          C++
          </td>
        @else
          <td class='bg-dark text-light name_lang'>
          {{ $lang->name }}
          </td>
        @endif
        <td class='val-cndg-2020 text-right'>
          {{ $lang->cnd_val }}
        </td>
        <td class='val_noexp-cndg-2020 text-right'>
          {{ $lang->cnd_vn }}
        </td>
        <td class='res_vac-cndg-2020 text-right'>
          {{ $lang->cnd_rv }}
        </td>
        <td class='text-right text-secondary bg-dark'>
          {{ $lang->rate }}
        </td>
      </tr>
    @endforeach
  </table>

  <table class='table-sm table-dark table-bordered mt-2'>
    <caption style='caption-side: down'><small>Number of vacancies, percent without experience, number applicants on vacancy (from hh.ru)</small></caption>
    @foreach ($langs2021 as $lang)
      <tr>
        @if ($lang->name == 'C%23')
          <td class='bg-dark text-light name_lang'>
          C#
          </td>
        @elseif($lang->name == 'cpp')
          <td class='bg-dark text-light name_lang'>
          C++
          </td>
        @else
          <td class='bg-dark text-light name_lang'>
          {{ $lang->name }}
          </td>
        @endif
        <td class='val-cndg-2021 text-right'>
          {{ $lang->cnd_val }}
        </td>
        <td class='val_noexp-cndg-2021 text-right'>
          {{ $lang->cnd_vn }}
        </td>
        <td class='res_vac-cndg-2021 text-right'>
          {{ $lang->cnd_rv }}
        </td>
        <td class='text-right rate-to-march text-secondary bg-dark'>
          {{ $lang->rate }}
        </td>
      </tr>
    @endforeach
  </table>

  <div class='flex-wrap mt-4'>
    <div class='mb-3'><canvas id="line-chart" width="800" height="450"></canvas></div>
    <div class='radWin d-flex justify-content-around'>
      <div>
        <label>Window of rolling mean: <input type='radio' id='w7' name='win' value="7">7</label>
        <label><input type='radio' id='w14' name='win' value="14" checked="checked">14</label>
        <label><input type='radio' id='w28' name='win' value="28">28</label>
      </div>
    </div>
    <div class='pr-4'><canvas id="line-chart-avg" width="800" height="450"></canvas></div>
  </div>
  <script type="text/javascript">
    var receivedData  = {!! json_encode($graphs) !!};
    var receivedDataAvg  = {!! json_encode($graphsAvg) !!};
  </script>
<script src="{{asset('hh.js')}}"></script>
@endsection