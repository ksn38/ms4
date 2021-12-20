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
  

@endsection