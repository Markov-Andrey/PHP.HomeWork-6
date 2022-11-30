let del;
let content;
let contextMenu = document.querySelectorAll('.context-menu');
let contextMenuOpen = document.querySelector('.context-menu-open');
for (let i = 0; i < contextMenu.length; i++){
    //готовое решение открытия меню
    contextMenu[i].addEventListener('contextmenu', function(e) {
        e.preventDefault();
        contextMenuOpen.style.left = e.clientX + 'px';
        contextMenuOpen.style.top = e.clientY + 'px';
        contextMenuOpen.style.display = 'block';

        //создание параметра
        content = "" + contextMenu[i];
        content = content.split('=')[1];
    });
}

window.addEventListener('click', function() {
    contextMenuOpen.style.display = 'none';
});

function buttonDelete(){
  elem = document.querySelector('#del');
  elem.href = "?ctlg=" + content + "&status=del";
}