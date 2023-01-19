@extends ( ' layouts.aplicativo ' )

@seção ( ' título ' , ' | Painel ' )

@seção ( ' conteúdo ' )
    < a  href = " {{ route ( ' logout ' ) } } "   class = " position-absolute top-0 end-0 link-secondary p-3 " >
        < i  class = " bi-box-arrow-right fs-3 " ></ i >
    </a> _ _
    < div  class = " min-vh-100 d-flex justify-content-center align-items-center " >
        < div  class = " shadow-lg p-3 bg-dark text-white rounded p-5 "  style = " width : 850 px ; min-height : 300 px ; " >
            < h1 >Tarefas</ h1 >
            < small  class = " text-info " > {{ $is_complete_counter } } ativas</ small >  
            < form  action = " /todos "  metodo = " post "  class = " mt-3 " >
                @csrf
                < div  class = " grupo de entrada " >
                    < div  class = " input-group-text bg-white p-0 " >
                        < input  type = " color "  class = " form-control form-control-color border-0 "  name = " color "  title = " Escolha uma cor " >
                    </ div >
                    < input  type = " text "  class = " form-control "  name = " title "  placeholder = " O que fazer? "  required >
                    < tipo de botão  = " enviar " classe = " btn btn-secondary " > 
                        < i  class = " bi bi-plus fs-4 " ></ i >
                    </ botão >
                </ div >
            </ forma >
            < h >
            < ul  class = " lista-grupo lista-grupo-flush " >
                @foreach ( $todos  como  $ todos )
                    < li  class = " lista-grupo-item d-flex justificar-conteúdo-entre alinhar-itens-centro bg-transparente texto-branco " >
                        < div  class = " d-flex align-items-center " >
                            < span  class = " badge rounded-pill me-2 "  style = " background-color : {{ $todo-> color ?? ' #FFFFFF ' }} " > & nbsp ; </ span >
                            @if ( $todo -> is_complete )
                                < del > {{ $todo -> titulo } } </ del >  
                            @outro
                                {{ $todo -> título } }  
                            @fim se
                        </ div >
                        < div  class = " d-flex align-items-center " >
                            < a  href = " /todos/ {{ $todo -> id } } /edit "    class = " text-light " >
                                < i  class = " bi bi-lápis fs-4 " ></ i >
                            </a> _ _
                            @if ( ! $todo -> is_complete )
                                < a  href = " /todos/ {{ $todo -> id } } /complete "    class = " text-light ms-2 " >
                                    < i  class = " bi-check2-square fs-4 " ></ i >
                                </a> _ _
                            @fim se
                            < form  action = " /todos/ {{ $todo -> id } } "    method = " post "  class = " ms-2 " >
                                @csrf
                                @método ( ' apagar ' )
                                < tipo de botão  = " enviar " estilo = " all : unset ; cursor : ponteiro ; " > 
                                    < i  class = " bi-x-octagon fs-4 " ></ i >
                                </ botão >
                            </ forma >
                        </ div >
                    </ li >
                @endforeach
            </ ul >
        </ div >
    </ div >
@endsection