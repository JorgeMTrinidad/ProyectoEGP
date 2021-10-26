@extends('principal')
@section('contenido')
<main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="/">SISTEMA DE INGRESOS - EGRESOS</a></li>
            </ol>
            <svg viewBox="0 0 960 300">
                <symbol id="s-text">
                    <text text-anchor="middle" x="50%" y="80%">Proyecto EGP</text>
                </symbol>

                <g class = "g-ants">
                    <use xlink:href="#s-text" class="text-copy"></use>
                    <use xlink:href="#s-text" class="text-copy"></use>
                    <use xlink:href="#s-text" class="text-copy"></use>
                    <use xlink:href="#s-text" class="text-copy"></use>
                    <use xlink:href="#s-text" class="text-copy"></use>
                </g>
            </svg>

            <style>
                @import url(https://fonts.googleapis.com/css?family=Montserrat);

html, body{
  height: 100%;
  font-weight: 100;
}

body{
  background: #9ca7ac;
  font-family: Arial;
}

svg {
    display: block;
    font: 6.3em 'Montserrat';
    width: 960px;
    height: 300px;
    margin: 0 auto;
}

.text-copy {
    fill: none;
    stroke: white;
    stroke-dasharray: 6% 29%;
    stroke-width: 5px;
    stroke-dashoffset: 0%;
    animation: stroke-offset 5.5s infinite linear;
}

.text-copy:nth-child(1){
	stroke: #000000;
	animation-delay: -1;
}

.text-copy:nth-child(2){
	stroke: #130f0f;
	animation-delay: -2s;
}

.text-copy:nth-child(3){
	stroke: #201e1e;
	animation-delay: -3s;
}

.text-copy:nth-child(4){
	stroke: #20201e;
	animation-delay: -4s;
}

.text-copy:nth-child(5){
	stroke: #ffffff;
	animation-delay: -5s;
}

@keyframes stroke-offset{
	100% {stroke-dashoffset: -35%;}
}
            </style>


        </main>

@endsection
