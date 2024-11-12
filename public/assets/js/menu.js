function cargarMenuPrincipal() {

    let url = setBaseURL() + "obtener/menu/0";

    $.ajax({
        url: url,
        method: "GET",
        dataType: 'json',
    }).done(function (data) {
        console.log(data);

        let menuItems = data.Cls_MenuDoctos

        /**
         * onmouseover="submenus(this)"
         * onclick="submenus(this)"
         */

        for (let index = 0; index < menuItems.length; index++) {
            const element = menuItems[index];
            let item = `
                <div class="dropdown">
                    <a id="menu_${element.id_menu}" data-id="${element.id_menu}" 
                        class="nav-link dropdown-toggle text-white" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false" 
                        onmouseover="submenus(this)" onmouseout="eliminarSubmenus('#subMenu_${element.id_menu}')">
                        ${element.descripcion}
                    </a>
                    <div id="subMenu_${element.id_menu}" class="dropdown-menu">

                    </div>
                </div>
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
            console.log(data.Cls_MenuDoctos.descripcion);

            let idSubmenu = "#subMenu_" + idMenu;
            let item = "";

            if (data.Cls_MenuDoctos.descripcion == undefined || data.Cls_MenuDoctos.descripcion == null) {

                let menuItems = data.Cls_MenuDoctos.sort((a, b) => a.orden - b.orden);

                for (let index = 0; index < menuItems.length; index++) {

                    const element = menuItems[index];
                    console.log(element);

                    if (element.url_destino == "" || element.url_destino == null) {

                        item = item + `
                            <div class="dropend">
                                <a id="menu_${element.id_menu}" data-id="${element.id_menu}" class="dropdown-item" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                                    onclick="submenus(this)">
                                    ${element.descripcion}
                                </a>
                                <div id="subMenu_${element.id_menu}" class="dropdown-menu">
                                    
                                </div>
                            </div>
                        `;

                    } else {

                        item = item + `
                            <div>
                                <a  class="dropdown-item" target="_blank" href="${element.url_destino}">
                                    ${element.descripcion}
                                </a>
                            </div>
                        `;

                    }

                }

            }
            else {
                item = item + `
                <div>
                    <a  class="dropdown-item" target="_blank" href="${data.Cls_MenuDoctos.url_destino}">
                        ${data.Cls_MenuDoctos.descripcion}
                    </a>
                </div>
            `;
            }

            $(idSubmenu).html(item);



        }).fail(function (e) {
            console.log("Request: " + JSON.stringify(e));
        });
    }
    else {
        console.log('no hay mas submenus');
    }

}

function eliminarSubmenus(elemento) {
    console.log('eleiminarmenus');
    $(elemento).empty();
}


//! nueva funcion de carga de menu
function cargarMenuTest() {
    let url = setBaseURL() + "obtener/menu/0";

    $.ajax({
        url: url,
        method: "GET",
        dataType: 'json',
    }).done(function (data) {
        //console.log(data);

        let menuItems = data.Cls_MenuDoctos

        /**
         * onmouseover="submenus(this)"
         * onclick="submenus(this)"
         */

        for (let index = 0; index < menuItems.length; index++) {
            const element = menuItems[index];
            //console.log(element);

            // onmouseover="submenus(this)" onmouseout="eliminarSubmenus('#subMenu_${element.id_menu}')"

            let item = `
                <div class="dropdown">
                    <a id="menu_${element.id_menu}" data-id="${element.id_menu}" 
                        class="nav-link dropdown-toggle text-white" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        ${element.descripcion}
                    </a>
                    <div id="subMenu_${element.id_menu}" class="dropdown-menu">

                    </div>
                </div>
            `;

            $("#listaMenus").append($("<li>").html(item));

            crearSubmenus(element);

        }


    }).fail(function (e) {
        console.log("Request: " + JSON.stringify(e));
    });

}

function crearSubmenus(elemento) {
    let idMenu = elemento.id_menu;
    let link = elemento.url_destino;

    if (link == "") {
        //console.log('verificar si hay mas menus');

        let url = setBaseURL() + "obtener/menu/" + idMenu;
        //console.log(url);


        $.ajax({
            url: url,
            method: "GET",
            dataType: 'json',
        }).done(function (data) {
            //console.log(data.Cls_MenuDoctos);

            let idSubmenu = "#subMenu_" + idMenu;
            let item = "";

            if (data.Cls_MenuDoctos.descripcion == undefined || data.Cls_MenuDoctos.descripcion == null) {

                let menuItems = data.Cls_MenuDoctos.sort((a, b) => a.orden - b.orden);

                for (let index = 0; index < menuItems.length; index++) {

                    const element = menuItems[index];
                    //console.log(element);

                    if (element.url_destino == "" || element.url_destino == null) {

                        item = item + `
                            <div class="dropend">
                                <a id="menu_${element.id_menu}" data-id="${element.id_menu}" class="dropdown-item" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                                    onclick="submenus(this)">
                                    ${element.descripcion}
                                </a>
                                <div id="subMenu_${element.id_menu}" class="dropdown-menu">
                                    
                                </div>
                            </div>
                        `;

                    } else {

                        item = item + `
                            <div>
                                <a  class="dropdown-item" target="_blank" href="${element.url_destino}">
                                    ${element.descripcion}
                                </a>
                            </div>
                        `;

                    }

                }

            }
            else {
                item = item + `
                <div>
                    <a  class="dropdown-item" target="_blank" href="${data.Cls_MenuDoctos.url_destino}">
                        ${data.Cls_MenuDoctos.descripcion}
                    </a>
                </div>
            `;
            }

            $(idSubmenu).html(item);



        }).fail(function (e) {
            console.log("Request: " + JSON.stringify(e));
        });
    }
    else {
        //console.log('no hay mas submenus');
    }

}