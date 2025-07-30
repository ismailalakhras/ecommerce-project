$(document).ready(function () {

    let receiverId = null;
    let channelId = null;
    let senderId = $('meta[name="user-id"]').attr("content");
    let onlineUsers = [];
    let currentChannel = null;

    $("#users-list li").click(function () {
        receiverId = $(this).data("id");
        channelId = senderId < receiverId ? senderId + "-" + receiverId : receiverId + "-" + senderId;

        if (currentChannel) {
            currentChannel.unsubscribe();
            currentChannel = null;
            onlineUsers = [];
        }

        currentChannel = subscribeToChannel(channelId);

        $("#users-list li").removeClass("active").css({
            "color": "#494949",
            "font-weight": 400,
            "font-size": "14px"
        });
        $(this).addClass("active").css({
            "color": "#494949",
            "font-weight": 500,
            "font-size": "20px"
        });

        $("#chat-container").show();
        $("#chat-footer-x").show();
        $("#chat-header-x").show();

        $("#chat-header").text("Chat with " + $(this).text());
        $("#chat-container").removeClass("scroll");

        updateReceiverStatus();
        loadMessages();
    });

    $("#send").click(function () {
        $("#chat-container").addClass("scroll");

        let message = $("#message").val();
        if (message.trim() !== "" && receiverId) {
            $.post("/send-message", {
                receiver_id: receiverId,
                message: message
            }, function () {
                $("#message").val("");
            });
        }
    });


    window.Echo.join("presence-global-chat")
        .here((users) => {
            console.log(channelId);

            onlineUsers = users;
            updateReceiverStatus();
            users.forEach(user => updateUserStatus(user.id, true));
        })
        .joining((user) => {
            onlineUsers.push(user);
            updateReceiverStatus();
            updateUserStatus(user.id, true);
        })
        .leaving((user) => {
            onlineUsers = onlineUsers.filter(u => u.id !== user.id);
            updateReceiverStatus();
            updateUserStatus(user.id, false);
        })



    //! subscribe to channel function
    function subscribeToChannel(channelId) {
        return window.Echo.join("presence-chat-channel." + channelId)
            .listen(".new-message", function (data) {
                if (data.message.receiver_id == senderId || data.message.sender_id == senderId) {

                    let userName = data.message.sender.name ?? "Unknown";

                    const rightMessage = $(`<div class="chat-content-rightside chat-msg-animate ">
                            <div class="d-flex ms-auto">
                                <div class="flex-grow-1 me-2">
                                    <p class="mb-0 chat-time text-end">you,${formatTime(data.message.created_at)}</p>
                                    <p class="chat-right-msg">${data.message.message}</p>
                                </div>
                            </div>
                        </div>`);

                    const leftMessage = $(`
                        <div class="chat-content-leftside chat-msg-animate">
                            <div class="d-flex" >
                                <img src="${data.message.sender.avatar}" width="48" height="48" class="rounded-circle" alt="" />
                                <div class="flex-grow-1 ms-2">
                                    <p class="mb-0 chat-time">${userName}, ${formatTime(data.message.created_at)}</p>
                                    <p class="chat-left-msg">${data.message.message}</p>
                                </div>
                            </div>
                        </div>
                    `);

                    if (data.message.sender_id == senderId) {
                        $("#chat-box").append(rightMessage);
                        setTimeout(() => rightMessage.addClass("show"), 20);
                    } else {
                        $("#chat-box").append(leftMessage);
                        setTimeout(() => leftMessage.addClass("show"), 20);
                    }
                    $("#chat-container").scrollTop($("#chat-container")[0].scrollHeight);
                }
            });
    }


    //! load messages function
    function loadMessages() {
        if (!receiverId) return;
        $.get("/messages/" + receiverId, function (data) {
            $("#chat-box").html("");
            data.forEach(msg => {
                let userName = msg.sender_name ?? "Unknown";
                let avatar = msg.avatar ?? "Unknown";

                if (msg.sender_id == senderId) {
                    $("#chat-box").append(`
                        <div class="chat-content-rightside">
                            <div class="d-flex ms-auto">
                                <div class="flex-grow-1 me-2">
                                    <p class="mb-0 chat-time text-end">you,${formatTime(msg.created_at)}</p>
                                    <p class="chat-right-msg">${msg.message}</p>
                                </div>
                            </div>
                        </div>`);
                } else {
                    $("#chat-box").append(`
                        <div class="chat-content-leftside">
                            <div class="d-flex">
                                <img src="${avatar}" width="48" height="48" class="rounded-circle" alt="" />
                                <div class="flex-grow-1 ms-2">
                                    <p class="mb-0 chat-time">${userName}, ${formatTime(msg.created_at)}</p>
                                    <p class="chat-left-msg">${msg.message}</p>
                                </div>
                            </div>
                        </div>`);
                }
            });
            $("#chat-container").scrollTop($("#chat-container")[0].scrollHeight);
        });
    }

    //! format time function
    function formatTime(timestamp) {
        let time = new Date(timestamp);
        return time.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    }

    //! update user status in sidebar function
    function updateUserStatus(userId, isOnline) {
        const $element = $(`[data-id="onlineOffline-${userId}"]`);
        if ($element.length === 0) return;
        $element.toggleClass('online-user-chat', isOnline);
        $element.toggleClass('offline-user-chat', !isOnline);
    }

    //! update user status in head of chat function
    function updateReceiverStatus() {
        if (!receiverId) return;
        const isOnline = onlineUsers.some(user => user.id === receiverId);
        $("#onlineOffline").toggleClass("chart-online", isOnline);
        $("#onlineOffline").toggleClass("chart-offline", !isOnline);
        $("#onlineOfflineText").html(isOnline
            ? "<small id='onlineOffline' class='bx bxs-circle me-1 chart-online'></small>Active Now"
            : "<small id='onlineOffline' class='bx bxs-circle me-1 chart-offline'></small>Offline");
    }

});
