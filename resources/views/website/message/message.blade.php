
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Sandwip Network Toolkit</title>
        @include('website.includes.website-header_script')
    </head>
    <body>
        <div class="theme-layout">

            <!--<div class="se-pre-con"></div>-->

            @include('website.includes.website-navbar')

            {{-- Profile Section Yield --}}

            <section>
                <div class="gap gray-bg">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row" id="page-contents">

                                    @include('website.includes.website-left_sidebar')

                                    <div class="col-lg-6">
                                        {{-----------------message section START-------------------------------}}
                                        <div class="chat-list">

                                        </div>

                                        <div id="message-box" class="message-box" style="display: none;"> <!-- Hide initially -->
                                            <div class="message-header">
                                                <span id="user-name">User 1</span>
                                                <button id="close-box">X</button>
                                            </div>
                                            <div class="message-body">
                                                <div class="messages">
                                                    <!-- Messages will appear here -->
                                                </div>
                                                <!-- Message input and send button -->
                                                <form id="send-message-form">
                                                    @csrf
                                                    <input type="hidden" id="receiver-id"> <!-- Hidden input for the receiver ID -->
                                                    <input type="text" id="message-input" placeholder="Type a message">
                                                    <button type="submit" id="send-button">Send</button> <!-- Send button -->
                                                </form>
                                            </div>
                                        </div>

                                        {{-----------------message section END-------------------------------}}
                                    </div>

{{--                                    @include('website.includes.website-right_sidebar')--}}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>



            @include('website.includes.website-footer')

            @include('website.includes.website-offcanvas')

            @include('website.includes.website-footer_script')

        </div>

    </body>


    <script>
        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

             const userId = {{userId()}};

            loadMessageList();

            // Load the user network list
            function loadMessageList() {


                console.log("Load Message list :");
                $.ajax({
                    url: `/message_list`, // Correct URL to include userId
                    type: 'GET',
                    success: function (response) {
                        console.log("come response :"+ response);
                        const networks = response.data;
                        console.log(networks);

                        $('.chat-list').empty();  // Modified: Clear the chat-list instead of #messages-list
                        networks.forEach(function (network) {

                            // Determine the other user in the network
                            const isSender = network.sender && (network.sender.id === userId);
                            const otherUser = isSender ? network.receiver : network.sender;
                            console.log("other user :"+ otherUser);
                            // Ensure otherUser is valid
                            if (otherUser) {
                                const otherUserName = otherUser.name;
                                const otherUserId = otherUser.id;

                                // Append chat item with the other user's ID and name
                                $('.chat-list').append(`
                                <div class="chat btn btn-info " data-user='${otherUserId}'>
                                    ${otherUserName}
                                </div><br>
                            `);  // Modified: Use .chat-list and .chat class for users
                            }
                        });
                    }
                });
            }

            // Handle click event on user to load messages
            $(document).on("click", ".chat", function () {  // Modified: Use .chat class
                var otherId = $(this).data('user');  // Modified: Use data-user instead of data-id
                var otherName = $(this).text();

                console.log('Clicked user ID:', otherId);

                // Display the selected user's name
                $('#user-name').text(otherName);

                loadMessage(otherId);

                // Show the message box (if it's hidden initially)
                $('#message-box').show();  // New: Ensure the message box is visible when clicking a user
            });

            // Load messages for the selected user
            function loadMessage(otherId) {
                $.ajax({
                    url: `/message/${otherId}`,
                    type: "GET",
                    success: function (response) {

                        const messages = response.data;
                        var html = '';

                        messages.forEach(function (message) {
                            const senderName = message.sender.id === userId ? 'You' : message.sender.name;
                            html += `
                            <div class="message">
                                <strong>${senderName}: </strong> ${message.messsge_body}
                            </div>
                        `;  // Modified: Simplified message display in .message class
                        });

                        $('.messages').html(html);  // Modified: Append messages inside .messages container

                        // Set the receiver ID in the input field
                        $('#receiver-id').val(otherId);
                    },
                    error: function (xhr, status, error) {
                        console.log("XHR:", xhr);
                        console.log("Status:", status);
                        console.log("Error:", error);
                    }
                });
            }

            // Send a new message
            $('#send-message-form').on('submit', function (element) {
                element.preventDefault();



                var receiverId = $('#receiver-id').val();
                var messageBody = $('#message-input').val(); // The message from the input field
                var userId = {{userId()}};

                console.log('receiver ID : ' + receiverId + ' sender_id or User_id : '+userId+' message_body : '+ messageBody + "<br>");

                var formData = new FormData();

                formData.append('sender_id', userId);
                formData.append('receiver_id', receiverId);
                formData.append('messsge_body', messageBody);
                for (var pair of formData.entries()) {
                    console.log(pair[0]+ ', ' + pair[1]);
                }
               // console.log("FORM DATA : " + formData);

                $.ajax({
                    url: `/store`,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {

                        console.log('Successfully saved data');

                        // Clear the message input
                        $('#message-input').val('');

                        // Reload the messages to show the new one
                        loadMessage(receiverId);
                    },
                    error: function (error) {
                        console.log("Error: " + error);
                    }
                });
            });

            // Optionally, close the message box
            $('#close-box').on('click', function () {
                $('#message-box').hide();  // New: Hide the message box when clicking the close button
            });

        });
    </script>

</html>
