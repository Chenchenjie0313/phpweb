@extends('common.layout')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/top.css')}}" media="all">
@endsection

@section('header')
  @include('parts.header')
@endsection

@section('path')
  @include('parts.path',['path'=>'イベント'])
@endsection

@section('bxslider')
  @include('parts.bxslider')
@endsection

@section('content')
  @include('parts.event')
@endsection

@section('scripts')
@endsection