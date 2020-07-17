$(document).ready(function () {


    $('form').on('submit', function (event) {
        let title = $('#name').val();
        let content = $('#content').val();
        let image = $('#image').val();

        let imageExt = image.split(/\./)[1];
        let imgArr = ['jpg', 'jpeg', 'png', 'svg'];

        if (title === '' || title.length < 3 || jQuery.type(title) !== 'string')
        {
            event.preventDefault();
            alert('wrong title');
        }
        if (content === '' || content.length < 10 || jQuery.type(content) !== 'string')
        {
            event.preventDefault();
            alert('wrong content');
        }
        if (!imgArr.includes(imageExt) && imageExt !== undefined)
        {
            event.preventDefault();
            alert('wrong image ext');
        }
    });

})
