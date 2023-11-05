function showFlashMessage(message, messageType, divId) {
  console.log(divId);
    var flashContainer = $('#'+divId);
    var messageElement = $('<div>').addClass('flash-message ' + messageType).text(message);
    flashContainer.append(messageElement);

    // Set a timeout to automatically remove the message after a few seconds (optional)
    setTimeout(function() {
        messageElement.fadeOut('slow', function() {
            $(this).remove();
        });
    }, 5000); // Adjust the timeout as needed
}