
var menuItem = document.querySelectorAll('.item-menu')

//Remove a classe ativo de todos os itens e adiciona no que foi selecionado
function linkSelection(){
    menuItem.forEach((item)=>
        item.classList.remove('ativo')
    )
    this.classList.add('ativo')
}

//Escutador de eventos
//Checa qual item foi clicado no menu
menuItem.forEach((item)=>
    item.addEventListener('click', linkSelection)
)

//Expandir o menu
var btnExp = document.querySelector('#btn-exp')
var sideMenu = document.querySelector('.menu-lateral')
var aparecer = document.querySelectorAll('.txt-link')

//Cria e adiciona a classe expandir pelo click
btnExp.addEventListener('click', function(){
    //toggle = se existir tira senao cria
    sideMenu.classList.toggle('expandir')

    aparecer.forEach((sa)=>
        sa.classList.toggle('aparecer')
    )
})


