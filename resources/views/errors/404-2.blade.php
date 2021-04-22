@extends('frontend.layout.template')

@section('title', 404)

@section('description', 404)

@section('keywords', '')

@section('image', '')

@section('url', '')

@section('content')

<style>
    .fixed-menu {
        background-image: url('{{ url('/assets/images/bg_header.png') }}');
        background-position: top center;
        background-size: cover;
        height: 160px;
        position: relative;
    }
</style>

    <section class="error404">
        <article class="container" data-aos="fade-up" data-aos-duration="2000">
            
            <div class="row">
                
                <div class="col-md-12 noticia" data-aos="fade-up">
                   
                    <div class="title-article-404">
                        <h2><img src="{{ url('/assets/icones/icon-404.png') }}" class="icon-404 icon-title-404"> 404</h2>
                        <p>Desculpe, a página que você está tentando acessar não foi encontrada!</p>
                    </div>
                
                </div>

            </div>

        </article>
    </section>
    
@endsection