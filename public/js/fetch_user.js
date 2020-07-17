$(document).ready(function() {

    Pusher.logToConsole = true;
    const pusher = new Pusher('b7a251164dc429135185', {
        cluster: 'eu',
        encrypted: true,
        authEndpoint: '/pusherAuth',
        auth: {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }
    });
    let id = $('.currentUser').attr('id');
    let channel = pusher.subscribe('private-chatbox_'+id);
    channel.bind('MessageSend', function(data) {
        let to_user_id = $('.send_chat').attr('id');
        console.log(JSON.stringify(data));
        data.message = data.message.message;
        data.username = data.user.name;
        let today = new Date;
        data.updated_at = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate() + ' '+ today.getHours()+ ':'+ today.getMinutes()+ ':' + today.getSeconds();
        $('#messageTmpl').tmpl(data).appendTo('#chat_history_'+to_user_id);
        $('#chat_history_'+to_user_id).scrollTop($('#chat_history_'+to_user_id)[0].scrollHeight);
    });
    fetch_user();

    function fetch_user() {
        let html = '';
        $.get("/getUsers")
            .done((data) => {
                console.log(data);
                $('#user_model_details').empty();
                $('#userTempl').tmpl(data).appendTo('#user_model_details');
            });
    }

    function make_chat_dialog_box(to_user_id, to_user_name)
    {
        let modal_content = '<div id="user_dialog_'+to_user_id+'" class="user_dialog" title="You have chat with '+to_user_name+'">';
        modal_content += '<div style="height:400px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="'+to_user_id+'" id="chat_history_'+to_user_id+'">';
        modal_content += fetch_user_chat_history(to_user_id);
        modal_content += '</div>';
        modal_content += '<div class="form-group">';
        modal_content += '<textarea name="chat_message_'+to_user_id+'" id="chat_message_'+to_user_id+'" class="form-control"></textarea>';
        modal_content += '</div><div class="form-group" align="right">';
        modal_content+= '<button type="button" name="send_chat" id="'+to_user_id+'" class="btn btn-info send_chat">Send</button></div></div>';
        $(modal_content).appendTo('#user_model_details');
    }

    $(document).on('click', '.start_chat', function(){
        var to_user_id = $(this).data('touserid');
        let to_user_name = $(this).data('tousername');
        make_chat_dialog_box(to_user_id, to_user_name);
        $("#user_dialog_"+to_user_id).dialog({
            autoOpen:false,
            width:400
        });
        $('#user_dialog_'+to_user_id).dialog('open');

        let channel = pusher.subscribe('private-chatbox_'+to_user_id);
        channel.bind('MessageSend', function(data) {
            let to_user_id = $('.send_chat').attr('id');
            console.log(JSON.stringify(data));
            data.message = data.message.message;
            data.username = data.user.name;
            let today = new Date;
            data.updated_at = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate() + ' '+ today.getHours()+ ':'+ today.getMinutes()+ ':' + today.getSeconds();
            $('#messageTmpl').tmpl(data).appendTo('#chat_history_'+to_user_id);
            $('#chat_history_'+to_user_id).scrollTop($('#chat_history_'+to_user_id)[0].scrollHeight);
        });
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.send_chat', function() {
        let to_user_id = $(this).attr('id');
        let chat_message = $('#chat_message_' + to_user_id).val();
        $.post("/sendMessage",
            {to_user_id:to_user_id,  message:chat_message},
            (data) => {
                console.log(data);
                $('#chat_message_'+to_user_id).val('');
            })
    });

    function fetch_user_chat_history(to_user_id)
    {
        $.post("/fetchMessages",
            {to_user_id:to_user_id},
            (data) => {
                console.log(data);
                let html = $('#messageTmpl').tmpl(data);
                $('#chat_history_'+to_user_id).html(html).scrollTop($('#chat_history_'+to_user_id)[0].scrollHeight);
            });
    }

    $(document).on('click', '.ui-button-icon', function(){
        $('.user_dialog').dialog('destroy').remove();
    });
});
