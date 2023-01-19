<?php

namespace  App \ Http \ Controllers ;

use  App \ Modelos \ Todo ;
use  Illuminate \ Http \ Request ;

classe  TodoController  estende  Controller
{
    /**
     * Exibir uma listagem do recurso.
     *
     * @return \Illuminate\Http\Response
     */
     índice de função  pública ()
    {
        $ usuario = auth()-> usuario ();

        $ is_complete_counter = 0 ;

        $ todos = Todo :: where ( 'user_id' , $ user -> id )-> get ();

        foreach ( $ todos  as  $ todos ) {
            if ( $ todo -> is_complete == false ) {
                $ is_complete_counter += 1 ;
            }
        }

        return view( 'dashboard' , compact( 'user' , 'todos' , 'is_complete_counter' ));
    }

    /**
     * Armazene um recurso recém-criado no armazenamento.
     *
     * @param \App\Http\Requests\Request $request
     * @return \Illuminate\Http\Response
     */
     loja de função  pública ( Requisição $ requisição ) 
    {
        tente {
            $ usuario = auth()-> usuario ();

            $ atributos = $ pedido -> apenas ([
                'título' ,
                'descrição' ,
                'cor'
            ]);

            $ attribute [ 'user_id' ] = $ user -> id ;

            $ todo = Todo :: criar ( $ atributos );
        } catch ( \ Throwable  $ th ) {
            logger()-> erro ( $ th );
            return redirect( '/todos/create' )-> with ( 'error' , 'Erro ao criar TODO' );
        }

        return redirect( '/dashboard' )-> with ( 'success' , 'TODO criado com sucesso' );
    }

    /**
     * Complete o recurso especificado no armazenamento.
     *
     * @param \App\Models\Todo $todo
     * @return \Illuminate\Http\Response
     */
     função  pública completa ( Todo  $ todo )
    {
        tente {
            $ usuario = auth()-> usuario ();

            // Verifica se TODO é do usuário
            if ( $ todo -> user_id !== $ user -> id ) {
                return resposta( '' , 403 );
            }

            $ todo -> atualização ([ 'is_complete' => true ]);
        } catch ( \ Throwable  $ th ) {
            logger()-> erro ( $ th );
            return redirect( '/dashboard' )-> with ( 'error' , 'Erro ao concluir TODO' );
        }

        return redirect( '/dashboard' )-> with ( 'success' , 'TODO concluído com sucesso' );
    }

    /**
     * Remova o recurso especificado do armazenamento.
     *
     * @param \App\Models\Todo $todo
     * @return \Illuminate\Http\Response
     */
     função  pública destruir ( $ todo )
    {
        tente {
            // Verifica se TODO é do usuário
            $ usuario = auth()-> usuario ();

            $ todo = Todo :: find ( $ todo );

            if ( $ todo -> user_id !== $ user -> id ) {
                return resposta( '' , 403 );
            }

            $ todo -> deletar ();
        } catch ( \ Throwable  $ th ) {
            logger()-> erro ( $ th );
            return redirect( '/dashboard' )-> with ( 'error' , 'Erro ao deletar TODO' );
        }

        return redirect( '/dashboard' )-> with ( 'success' , 'TODO deletado com sucesso' );
    }
}
