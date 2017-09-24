

function ctm_left_menu_mkactive() {
    var ctm_current_url = window.location.href;
    var ctm_cuturl = ctm_current_url;
    var ctm_dataurl = ctm_cuturl.split("?");
    var ctm_pathname = window.location.pathname;
//    alert(ctm_dataurl.length);
    if (ctm_dataurl.length > 1) {
        $("#ctm_left_menu").find("li.active").removeClass("active");
        $("#ctm_left_menu").find("li a[href='" + ctm_current_url + "']").parent().parent().parent().addClass("active");
        $("#ctm_left_menu").find("li a[href='" + ctm_current_url + "']").parent().addClass("active");
    }
}
function selection() {
    $('#box2View option').prop('selected', true);
//    alert("pez");
}
function toggle_pass() {
    $(".passphrase_users").toggle();
}
function cargar_ciudades() {

    $("#ctm-country").change(function () {
        var selected = $("option:selected", this);
        var value = this.value;
//    alert(value);
        $.ajax({
            type: "POST",
            url: "../ajax/cargar_ciudades.php",
            data: {fk_id_country: value},
            success: function (msg) {
//                alert(msg);
                $("#ctm-cities").attr("disabled");
                $("#ctm-cities").text("");
                $("#ctm-cities").append(msg);
                $("#ctm-cities").removeAttr("disabled");
            },
            error: function (msg) {
                alert(msg);
            }
        });
    });
}
function upload_image(where, who) {
//    alert("llegar");
    if (where == 0) {
        //alumns
        where = "persona";
    } else {
        if (where == 1) {
            //aulas
            where = "aula";
        }
    }
    var formatos_validos = ["gif", "jpg", "png", "JPG", "PNG", "JPEG", "GIF"];
    var fileInput = $('#ctm-upload-images-input-aulas');
    var formato = fileInput.val();
    formato = formato.split(".");
    formato = formato[formato.length - 1];
    var url = window.location.href;
    if ((fileInput.val() != "") && (formatos_validos.indexOf(formato) != "-1")) {
        $("#ctm-btn-steps").addClass("loading").removeClass("btn-primary").attr("disabled", "disabled");
//        $("#ctm-pictures-form button").prop("disabled", true);
        regexp = /^[^[\]]+/;
        var files = $(fileInput)[0].files;
        var fileInputName = regexp.exec(fileInput.attr('name'));
        var data = new FormData();
        for (i = 0; i < files.length; i++) {
            var file = files[i];
            data.append('newImage[]', file, file.name);
        }
        if (who) {
            id = who;
        } else {
            var id = url.split("=");
            id = id[1];
        }
        data.append("from", where);
        data.append("id", id);
        $.ajax({
            type: "POST",
            url: "ajax/upload_images.php",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (msg) {
//              console.log(msg);
                window.location = url;
            },
            error: function (msg) {
//                alert(msg);
            }
        });
    } else {
        alert("Imagen no selecionada o Formato no valido");
    }
}
function gotofullcal(e) {
    window.location = 'admin.gestor-energetico.com/?calendar=' + e;

}
$(document).ready(function () {
    $('#ctm-calendar span i').click(function(){
        var e = $(this).attr('class');
        gotofullcal(e);
    });
//    $('body').mousemove(function () {
//        selection();
//    });
//    alert("aldjsladjsasdlkdjsld");
    ctm_left_menu_mkactive();
    cargar_ciudades();
    var descuento = 0;
    var h = $(document).height();
//    alert(((60 * h)/100));
    $('.chat.ctm-crono-noticias').css({
        "height": ((53 * h) / 100) + "px"
    });
    $('#ctm-task-service').on("change", function () {
        var value = this.value;
        $.ajax({
            type: "POST",
            url: "../ajax/get_servicio.php",
            data: {id: value, option_1: "price_servicio", option_2: "price_servicio2"},
            success: function (msg) {
//                alert(msg);
                msg = msg.split(",");
                $("#ctm_precio_servicio span").text(msg[0]);
                if (msg[1] === parseInt(msg[1], 10)) {
                } else {
                    msg[1] = parseInt(msg[1]);
                }
//                alert(msg[1]);
                $("#ctm_precio_servicio_dos span").text(msg[1]);
                var descuento = $("#ctm_descuento_servicio_value").val();
                if (descuento === parseInt(descuento, 10)) {
                } else {
                    descuento = parseInt($("#ctm_descuento_servicio_value").val());
                    if (NaN(descuento)) {
                        descuento = 0;
                    }
                }
                var suma = (parseInt(msg[0]) + parseInt(msg[1])) - parseInt(descuento);

                $("#ctm_precio_servicio_total span").text(suma);
            },
            error: function (msg) {
                $("#ctm_precio_servicio span").text(0);
//                alert(msg);
            }
        });
    });
    $('#ctm_descuento_servicio_value').on("change", function () {
        var precio_1 = parseInt($("#ctm_precio_servicio span").text());
        var precio_2 = parseInt($("#ctm_precio_servicio_dos span").text());
        var descuento = parseInt($("#ctm_descuento_servicio_value").val());
        $("#ctm_precio_servicio_descuento span").text(descuento);
        $("#ctm_descuento_box").show();
        $("#ctm_precio_servicio_total span").text((precio_1 + precio_2) - descuento);
    });

    var doc_api = new jsPDF();
    var specialElementHandlers_ctm = {
        '#editor': function (element, renderer) {
            return true;
        }
    };

    $('#get-pdf').click(function () {
        html2canvas($("#printable"), {
            onrendered: function (canvas) {
                var imgData = canvas.toDataURL(
                        'image/png');
                var doc = new jsPDF('p', 'mm');
                doc.addImage(imgData, 'PNG', 10, 10);
                doc.save('sample-file.pdf');
            }
        });
    });
});