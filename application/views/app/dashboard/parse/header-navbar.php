<?php
$CI =& get_instance();
?>
<header class="mn-header navbar-fixed">
    <nav class="indigo darken-4">
        <div class="nav-wrapper row">
            <section class="material-design-hamburger navigation-toggle">
                <a href="#" data-activates="slide-out" class="button-collapse show-on-large material-design-hamburger__icon">
                    <span class="material-design-hamburger__layer"></span>
                </a>
            </section>
            <div class="header-title col s3">
                <span class="chapter-title"><img src="<?= PATH_PUBLIC_IMG."/logotamy.png" ?>" width="55px" alt="<?= NAME_SITE ?>"></span>
            </div>
            <!--<form class="left search col s6 hide-on-small-and-down">
                <div class="input-field">
                    <input id="search" type="search" placeholder="Buscar" autocomplete="off">
                    <label for="search"><i class="material-icons search-icon">search</i></label>
                </div>
                <a href="javascript: void(0)" class="close-search"><i class="material-icons">close</i></a>
            </form>-->
            <ul class="right col s9 m3 nav-right-menu">

                <!--<li><a href="javascript:void(0)" data-activates="chat-sidebar" class="chat-button show-on-large"><i class="material-icons">more_vert</i></a>
                </li>-->
                
                <li>
                    <a href="javascript:void(0)" data-activates="dropdown1" class="dropdown-button dropdown-right show-on-large">
                        <i class="material-icons">shopping_cart</i>
                        <span class="badge" id="count-order">0</span>
                    </a>
                </li>

                <li>
                    Semana <?= date("W") ?>
                </li>

                
            </ul>
            <ul id="dropdown1" class="dropdown-content notifications-dropdown">
                <li class="notificatoins-dropdown-container">
                    <ul>
                        <li class="notification-drop-title">Compras no confirmadas</li>
                        <div id="order-peding">
                        
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
<script type="text/javascript">
    $(function() {
        loadOrder = function() {
            $.getJSON('<?= URL_WEB ?>cart/find-order-pending-store', function(json, textStatus) {
                $("#count-order").empty().html(json.count.tosss);
                var li = '';
                $.each(json.list, function(index, val) {
                    li += ' <li>' +
                        '<a href="<?= URL_WEB ?>mi-carrito?store=' + val.id + '">' +
                        '<div class="notification">' +
                        '<div class="notification-icon circle cyan"><i class="material-icons">store</i></div>' +
                        '<div class="notification-text"><p><b>' + val._store + '</b> </p><span>$ ' + number_format(val.t, 2, ",", ".") + '</span></div>' +
                        '</div>' +
                        '</a>' +
                        '</li>';
                });

                $("#order-peding").empty().append(li);
            });
        };
        loadOrder();

        $(".chat-button").sideNav({edge:"right"})

        var ws;
        var date = new Date();
        var fecha = date.getHours()+":"+date.getMinutes()+":"+date.getSeconds();

                iniciarWebsocket = function() {
                    ws = new WebSocket('ws://achex.ca:4010');

                    ws.onopen = function() {
                        ws.send('{"setID":"tamymayorista", "passwd":"12345"}');
                    };
                    ws.onmessage = function(message) {
                        var ob = jQuery.parseJSON(message.data);
                        if (ob.user != null && ob.text != null) {
                            //$("#items-chat").append(ob.user+" - "+ob.text+"-"+ob.date+" <br>");
                            if(ob.user == '<?= $this->session->userdata("nickname") ?>'){
                                return false;
                            }
                            else{
                                $(".chat-list").html('<a href="javascript:void(0)" class="chat-message">'+
                                '<div class="chat-item">'+
                                '<div class="chat-item-image">'+
                                        '<img src="'+ob.picture+'" width="55px">'+
                                    '</div>'+
                                    '<div class="chat-item-info">'+
                                        '<p class="chat-name">'+ob.user+'</p>'+
                                        '<span class="chat-message">'+ob.date+'</span>'+
                                    '</div> </div></a>');
                            }
                        }

                    };
                    ws.onclose = function() {
                        $(".chat-list").html('');
                    };
                };

                //iniciarWebsocket();

                $("#send").click(function(event) {

                    var date = new Date();
                    var msg = {
                            type: "messages",
                            user: '<?= $this->session->userdata("nickname") ?>',
                            picture: '<?= PATH_PUBLIC_IMG."/logotamy.png" ?>',
                            text: "hola",
                            to: 'tamymayorista',
                            date: date.getHours()+":"+date.getMinutes()+":"+date.getSeconds()
                        };
                        ws.send(JSON.stringify(msg));
                });

                loadUsers = function(){
                    var date = new Date();
                    var msg = {
                            type: "messages",
                            user: '<?= $this->session->userdata("nickname") ?>',
                            picture: '<?= PATH_PUBLIC_IMG."/logotamy.png" ?>',
                            text: "hola",
                            to: 'tamymayorista',
                            date: date.getHours()+":"+date.getMinutes()+":"+date.getSeconds()
                        };
                        ws.send(JSON.stringify(msg));
                };      
    });
</script>