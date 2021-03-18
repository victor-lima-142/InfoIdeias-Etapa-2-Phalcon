{% extends 'layouts/index.volt' %}

{% block content %}

<div id="cadastro_ticket" class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="glyphicon glyphicon-plus"></i>
                &nbsp;Cadatrar Notícia
            </div>
            {{ form('noticias/salvar', 'method': 'post', 'enctype' : 'multipart/form-data', 'name':'cadastrar',
            'id':'formulario-cadastro') }}
            <div class="panel-body">
                <div class="col-md-12" id="conteudo">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <label for="Titulo">Título <span class="error">(*)<span></label>
                                    {{ text_field("titulo", "width": '100%', "class": 'form-control') }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <label for="Texto">Texto</label>
                                    {{ text_area("texto", "class": 'form-control tinymce-editor') }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <label for="Categoria">Categoria</label>
                                    <select name="categoria" class="form-control" id="categoria">
                                        <option selected>Escolher categoria</option>
                                        {% for categoria in categorias %}
                                        <option value="{{categoria.id}}">{{categoria.nome}}</option>
                                        {% endfor %}
                                    </select>
                                </div>
                            </div>
                        </div>{#/.panel-body#}
                    </div>{#/.panel#}
                    <div class="row" style="text-align:right;">
                        <div id="buttons-cadastro" class="col-md-12">
                            <a href="{{ url(['for':'noticia.lista']) }}" class="btn btn-default">Cancelar</a>
                            {{ submit_button('Gravar', "class": 'btn btn-primary', "id":'envia') }}
                        </div>
                    </div>
                </div>{#/.conteudo#}
            </div>{#/.panel-body#}
            {{ end_form() }}
        </div>{#/.panel#}
    </div>{#/.col-md-12#}
</div><!-- row -->

{% endblock %}

{% block extrafooter %}

<script>
    $(document).ready(function () {
    });
</script>
{% endblock %}