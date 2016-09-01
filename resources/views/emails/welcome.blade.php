<h1>Clinks - Analysee</h1>

<div>
******* texto do db **********

{!! $texto !!}


*****************************
</div>

<h3>Relatório de 'teste' no periodo {{ date('d-m-Y', strtotime('today -1 month')) }} á {{ date('d-m-Y',strtotime('today')) }}</h3>

<p>Clique aqui para Acessar seu relatório: <a href="{{ $link = $attach }}"> Visualize aqui </a></p>