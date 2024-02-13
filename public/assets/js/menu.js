function cargarMenuPrincipal() {

    let url = setBaseURL() + "obtener/menu/0";

    $.ajax({
        url: url,
        method: "GET",
        dataType: 'json',
    }).done(function (data) {
        console.log(data);

        let menuItems = data.Cls_MenuDoctos;

        for (let index = 0; index < menuItems.length; index++) {
            const element = menuItems[index];
            let item = `
                <li class="dropdown">
                    <a id="menu_${element.id_menu}" data-id="${element.id_menu}" 
                        class="nav-link dropdown-toggle text-white" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false" 
                        onmouseover="submenus(this)" onmouseout="eliminarSubmenus(this)">
                        ${element.descripcion}
                    </a>
                    <ul id="subMenu_${element.id_menu}" class="dropdown-menu">

                    </ul>
                </li>
            `;

            $("#listaMenus").append($("<li>").html(item));

        }


    }).fail(function (e) {
        console.log("Request: " + JSON.stringify(e));
    });
}

function submenus(elemento) {
    
    let idMenu = $(elemento).data("id");
    let link = $(elemento).attr('href');

    if (link == "#") {
        console.log('verificar si hay mas menus');

        let url = setBaseURL() + "obtener/menu/" + idMenu;

        $.ajax({
            url: url,
            method: "GET",
            dataType: 'json',
        }).done(function (data) {
            console.log(data);

            let idSubmenu = "#subMenu_" + idMenu;
            let menuItems = data.Cls_MenuDoctos;

            for (let index = 0; index < menuItems.length; index++) {
               
                const element = menuItems[index];
                console.log(element);
                let item = `
                    <li>
                        <a class="dropdown-item" target="_blank" href="${element.url_destino}">
                            ${element.descripcion}
                        </a>
                    </li>
                `;

                $(idSubmenu).append($("<li>").html(item));

            }


        }).fail(function (e) {
            console.log("Request: " + JSON.stringify(e));
        });
    }
    else {
        console.log('no hay mas submenus');
    }

}


function eliminarSubmenus(elemento) {
    $(elemento).remove($('<li>'));
}

