$(function () {
    let receiverId = 1;
    let channelId = null;
    let senderId = $('meta[name="user-id"]').attr("content");
    let currentChannel = null;


    $('#support-btn').on('click', function () {
        $('#chatAside').css("right", 0)
        $('#support-btn').hide()
    })

    $('.close-btn').on('click', function () {
        $('#chatAside').css("right", "-400px")
        $('#support-btn').show()

    })


    //! fetch  messages when click on support button
    $("#support-btn").click(function () {
        $("#chatBody").removeClass("scroll");

        channelId = senderId < receiverId ? senderId + "-" + receiverId : receiverId + "-" + senderId;

        if (currentChannel) {
            window.Echo.leave("presence-chat-channel." + channelId);
            currentChannel = null;
        }

        currentChannel = subscribeToChannel(channelId);

        loadMessages();

    });
    
    //! send messages when click Enter
    $('#frontend-input-message').on('keydown', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            $("#chatBody").addClass("scroll");

            let message = $("#frontend-input-message").val();


            if (!senderId || !receiverId) return;

            if (message.trim() !== "" && receiverId) {
                $.post("/send-message", {
                    sender_id: senderId,
                    receiver_id: receiverId,
                    message: message
                }, function () {
                    $("#frontend-input-message").val("");
                });
            }
        }

    })


    //! subscribe to channel function
    function subscribeToChannel(channelId) {

        return window.Echo.join("presence-chat-channel." + channelId)

            .listen(".new-message", function (data) {
                if (data.message.receiver_id == senderId || data.message.sender_id == senderId) {

                    let userName = data.message.sender.name ?? "Unknown";

                    const rightMessage = $(`<div class="message-group user">
                            <div class="message-content">
                                <div class="meta">you,${formatTime(data.message.created_at)}</div>
                                <div class="message-bubble">${data.message.message}</div>
                            </div>
                        </div>`);



                    const leftMessage = $(`
                       <div class="message-group">
                        <div class="avatar">
                            <img src="/${data.message.sender.avatar}" alt="avatar">
                        </div>
                        <div class="message-content">
                            <div class="meta">${userName}, ${formatTime(data.message.created_at)}</div>
                            <div class="message-bubble">${data.message.message}</div>
                        </div>
                    </div>
                    `);



                    if (data.message.sender_id == senderId) {
                        $("#frontend-chat-box").append(rightMessage);
                        setTimeout(() => rightMessage.addClass("show"), 20);
                    } else {
                        $("#frontend-chat-box").append(leftMessage);
                        setTimeout(() => leftMessage.addClass("show"), 20);
                    }
                    $("#chatBody").scrollTop($("#chatBody")[0].scrollHeight);
                }
            });

    }


    //! load messages function
    function loadMessages() {

        if (!senderId || !receiverId) return;
        $.get("/messages/" + receiverId, function (data) {
            data.forEach(msg => {
                let userName = msg.sender_name ?? "Unknown";
                let avatar = msg.avatar ?? "Unknown";

                if (msg.sender_id == senderId) {
                    $("#frontend-chat-box").append(`
                       <div class="message-group user">
                            <div class="message-content">
                                <div class="meta">you,${formatTime(msg.created_at)}</div>
                                <div class="message-bubble">${msg.message}</div>
                            </div>
                        </div>`);



                } else {
                    $("#frontend-chat-box").append(`
                        <div class="message-group">
                        <div class="avatar">
                            <img src="/${avatar}" alt="avatar">
                        </div>
                        <div class="message-content">
                            <div class="meta">${userName}, ${formatTime(msg.created_at)}</div>
                            <div class="message-bubble">${msg.message}</div>
                        </div>
                    </div>`);

                }
            });
            $("#chatBody").scrollTop($("#chatBody")[0].scrollHeight);
        });
    }




    //! format time function
    function formatTime(timestamp) {
        let time = new Date(timestamp);
        return time.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    }

    window.Echo.join("presence-global-chat")

})




