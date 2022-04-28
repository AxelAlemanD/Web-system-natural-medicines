
function custom_template(obj){
    var data	= $(obj.element).data();
    var text	= $(obj.element).text();
    text1 		= text.split("$");
    title		= text1[0];
    description	= text1[1];

    if(data && data['img_src']){
        img_src = data['img_src'];
        template = $("<div class='opciones'><img class='opcionImg' src=\"" + img_src + "\"/><div class='opcionInfo'><p class='opcionTxt'>" + title + "<p class='text-muted descrpition text-wrap'>" + description + "</p></p></div></div>");
        return template;
    }
    else{
        template = $("<div class='opciones'><p >" + text + "</p></div>");
        return template;
    }

}

var options = {
    'templateSelection': custom_template,
    'templateResult': custom_template,
}
$('.platillos').select2(options);
$($('.platillos').data('select2').$container).addClass('carclass');
