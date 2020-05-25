$(document).ready(function () {
    $('.navShowHide').on('click', function () {
        let nav = $('#sideNavContainer');
        let main = $('#mainSectionContainer');

        if (main.hasClass("leftPadding")) {
            nav.hide();
        } else {
            nav.show();
        }

        main.toggleClass('leftPadding')

    })
})