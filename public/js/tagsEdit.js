$(document).ready(function () {
    $('#tag').hide();
    $('#tagsList').css({'list-style':'none','width':'25%', 'max-height': '250px', 'overflow': 'auto'});
    function addLi(tag)
    {
        let $tag_li = $('<button data-id="delete" ' +
            'type="button"' +
            ' class="btn-outline-danger rounded-circle float-left " > - </button>' +
            '<li class="ml-4">'+ tag +'</li>' +
            '<br>');
        return $('#tagsList').prepend($tag_li);
    }
    function deleteLi()
    {
        $('[data-id=delete]').on('click', function () {
            let $li = $(this).next('li').text();
            $('#tag option').each(function () {
                let $option_li = $(this).val();
                if ($option_li === $li)
                {
                    $(this).remove();
                }
            })
            $(this).next('li').remove();
            $(this).remove();
        });
    }
    $('#addTag').on('click', function () {
        let $tag = $('#tags').val();
        if ($tag !== '' && $tag.length > 2 &&  jQuery.type($tag) === 'string')
        {
            addLi($tag);
            let $tagSelect = $('<option>', {value:$tag.trim(),text:$tag.trim()});
            $tagSelect.prop('selected', true);
            $('#tag').prepend($tagSelect);
        }else
        {
            alert('wrong tag input');
        }
        deleteLi();
    });
    $('#tag option:selected').each(function () {
        let $tag = $(this).val();
        addLi($tag);
    });
    deleteLi();


})
