
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
			@yield("profile-content")

			<section>
				<div class="gap gray-bg">
					<div class="container-fluid">
						<div class="row">
							<div class="col-lg-12">
								<div class="row" id="page-contents">

									@include('website.includes.website-left_sidebar')

									<div class="col-lg-6">
										@yield("content")
									</div>

									@include('website.includes.website-right_sidebar')

								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

{{-----------------message section START-------------------------------}}

            <section id = "for-messages">
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
                            <input type="hidden" id="receiver-id"> <!-- Hidden input for the receiver ID -->
                            <input type="text" id="message-input" placeholder="Type a message">
                            <button type="submit" id="send-button">Send</button> <!-- Send button -->
                        </form>
                    </div>
                </div>
            </section>

        {{-----------------message section END-------------------------------}}

		@include('website.includes.website-footer')

		@include('website.includes.website-offcanvas')

		@include('website.includes.website-footer_script')

    </div>

<script>
    $(document).ready(function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    $(document).on('click' , '.like-button', function(event){
        event.preventDefault();

        console.log("click on like button");
        const postId = $(this).data('post-id');
        console.log(postId);

        $.ajax({
            url: "{{ route('website.post.like') }}",
            type: 'POST',
            data: {
                post_id: postId,
            },

            success: function(response){
                console.log('successfully liked');
                console.log(response);
            },
            error: function(error){
                console.log('Error:', error);
            }
        });
    });

    $(document).on('click' , '.dislike-button', function(event){
        event.preventDefault();

        console.log("click on dislike button");
        const postId = $(this).data('post-id');
        console.log(postId);

        $.ajax({
            url: "{{ route('website.post.dislike') }}",
            type: 'POST',
            data: {
                post_id: postId,
            },

            success: function(response){
                console.log('successfully liked');
                console.log(response);
            },
            error: function(error){
                console.log('Error:', error);
            }
        });
    });

    //-------------------START message part-----------------------------

        const userId = {{ auth()->user()->id }}; // Replace with the actual logged-in user's ID
        console.log(userId);
        // Load the chat list into the dropdown
        loadMessageList(userId);

        function loadMessageList(userId) {
            console.log("User Id :".userId);

            $.ajax({
                url: `/user-network/${userId}`,
                type: 'GET',
                success: function (response) {

                    const networks = response.data;
                    console.log(networks);

                    $('.chat-list').empty(); // Clear the existing chat list

                    networks.forEach(function (network) {

                        // Determine the other user in the network
                        const isSender = network.sender && (network.sender.id === userId);
                        const otherUser = isSender ? network.receiver : network.sender;

                        // Ensure otherUser is valid
                        if (otherUser) {
                            const otherUserName = otherUser.name;
                            const otherUserId = otherUser.id;

                            // Append each chat item to the chat list
                            $('.chat-list').append(`
                            <li>
                                <a href="#" class="chat" data-id="${otherUserId}">
                                    <img src="images/resources/thumb-1.jpg" alt="">
                                    <div class="mesg-meta">
                                        <h6>${otherUserName}</h6>
                                        <span>Last message preview...</span>
                                        <i>2 min ago</i>
                                    </div>
                                </a>
                                <span class="tag green">New</span>
                            </li>
                        `);
                        }

                    });
                }
            });
        }

        // Handle chat click event
        $(document).on("click", ".chat", function (e) {
            e.preventDefault(); // Prevent default anchor behavior

            var otherId = $(this).data('id');
            console.log('Clicked user ID:', otherId);

            // Load messages between the user and the clicked chat
            loadMessage(otherId);

            // Show the message box
            $('#message-box').show();
        });

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
                            <strong>${senderName}:</strong> ${message.message_body}
                        </div>`;
                    });

                    $('.messages').html(html); // Display the messages

                    // Set the receiver ID for sending new messages
                    $('#receiver-id').val(otherId);

                    // Optionally, scroll to the bottom of the message box
                    $('.messages').scrollTop($('.messages')[0].scrollHeight);
                }
            });
        }

        // Handle form submission to send a new message
        $('#send-message-form').on('submit', function (e) {
            e.preventDefault();

            var receiverId = $('#receiver-id').val();
            var messageBody = $('#message-input').val();
            var formData = new FormData();

            formData.append('sender_id', userId);
            formData.append('receiver_id', receiverId);
            formData.append('message_body', messageBody);

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

        // Close the message box
        $('#close-box').on('click', function () {
            $('#message-box').hide();
        });

    });



    //-------------------END message part-----------------------------











</script>




    </body>
</html>
