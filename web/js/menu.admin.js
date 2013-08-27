
function saveItem() {
    //controle de atualização de item
    $('.save').unbind('click').click(function() {
        span = $(this).parents('li:first').find(' > span');
        $.post($(this).data('url'), $(this).parent('form').serialize(), function(theResponse) {
            span.html(theResponse);
        });
    });
}

function removeItem() {
    //controle de remoção
    $('.remove').unbind('click').click(function() {
        target = $(this).parents('li').get(0);
        $.post($(this).data('url'), {id: $(this).parent('form').data('id')}, function() {
            target.remove();
        });
    });
}

function displayControl() {
    //Exibição de edit-block para atualização de valores do menu
    $("#list ul li .trigger-block").each(function() {
        $(this).unbind('click').css('cursor', 'pointer').click(function() {
            $(this).nextUntil('.edit-block').next('.edit-block').fadeToggle();
        });
    });
}

function startSortable() {
    $("#list ul").sortable({placeholder: "ui-state-highlight", connectWith: ".connectedSortable", opacity: 0.6, update: function() {
            var order = $(this).sortable("serialize") + "&arrayorder[parent]=" + $(this).data('parent');
            $.post($('#updateAction').val(), order, function(theResponse) {
                $("#response").html(theResponse);
                $("#response").fadeIn('slow');
                $("#response").delay(3000).fadeOut('slow');
            });
            if ($(this).find('li').length > 0) {
                $(this).removeClass('empty');
            } else {
                $(this).addClass('empty');
            }
        }
    });
}

$(function() {
    // Controle para ordenar a lista
    $("#response").hide();
    startSortable();
    displayControl();

    //Controle de criação e adição de novo menu na lista
    $('.add').click(function() {
        form = $(this).parents('form');
        $.post(form.attr('action'), form.serialize(), function(theResponse) {
            $("#list > ul").append(theResponse);

            displayControl();
            removeItem();
            saveItem();
            startSortable();

            form[0].reset();
        });
    });

    removeItem();
    saveItem();
})