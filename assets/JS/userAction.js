function subscribe(userTo, userFrom, button) {

    if (userTo == userFrom) {
        alert("you cannot subscribe it yourself");
    } else {
        $.post("ajax/subscribe.php",{userTo:userTo, userFrom:userFrom})
            .done(function (data) {
                console.log(data);
            })
    }
}