function subscribe(userTo, userFrom, button) {
    $.post("ajax/subscribe.php")
        .done(function () {
            console.log(" done")
        })
}