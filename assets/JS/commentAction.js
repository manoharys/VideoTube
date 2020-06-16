function postComment(button, postedBy, videoId, replyTo, containerClass) {
    let textarea = $(button).siblings("textarea");
    let commentText = textarea.val();
    //Emptying textarea once btn is clicked
    textarea.val("");

    if (commentText) {
        $.post("ajax/postComment.php", {
                commentText: commentText,
                postedBy: postedBy,
                videoId: videoId,
                responseTo: replyTo
            })
            .done(function (data) {
                console.log(data);
            });
    } else {
        alert("You can't post an empty comment");
    }
}